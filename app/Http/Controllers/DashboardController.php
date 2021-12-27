<?php

namespace App\Http\Controllers;

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

        $d1 = Neraca::where('bulan', '1')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d2 = Neraca::where('bulan', '2')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d3 = Neraca::where('bulan', '3')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d4 = Neraca::where('bulan', '4')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d5 = Neraca::where('bulan', '5')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d6 = Neraca::where('bulan', '6')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d7 = Neraca::where('bulan', '7')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d8 = Neraca::where('bulan', '8')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d9 = Neraca::where('bulan', '9')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d10 = Neraca::where('bulan', '10')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d11 = Neraca::where('bulan', '11')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');
        $d12 = Neraca::where('bulan', '12')->where('tahun', $tahun)->whereNotNull('debit')->sum('debit');

        $k1 = Neraca::where('bulan', '1')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k2 = Neraca::where('bulan', '2')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k3 = Neraca::where('bulan', '3')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k4 = Neraca::where('bulan', '4')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k5 = Neraca::where('bulan', '5')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k6 = Neraca::where('bulan', '6')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k7 = Neraca::where('bulan', '7')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k8 = Neraca::where('bulan', '8')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k9 = Neraca::where('bulan', '9')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k10 = Neraca::where('bulan', '10')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k11 = Neraca::where('bulan', '11')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');
        $k12 = Neraca::where('bulan', '12')->where('tahun', $tahun)->whereNotNull('kredit')->sum('kredit');


        $databalance = [
            $balance1 = $d1 - $k1 ,
            $balance2 = $balance1 + $d2 - $k2 ,
            $balance3 = $balance2 + $d3 - $k3 ,
            $balance4 = $balance3 + $d4 - $k4 ,
            $balance5 = $balance4 + $d5 - $k5 ,
            $balance6 = $balance5 + $d6 - $k6 ,
            $balance7 = $balance6 + $d7 - $k7 ,
            $balance8 = $balance7 + $d8 - $k8 ,
            $balance9 = $balance8 + $d9 - $k9 ,
            $balance10 = $balance9 + $d10 - $k10 ,
            $balance11 = $balance10 + $d11 - $k11 ,
            $balance12 = $balance11 + $d12 - $k12
        ];

        $datadebit = [
            $d1,
            $d2,
            $d3,
            $d4,
            $d5,
            $d6,
            $d7,
            $d8,
            $d9,
            $d10,
            $d11,
            $d12
        ];

        $datakredit = [
            $k1,
            $k2,
            $k3,
            $k4,
            $k5,
            $k6,
            $k7,
            $k8,
            $k9,
            $k10,
            $k11,
            $k12
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

        return view('dashboard.index', compact ('categories',
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
                                                ));
    }
}
