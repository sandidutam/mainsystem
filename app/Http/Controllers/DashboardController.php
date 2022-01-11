<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Neraca;
use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');

        $sumneraca = Neraca::all()->count();
        $sumdebit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        $sumkredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        $balance = $sumdebit - $sumkredit;

        $date0v2 = Carbon::now()->subDays(0)->timezone('Asia/Jakarta')->format('d F Y');
        $date1v2 = Carbon::now()->subDays(1)->timezone('Asia/Jakarta')->format('d F Y');
        $date2v2 = Carbon::now()->subDays(2)->timezone('Asia/Jakarta')->format('d F Y');
        $date3v2 = Carbon::now()->subDays(3)->timezone('Asia/Jakarta')->format('d F Y');
        $date4v2 = Carbon::now()->subDays(4)->timezone('Asia/Jakarta')->format('d F Y');
        $date5v2 = Carbon::now()->subDays(5)->timezone('Asia/Jakarta')->format('d F Y');
        $date6v2 = Carbon::now()->subDays(6)->timezone('Asia/Jakarta')->format('d F Y');
        $date7v2 = Carbon::now()->subDays(7)->timezone('Asia/Jakarta')->format('d F Y');

        $categories =       [
            $date6v2,
            $date5v2,
            $date4v2,
            $date3v2,
            $date2v2,
            $date1v2,
            $date0v2
                            ];

        $date1 = Carbon::now()->subDays(1)->timezone('Asia/Jakarta')->format('Y-m-d');
        $date2 = Carbon::now()->subDays(2)->timezone('Asia/Jakarta')->format('Y-m-d');
        $date3 = Carbon::now()->subDays(3)->timezone('Asia/Jakarta')->format('Y-m-d');
        $date4 = Carbon::now()->subDays(4)->timezone('Asia/Jakarta')->format('Y-m-d');
        $date5 = Carbon::now()->subDays(5)->timezone('Asia/Jakarta')->format('Y-m-d');
        $date6 = Carbon::now()->subDays(6)->timezone('Asia/Jakarta')->format('Y-m-d');
        $date7 = Carbon::now()->subDays(7)->timezone('Asia/Jakarta')->format('Y-m-d');

        $group1sumhadir = Presensi::where('tanggal', '=', $today)->where('keterangan','Hadir')->count();
        $group1sumbolos = Presensi::where('tanggal', '=', $today)->where('keterangan','Bolos')->count();
        $group1sumcuti = Presensi::where('tanggal', '=', $today)->where('keterangan','Cuti')->count();
        $group1sumsakit = Presensi::where('tanggal', '=', $today)->where('keterangan','Sakit')->count();
        $group1sumizin = Presensi::where('tanggal', '=', $today)->where('keterangan','Izin')->count();

        $group2sumhadir = Presensi::where('tanggal', '=', $date1)->where('keterangan','Hadir')->count();
        $group2sumbolos = Presensi::where('tanggal', '=', $date1)->where('keterangan','Bolos')->count();
        $group2sumcuti = Presensi::where('tanggal', '=', $date1)->where('keterangan','Cuti')->count();
        $group2sumsakit = Presensi::where('tanggal', '=', $date1)->where('keterangan','Sakit')->count();
        $group2sumizin = Presensi::where('tanggal', '=', $date1)->where('keterangan','Izin')->count();

        $group3sumhadir = Presensi::where('tanggal', '=', $date2)->where('keterangan','Hadir')->count();
        $group3sumbolos = Presensi::where('tanggal', '=', $date2)->where('keterangan','Bolos')->count();
        $group3sumcuti = Presensi::where('tanggal', '=', $date2)->where('keterangan','Cuti')->count();
        $group3sumsakit = Presensi::where('tanggal', '=', $date2)->where('keterangan','Sakit')->count();
        $group3sumizin = Presensi::where('tanggal', '=', $date2)->where('keterangan','Izin')->count();

        $group4sumhadir = Presensi::where('tanggal', '=', $date3)->where('keterangan','Hadir')->count();
        $group4sumbolos = Presensi::where('tanggal', '=', $date3)->where('keterangan','Bolos')->count();
        $group4sumcuti = Presensi::where('tanggal', '=', $date3)->where('keterangan','Cuti')->count();
        $group4sumsakit = Presensi::where('tanggal', '=', $date3)->where('keterangan','Sakit')->count();
        $group4sumizin = Presensi::where('tanggal', '=', $date3)->where('keterangan','Izin')->count();

        $group5sumhadir = Presensi::where('tanggal', '=', $date4)->where('keterangan','Hadir')->count();
        $group5sumbolos = Presensi::where('tanggal', '=', $date4)->where('keterangan','Bolos')->count();
        $group5sumcuti = Presensi::where('tanggal', '=', $date4)->where('keterangan','Cuti')->count();
        $group5sumsakit = Presensi::where('tanggal', '=', $date4)->where('keterangan','Sakit')->count();
        $group5sumizin = Presensi::where('tanggal', '=', $date4)->where('keterangan','Izin')->count();

        $group6sumhadir = Presensi::where('tanggal', '=', $date5)->where('keterangan','Hadir')->count();
        $group6sumbolos = Presensi::where('tanggal', '=', $date5)->where('keterangan','Bolos')->count();
        $group6sumcuti = Presensi::where('tanggal', '=', $date5)->where('keterangan','Cuti')->count();
        $group6sumsakit = Presensi::where('tanggal', '=', $date5)->where('keterangan','Sakit')->count();
        $group6sumizin = Presensi::where('tanggal', '=', $date5)->where('keterangan','Izin')->count();

        $group7sumhadir = Presensi::where('tanggal', '=', $date6)->where('keterangan','Hadir')->count();
        $group7sumbolos = Presensi::where('tanggal', '=', $date6)->where('keterangan','Bolos')->count();
        $group7sumcuti = Presensi::where('tanggal', '=', $date6)->where('keterangan','Cuti')->count();
        $group7sumsakit = Presensi::where('tanggal', '=', $date6)->where('keterangan','Sakit')->count();
        $group7sumizin = Presensi::where('tanggal', '=', $date6)->where('keterangan','Izin')->count();

        $data1 = [
            $group7sumhadir,
            $group6sumhadir,
            $group5sumhadir,
            $group4sumhadir,
            $group3sumhadir,
            $group2sumhadir,
            $group1sumhadir

        ];
        $data2 = [
            $group7sumbolos,
            $group6sumbolos,
            $group5sumbolos,
            $group4sumbolos,
            $group3sumbolos,
            $group2sumbolos,
            $group1sumbolos

        ];
        $data3 = [
            $group7sumcuti,
            $group6sumcuti,
            $group5sumcuti,
            $group4sumcuti,
            $group3sumcuti,
            $group2sumcuti,
            $group1sumcuti

        ];
        $data4 = [
            $group7sumsakit,
            $group6sumsakit,
            $group5sumsakit,
            $group4sumsakit,
            $group3sumsakit,
            $group2sumsakit,
            $group1sumsakit

        ];
        $data5 = [
            $group7sumizin,
            $group6sumizin,
            $group5sumizin,
            $group4sumizin,
            $group3sumizin,
            $group2sumizin,
            $group1sumizin

        ];

        $tahun = Carbon::now()->format('Y');
        $tahunkemarin = Carbon::now()->subYears(1)->format('Y');

        $monthname1 = Carbon::now()->subMonth(0)->timezone('Asia/Jakarta')->format('F Y');
        $monthname2 = Carbon::now()->subMonth(1)->timezone('Asia/Jakarta')->format('F Y');
        $monthname3 = Carbon::now()->subMonth(2)->timezone('Asia/Jakarta')->format('F Y');
        $monthname4 = Carbon::now()->subMonth(3)->timezone('Asia/Jakarta')->format('F Y');
        $monthname5 = Carbon::now()->subMonth(4)->timezone('Asia/Jakarta')->format('F Y');
        $monthname6 = Carbon::now()->subMonth(5)->timezone('Asia/Jakarta')->format('F Y');
        $monthname7 = Carbon::now()->subMonth(6)->timezone('Asia/Jakarta')->format('F Y');
        $monthname9 = Carbon::now()->subMonth(8)->timezone('Asia/Jakarta')->format('F Y');
        $monthname8 = Carbon::now()->subMonth(7)->timezone('Asia/Jakarta')->format('F Y');
        $monthname10 = Carbon::now()->subMonth(9)->timezone('Asia/Jakarta')->format('F Y');
        $monthname11 = Carbon::now()->subMonth(10)->timezone('Asia/Jakarta')->format('F Y');
        $monthname12 = Carbon::now()->subMonth(11)->timezone('Asia/Jakarta')->format('F Y');

        $month1 = Carbon::now()->subMonth(0)->timezone('Asia/Jakarta')->format('Y-m');
        $month2 = Carbon::now()->subMonth(1)->timezone('Asia/Jakarta')->format('Y-m');
        $month3 = Carbon::now()->subMonth(2)->timezone('Asia/Jakarta')->format('Y-m');
        $month4 = Carbon::now()->subMonth(3)->timezone('Asia/Jakarta')->format('Y-m');
        $month5 = Carbon::now()->subMonth(4)->timezone('Asia/Jakarta')->format('Y-m');
        $month6 = Carbon::now()->subMonth(5)->timezone('Asia/Jakarta')->format('Y-m');
        $month7 = Carbon::now()->subMonth(6)->timezone('Asia/Jakarta')->format('Y-m');
        $month8 = Carbon::now()->subMonth(7)->timezone('Asia/Jakarta')->format('Y-m');
        $month9 = Carbon::now()->subMonth(8)->timezone('Asia/Jakarta')->format('Y-m');
        $month10 = Carbon::now()->subMonth(9)->timezone('Asia/Jakarta')->format('Y-m');
        $month11 = Carbon::now()->subMonth(10)->timezone('Asia/Jakarta')->format('Y-m');
        $month12 = Carbon::now()->subMonth(11)->timezone('Asia/Jakarta')->format('Y-m');

        $monthcategories =       [
            $monthname12,
            $monthname11,
            $monthname10,
            $monthname9,
            $monthname8,
            $monthname7,
            $monthname6,
            $monthname5,
            $monthname4,
            $monthname3,
            $monthname2,
            $monthname1
                            ];

        $d1 = Neraca::where('bulan', $month1)->whereNotNull('debit')->sum('debit');
        $d2 = Neraca::where('bulan', $month2)->whereNotNull('debit')->sum('debit');
        $d3 = Neraca::where('bulan', $month3)->whereNotNull('debit')->sum('debit');
        $d4 = Neraca::where('bulan', $month4)->whereNotNull('debit')->sum('debit');
        $d5 = Neraca::where('bulan', $month5)->whereNotNull('debit')->sum('debit');
        $d6 = Neraca::where('bulan', $month6)->whereNotNull('debit')->sum('debit');
        $d7 = Neraca::where('bulan', $month7)->whereNotNull('debit')->sum('debit');
        $d8 = Neraca::where('bulan', $month8)->whereNotNull('debit')->sum('debit');
        $d9 = Neraca::where('bulan', $month9)->whereNotNull('debit')->sum('debit');
        $d10 = Neraca::where('bulan', $month10)->whereNotNull('debit')->sum('debit');
        $d11 = Neraca::where('bulan', $month11)->whereNotNull('debit')->sum('debit');
        $d12 = Neraca::where('bulan', $month12)->whereNotNull('debit')->sum('debit');
        $d13 = Neraca::where('bulan', '<', $month12)->whereNotNull('debit')->sum('debit');

        $k1 = Neraca::where('bulan', $month1)->whereNotNull('kredit')->sum('kredit');
        $k2 = Neraca::where('bulan', $month2)->whereNotNull('kredit')->sum('kredit');
        $k3 = Neraca::where('bulan', $month3)->whereNotNull('kredit')->sum('kredit');
        $k4 = Neraca::where('bulan', $month4)->whereNotNull('kredit')->sum('kredit');
        $k5 = Neraca::where('bulan', $month5)->whereNotNull('kredit')->sum('kredit');
        $k6 = Neraca::where('bulan', $month6)->whereNotNull('kredit')->sum('kredit');
        $k7 = Neraca::where('bulan', $month7)->whereNotNull('kredit')->sum('kredit');
        $k8 = Neraca::where('bulan', $month8)->whereNotNull('kredit')->sum('kredit');
        $k9 = Neraca::where('bulan', $month9)->whereNotNull('kredit')->sum('kredit');
        $k10 = Neraca::where('bulan', $month10)->whereNotNull('kredit')->sum('kredit');
        $k11 = Neraca::where('bulan', $month11)->whereNotNull('kredit')->sum('kredit');
        $k12 = Neraca::where('bulan', $month12)->whereNotNull('kredit')->sum('kredit');
        $k13 = Neraca::where('bulan', '<', $month12)->whereNotNull('kredit')->sum('kredit');

        $lastyeartotalkredit = Neraca::where('tahun', '!=', $tahun)->whereNotNull('kredit')->sum('kredit');
        $lastyeartotaldebit = Neraca::where('tahun', '!=', $tahun)->whereNotNull('debit')->sum('debit');
        $lastbalance = $d13 - $k13;

        $balance12 = $lastbalance + $d12 - $k12 ;
        $balance11 = $balance12 + $d11 - $k11 ;
        $balance10 = $balance11 + $d10 - $k10 ;
        $balance9 = $balance10 + $d9 - $k9 ;
        $balance8 = $balance9 + $d8 - $k8 ;
        $balance7 = $balance8 + $d7 - $k7 ;
        $balance6 = $balance7 + $d6 - $k6 ;
        $balance5 = $balance6 + $d5 - $k5 ;
        $balance4 = $balance5 + $d4 - $k4 ;
        $balance3 = $balance4 + $d3 - $k3 ;
        $balance2 = $balance3 + $d2 - $k2 ;
        $balance1 = $balance2 + $d1 - $k1;

        $databalance = [
            $balance12 ,
            $balance11 ,
            $balance10 ,
            $balance9 ,
            $balance8 ,
            $balance7 ,
            $balance6 ,
            $balance5 ,
            $balance4 ,
            $balance3 ,
            $balance2 ,
            $balance1
        ];

        $datadebit = [
            $d12,
            $d11,
            $d10,
            $d9,
            $d8,
            $d7,
            $d6,
            $d5,
            $d4,
            $d3,
            $d2,
            $d1
        ];

        $datakredit = [
            $k12,
            $k11,
            $k10,
            $k9,
            $k8,
            $k7,
            $k6,
            $k5,
            $k4,
            $k3,
            $k2,
            $k1,
        ];

        $jml_pegawai= Pegawai::all()->count();

        $jml_hadir = Pegawai::whereHas('presensi', function ($query) {
            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
            $query->where('tanggal', '=', $today)
            ->where('jam_masuk', '!=', '00:00:00')
            ->where('catatan_masuk', '!=', '-');
            })->count();

        $jml_bolos = Pegawai::whereHas('presensi', function ($query) {
                    $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                    $query->where('tanggal', '=', $today)
                    ->where('catatan_masuk', '=', '-')
                    ->where('keterangan', '=', 'Bolos');
                    })->count();

        $jml_cuti = Pegawai::whereHas('presensi', function ($query) {
                        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $query->where('tanggal', '=', $today)
                        ->where('catatan_masuk', '=', '-')
                        ->where('keterangan', '=', 'Cuti');
                        })->count();

        $jml_izin = Pegawai::whereHas('presensi', function ($query) {
                        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $query->where('tanggal', '=', $today)
                        ->where('catatan_masuk', '=', '-')
                        ->where('keterangan', '=', 'Izin');
                        })->count();

        $jml_sakit = Pegawai::whereHas('presensi', function ($query) {
                        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $query->where('tanggal', '=', $today)
                        ->where('catatan_masuk', '=', '-')
                        ->where('keterangan', '=', 'Sakit');
                        })->count();


        $izin = $jml_cuti+$jml_izin+$jml_sakit;
        $belum_hadir = $jml_pegawai-$jml_hadir-$jml_bolos-$jml_cuti-$jml_izin-$jml_sakit;

        $jml_s1 = Pegawai::where('sektor_area','1')->count();
        $jml_s2 = Pegawai::where('sektor_area','2')->count();
        $jml_s3 = Pegawai::where('sektor_area','3')->count();
        $jml_s4 = Pegawai::where('sektor_area','4')->count();


        return view('dashboard.index', compact ('categories',
                                                'monthcategories',
                                                'data1',
                                                'data2',
                                                'data3',
                                                'data4',
                                                'data5',
                                                'databalance',
                                                'datadebit',
                                                'datakredit',
                                                'today',
                                                'sumneraca',
                                                'sumdebit',
                                                'sumkredit',
                                                'balance',
                                                'belum_hadir',
                                                'jml_hadir',
                                                'jml_bolos',
                                                'izin',
                                                'jml_s1',
                                                'jml_s2',
                                                'jml_s3',
                                                'jml_s4'
                                                ));
    }
}
