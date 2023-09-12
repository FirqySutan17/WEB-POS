<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:RS Show', ['only' => 'report_stock']);
        $this->middleware('permission:RT Show', ['only' => 'report_transaction']);
    }
    
    /* START REPORT TRANSACTION */
        public function report_stock(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data = $this->get_stock($sdate, $edate, $search);
            }
            return view('admin.report.stock', compact('data', 'sdate', 'edate', 'search'));
        }

        public function report_stock_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data = $this->get_stock($sdate, $edate, $search);
            }
            return Excel::download(new StockExport($data), 'stock.xlsx');
        }

        public function report_stock_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data = $this->get_stock($sdate, $edate, $search);
            }
            $pdf = PDF::loadview('exports/stock',['data'=>$data]);
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        private function get_stock($sdate, $edate, $search) {
            $where = empty($search) ? "" : " AND (products.code LIKE '%".$search."%' OR products.name LIKE '%".$search."%')";
            $query = "
                SELECT 
                    products.code, 
                    products.name,
                    (
                        COALESCE(
                            (
                                SELECT SUM(rc_detail.quantity)
                                FROM tr_receive_detail AS rc_detail
                                INNER JOIN tr_receive AS rc ON rc_detail.receive_code = rc.receive_code
                                WHERE rc.receive_date < '$sdate' AND rc_detail.product_code = products.code
                                GROUP BY rc_detail.product_code
                            ), 0
                        ) - COALESCE(
                            (
                                SELECT SUM(trans_detail.quantity)
                                FROM tr_transaction_detail AS trans_detail
                                INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                                WHERE trans.trans_date < '$sdate' AND trans_detail.product_code = products.code
                                GROUP BY trans_detail.product_code
                            ), 0
                        )
                    ) AS qty_begin,
                    COALESCE(
                        (
                            SELECT SUM(rc_detail.quantity)
                            FROM tr_receive_detail AS rc_detail
                            INNER JOIN tr_receive AS rc ON rc_detail.receive_code = rc.receive_code
                            WHERE (rc.receive_date BETWEEN '$sdate' AND '$edate') AND rc_detail.product_code = products.code
                            GROUP BY rc_detail.product_code
                        ), 0
                    ) AS qty_in,
                    COALESCE(
                        (
                            SELECT SUM(trans_detail.quantity)
                            FROM tr_transaction_detail AS trans_detail
                            INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                            WHERE (trans.trans_date BETWEEN '$sdate' AND '$edate') AND trans_detail.product_code = products.code
                            GROUP BY trans_detail.product_code
                        ), 0
                    ) AS qty_out,
                    (
                        COALESCE(
                            (
                                SELECT SUM(rc_detail.quantity)
                                FROM tr_receive_detail AS rc_detail
                                INNER JOIN tr_receive AS rc ON rc_detail.receive_code = rc.receive_code
                                WHERE rc.receive_date <= '$edate' AND rc_detail.product_code = products.code
                                GROUP BY rc_detail.product_code
                            ), 0
                        ) - COALESCE(
                            (
                                SELECT SUM(trans_detail.quantity)
                                FROM tr_transaction_detail AS trans_detail
                                INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                                WHERE trans.trans_date <= '$edate' AND trans_detail.product_code = products.code
                                GROUP BY trans_detail.product_code
                            ), 0
                        )
                    ) AS qty_end
                FROM products
                WHERE deleted_at IS NULL ".$where."
                ORDER BY products.name ASC, products.code ASC       
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }
    /* END REPORT TRANSACTION */

    /* START REPORT TRANSACTION */

        public function report_transaction_by_date(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data = $this->get_transaction($sdate, $edate, $search);
            }
            return view('admin.report.transaction', compact('data', 'sdate', 'edate', 'search'));
        }

        public function report_transaction_by_date_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data = $this->get_transaction($sdate, $edate, $search);
            }
            return Excel::download(new ReportExport($data, 'transaction'), 'transaction.xlsx');
        }
    
        public function report_transaction_by_date_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data = $this->get_transaction($sdate, $edate, $search);
            }
            $pdf = PDF::loadview('exports/transaction',['data'=>$data]);
            return $pdf->stream();

            
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_transaction_by_invoice(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $order_by = "ORDER BY trans.trans_date DESC, trans.invoice_no ASC, trans_detail.product_code ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search);
                $data     = $this->convert_transaction_by_invoice($data_raw);
                // dd($data_converted);
            }


            return view('admin.report.transactioninvoice', compact('data', 'sdate', 'edate', 'search'));
        }

        public function report_transaction_by_invoice_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $order_by = "ORDER BY trans.trans_date DESC, trans.invoice_no ASC, trans_detail.product_code ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search);
                $data     = $this->convert_transaction_by_invoice($data_raw);
            }
            return Excel::download(new ReportExport($data, 'transactioninvoice'), 'transactioninvoice.xlsx');
        }
    
        public function report_transaction_by_invoice_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $order_by = "ORDER BY trans.trans_date DESC, trans.invoice_no ASC, trans_detail.product_code ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search);
                $data     = $this->convert_transaction_by_invoice($data_raw);
            }
            $pdf = PDF::loadview('exports/transactioninvoice',['data'=>$data])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return view('exports.transactioninvoice', compact('data'));
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_transaction_by_product(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search = "";
            $categories = "ALL";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $order_by = "ORDER BY trans.trans_date DESC, trans_detail.product_code ASC, trans.invoice_no ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "", $categories);
                $data     = $this->convert_transaction_by_product($data_raw);
            }
            return view('admin.report.transactionproduct', compact('data', 'sdate', 'edate', 'search', 'categories'));
        }

        public function report_transaction_by_product_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search = "";
            $categories = "ALL";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $order_by = "ORDER BY trans.trans_date DESC, trans_detail.product_code ASC, trans.invoice_no ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "", $categories);
                $data     = $this->convert_transaction_by_product($data_raw);
            }
            return Excel::download(new ReportExport($data, 'transactionproduct'), 'transactionproduct.xlsx');
        }
    
        public function report_transaction_by_product_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search = "";
            $categories = "ALL";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $order_by = "ORDER BY trans.trans_date DESC, trans_detail.product_code ASC, trans.invoice_no ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "", $categories);
                $data     = $this->convert_transaction_by_product($data_raw);
            }
            $pdf = PDF::loadview('exports/transactionproduct',['data'=>$data])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_transaction_by_cashier(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $order_by = "ORDER BY users.name ASC, trans.trans_date DESC, trans_detail.product_code ASC, trans.invoice_no ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "cashier");
                $data     = $this->convert_transaction_by_cashier($data_raw);
            }
            return view('admin.report.transactioncashier', compact('data', 'sdate', 'edate', 'search'));
        }

        private function get_transaction($sdate, $edate, $search) {
            $where = empty($search) ? "" : " AND (users.name LIKE '%".$search."%' OR users.employee_id LIKE '%".$search."%')";
            $query = "
                SELECT trans.invoice_no, trans.trans_date, trans.payment_method, trans.total_price, users.employee_id, users.name
                FROM tr_transaction trans
                INNER JOIN users ON trans.emp_no = users.employee_id
                WHERE trans.status = 'FINISH' AND trans.trans_date BETWEEN '$sdate' AND '$edate' ".$where."
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function get_transaction_by_invoice($sdate, $edate, $order_by, $search, $by = "", $categories = "") {
            $where = "";
            if (!empty($search)) {
                $where = " AND (users.name LIKE '%".$search."%' OR users.employee_id LIKE '%".$search."%' OR products.name LIKE '%".$search."%' OR products.code LIKE '%".$search."%')";
                if ($by == "cashier") {
                    $where = " AND (users.name LIKE '%".$search."%' OR users.employee_id LIKE '%".$search."%')";
                }
            }
            if (!empty($categories) && $categories != "ALL") {
                $where = " AND products.categories = '".$categories."'";
            }
            $query = "
                SELECT 
                    trans_detail.product_code, products.name as product_name, 
                    trans_detail.quantity, trans_detail.basic_price, trans_detail.discount, trans_detail.price,
                    trans.invoice_no, trans.trans_date, trans.payment_method, trans.total_price, users.name, users.employee_id
                FROM tr_transaction_detail AS trans_detail
                INNER JOIN products ON trans_detail.product_code = products.code
                INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                INNER JOIN users ON trans.emp_no = users.employee_id
                WHERE trans.status = 'FINISH' AND trans.trans_date BETWEEN '$sdate' AND '$edate' ".$where."
                $order_by
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function convert_transaction_by_invoice($data_raw) {
            $data_invoice = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    $invoice_no = $item->invoice_no;
                    if (!array_key_exists($invoice_no, $data_invoice)) {
                        $data_invoice[$invoice_no] = [
                            "invoice_no"    => $invoice_no,
                            "trans_date"    => $item->trans_date,
                            "pic"           => $item->name,
                            "payment_method" => $item->payment_method,
                            "total_price"   => 0,
                            "products"      => []
                        ];
                    }
                    
                    $sub_price = $item->price * $item->quantity;
                    $data_invoice[$invoice_no]["total_price"] += $sub_price;
                    $data_invoice[$invoice_no]["products"][] = [
                        "name"  => $item->product_name,
                        "code"  => $item->product_code,
                        "price"         => $item->price,
                        "basic_price"   => $item->basic_price,
                        "discount"      => $item->discount,
                        "quantity"  => $item->quantity
                    ];
                }
            }
            return $data_invoice;
        }

        private function convert_transaction_by_product($data_raw) {
            $data_product = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    $product_code = $item->product_code;
                    if (!array_key_exists($product_code, $data_product)) {
                        $data_product[$product_code] = [
                            "name"  => $item->product_name,
                            "code"  => $item->product_code,
                            "details" => []
                        ];
                    }
                    $data_product[$product_code]["details"][] = [
                        "invoice_no"    => $item->invoice_no,
                        "trans_date"    => $item->trans_date,
                        "price"         => $item->price,
                        "basic_price"   => $item->basic_price,
                        "discount"      => $item->discount,
                        "quantity"  => $item->quantity
                    ];
                }
            }
            return $data_product;
        }

        private function convert_transaction_by_cashier($data_raw) {
            $data_cashier = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    $employee_id = $item->employee_id;
                    if (!array_key_exists($employee_id, $data_cashier)) {
                        $data_cashier[$employee_id] = [
                            "name"  => $item->name,
                            "code"  => $item->employee_id,
                            "details" => []
                        ];
                    }
                    $data_cashier[$employee_id]["details"][] = [
                        "invoice_no"    => $item->invoice_no,
                        "trans_date"    => $item->trans_date,
                        "total_price"   => $item->total_price,
                        "payment_method"   => $item->payment_method
                    ];
                }
            }
            return $data_cashier;
        }

    /* END REPORT TRANSACTION */

    /* START REPORT RECEIVE */

        public function report_receive_by_date(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            if ($request->_token) {
                // $order_by = "ORDER BY ";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $data_raw = $this->get_receive_by_date($sdate, $edate);
                $data     = $this->convert_receive_by_date($data_raw);
                // dd($data);
            }
            return view('admin.report.receive', compact('data', 'sdate', 'edate'));
        }

        public function report_receive_by_date_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $data_raw = $this->get_receive_by_date($sdate, $edate);
                $data     = $this->convert_receive_by_date($data_raw);
            }
            return Excel::download(new ReportExport($data, 'receive'), 'receive.xlsx');
        }
    
        public function report_receive_by_date_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $data_raw = $this->get_receive_by_date($sdate, $edate);
                $data     = $this->convert_receive_by_date($data_raw);
            }
            $pdf = PDF::loadview('exports/receive',['data'=>$data])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_receive_by_no(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by);
                $data     = $this->convert_receive_by_no($data_raw);
                // dd($data);
            }
            return view('admin.report.receiveno', compact('data', 'sdate', 'edate'));
        }

        public function report_receive_by_no_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by);
                $data     = $this->convert_receive_by_no($data_raw);
            }
            return Excel::download(new ReportExport($data, 'receiveno'), 'receiveno.xlsx');
        }
    
        public function report_receive_by_no_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by);
                $data     = $this->convert_receive_by_no($data_raw);
            }
            $pdf = PDF::loadview('exports/receiveno',['data'=>$data])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_receive_by_product(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search  = ""; 
            if ($request->_token) {
                $order_by = "ORDER BY receive_detail.product_code ASC, receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search);
                $data     = $this->convert_receive_by_product($data_raw);
                // dd($data);
            }
            return view('admin.report.receiveproduct', compact('data', 'sdate', 'edate', 'search'));
        }

        public function report_receive_by_product_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search  = ""; 
            if ($request->_token) {
                $order_by = "ORDER BY receive_detail.product_code ASC, receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search);
                $data     = $this->convert_receive_by_product($data_raw);
                // dd($data);
            }
            return Excel::download(new ReportExport($data, 'receiveproduct'), 'receiveproduct.xlsx');
        }
    
        public function report_receive_by_product_pdf(Request $request) {
           $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search  = ""; 
            if ($request->_token) {
                $order_by = "ORDER BY receive_detail.product_code ASC, receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search);
                $data     = $this->convert_receive_by_product($data_raw);
                // dd($data);
            }
            $pdf = PDF::loadview('exports/receiveproduct',['data'=>$data])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }
        
        private function get_receive_by_date($sdate, $edate) {
            $query = "
                SELECT 
                    receive_detail.receive_code, receive.receive_date, receive.delivery_no, users.name AS pic, 
                    COUNT(receive_detail.product_code) AS total_product,
                    SUM(receive_detail.quantity) AS total_qty
                FROM tr_receive_detail receive_detail
                INNER JOIN tr_receive receive ON receive_detail.receive_code = receive.receive_code
                INNER JOIN users ON receive.created_by = users.id
                WHERE receive.receive_date BETWEEN '$sdate' AND '$edate'
                GROUP BY receive_detail.receive_code, receive.receive_date, receive.delivery_no, users.name
                ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function get_receive_raw($sdate, $edate, $order_by, $search = "") {
            $where = empty($search) ? "" : " AND (products.name LIKE '%".$search."%' OR products.code LIKE '%".$search."%')";
            $query = "
                SELECT 
                    receive_detail.receive_code, receive.receive_date, receive.delivery_no, users.name AS pic, 
                    receive_detail.product_code, products.name AS product_name, receive_detail.quantity
                FROM tr_receive_detail receive_detail
                INNER JOIN tr_receive receive ON receive_detail.receive_code = receive.receive_code
                INNER JOIN users ON receive.created_by = users.id
                INNER JOIN products ON receive_detail.product_code = products.code
                WHERE receive.receive_date BETWEEN '$sdate' AND '$edate' ".$where."
                $order_by
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function convert_receive_by_date($data_raw) {
            $data_receive = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    $receive_date = $item->receive_date;
                    $rd_stringfy = strtotime($receive_date);
                    if (!array_key_exists($rd_stringfy, $data_receive)) {
                        $data_receive[$rd_stringfy] = [
                            "receive_date"  => $receive_date,
                            "details"       => []
                        ];
                    }
                    
                    $data_receive[$rd_stringfy]["details"][] = [
                        "code"          => $item->receive_code,
                        "delivery_no"   => $item->delivery_no,
                        "pic"           => $item->pic,
                        "total_product"       => $item->total_product,
                        "total_qty"      => $item->total_qty
                    ];
                }
            }
            return $data_receive;
        }

        private function convert_receive_by_no($data_raw) {
            $data_receive = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    $receive_code = $item->receive_code;
                    if (!array_key_exists($receive_code, $data_receive)) {
                        $data_receive[$receive_code] = [
                            "code"          => $receive_code,
                            "delivery_no"   => $item->delivery_no,
                            "pic"           => $item->pic,
                            "receive_date"  => $item->receive_date,
                            "details"       => []
                        ];
                    }
                    
                    $data_receive[$receive_code]["details"][] = [
                        "product"       => $item->product_code." | ".$item->product_name,
                        "quantity"      => $item->quantity
                    ];
                }
            }
            return $data_receive;
        }

        private function convert_receive_by_product($data_raw) {
            $data_receive = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    $product_code = $item->product_code;
                    if (!array_key_exists($product_code, $data_receive)) {
                        $data_receive[$product_code] = [
                            "product"  => $item->product_code." | ".$item->product_name,
                            "details"  => []
                        ];
                    }
                    
                    $data_receive[$product_code]["details"][] = [
                        "quantity"      => $item->quantity,
                        "receive_code"  => $item->receive_code,
                        "receive_date"  => $item->receive_date,
                        "delivery_no"   => $item->delivery_no,
                        "pic"           => $item->pic
                    ];
                }
            }
            return $data_receive;
        }

    /* END REPORT RECEIVE */

    // START REPORT CASH FLOW
        public function report_cash_flow(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            // if ($request->_token) {
            //     $sdate = $request->sdate;
            //     $edate = $request->edate;
            //     $search = trim($request->search);
            //     $data = $this->get_stock($sdate, $edate, $search);
            // }
            return view('admin.report.cash-flow', compact('data', 'sdate', 'edate', 'search'));
        }

        
    // END REPORT CASH FLOW

    // START REPORT BEST SELLER
        public function report_best_seller(Request $request) {
            $data   = [];
            $sdate  = "";
            $search  = ""; 
            if ($request->_token) {
                $sdate = $request->sdate;
                $search = trim($request->search);
                $data = $this->get_bestseller($sdate, $search);
            }
            return view('admin.report.best-seller', compact('data', 'sdate', 'search'));
        }

        private function get_bestseller($sdate, $search) {
            $sdate_exp = explode("-", $sdate);
            $year   = $sdate_exp[0];
            $month  = $sdate_exp[1];
            $where = empty($search) ? "" : " AND (products.code LIKE '%".$search."%' OR products.name LIKE '%".$search."%')";
            $query = "
                SELECT
                    products.name as product_name,
                    trans_detail.product_code, 
                    SUM(trans_detail.quantity) AS total_sales,
                    (SUM(trans_detail.quantity) / COUNT(trans.invoice_no)) AS sales_per_invoice
                FROM tr_transaction_detail AS trans_detail
                INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                INNER JOIN products ON trans_detail.product_code = products.code
                WHERE 
                    MONTH(trans.trans_date) = '$month' AND YEAR(trans.trans_date) = '$year' AND trans.status = 'FINISH'
                    ".$where."
                GROUP BY products.name, trans_detail.product_code
                ORDER BY total_sales DESC
                LIMIT 5
            ";
            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }
    
    // END REPORT BEST SELLER
}
