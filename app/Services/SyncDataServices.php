<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SyncDataServices 
{
    static function synchronize_data($query)
    {
      $url = "http://10.137.26.67:8080/";
      // if (!in_array($ip, $arr_local_ip)) {
          // $url = "http://103.209.6.32:8080/";
      // }
      $url .= 'meatmaster/api/pos';
      $options = [
          'Accept' => 'application/json',
      ];
      $response = Http::post($url, [
          'query' => $query
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

      return $status;
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

}