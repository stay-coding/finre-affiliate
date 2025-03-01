<?php

namespace App\Charts;

use App\Models\ReferalAccess;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($from = null, $to = null): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $get_click = DB::table('referals')
            ->join('referal_accesses', 'referals.id', '=', 'referal_accesses.referal_id')
            ->when(auth()->user()->hasRole('afiliator'), function ($query) {
                return $query->where('referals.user_id', Auth::user()->id);
            })
            ->when($from && $to, function ($query) use ($from, $to) {
                return $query->whereBetween('referal_accesses.created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                    ->select(
                        DB::raw("DATE(referal_accesses.created_at) as date"),                   // Format tanggal
                        DB::raw("COUNT(*) as total_clicks")                                     // Menjumlahkan klik
                    )->groupBy('date')                                                          // Kelompokkan berdasarkan tanggal
                    ->orderBy('date', 'asc');                                                   // Urutkan secara kronologis;
            }, function ($query) {
                return $query->whereYear('referal_accesses.created_at', date('Y'))
                    ->select(
                        DB::raw("MONTH(referal_accesses.created_at) as month"),                  // Format bulam
                        DB::raw("COUNT(*) as total_clicks")                                      // Menjumlahkan klik
                    )->groupBy('month')                                                          // Kelompokkan berdasarkan bulam
                    ->orderBy('month', 'asc');                                                   // Urutkan secara kronologis;
            })
            ->get();

        $get_sales = DB::table('comissions')
            ->when(auth()->user()->hasRole('afiliator'), function ($query) {
                return $query->where('user_id', Auth::user()->id);
            })
            ->when($from && $to, function ($query) use ($from, $to) {
                return $query->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                    ->select(
                        DB::raw("DATE(created_at) as date"),        // Format tanggal
                        DB::raw("COUNT(*) as total_sale")           // Menjumlahkan sale
                    )
                    ->groupBy('date')                               // Kelompokkan tanggal
                    ->orderBy('date', 'asc');                       // Urutkan secara kronologis
            }, function ($query) {
                return $query->whereYear('created_at', date('Y'))
                    ->select(
                        DB::raw("MONTH(created_at) as month"),      // Format bulan
                        DB::raw("COUNT(*) as total_sale")           // Menjumlahkan sale
                    )
                    ->groupBy('month')                              // Kelompokkan bulan
                    ->orderBy('month', 'asc');                      // Urutkan secara kronologis
            })
            ->get();

        $clicks = [];
        $sales = [];
        $dates = [];
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        if ($from && $to) {
            $period = CarbonPeriod::create($from, $to);

            foreach ($period as $date) {
                array_push($dates, $date->locale('id')->isoFormat('D MMMM YYYY'));
                $clicks[$date->format('Y-m-d')] = 0;
                $sales[$date->format('Y-m-d')] = 0;
            }

            // Isi array berdasarkan hasil query
            foreach ($get_click as $click) {
                $clicks[$click->date] = $click->total_clicks;
            }

            // Isi array berdasarkan hasil query
            foreach ($get_sales as $sale) {
                $sales[$sale->date] = $sale->total_sale;
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $clicks[$i] = 0;
                $sales[$i] = 0;
            }

            foreach ($get_click as $click) {
                $clicks[$click->month] = $click->total_clicks;
            }

            foreach ($get_sales as $sale) {
                $sales[$sale->month] = $sale->total_sale;
            }
        }

        return $this->chart->barChart()
            ->setTitle('Jumlah Klik vs Jumlah Sales ' . now()->locale('id')->isoFormat('YYYY'))
            ->addData('Klik', array_values($clicks))
            ->addData('Sales', array_values($sales))
            ->setXAxis($from && $to ? $dates : $month)
            ->setFontColor('#9e9e9e');
    }
}
