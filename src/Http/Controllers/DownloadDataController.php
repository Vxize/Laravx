<?php

namespace Vxize\Lavx\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DownloadDataController extends Controller
{
    public static function toCSV($header, $body, $file_name = 'data')
    {
        $headers = [
            'Expires' => 0,
            'Pragma' => 'no-cache',
            'Cache-Control' => 'max-age=0, no-cache, must-revalidate, proxy-revalidate',
            'Content-Encoding' => 'UTF-8',
            'Content-type' => 'text/csv;charset=utf-8',
            'Content-Disposition' => 'attachment; filename="'.$file_name.'.csv"',
        ];
        $header = self::prepareHeader($header);
        $body = self::prepareBody($header, $body);
        return response()->stream(function() use($header, $body) {
            $fp= fopen('php://output', 'w');
            fwrite($fp,chr(0xEF).chr(0xBB).chr(0xBF)); // output BOM header
            fputcsv($fp, $header);
            foreach($body as $row) {
                fputcsv($fp, $row);
            }
            fclose($fp);
        }, 200, $headers);
    }

    public static function prepareBody($header, $body)
    {
        $result = [];
        foreach ($body as $row) {
            $row_data = [];
            foreach ($header as $col => $name) {
                $row_data[$col] = Arr::get($row, $col, '');
            }
            $result[] = $row_data;
        }
        return $result;
    }

    public static function prepareHeader($header)
    {
        foreach ($header as $key => $hd) {
            $header[$key] = __($hd);
        }
        return $header;
    }

}
