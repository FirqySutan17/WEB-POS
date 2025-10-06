<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DatabaseController extends Controller
{

public function download()
{
    $dbName = env('DB_DATABASE');
    $user   = env('DB_USERNAME');
    $pass   = env('DB_PASSWORD');
    $host   = env('DB_HOST');
    $port   = env('DB_PORT', 3306);

    $fileName = $dbName . '_' . date('Y-m-d_H-i-s') . '.sql';
    $documentPath = env('USERPROFILE') . '\Documents\BackUp DB';

    if (!file_exists($documentPath)) {
        mkdir($documentPath, 0777, true);
    }

    $filePath = $documentPath . '\\' . $fileName;

    // pakai path absolut mysqldump
    $mysqldump = 'C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqldump.exe';

    if (!empty($pass)) {
        $command = "\"{$mysqldump}\" --user={$user} --password={$pass} --host={$host} --port={$port} {$dbName} --result-file=\"{$filePath}\"";
    } else {
        $command = "\"{$mysqldump}\" --user={$user} --host={$host} --port={$port} {$dbName} --result-file=\"{$filePath}\"";
    }

    $output = null;
    $returnVar = null;
    exec($command . " 2>&1", $output, $returnVar);

    if ($returnVar !== 0) {
        dd("Backup gagal", $command, $output);
    }

    return response()->download($filePath)->deleteFileAfterSend(false);
}
}
