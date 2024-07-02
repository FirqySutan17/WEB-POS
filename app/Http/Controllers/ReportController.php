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
            $order = "";
            $categories = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $order = $request->order;
                $data = $this->get_stock($sdate, $edate, $search, $order, $categories);
            }
            return view('admin.report.stock', compact('data', 'sdate', 'edate', 'search', 'order', 'categories'));
        }

        public function report_stock_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            $order = "";
            $categories = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $order = $request->order;
                $data = $this->get_stock($sdate, $edate, $search, $order, $categories);
            }
            return Excel::download(new StockExport($data), 'stock.xlsx');
        }

        public function report_stock_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = ""; 
            $order = "";
            $categories = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $order = $request->order;
                $data = $this->get_stock($sdate, $edate, $search, $order, $categories);
            }
            $pdf = PDF::loadview('exports/stock',['data'=>$data]);
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        private function get_stock($sdate, $edate, $search, $order, $categories) {
            $where = empty($search) ? "" : " AND (cd.code LIKE '%".$search."%' OR cd.name LIKE '%".$search."%')";
            if (!empty($categories) && $categories != "ALL") {
                $where .= " AND cd.categories = '".$categories."'";
            }
            $query = "
                SELECT product_code as code,
                name,
                Sum(bg)                                         qty_begin,
                Sum(in_rcv)                                     qty_in,
                Sum(in_adj)                                     IN_adj,
                Sum(out_trans)                                  qty_out,
                Sum(out_adj)                                    out_adj,
                Sum(bg + in_rcv + in_adj - out_trans - out_adj) qty_end
                FROM   (
                    SELECT product_code,
                            quantity * -1 AS bg,
                            0             IN_rcv,
                            0             in_adj,
                            0             out_trans,
                            0             out_adj
                    FROM   tr_transaction_detail a,
                            tr_transaction b
                    WHERE   a.invoice_no = b.invoice_no
                            AND b.status = 'FINISH'
                            AND b.trans_date < '".$sdate."'
                    UNION ALL
                    SELECT product_code,
                            quantity AS bg,
                            0        IN_rcv,
                            0        in_adj,
                            0        out_trans,
                            0        out_adj
                    FROM   tr_receive_detail a,
                            tr_receive b
                    WHERE  a.receive_code = b.receive_code
                            AND b.receive_date < '".$sdate."'
                    UNION ALL
                    SELECT product_code,
                        qty * -1 AS bg,
                        0             IN_rcv,
                        0             in_adj,
                        0             out_trans,
                        0             out_adj
                    FROM   tr_adjust_stock a
                    WHERE a.type = 'OUT'
                        AND a.date < '".$sdate."'
                    UNION ALL
                    SELECT product_code,
                        qty AS bg,
                        0             IN_rcv,
                        0             in_adj,
                        0             out_trans,
                        0             out_adj
                    FROM   tr_adjust_stock a
                    WHERE a.type = 'IN'
                        AND a.date < '".$sdate."'
                    UNION ALL
                    SELECT product_code,
                            0        AS bg,
                            quantity IN_rcv,
                            0        in_adj,
                            0        out_trans,
                            0        out_adj
                    FROM   tr_receive_detail a,
                            tr_receive b
                    WHERE  a.receive_code = b.receive_code
                            AND b.receive_date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT product_code,
                            0 bg,
                            0             IN_rcv,
                            qty as             in_adj,
                            0             out_trans,
                            0 out_adj
                    FROM   tr_adjust_stock a
                    WHERE a.type = 'IN'
                            AND a.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT product_code,
                            0        AS bg,
                            0        IN_rcv,
                            0        in_adj,
                            quantity out_trans,
                            0        out_adj
                    FROM   tr_transaction_detail a,
                            tr_transaction b
                    WHERE   a.invoice_no = b.invoice_no
                            AND b.status = 'FINISH'
                            AND b.trans_date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT product_code,
                            0 bg,
                            0             IN_rcv,
                            0             in_adj,
                            0             out_trans,
                            qty as out_adj
                    FROM   tr_adjust_stock a
                    WHERE a.type = 'OUT'
                            AND a.date BETWEEN '".$sdate."' AND '".$edate."'
                ) AS tbl, products cd
                WHERE  tbl.product_code = cd.code ".$where."
                GROUP  BY product_code, cd.name
                ORDER  BY qty_end ".$order."
            ";
            // echo "<pre/>";print_r($query);exit;
            $db_query = DB::select(DB::raw($query));
            // dd($db_query);
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
            $payment_method = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $payment_method = trim($request->payment_method);
                $search = trim($request->search);
                $order_by = "ORDER BY trans.created_at DESC, trans.invoice_no ASC, trans_detail.product_code ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "", "", $payment_method);
                $data     = $this->convert_transaction_by_invoice($data_raw);
                // dd($data_converted);
            }


            return view('admin.report.transactioninvoice', compact('data', 'sdate', 'edate', 'search', 'payment_method'));
        }

        public function report_transaction_by_invoice_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search = "";
            $payment_method = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $payment_method = trim($request->payment_method);
                $search = trim($request->search);
                $order_by = "ORDER BY trans.trans_date DESC, trans.invoice_no ASC, trans_detail.product_code ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "", "", $payment_method);
                $data     = $this->convert_transaction_by_invoice($data_raw);
            }
            return Excel::download(new ReportExport($data, 'transactioninvoice'), 'transactioninvoice.xlsx');
        }
    
        public function report_transaction_by_invoice_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search = "";
            $payment_method = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $payment_method = trim($request->payment_method);
                $search = trim($request->search);
                $order_by = "ORDER BY trans.trans_date DESC, trans.invoice_no ASC, trans_detail.product_code ASC";
                $data_raw = $this->get_transaction_by_invoice($sdate, $edate, $order_by, $search, "", "", $payment_method);
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
                $order_by = "ORDER BY products.name ASC, trans.trans_date DESC, trans_detail.product_code ASC, trans.invoice_no ASC";
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
                SELECT trans.invoice_no, trans.created_at as trans_date, trans.payment_method, trans.total_price, users.employee_id, users.name
                FROM tr_transaction trans
                INNER JOIN users ON trans.emp_no = users.employee_id
                WHERE trans.status = 'FINISH' AND trans.trans_date BETWEEN '$sdate' AND '$edate' ".$where."
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function get_transaction_by_invoice($sdate, $edate, $order_by, $search, $by = "", $categories = "", $payment_method = "ALL") {
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

            if ($payment_method != "ALL") {
                $where = $payment_method == 'Tunai' ? " AND trans.payment_method = 'Tunai'" : " AND trans.payment_method <> 'Tunai'";
            }
            $query = "
                SELECT 
                    trans_detail.product_code, products.name as product_name, 
                    trans_detail.quantity, trans_detail.basic_price, trans_detail.discount, trans_detail.price,
                    trans.invoice_no, trans.created_at as trans_date, trans.payment_method, trans.total_price, users.name, users.employee_id
                FROM tr_transaction_detail AS trans_detail
                INNER JOIN products ON trans_detail.product_code = products.code
                INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                INNER JOIN users ON trans.emp_no = users.employee_id
                WHERE trans.status = 'FINISH' AND trans.trans_date BETWEEN '$sdate' AND '$edate' ".$where."
                $order_by
            ";
            // echo "<pre/>";print_r($query);exit;
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

                    $trans_date = date("Y-m-d", strtotime($item->trans_date));
                    $transdate = str_replace("-", "", $trans_date);
                    if (!array_key_exists($transdate, $data_product[$product_code]["details"])) {
                        $data_product[$product_code]["details"][$transdate] = [
                            "price"         => $item->price,
                            "quantity"      => 0,
                            "trans_date"    => $trans_date,
                            "total"         => 0,
                        ];
                    }
                    $total = $item->price * $item->quantity;
                    $data_product[$product_code]["details"][$transdate]["quantity"] += $item->quantity;
                    $data_product[$product_code]["details"][$transdate]["total"] += $total;
                    // dd($data_product);
                    // $data_product[$product_code]["details"][] = [
                    //     "invoice_no"    => $item->invoice_no,
                    //     "trans_date"    => $item->trans_date,
                    //     "price"         => $item->price,
                    //     "basic_price"   => $item->basic_price,
                    //     "discount"      => $item->discount,
                    //     "quantity"  => $item->quantity
                    // ];
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

                    if (!array_key_exists($item->invoice_no, $data_cashier[$employee_id]["details"])) {
                        $data_cashier[$employee_id]["details"][$item->invoice_no] = [
                            "invoice_no"    => $item->invoice_no,
                            "trans_date"    => $item->trans_date,
                            "total_price"   => $item->total_price,
                            "payment_method"   => $item->payment_method
                        ];
                    }
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
            $categories  = ""; 
            if ($request->_token) {
                // $order_by = "ORDER BY ";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $categories = $request->categories;
                $data_raw = $this->get_receive_by_date($sdate, $edate, $categories);
                $data     = $this->convert_receive_by_date($data_raw);
                // dd($data);
            }
            return view('admin.report.receive', compact('data', 'sdate', 'edate', 'categories'));
        }

        public function report_receive_by_date_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $categories  = ""; 
            if ($request->_token) {
                // $order_by = "ORDER BY ";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $categories = $request->categories;
                $data_raw = $this->get_receive_by_date($sdate, $edate, $categories);
                $data     = $this->convert_receive_by_date($data_raw);
                // dd($data);
            }
            return Excel::download(new ReportExport($data, 'receive', $sdate, $edate), 'receive.xlsx');
        }
    
        public function report_receive_by_date_pdf(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $categories  = ""; 
            if ($request->_token) {
                // $order_by = "ORDER BY ";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $categories = $request->categories;
                $data_raw = $this->get_receive_by_date($sdate, $edate, $categories);
                $data     = $this->convert_receive_by_date($data_raw);
                // dd($data);
            }
            $pdf = PDF::loadview('exports/receive',['data'=>$data, 'sdate' => $sdate, 'edate' => $edate])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_receive_by_no(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $categories = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $categories = $request->categories;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search, $categories);
                $data     = $this->convert_receive_by_no($data_raw);
                
            }
            return view('admin.report.receiveno', compact('data', 'sdate', 'edate', 'categories'));
        }

        public function report_receive_by_no_excel(Request $request) {
            $sdate  = "";
            $edate  = "";
            $categories = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $categories = $request->categories;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search, $categories);
                $data     = $this->convert_receive_by_no($data_raw);
                
            }
            return Excel::download(new ReportExport($data, 'receiveno', $sdate, $edate), 'receiveno.xlsx');
        }
    
        public function report_receive_by_no_pdf(Request $request) {
            $sdate  = "";
            $edate  = "";
            $categories = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $categories = $request->categories;
                $search = trim($request->search);
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search, $categories);
                $data     = $this->convert_receive_by_no($data_raw);
                
            }
            $pdf = PDF::loadview('exports/receiveno',['data'=>$data,  'sdate' => $sdate, 'edate' => $edate])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }

        public function report_receive_by_product(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search  = "";
            $categories = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive_detail.product_code ASC, receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search, $categories);
                $data     = $this->convert_receive_by_product($data_raw);
                // dd($data);
            }
            return view('admin.report.receiveproduct', compact('data', 'sdate', 'edate', 'search', 'categories'));
        }

        public function report_receive_by_product_excel(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search  = "";
            $categories = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive_detail.product_code ASC, receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search, $categories);
                $data     = $this->convert_receive_by_product($data_raw);
                // dd($data);
            }
            return Excel::download(new ReportExport($data, 'receiveproduct', $sdate, $edate), 'receiveproduct.xlsx');
        }
    
        public function report_receive_by_product_pdf(Request $request) {
           $data   = [];
            $sdate  = "";
            $edate  = ""; 
            $search  = "";
            $categories = "";
            if ($request->_token) {
                $order_by = "ORDER BY receive_detail.product_code ASC, receive.receive_date DESC, receive_detail.receive_code ASC";
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
                $data_raw = $this->get_receive_raw($sdate, $edate, $order_by, $search, $categories);
                $data     = $this->convert_receive_by_product($data_raw);
                // dd($data);
            }
            $pdf = PDF::loadview('exports/receiveproduct',['data'=>$data,  'sdate' => $sdate, 'edate' => $edate])->setPaper('a4', 'landscape');
            return $pdf->stream();
            // return $pdf->download('stock-opname-pdf');
        }
        
        private function get_receive_by_date($sdate, $edate, $categories) {
            $where = "";
            if (!empty($categories) && $categories != "ALL") {
                $where .= " AND products.categories = '".$categories."'";
            }
            $query = "
                SELECT 
                    receive_detail.receive_code, receive.receive_date, receive.delivery_no, users.name AS pic,
                    receive_detail.product_code, products.name AS product_name, receive_detail.quantity, COALESCE(receive_detail.unit_price, 0) as unit_price, COALESCE(receive_detail.amount, 0) as amount
                FROM tr_receive_detail receive_detail
                INNER JOIN tr_receive receive ON receive_detail.receive_code = receive.receive_code
                INNER JOIN users ON receive.created_by = users.id
                INNER JOIN products ON receive_detail.product_code = products.code
                WHERE receive.receive_date BETWEEN '$sdate' AND '$edate' ".$where."
                ORDER BY receive.receive_date DESC, receive_detail.receive_code ASC
            ";

            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function get_receive_raw($sdate, $edate, $order_by, $search = "", $categories = "") {
            $where = empty($search) ? "" : " AND (products.name LIKE '%".$search."%' OR products.code LIKE '%".$search."%')";
            if (!empty($categories) && $categories != "ALL") {
                $where .= " AND products.categories = '".$categories."'";
            }
            $query = "
                SELECT 
                    receive_detail.receive_code, receive.receive_date, receive.delivery_no, users.name AS pic, 
                    receive_detail.product_code, products.name AS product_name, receive_detail.quantity, COALESCE(receive_detail.unit_price, 0) as unit_price, COALESCE(receive_detail.amount, 0) as amount,
                    suppliers.supplier_code, suppliers.name as supplier_name
                FROM tr_receive_detail receive_detail
                INNER JOIN tr_receive receive ON receive_detail.receive_code = receive.receive_code
                INNER JOIN users ON receive.created_by = users.id
                INNER JOIN products ON receive_detail.product_code = products.code
                LEFT JOIN suppliers ON products.supplier_id = suppliers.id
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
                    
                    if (!array_key_exists($item->product_code, $data_receive[$rd_stringfy]["details"])) {
                        $data_receive[$rd_stringfy]["details"][$item->product_code] = [
                            "product_code"  => $item->product_code,
                            "product_name"  => $item->product_name,
                            "qty"           => 0,
                            "unit_price"    => 0,
                            "amount"        => 0,
                        ];
                    }
                    $data_receive[$rd_stringfy]["details"][$item->product_code]["qty"] += $item->quantity;
                    $data_receive[$rd_stringfy]["details"][$item->product_code]["unit_price"] = $item->unit_price;
                    $data_receive[$rd_stringfy]["details"][$item->product_code]["amount"] = $data_receive[$rd_stringfy]["details"][$item->product_code]["qty"] * $data_receive[$rd_stringfy]["details"][$item->product_code]["unit_price"];
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
                        "quantity"      => $item->quantity,
                        "unit_price"      => $item->unit_price,
                        "amount"      => $item->amount
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
                            "supplier"  => $item->supplier_code." | ".$item->supplier_name,
                            "product"  => $item->product_code." | ".$item->product_name,
                            "details"  => []
                        ];
                    }
                    
                    $data_receive[$product_code]["details"][] = [
                        "quantity"      => $item->quantity,
                        "receive_code"  => $item->receive_code,
                        "receive_date"  => $item->receive_date,
                        "delivery_no"   => $item->delivery_no,
                        "pic"           => $item->pic,
                        "unit_price"    => $item->unit_price,
                        "amount"        => $item->amount
                    ];
                }
            }
            return $data_receive;
        }

    /* END REPORT RECEIVE */

    // START REPORT CASH FLOW
        public function report_cash_flow(Request $request) {
            $data   = [];
            $column = [
                "sdate" => "",
                "edate" => "",
                "search" => "",
            ];
            if ($request->_token) {
                $column = [
                    "sdate" => $request->sdate,
                    "edate" => $request->edate,
                    "search" => trim($request->search),
                ];
                $data = $this->get_cashflow($column);
            }
            return view('admin.report.cash-flow', compact('data', 'column'));
        }

        public function report_cash_flow_excel(Request $request) {
            $data   = [];
            $column = [
                "sdate" => "",
                "edate" => "",
                "search" => "",
            ];
            if ($request->_token) {
                $column = [
                    "sdate" => $request->sdate,
                    "edate" => $request->edate,
                    "search" => trim($request->search),
                ];
                $data = $this->get_cashflow($column);
            }
            $filename = 'cashflow-'.date('YmdHis').'.xlsx';
            return Excel::download(new ReportExport($data, 'cashflow'), $filename);
        }

        private function get_cashflow($column) {
            $sdate  = $column['sdate'];
            $edate  = $column['edate'];
            $search = $column['search'];

            $prevdate = date('Y-m-d', strtotime($sdate." -1 days"));
            $where = empty($search) ? "" : " AND (apprv_user.employee_id LIKE '%".$search."%' OR apprv_user.name LIKE '%".$search."%')";
            $oldquery      = "
                SELECT *
                FROM (
                    SELECT 
                        CONCAT('".$prevdate."', ' 23:59') AS cash_date,
                        'SYSTEM' AS approved_by,
                        'SALDO AWAL' AS description,
                        'SALDO_AWAL' AS category,
                        COALESCE(SUM(bank_in - bank_out), 0) AS bank_in,
                        0 AS bank_out,
                        COALESCE(SUM(cash_in - cash_out), 0) AS cash_in,
                        0 AS cash_out
                    FROM (
                        SELECT
                            CONCAT(cf.date, ' ', cf.time) AS cash_date,
                            CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                            cf.description,
                            'CASH_IN' AS category,
                            0 AS bank_in,
                            0 AS bank_out,
                            cf.cash AS cash_in,
                            0 AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'IN' AND
                            cf.date < '".$sdate."'
                        UNION ALL
                        SELECT
                        CONCAT(cf.date, ' ', cf.time) AS cash_date,
                        CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                        cf.description,
                        'CASH_OUT' AS category,
                        0 AS bank_in,
                        0 AS bank_out,
                        0 AS cash_in,
                        cf.cash AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'OUT' AND
                        cf.date < '".$sdate."'
                        UNION ALL
                        SELECT 
                        trans.created_at AS cash_date,
                        CONCAT(trans.emp_no, ' | ', emp_user.name) AS approved_by,
                        CONCAT('TRANS ', trans.invoice_no, ' ', trans.payment_method) AS description,
                        CASE 
                            WHEN trans.payment_method = 'TUNAI' THEN 'CASH_IN'
                            ELSE 'BANK_IN'
                        END AS category, 
                        CASE 
                            WHEN trans.payment_method = 'TUNAI' THEN 0
                            ELSE trans.total_price
                        END AS bank_in,
                        0 AS bank_out,
                        CASE 
                            WHEN trans.payment_method = 'TUNAI' THEN trans.total_price
                            ELSE 0
                        END AS bank_in,
                        0 AS cash_out
                        FROM tr_transaction trans, users as emp_user
                        WHERE 
                            trans.emp_no = emp_user.employee_id AND
                            trans.status = 'FINISH' AND trans.trans_date < '".$sdate."'
                        UNION ALL
                        SELECT
                        CONCAT(cf.date, ' ', cf.time) AS cash_date,
                        CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                        cf.description,
                        'BANK_IN' AS category,
                        cf.cash AS bank_in,
                        0 AS bank_out,
                        0 AS cash_in,
                        cf.cash AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'STR' AND
                        cf.date < '".$sdate."'
                        UNION ALL
                        SELECT
                        CONCAT(cf.date, ' ', cf.time) AS cash_date,
                        CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                        cf.description,
                        'BANK_OUT' AS category,
                        0 AS bank_in,
                        cf.cash AS bank_out,
                        0 AS cash_in,
                        0 AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'OUT-BANK' AND
                        cf.date < '".$sdate."'
                    ) tbl_saldo_awal
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'CASH_IN' AS category,
                    0 AS bank_in,
                    0 AS bank_out,
                    cf.cash AS cash_in,
                    0 AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'IN' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'CASH_OUT' AS category,
                    0 AS bank_in,
                    0 AS bank_out,
                    0 AS cash_in,
                    cf.cash AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'OUT' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT 
                    trans.created_at AS cash_date,
                    CONCAT(trans.emp_no, ' | ', emp_user.name) AS approved_by,
                    CONCAT('TRANS ', trans.invoice_no, ' ', trans.payment_method) AS description,
                    CASE 
                        WHEN trans.payment_method = 'TUNAI' THEN 'CASH_IN'
                        ELSE 'BANK_IN'
                    END AS category, 
                    CASE 
                        WHEN trans.payment_method = 'TUNAI' THEN 0
                        ELSE trans.total_price
                    END AS bank_in,
                    0 AS bank_out,
                    CASE 
                        WHEN trans.payment_method = 'TUNAI' THEN trans.total_price
                        ELSE 0
                    END AS bank_in,
                    0 AS cash_out
                    FROM tr_transaction trans, users as emp_user
                    WHERE 
                        trans.emp_no = emp_user.employee_id AND
                        trans.status = 'FINISH' AND trans.trans_date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'BANK_IN' AS category,
                    cf.cash AS bank_in,
                    0 AS bank_out,
                    0 AS cash_in,
                    cf.cash AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'STR' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'BANK_OUT' AS category,
                    0 AS bank_in,
                    cf.cash AS bank_out,
                    0 AS cash_in,
                    0 AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'OUT-BANK' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                ) AS cash_flow
                ORDER BY cash_date ASC
            ";

            $modal_in_awal = $this->query_modal_in($sdate, $edate, 1);
            $modal_in = $this->query_modal_in($sdate, $edate);
            $modal_out_awal = $this->query_modal_out($sdate, $edate, 1);
            $modal_out = $this->query_modal_out($sdate, $edate);
            $query      = "
                SELECT *
                FROM (
                    SELECT 
                        CONCAT('".$prevdate."', ' 23:59') AS cash_date,
                        'SYSTEM' AS approved_by,
                        'SALDO AWAL' AS description,
                        'SALDO_AWAL' AS category,
                        COALESCE(SUM(bank_in - bank_out), 0) AS bank_in,
                        0 AS bank_out,
                        COALESCE(SUM(cash_in - cash_out), 0) AS cash_in,
                        0 AS cash_out
                    FROM (
                        ".$modal_in_awal."
                        UNION ALL
                        ".$modal_out_awal."
                        UNION ALL
                        SELECT
                            CONCAT(cf.date, ' ', cf.time) AS cash_date,
                            CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                            cf.description,
                            'CASH_IN' AS category,
                            0 AS bank_in,
                            0 AS bank_out,
                            cf.cash AS cash_in,
                            0 AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'IN' AND
                            cf.date < '".$sdate."'
                        UNION ALL
                        SELECT
                            CONCAT(cf.date, ' ', cf.time) AS cash_date,
                            CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                            cf.description,
                            'CASH_OUT' AS category,
                            0 AS bank_in,
                            0 AS bank_out,
                            0 AS cash_in,
                            cf.cash AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'OUT' AND
                            cf.date < '".$sdate."'
                        UNION ALL
                        SELECT 
                        trans.created_at AS cash_date,
                        CONCAT(trans.emp_no, ' | ', emp_user.name) AS approved_by,
                        CONCAT('TRANS ', trans.invoice_no, ' ', trans.payment_method) AS description,
                        CASE 
                            WHEN trans.payment_method = 'TUNAI' THEN 'CASH_IN'
                            ELSE 'BANK_IN'
                        END AS category, 
                        CASE 
                            WHEN trans.payment_method = 'TUNAI' THEN 0
                            ELSE trans.total_price
                        END AS bank_in,
                        0 AS bank_out,
                        CASE 
                            WHEN trans.payment_method = 'TUNAI' THEN trans.total_price
                            ELSE 0
                        END AS bank_in,
                        0 AS cash_out
                        FROM tr_transaction trans, users as emp_user
                        WHERE 
                            trans.emp_no = emp_user.employee_id AND
                            trans.status = 'FINISH' AND trans.trans_date < '".$sdate."'
                        UNION ALL
                        SELECT
                            CONCAT(cf.date, ' ', cf.time) AS cash_date,
                            CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                            cf.description,
                            'BANK_IN' AS category,
                            cf.cash AS bank_in,
                            0 AS bank_out,
                            0 AS cash_in,
                            cf.cash AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'STR' AND
                            cf.date < '".$sdate."'
                        UNION ALL
                        SELECT
                            CONCAT(cf.date, ' ', cf.time) AS cash_date,
                            CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                            cf.description,
                            'BANK_IN' AS category,
                            cf.cash AS bank_in,
                            0 AS bank_out,
                            0 AS cash_in,
                            0 AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'IN-BANK' AND
                            cf.date < '".$sdate."'
                        UNION ALL
                        SELECT
                            CONCAT(cf.date, ' ', cf.time) AS cash_date,
                            CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                            cf.description,
                            'BANK_OUT' AS category,
                            0 AS bank_in,
                            cf.cash AS bank_out,
                            0 AS cash_in,
                            0 AS cash_out
                        FROM cash_flow AS cf, users AS apprv_user
                        WHERE
                            cf.approval = apprv_user.pin AND
                            cf.categories = 'OUT-BANK' AND
                            cf.date < '".$sdate."'
                    ) tbl_saldo_awal
                    UNION ALL
                    ".$modal_in."
                    UNION ALL
                    ".$modal_out."
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'CASH_IN' AS category,
                    0 AS bank_in,
                    0 AS bank_out,
                    cf.cash AS cash_in,
                    0 AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'IN' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'CASH_OUT' AS category,
                    0 AS bank_in,
                    0 AS bank_out,
                    0 AS cash_in,
                    cf.cash AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'OUT' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT 
                    trans.created_at AS cash_date,
                    CONCAT(trans.emp_no, ' | ', emp_user.name) AS approved_by,
                    CONCAT('TRANS ', trans.invoice_no, ' ', trans.payment_method) AS description,
                    CASE 
                        WHEN trans.payment_method = 'TUNAI' THEN 'CASH_IN'
                        ELSE 'BANK_IN'
                    END AS category, 
                    CASE 
                        WHEN trans.payment_method = 'TUNAI' THEN 0
                        ELSE trans.total_price
                    END AS bank_in,
                    0 AS bank_out,
                    CASE 
                        WHEN trans.payment_method = 'TUNAI' THEN trans.total_price
                        ELSE 0
                    END AS bank_in,
                    0 AS cash_out
                    FROM tr_transaction trans, users as emp_user
                    WHERE 
                        trans.emp_no = emp_user.employee_id AND
                        trans.status = 'FINISH' AND trans.trans_date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'BANK_IN' AS category,
                    cf.cash AS bank_in,
                    0 AS bank_out,
                    0 AS cash_in,
                    cf.cash AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'STR' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'BANK_IN' AS category,
                    cf.cash AS bank_in,
                    0 AS bank_out,
                    0 AS cash_in,
                    0 AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'IN-BANK' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                    UNION ALL
                    SELECT
                    CONCAT(cf.date, ' ', cf.time) AS cash_date,
                    CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                    cf.description,
                    'BANK_OUT' AS category,
                    0 AS bank_in,
                    cf.cash AS bank_out,
                    0 AS cash_in,
                    0 AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'OUT-BANK' AND
                    cf.date BETWEEN '".$sdate."' AND '".$edate."'
                ) AS cash_flow
                ORDER BY cash_date ASC
            ";
            // echo "<pre/>";print_r($query);exit;
            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

        private function query_modal_in($sdate, $edate, $is_saldo_awal = 0) {
            $filter_date = " AND (cf.date BETWEEN '".$sdate."' AND '".$edate."')";
            if ($is_saldo_awal) {
                $filter_date = " AND cf.date < '".$sdate."'";
            }
            // $query = "
            //     SELECT * FROM (
            //         SELECT cash_date, approved_by, description, category, bank_in, bank_out, cash_in, cash_out FROM (
            //             SELECT
            //                 CONCAT(cf.date, ' ', cf.time) AS cash_date,
            //                 CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
            //                 CONCAT(cf.description, ' ', 'PC TO CD') AS description,
            //                 'MODAL_IN' AS category,
            //                 0 AS bank_in,
            //                 0 AS bank_out,
            //                 0 AS cash_in,
            //                 cf.cash AS cash_out,
            //                 1 AS sequence
            //             FROM cash_flow AS cf, users AS apprv_user
            //             WHERE
            //                     cf.approval = apprv_user.pin AND
            //                     cf.categories = 'MDL-IN'
            //                     ".$filter_date."
                                
            //             UNION ALL
                    
            //             SELECT
            //                 CONCAT(cf.date, ' ', cf.time) AS cash_date,
            //                 CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
            //                 CONCAT(cf.description, ' ', 'PC TO CD')  AS description,
            //                 'MODAL_IN' AS category,
            //                 0 AS bank_in,
            //                 0 AS bank_out,
            //                 cf.cash AS cash_in,
            //                 0 AS cash_out,
            //                 2 AS sequence
            //             FROM cash_flow AS cf, users AS apprv_user
            //             WHERE
            //                     cf.approval = apprv_user.pin AND
            //                     cf.categories = 'MDL-IN'
            //                     ".$filter_date."
            //         ) AS data_in
            //         ORDER BY data_in.cash_date ASC, data_in.sequence ASC
            //     ) AS modal_in 
            // ";
            $query = "
                SELECT * FROM (
                    SELECT
                        CONCAT(cf.date, ' ', cf.time) AS cash_date,
                        CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                        CONCAT(cf.description, ' ', 'PC TO CD')  AS description,
                        'MODAL_IN' AS category,
                        0 AS bank_in,
                        0 AS bank_out,
                        cf.cash AS cash_in,
                        cf.cash AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'MDL-IN'
                        ".$filter_date."
                ) AS modal_in 
            ";

            return $query;
        }

        private function query_modal_out($sdate, $edate, $is_saldo_awal = 0) {
            $filter_date = " AND (cf.date BETWEEN '".$sdate."' AND '".$edate."')";
            if ($is_saldo_awal) {
                $filter_date = " AND cf.date < '".$sdate."'";
            }
            // $query = "
            //     SELECT * FROM (
            //         SELECT cash_date, approved_by, description, category, bank_in, bank_out, cash_in, cash_out FROM (
            //             SELECT
            //                 CONCAT(cf.date, ' ', cf.time) AS cash_date,
            //                 CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
            //                 CONCAT(cf.description, ' ', 'CD TO PC') AS description,
            //                 'MODAL_OUT' AS category,
            //                 0 AS bank_in,
            //                 0 AS bank_out,
            //                 0 AS cash_in,
            //                 cf.cash AS cash_out,
            //                 2 AS sequence
            //             FROM cash_flow AS cf, users AS apprv_user
            //             WHERE
            //                 cf.approval = apprv_user.pin AND
            //                 cf.categories = 'MDL-OUT'
            //                 ".$filter_date."
                                
            //             UNION ALL
                        
            //             SELECT
            //                 CONCAT(cf.date, ' ', cf.time) AS cash_date,
            //                 CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
            //                 CONCAT(cf.description, ' ', 'CD TO PC')  AS description,
            //                 'MODAL_OUT' AS category,
            //                 0 AS bank_in,
            //                 0 AS bank_out,
            //                 cf.cash AS cash_in,
            //                 0 AS cash_out,
            //                 1 AS sequence
            //             FROM cash_flow AS cf, users AS apprv_user
            //             WHERE
            //                 cf.approval = apprv_user.pin AND
            //                 cf.categories = 'MDL-OUT'
            //                 ".$filter_date."
            //         ) as data_out
            //         ORDER BY data_out.cash_date ASC, data_out.sequence ASC
            //     ) AS modal_out
            // ";
            $query = "
                SELECT * FROM (
                    SELECT
                        CONCAT(cf.date, ' ', cf.time) AS cash_date,
                        CONCAT(apprv_user.employee_id, ' | ', apprv_user.name) AS approved_by,
                        CONCAT(cf.description, ' ', 'CD TO PC') AS description,
                        'MODAL_OUT' AS category,
                        0 AS bank_in,
                        0 AS bank_out,
                        cf.cash AS cash_in,
                        cf.cash AS cash_out
                    FROM cash_flow AS cf, users AS apprv_user
                    WHERE
                        cf.approval = apprv_user.pin AND
                        cf.categories = 'MDL-OUT'
                        ".$filter_date."
                ) AS modal_out
            ";

            return $query;
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
                    SUM(trans_detail.quantity * trans_detail.price) AS total_amount
                FROM tr_transaction_detail AS trans_detail
                INNER JOIN tr_transaction AS trans ON trans_detail.invoice_no = trans.invoice_no
                INNER JOIN products ON trans_detail.product_code = products.code
                WHERE 
                    MONTH(trans.trans_date) = '$month' AND YEAR(trans.trans_date) = '$year' AND trans.status = 'FINISH'
                    ".$where."
                GROUP BY products.name, trans_detail.product_code
                ORDER BY total_sales DESC
                LIMIT 10
            ";
            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }
    
    // END REPORT BEST SELLER

    // START REPORT LABA RUGI
        public function report_laba_rugi(Request $request) {
            $data   = [];
            $sdate  = "";
            $edate  = "";
            $search  = "";
            $categories = "";
            if ($request->_token) {
                $sdate = $request->sdate;
                $edate = $request->edate;
                $search = trim($request->search);
                $categories = $request->categories;
            }

            $data_raw = $this->get_labarugi($sdate, $edate, $search, $categories);
            $data = $this->convert_labarugi($data_raw);
            return view('admin.report.labarugi', compact('data', 'sdate', 'edate', 'search', 'categories'));
        }

        private function bak_convert_labarugi($data_raw) {
            $data = [];
            if (!empty($data_raw)) {
                foreach ($data_raw as $item) {
                    dd($data_raw);
                    $product_code = $item->product_code;
                    if (!array_key_exists($product_code, $data)) {
                        $data[$product_code] = [
                            "product_name"  => $item->product_name,
                            "detail"        => []
                        ];
                    }
                    $item->trans_date = date('Y-m-d', strtotime($item->trans_date));
                    $tanggal = strtotime($item->trans_date);

                    $item->receive_date = date('Y-m-d', strtotime($item->receive_date));
                    $tanggal_rcv = strtotime($item->receive_date);
                    if ($tanggal_rcv < $tanggal) {
                        if (!array_key_exists($tanggal_rcv, $data[$product_code]["detail"])) {
                            $data[$product_code]["detail"][$tanggal_rcv] = [
                                "tanggal"       => $item->receive_date,
                                "quantity"      => $item->quantity_rcv,
                                "harga_jual"    => 0,
                                "harga_beli"    => $item->harga_beli,
                                "is_receive"    => 1
                            ];
                            
                        }
                    }
                    if (!array_key_exists($tanggal, $data[$product_code]["detail"])) {
                        $data[$product_code]["detail"][$tanggal] = [
                            "tanggal"       => $item->trans_date,
                            "quantity"      => $item->quantity,
                            "harga_jual"    => $item->harga_jual,
                            "harga_beli"    => $item->harga_beli,
                            "is_receive"    => ($tanggal_rcv == $tanggal) ? 2 : 0
                        ];
                    } else {
                        $data[$product_code]["detail"][$tanggal]["quantity"] += $item->quantity;
                    }
                }
                // dd($data);
            }
            return $data;
        }

        private function convert_labarugi($data_raw) {
            $data = [];
            if (!empty($data_raw)) {
                $previous_product_code = "";
                foreach ($data_raw as $item) {
                    $product_code = $item->kode_produk;
                    if (!array_key_exists($product_code, $data)) {
                        $data[$product_code] = [
                            "product_code"  => $product_code,
                            "product_name"  => $item->name,
                            "detail"        => []
                        ];
                    }

                    if ($previous_product_code != $product_code && $item->status_data == 2) {
                        // PROCEED TO GET FIRST TIME RECEIVE
                        $previous = $this->get_previous_receive($product_code, $item->tanggal);
                        $previous->tanggal = date('Y-m-d', strtotime($previous->tanggal));
                        $tanggal = strtotime($previous->tanggal);
                        
                        if (!array_key_exists($tanggal, $data[$product_code]["detail"])) {
                            $data[$product_code]["detail"][$tanggal] = [
                                "tanggal"   => $previous->tanggal,
                                "receive"   => [],
                                "sales"     => []
                            ];
                        }
                        
                        // dd($previous, $tanggal, $data[$product_code]);
                        if ($previous->status_data == 0) {
                            $data[$product_code]["detail"][$tanggal]["receive"] = [
                                "quantity"      => 0 + $previous->quantity,
                                "unit_price"    => 0 + $previous->unit_price,
                                "amount"        => 0 + $previous->amount,
                            ];
                        }
                    }
                    $previous_product_code = $product_code;
                    $item->tanggal = date('Y-m-d', strtotime($item->tanggal));
                    $tanggal = strtotime($item->tanggal);
                    
                    if (!array_key_exists($tanggal, $data[$product_code]["detail"])) {
                        $data[$product_code]["detail"][$tanggal] = [
                            "tanggal"   => $item->tanggal,
                            "receive"   => [],
                            "sales"     => []
                        ];
                    }
                    
                    // dd($item, $tanggal, $data[$product_code]);
                    if ($item->status_data == 1) {
                        $data[$product_code]["detail"][$tanggal]["receive"] = [
                            "quantity"      => 0 + $item->quantity,
                            "unit_price"    => 0 + $item->unit_price,
                            "amount"        => 0 + $item->amount,
                        ];
                    } elseif ($item->status_data == 2) {
                        if (empty($data[$product_code]["detail"][$tanggal]["sales"])) {
                            $data[$product_code]["detail"][$tanggal]["sales"] = [
                                "quantity"      => 0,
                                "unit_price"    => 0 + $item->unit_price,
                                "amount"        => 0,
                            ];
                        }
                        $data[$product_code]["detail"][$tanggal]["sales"]["quantity"] += $item->quantity;
                        $data[$product_code]["detail"][$tanggal]["sales"]["amount"] += $item->amount;
                    }
                }
            }
            return $data;
        }

        private function get_previous_receive($product_code, $date) {
            $query = "
                SELECT 
                    rcv.receive_date AS tanggal, 
                    rcv.created_at, 
                    rcv_detail.product_code AS kode_produk, s
                    rcv_detail.quantity, 
                    rcv_detail.unit_price, 
                    rcv_detail.amount, 0 AS status_data
                FROM 
                    tr_receive_detail rcv_detail,
                    tr_receive rcv
                WHERE
                    rcv.receive_code = rcv_detail.receive_code
                    AND DATE(rcv.receive_date) < '$date' 
                    AND rcv_detail.product_code = '$product_code'
                ORDER BY rcv.id DESC
                LIMIT 1
            ";
            $db_query = DB::select(DB::raw($query));
            return $db_query[0];
        }

        private function get_labarugi($sdate, $edate, $search, $categories) {
            $where = empty($search) ? "" : " AND (products.code LIKE '%".$search."%' OR products.name LIKE '%".$search."%')";
            $whereDate = "";
            if (!empty($sdate)) {
                $sdate_exp = explode("-", $sdate);    
            } else {
                $sdate_exp = explode("-", date("Y-m"));
            }
            $year   = $sdate_exp[0];
            $month  = $sdate_exp[1];
            // $whereDate = "AND (YEAR(trans.trans_date) = '".$year."' AND MONTH(trans.trans_date) = '".$month."')";
            $whereDate = " AND (trans.trans_date BETWEEN '".$sdate."' AND '".$edate."')";
            if (!empty($categories) && $categories != "ALL") {
                $where .= " AND products.categories = '".$categories."'";
            }
            $oldquery = "
                SELECT 
                    products.code as product_code,
                    CONCAT(products.code, ' | ', products.name) AS product_name,
                    trans.created_at as trans_date,
                    trans_detail.quantity,
                    trans_detail.price AS harga_jual,
                    COALESCE (
                        (
                           SELECT rcv.created_at
                           FROM 
                               tr_receive_detail rcv_detail,
                               tr_receive rcv
                           WHERE
                               rcv.receive_code = rcv_detail.receive_code
                               AND rcv_detail.product_code = trans_detail.product_code
                               AND rcv.created_at <= trans.created_at
                           ORDER BY rcv.id DESC
                           LIMIT 1
                        ),
                        (
                           SELECT rcv.created_at
                           FROM 
                               tr_receive_detail rcv_detail,
                               tr_receive rcv
                           WHERE
                               rcv.receive_code = rcv_detail.receive_code
                               AND rcv_detail.product_code = trans_detail.product_code
                               AND DATE(rcv.created_at) <= DATE(trans.created_at)
                           ORDER BY rcv.id DESC
                           LIMIT 1
                        )
                    ) AS receive_date,
                    COALESCE (
                        (
                           SELECT rcv_detail.unit_price
                           FROM 
                               tr_receive_detail rcv_detail,
                               tr_receive rcv
                           WHERE
                               rcv.receive_code = rcv_detail.receive_code
                               AND rcv_detail.product_code = trans_detail.product_code
                               AND rcv.created_at <= trans.created_at
                           ORDER BY rcv.id DESC
                           LIMIT 1
                        ),
                        (
                           SELECT rcv_detail.unit_price
                           FROM 
                               tr_receive_detail rcv_detail,
                               tr_receive rcv
                           WHERE
                               rcv.receive_code = rcv_detail.receive_code
                               AND rcv_detail.product_code = trans_detail.product_code
                               AND DATE(rcv.created_at) <= DATE(trans.created_at)
                           ORDER BY rcv.id DESC
                           LIMIT 1
                        )
                    ) AS harga_beli,
                    COALESCE (
                        (
                           SELECT rcv_detail.quantity
                           FROM 
                               tr_receive_detail rcv_detail,
                               tr_receive rcv
                           WHERE
                               rcv.receive_code = rcv_detail.receive_code
                               AND rcv_detail.product_code = trans_detail.product_code
                               AND rcv.created_at <= trans.created_at
                           ORDER BY rcv.id DESC
                           LIMIT 1
                        ),
                        (
                           SELECT rcv_detail.quantity
                           FROM 
                               tr_receive_detail rcv_detail,
                               tr_receive rcv
                           WHERE
                               rcv.receive_code = rcv_detail.receive_code
                               AND rcv_detail.product_code = trans_detail.product_code
                               AND DATE(rcv.created_at) <= DATE(trans.created_at)
                           ORDER BY rcv.id DESC
                           LIMIT 1
                        )
                    ) AS quantity_rcv
                FROM 
                    tr_transaction_detail trans_detail,
                    tr_transaction trans,
                    products
                WHERE
                    trans.invoice_no = trans_detail.invoice_no
                    AND products.code = trans_detail.product_code
                    ".$whereDate."
                    ".$where."
                ORDER BY products.name ASC, trans.trans_date ASC        
            ";

            $query = "
                SELECT 
                    table_data.kode_produk,
                    products.name,
                    table_data.tanggal, 
                    table_data.quantity, 
                    table_data.unit_price, 
                    table_data.amount, 
                    table_data.status_data
                FROM (
                    SELECT rcv.receive_date AS tanggal, rcv.created_at, rcv_detail.product_code AS kode_produk, rcv_detail.quantity, rcv_detail.unit_price, rcv_detail.amount, 1 AS status_data
                    FROM 
                        tr_receive_detail rcv_detail,
                        tr_receive rcv
                    WHERE
                        rcv.receive_code = rcv_detail.receive_code
                        AND (DATE(rcv.receive_date) BETWEEN '$sdate' AND '$edate')
                    
                    UNION ALL
                    
                    SELECT trans.trans_date AS tanggal, trans.created_at, trans_detail.product_code AS kode_produk, trans_detail.quantity, trans_detail.price as unit_price, (trans_detail.quantity * trans_detail.price) as amount, 2 AS status_data
                    FROM 
                        tr_transaction_detail trans_detail,
                        tr_transaction trans
                    WHERE
                        trans.invoice_no = trans_detail.invoice_no
                        AND (DATE(trans.trans_date) BETWEEN '$sdate' AND '$edate')
                ) AS table_data, products
                WHERE products.code = table_data.kode_produk
                $where
                ORDER BY products.name ASC, table_data.created_at ASC
            ";
            // echo "<pre/>";print_r($query);exit;
            $db_query = DB::select(DB::raw($query));
            return $db_query;
        }

    // END REPORT LABA RUGI

    // START REPORT MONTLY
    public function report_monthly(Request $request) {
        $data   = [];
        $sdate  = "";
        $edate  = "";
        $search  = "";
        $categories = "";
        if ($request->_token) {
            $sdate = $request->sdate;
            $edate = $request->edate;
            $search = trim($request->search);
            $categories = $request->categories;
            $data = $this->get_monthly($sdate, $edate, $search, $categories);
            // dd($data);
        }

        // $data = $this->convert_monthly($data_raw);
        return view('admin.report.monthly', compact('data', 'sdate', 'edate', 'search', 'categories'));
    }

    private function get_monthly($sdate, $edate, $search, $categories) {
        $where = empty($search) ? "" : " AND (products.code LIKE '%".$search."%' OR products.name LIKE '%".$search."%')";
        $whereDate = "";
        if (!empty($sdate)) {
            $sdate_exp = explode("-", $sdate);    
        } else {
            $sdate_exp = explode("-", date("Y-m"));
        }
        $year   = $sdate_exp[0];
        $month  = $sdate_exp[1];
        // $whereDate = "AND (YEAR(trans.trans_date) = '".$year."' AND MONTH(trans.trans_date) = '".$month."')";
        $whereDate = " AND (trans.trans_date BETWEEN '".$sdate."' AND '".$edate."')";
        if (!empty($categories) && $categories != "ALL") {
            $where .= " AND products.categories = '".$categories."'";
        }
        $oldquery = "
            SELECT * FROM (
                SELECT 
                    a.product_code, SUM(a.quantity) AS receive, SUM(a.amount) AS total_harga_beli, (SUM(a.amount) / SUM(a.quantity)) AS up_harga_beli,
                    0 AS adjust_in, 0 AS adjust_out, 0 AS sales, 0 AS total_harga_jual, 0 AS up_harga_jual
                FROM tr_receive_detail a, tr_receive b
                WHERE 
                    b.receive_code = a.receive_code
                    AND b.receive_date BETWEEN '$sdate' AND '$edate'
                GROUP BY a.product_code
                
                UNION ALL
                
                SELECT 
                    c.product_code,0 AS receive, 0 AS total_harga_beli, 0 AS up_harga_beli,
                    c.qty AS adjust_in, 0 AS adjust_out, 0 AS sales, 0 AS total_harga_jual, 0 AS up_harga_jual
                FROM tr_adjust_stock c
                WHERE 
                    c.date BETWEEN '$sdate' AND '$edate'
                    AND c.`type` = 'IN'
                GROUP BY c.product_code
                
                UNION ALL
                
                SELECT 
                    c.product_code,0 AS receive, 0 AS total_harga_beli, 0 AS up_harga_beli,
                    0 AS adjust_in, c.qty AS adjust_out, 0 AS sales, 0 AS total_harga_jual, 0 AS up_harga_jual
                FROM tr_adjust_stock c
                WHERE 
                    c.date BETWEEN '$sdate' AND '$edate'
                    AND c.`type` = 'OUT'
                GROUP BY c.product_code
                
                UNION ALL
                
                SELECT 
                    d.product_code, 0 AS receive, 0 AS total_harga_beli, 0 AS up_harga_beli,
                    0 AS adjust_in, 0 AS adjust_out, 
                    SUM(d.quantity) AS sales, 
                    (SUM(d.quantity) * SUM(d.price)) AS total_harga_jual, 
                    ((SUM(d.quantity) * SUM(d.price)) / SUM(d.quantity)) AS up_harga_jual
                FROM tr_transaction_detail d, tr_transaction e
                WHERE 
                    e.invoice_no = d.invoice_no
                    AND e.trans_date BETWEEN '$sdate' AND '$edate'
                GROUP BY d.product_code
        ) AS tabledata
        ORDER BY tabledata.product_code ASC              
        ";

        $query = "
                SELECT 
                products.name,
                product_code, SUM(receive) AS receive, SUM(adjust_in) AS adjust_in, SUM(adjust_out) AS adjust_out, SUM(sales) AS sales,  
                SUM(total_harga_beli) AS total_harga_beli, SUM(total_harga_jual) AS total_harga_jual,
                COALESCE(SUM(total_harga_beli) / SUM(receive), 0) AS up_harga_beli, COALESCE(SUM(total_harga_jual) / SUM(sales), 0) AS up_harga_jual
        FROM (
                SELECT 
                    a.product_code, a.quantity AS receive, a.amount AS total_harga_beli,
                    0 AS adjust_in, 0 AS adjust_out, 0 AS sales, 0 AS total_harga_jual
                FROM tr_receive_detail a, tr_receive b
                WHERE 
                    b.receive_code = a.receive_code
                    AND b.receive_date BETWEEN '$sdate' AND '$edate'
                
                UNION ALL
                
                SELECT 
                    c.product_code,0 AS receive, 0 AS total_harga_beli,
                    c.qty AS adjust_in, 0 AS adjust_out, 0 AS sales, 0 AS total_harga_jual
                FROM tr_adjust_stock c
                WHERE 
                    c.date BETWEEN '$sdate' AND '$edate'
                    AND c.`type` = 'IN'
                
                UNION ALL
                
                SELECT 
                    c.product_code,0 AS receive, 0 AS total_harga_beli,
                    0 AS adjust_in, c.qty AS adjust_out, 0 AS sales, 0 AS total_harga_jual
                FROM tr_adjust_stock c
                WHERE 
                    c.date BETWEEN '$sdate' AND '$edate'
                    AND c.`type` = 'OUT'
                
                UNION ALL
                
                SELECT 
                    d.product_code, 0 AS receive, 0 AS total_harga_beli,
                    0 AS adjust_in, 0 AS adjust_out, 
                    d.quantity AS sales, 
                    (d.quantity * d.price) AS total_harga_jual
                FROM tr_transaction_detail d, tr_transaction e
                WHERE 
                    e.invoice_no = d.invoice_no
                    AND e.trans_date BETWEEN '$sdate' AND '$edate'
        ) AS tabledata, products
        WHERE products.code = tabledata.product_code
        GROUP BY product_code, products.name
        ORDER BY products.name ASC  
        ";
        // echo "<pre/>";print_r($query);exit;
        $db_query = DB::select(DB::raw($query));
        return $db_query;
    }
    // END REPORT MONTLY
}
