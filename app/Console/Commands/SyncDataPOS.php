<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


class SyncDataPOS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pos:sync-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Data DB POS to ORACLE CMS SUJA';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 'CRON POS Sync Data!';
        $this->get_cashflow();
    }

    
    private function get_cashflow()
    {
        $tbl_name = 'cash_flow';
        $last_sync  = DB::table('logs_sync_cms')->select('created_at', 'batch')->where('table_name', $tbl_name)->orderBy('id', 'DESC')->first();
        $current_time   = date('Y-m-d H:i:s');
        $query      = DB::table($tbl_name)->select('*');
        if (!empty($last_sync)) {
            $query->whereBetween('created_at', [$last_sync->created_at, $current_time]);
        } else {
            $query->where('created_at', '<=', $current_time);
        }
        $get_data   = $query->get();

        if (!empty($get_data)) {
            $header     = $this->get_cashflow_header();
            $convert_data   = $this->convert_cashflow($get_data);
            $insert_data    = $this->insert_cashflow($header, $convert_data);

            // $url = '103.209.6.32:8080/suja/pos-sync-data';
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, ["query" => $insert_data]);
            // $return = curl_exec($ch);
            // curl_close($ch);

        }
        $batch = !empty($last_sync->batch) ? $last_sync->batch + 1 : 1;

        $insert_logs = DB::table('logs_sync_cms')->insert([
            "table_name"    => $tbl_name,
            "batch"         => $batch,
            "created_at"    => date('Y-m-d H:i:s'),
            "updated_at"    => date('Y-m-d H:i:s')
        ]);
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
            // $curr_data  = [$cf->date, $cf->time, $cf->employee_id, $cf->categories, $cf->description, $cf->approval, $cf->cash, $cf->created_at];
            $curr_data  = [$cf->date, $cf->time, $cf->employee_id];

            $implode    = implode(",", $curr_data);
            $data[]     = "INTO POS_CASH_FLOW VALUES (".$cf->id.", '".str_replace(",", "', '", $implode)."')";
        }

        return $data;
    }

    private function insert_cashflow($header, $data)
    {
        $implode_data = implode(" ", $data);
        // dd($implode_data, $data);
        $query = "
            INSERT ALL
            ".$implode_data."
            SELECT 1 FROM dual
        ";
        return $query;
    }
}
