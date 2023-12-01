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
        // $cashflow = $this->get_cashflow();
        // $users = $this->get_users();
        // $products = $this->get_products();
        // $products_price_log = $this->get_products_price_log();
        // $tr_receive = $this->get_tr_receive();
        // $tr_receive_detail = $this->get_tr_receive_detail();
        // $tr_transaction = $this->get_tr_transaction();
        $tr_transaction_detail = $this->get_tr_transaction_detail();
        dd($tr_transaction);
        // return view('sync-data.index', compact('cashflow'));
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

    private function get_cashflow()
    {
        $tbl_name = 'cash_flow';
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 25;
        $get_data   = $query->limit($limit_perbatch)->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $header     = $this->get_cashflow_header();
            $convert_data   = $this->convert_cashflow($get_data);
            $insert_data    = $this->insert_cashflow($header, $convert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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
            $description = trim(preg_replace('/\s+/', ' ', $cf->description));
            $curr_data  = [$cf->date, $cf->time, $cf->employee_id, $cf->categories, $description, $cf->approval, $cf->cash,$cf->created_by, $cf->created_at];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_CASH_FLOW VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
            // if ($cf->id == 46) { dd($data_string); }
            $data[]     = $data_string;
        }

        return $data;
    }

    private function insert_cashflow($header, $data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "INSERT ALL ".$implode_data." SELECT 1 FROM dual";
        return $query;
    }

    private function get_users()
    {
        $tbl_name = 'users';
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_users($get_data);
            $insert_data    = $this->insert_users($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_users($arr_users)
    {
        $data = [];
        foreach ($arr_users as $cf) {
            $curr_data  = [$cf->employee_id, $cf->name, $cf->email, $cf->pin,$cf->status];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_USERS VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_products($get_data);
            $insert_data    = $this->insert_products($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_products($arr_products)
    {
        $data = [];
        foreach ($arr_products as $cf) {
            $name = $this->clean($cf->name);
            $curr_data  = [$cf->code, $cf->price_store, $cf->price_olshop, $cf->discount_store, $cf->discount_olshop, $cf->is_vat, $cf->is_active, $cf->deleted_at, $name, $cf->categories, $cf->supplier_id];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_PRODUCTS VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_products_price_log($get_data);
            $insert_data    = $this->insert_products_price_log($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_products_price_log($arr_products_price_log)
    {
        $data = [];
        foreach ($arr_products_price_log as $cf) {
            $curr_data  = [$cf->product_code, $cf->price_store, $cf->price_olshop, $cf->discount_store, $cf->discount_olshop, $cf->is_vat, $cf->created_at];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_PRODUCTS_PRICE_LOG VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_receive($get_data);
            $insert_data    = $this->insert_tr_receive($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_tr_receive($arr_tr_receive)
    {
        $data = [];
        foreach ($arr_tr_receive as $cf) {
            $delivery_no = $this->clean($cf->delivery_no);
            $curr_data  = [$cf->receive_code, $cf->receive_date, $cf->receive_time, $delivery_no, $cf->supplier_code, $cf->plate_no, $cf->driver, $cf->driver_phone, $cf->is_warehouse, $cf->created_by, $cf->created_at];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_RECEIVE VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_receive_detail($get_data);
            $insert_data    = $this->insert_tr_receive_detail($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_tr_receive_detail($arr_tr_receive_detail)
    {
        $data = [];
        foreach ($arr_tr_receive_detail as $cf) {
            $curr_data  = [$cf->receive_code, $cf->product_code, $cf->quantity, $cf->unit_price, $cf->amount];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_RECEIVE_DETAIL VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_transaction($get_data);
            $insert_data    = $this->insert_tr_transaction($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_tr_transaction($arr_tr_transaction)
    {
        $data = [];
        foreach ($arr_tr_transaction as $cf) {
            $receipt_no = $this->clean($cf->receipt_no);
            $curr_data  = [$cf->invoice_no, $receipt_no, $cf->emp_no, $cf->trans_date, $cf->payment_method, $cf->cash, $cf->sub_price, $cf->vat_ppn, $cf->total_price, $cf->status, $cf->cancellation_reason, $cf->created_at, $cf->kembalian];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_TRANSACTION VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch', 'last_id_data')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            // $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
            $query->where('id', '>', $last_sync->last_id_data);
        } else {
            // $query->where('created_at', '<=', $current_time);
            // $query->whereDate('created_at', '2023-10-21');
        }
        // $query->whereDate('created_at', '2023-10-21');
        $limit_perbatch = 0;
        if ($limit_perbatch > 0) {
            $query->limit($limit_perbatch);
        }
        $get_data   = $query->get();
        $url = "";
        $batch = 0;
        $status = "";
        if (count($get_data) > 0) {
            $total_data = count($get_data);
            $convert_data   = $this->convert_tr_transaction_detail($get_data);
            $insert_data    = $this->insert_tr_transaction_detail($convert_data);
            dd($insert_data);
            $last_id_data   = $get_data[$total_data - 1]->id;
            $arr_local_ip = [
                "103.209",
            ];
            $visitor = $this->get_client_ip();
            // $explode_visitor = explode(".", $visitor);
            // $ip = $explode_visitor[0].".".$explode_visitor[1];
            $url = "http://10.137.26.67:8080/";
            // if (!in_array($ip, $arr_local_ip)) {
                // $url = "http://103.209.6.32:8080/";
            // }
            // echo "<pre/>";print_r($insert_data);exit;
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

    private function convert_tr_transaction_detail($arr_tr_transaction_detail)
    {
        $data = [];
        foreach ($arr_tr_transaction_detail as $cf) {
            $curr_data  = [$cf->invoice_no, $cf->product_code, $cf->quantity, $cf->basic_price, $cf->discount, $cf->price];
            // $curr_data  = [$cf->id, $cf->date, $cf->time, $cf->employee_id];

            $implode    = implode("|", $curr_data);
            $data_string = "INTO POS_TR_TRANSACTION_DETAIL VALUES (".$cf->id.",'".str_replace("|", "', '", $implode)."')";
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

    public function clean($string) {
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = str_replace('-', ' ', $string);
        return $string; // Removes special chars.
    }
}
