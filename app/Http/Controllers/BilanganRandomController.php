<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BilanganRandomController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // Zi = (aZi-1 +c) mod m
    // masukkan data masa lalu
    public function index()
    {
        $data_chart = [];
        $data_interval = [];
        $data_distribusi = [];
        $random = [];
        $chart_interval = [];
        $chart_simulasi = [];
        return view('dashboard', compact('data_distribusi','data_interval','random','data_chart', 'chart_interval', 'chart_simulasi'));
    }

    public function generate(Request $request)
    {
        $frekuensi = $request['frekuensi'];
        $permintaan = $request['permintaan'];
        $jmh = array_sum($frekuensi);
        $data_distribusi = []; 
        $data_interval = [];
        $kumulatif = [];
        $chart_interval = [];
        $chart_simulasi = [];
        foreach ($permintaan as $key => $value) {
            $curr_prob = $frekuensi[$key] / $jmh;
            $kumulatif[$key] = ($key > 0 ? $curr_prob + $kumulatif[$key-1]  : $curr_prob);
            $interval_from = ($key > 0 ? number_format($kumulatif[$key-1] + 0.01, 2) : 0);
            $data_interval[] = [
                "permintaan" => $permintaan[$key],
                "probabilitas" => number_format($frekuensi[$key] / $jmh, 2),
                "kumulatif" => number_format($kumulatif[$key], 2),
                "interval" => [
                    "from" => $interval_from,
                    "to" => number_format($kumulatif[$key], 2)
                ]
            ];

            $data_distribusi[] = [
                "permintaan" => $permintaan[$key],
                "frekuensi" => $frekuensi[$key]
            ];
        }

        $iterasi = $request['iterasi'];
        $a = $request['a'];
        $m = $request['m'];
        $z0 = $request['z'];
        $random = [];
        
        for ($i=0; $i < $iterasi; $i++) { 
            if ($i == 0) {
                $random[$i] = ($a * $z0) % $m;  
            } else {
                $random[$i] = ($a * $random[$i-1]) % $m;
            }
        }

        foreach ($random as $key => $value) {
            $bil_rand = number_format($value / 128, 2);
            $random[$key] = [
              "bilangan" => $bil_rand
            ];
            foreach ($data_interval as $k => $data) {
                $from = $data['interval']['from'];
                $to = $data['interval']['to'];
                
                if ($bil_rand >= $from && $bil_rand <= $to) {
                    $random[$key]["kebutuhan"] = $data_interval[$k]['permintaan'];
                    // dd($bil_rand,$from,$bil_rand >= $from, $data_interval[$k]['permintaan']);
                }
            }

            $chart_simulasi['label'][$key] = $key+1;
            $chart_simulasi['series'][$key] = $random[$key]["kebutuhan"];

        }

        foreach ($data_interval as $key => $value) {
            $chart_interval['label'][$key] = $value['permintaan'];
            $chart_interval['series'][$key] = $value['kumulatif'];
        }

        // dd($chart_simulasi);

        // $chart_simulasi = [
        //     "label" => ['1','2','3','4', '5', '6', '7', '8', '9', '10'],
        //     "series" => [6, 6, 8, 7, 8, 7, 5, 8, 4, 7]
        // ];

        return view('dashboard', compact('data_distribusi','data_interval', 'random', 'chart_interval', 'chart_simulasi'));
    }

    function random(Request $request)
    {
        dd('i am here');
    }
}