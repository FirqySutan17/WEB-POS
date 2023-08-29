<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:RS Show', ['only' => 'report_stock']);
        $this->middleware('permission:RT Show', ['only' => 'report_transaction']);
    }
    
    public function report_stock(Request $request) {
        $data   = [];
        $sdate  = "";
        $edate  = ""; 
        if ($request->_token) {
            $sdate = $request->sdate;
            $edate = $request->edate;
            $data = $this->get_stock($sdate, $edate);
        }
        return view('admin.report.stock', compact('data', 'sdate', 'edate'));
    }

    private function get_stock($sdate, $edate) {
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
            WHERE deleted_at IS NULL
            ORDER BY products.name ASC, products.code ASC       
        ";

        $db_query = DB::select(DB::raw($query));
        return $db_query;
    }

    public function report_transaction(Request $request) {
        $data   = [];
        $sdate  = "";
        $edate  = ""; 
        if ($request->_token) {
            $sdate = $request->sdate;
            $edate = $request->edate;
            $data = $this->get_transaction($sdate, $edate);
        }
        return view('admin.report.transaction', compact('data', 'sdate', 'edate'));
    }

    private function get_transaction($sdate, $edate) {
        $query = "
            SELECT trans.invoice_no, trans.trans_date, trans.payment_method, trans.total_price, users.employee_id, users.name
            FROM tr_transaction trans
            INNER JOIN users ON trans.emp_no = users.employee_id
            WHERE trans.trans_date BETWEEN '$sdate' AND '$edate'
        ";

        $db_query = DB::select(DB::raw($query));
        return $db_query;
    }
}
