<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Http;

class SyncDataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $cashflow = $this->get_cashflow();
        $users = $this->get_users();
        $products = $this->get_products();
        $products_price_log = $this->get_products_price_log();
        $tr_receive = $this->get_tr_receive();
        $tr_receive_detail = $this->get_tr_receive_detail();
        $tr_transaction = $this->get_tr_transaction();
        $tr_transaction_detail = $this->get_tr_transaction_detail();
        $tr_adjust_stock = $this->get_tr_adjust_stock();

        $data = [
            "cashflow"  => $cashflow,
            "users"     => $users,
            "products"     => $products,
            "products_price_log"     => $products_price_log,
            "tr_receive"     => $tr_receive,
            "tr_receive_detail"     => $tr_receive_detail,
            "tr_transaction"     => $tr_transaction,
            "tr_transaction_detail"     => $tr_transaction_detail,
            "tr_adjust_stock"     => $tr_adjust_stock,
        ];
        return view('sync-data.index', compact('data'));
    }

    private function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else if(isset($_SERVER['REMOTE_HOST']))
            $ipaddress = $_SERVER['REMOTE_HOST'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private function get_lastdata_brs($tablename)
    {
        $tablename = "POS_".strtoupper($tablename);
        $url = "http://103.209.6.32:8080/meatmaster/api/pos";
        // dd($url);
        $options = [
            'Accept' => 'application/json',
        ];
        $response = Http::get($url, ['tablename' => $tablename], $options);
        $result = json_decode($response->getBody()->getContents());

        return $result;
    }

    private function get_cashflow()
    {
        $tbl_name           = 'cash_flow';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data     = count($get_data);
            $header         = $this->get_cashflow_header();
            $convert_data   = $this->convert_cashflow($get_data);
            $insert_data    = $this->insert_cashflow($header, $convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            // dd($url);
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function get_cashflow_header()
    {
        // return "('ID', 'TGL', 'WAKTU', 'EMPLOYEE_ID', 'CATEGORIES', 'DESCRIPTION', 'DESCRIPTION', 'APPROVAL', 'CASH', 'CREATED_AT')";
        return "('ID', 'TGL', 'WAKTU', 'EMPLOYEE_ID')";
    }

    private function convert_cashflow($arr_cashflow)
    {
        $data = [];
        foreach ($arr_cashflow as $cf) {
            $cf->description = substr($cf->description, 0, 50);
            $description = $this->clean(trim(preg_replace('/\s+/', ' ', $cf->description)));
            $curr_data  = [$this->stringfy($cf->plant), $this->convertDate('date', $cf->date), $this->convertDate('time', $cf->time), $this->stringfy($cf->employee_id), $this->cd_code('cashflow', $cf->categories), $this->stringfy($description), $this->stringfy($cf->approval), $cf->cash, $this->stringfy($cf->created_by), $this->convertDate('datetime', $cf->created_at)];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_CASH_FLOW VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_cashflow($header, $data)
    {
        $implode_data = implode(" ", $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_users()
    {
        $tbl_name = 'users';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_users($get_data);
            $insert_data    = $this->insert_users($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_users($arr_users)
    {
        $data = [];
        foreach ($arr_users as $cf) {
            $curr_data  = [$this->stringfy($cf->plant), $this->stringfy($cf->employee_id), $this->stringfy($cf->name), $this->stringfy($cf->email), $this->stringfy($cf->pin), $this->stringfy($cf->status)];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_USERS VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_users($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_products()
    {
        $tbl_name = 'products';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_products($get_data);
            $insert_data    = $this->insert_products($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_products($arr_products)
    {
        $data = [];
        foreach ($arr_products as $cf) {
            $name = $this->clean($cf->name);
            $curr_data  = [$this->stringfy($cf->code), !empty($cf->price_store) ? $cf->price_store : 0, !empty($cf->price_olshop) ? $cf->price_olshop : 0, !empty($cf->discount_store) ? $cf->discount_store : 0, !empty($cf->discount_olshop) ? $cf->discount_olshop : 0, $cf->is_vat, $cf->is_active, $this->convertDate('datetime', $cf->deleted_at), $this->stringfy($name), $this->cd_code('products', $cf->categories)];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_PRODUCTS VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_products($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_products_price_log()
    {
        $tbl_name = 'products_price_log';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_products_price_log($get_data);
            $insert_data    = $this->insert_products_price_log($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_products_price_log($arr_products_price_log)
    {
        $data = [];
        foreach ($arr_products_price_log as $cf) {
            $curr_data  = [$this->stringfy($cf->plant), $this->stringfy($cf->product_code), !empty($cf->price_store) ? $cf->price_store : 0, !empty($cf->price_store) ? $cf->price_store : 0, !empty($cf->discount_store) ? $cf->discount_store : 0,  !empty($cf->discount_olshop) ? $cf->discount_olshop : 0, !empty($cf->is_vat) ? $cf->is_vat : 0, $this->convertDate('datetime',$cf->created_at)];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_PRODUCTS_PRICE_LOG VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_products_price_log($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_tr_receive()
    {
        $tbl_name = 'tr_receive';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_receive($get_data);
            $insert_data    = $this->insert_tr_receive($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_tr_receive($arr_tr_receive)
    {
        $data = [];
        foreach ($arr_tr_receive as $cf) {
            $delivery_no = $this->clean($cf->delivery_no);
            $curr_data  = [$this->stringfy($cf->plant), $this->stringfy($cf->receive_code), $this->convertDate('date', $cf->receive_date), $this->convertDate('time', $cf->receive_time), $this->stringfy($delivery_no), $this->stringfy($cf->supplier_code), $this->stringfy($cf->plate_no), $this->stringfy($cf->driver), $this->stringfy($cf->driver_phone), $this->stringfy($cf->is_warehouse), $this->stringfy($cf->created_by), $this->convertDate('datetime', $cf->created_at)];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_RECEIVE VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_tr_receive($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_tr_receive_detail()
    {
        $tbl_name = 'tr_receive_detail';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_receive_detail($get_data);
            $insert_data    = $this->insert_tr_receive_detail($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_tr_receive_detail($arr_tr_receive_detail)
    {
        $data = [];
        foreach ($arr_tr_receive_detail as $cf) {
            $curr_data  = [$this->stringfy($cf->plant), $this->stringfy($cf->receive_code), $this->stringfy($cf->product_code), $cf->quantity, $cf->unit_price, $cf->amount];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_RECEIVE_DETAIL VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_tr_receive_detail($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_tr_transaction()
    {
        $tbl_name = 'tr_transaction';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data)->whereNull('deleted_at')->where('status', 'FINISH');
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_transaction($get_data);
            $insert_data    = $this->insert_tr_transaction($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_tr_transaction($arr_tr_transaction)
    {
        $data = [];
        foreach ($arr_tr_transaction as $cf) {
            $receipt_no = $this->clean($cf->receipt_no);
            $cl_cash = $this->clean(trim(preg_replace('/\s+/', ' ', $cf->cash)));
            $curr_data  = [$this->stringfy($cf->plant), $this->stringfy($cf->invoice_no), $this->stringfy($receipt_no), $this->stringfy($cf->emp_no), $this->convertDate('date', $cf->trans_date), $this->cd_code('transaction_pm', $cf->payment_method), !empty($cl_cash) ? $cl_cash : 0, !empty($cf->sub_price) ? $cf->sub_price : 0, !empty($cf->vat_ppn) ? $cf->vat_ppn : 0,  !empty($cf->total_price) ? $cf->total_price : 0, $this->cd_code('transaction', $cf->status), $this->stringfy($cf->cancellation_reason), $this->convertDate('datetime', $cf->created_at), $cf->kembalian, $cf->is_isales];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_TRANSACTION VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_tr_transaction($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_tr_transaction_detail()
    {
        $tbl_name = 'tr_transaction_detail';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_transaction_detail($get_data);
            $insert_data    = $this->insert_tr_transaction_detail($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_tr_transaction_detail($arr_tr_transaction_detail)
    {
        $data = [];
        foreach ($arr_tr_transaction_detail as $cf) {
            $curr_data  = [$this->stringfy($cf->plant), $this->stringfy($cf->invoice_no), $this->stringfy($cf->product_code), $cf->quantity, $cf->basic_price, $cf->discount, $cf->price];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_TRANSACTION_DETAIL VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }
    

    private function insert_tr_transaction_detail($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_tr_adjust_stock()
    {
        $tbl_name = 'tr_adjust_stock';
        $lastdata_brs       = $this->get_lastdata_brs($tbl_name);
        $last_id_data        = 0;
        if (!empty($lastdata_brs->data)) {
            $last_id_data    = $lastdata_brs->data->ID;
        }

        $query      = DB::table($tbl_name)->select('*');
        $query->where('id', '>', $last_id_data);
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_adjust_stock($get_data);
            $insert_data    = $this->insert_tr_adjust_stock($convert_data);
            $url = "http://103.209.6.32:8080/";
            $url .= 'meatmaster/api/pos';
            $options = [
                'Accept' => 'application/json',
            ];
            $response = Http::post($url, [
                'query' => $insert_data
            ], $options);
            $return_data = json_decode($response->getBody()->getContents());
            $status = $return_data->status;
            if ($return_data->status == 'success') {
                $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;
                $insert_logs = DB::table('logs_sync_cms')->insert([
                    "table_name"    => $tbl_name,
                    "batch"         => $batch,
                    "last_id_data"  => $last_id_data,
                    "created_at"    => date('Y-m-d H:i:s'),
                    "updated_at"    => date('Y-m-d H:i:s')
                ]);
            }
        }
        
        return ["url" => $url, "data" => $get_data, "status" => $status, "batch" => $batch];
    }

    private function convert_tr_adjust_stock($arr_tr_adjust_stock)
    {
        $data = [];
        foreach ($arr_tr_adjust_stock as $cf) {
            $cf->remark = substr($cf->remark, 0, 255);
            $remark = $this->stringfy($this->clean(trim(preg_replace('/\s+/', ' ', $cf->remark))));
            $curr_data  = [$this->stringfy($cf->plant), $this->convertDate('date',$cf->date), $this->convertDate('time', $cf->time), $this->stringfy($cf->employee_id), $this->stringfy($cf->product_code), $this->cd_code('adjust_stock', $cf->type), $cf->qty, $remark, $this->stringfy($cf->approval), $this->convertDate('datetime', $cf->created_at)];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_ADJUST_STOCK VALUES (".$cf->id.",".str_replace("|", ", ", $implode).")";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }
    

    private function insert_tr_adjust_stock($data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    public function clean($string) {
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = str_replace('-', ' ', $string);
        return $string; // Removes special chars.
    }

    public function stringfy($string) {
        return "'".$string."'";
    }

    public function convertDate($type,$string) {
        if (empty($string)) {
            return "''";
        }

        if ($type == 'datetime') {
            return "'".date('Ymd His', strtotime($string))."'";
        } elseif ($type == 'date') {
            return "'".date('Ymd', strtotime($string))."'";
        } elseif ($type == 'time') {
            return "'".date('His', strtotime($string))."'";
        }
    }

    public function cd_code($table, $code) {
        if ($table == 'cashflow') {
            if ($code == 'MDL-IN') { return "'01'"; }
            elseif ($code == 'MDL-OUT') { return "'02'"; }
            elseif ($code == 'IN') { return "'03'"; }
            elseif ($code == 'OUT') { return "'04'"; }
            elseif ($code == 'STR') { return "'05'"; }
            elseif ($code == 'OUT-BANK') { return "'06'"; }
            elseif ($code == 'IN-BANK') { return "'07'"; }
        } elseif ($table == 'products') {
            if ($code == 'Internal') { return "'01'"; }
            elseif ($code == 'External') { return "'02'"; }
        } elseif ($table == 'transaction') {
            if ($code == 'DRAFT') { return "'01'"; }
            elseif ($code == 'FINISH') { return "'02'"; }
        } elseif ($table == 'transaction_pm') {
            if ($code == 'Tunai') { return "'01'"; }
            elseif ($code == 'EDC - BCA') { return "'02'"; }
            elseif ($code == 'EDC - QRIS') { return "'03'"; }
        } elseif ($table == 'adjust_stock') {
            if ($code == 'IN') { return "'01'"; }
            elseif ($code == 'OUT') { return "'02'"; }
        }
        elseif ($table == 'internal_sales') {
            if ($code == 'Customer') { return "'0'"; }
            elseif ($code == 'Internal Sales') { return "'1'"; }
        }
    }
}
