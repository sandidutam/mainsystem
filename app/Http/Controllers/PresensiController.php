<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Exports\PresensiExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use App\Exports\PresensiMultiSheetExport;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexIn(Request $request)
    {

        // $data_pegawai = Pegawai::where('nomor_pegawai', 'LIKE', '%'.$request->search.'%')->get();
        // $data_presensi = Presensi::where('nomor_pegawai', 'LIKE', '%'.$request->search.'%')->orderBy('id','DESC')->take(1)->get();

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        // $status = DB::table('presensi')
        //                 ->where('tanggal' ,'=', $today )
        //                 ->count();
        // $data_pegawai = Pegawai::all();

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        // $data_pegawai = Pegawai::all();

        $data_lain = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_belakang','ASC')->whereHas('presensi', function ($query) {
                                $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
                                $query->where('tanggal', '=', $hari_ini)
                                ->orderBy('id','DESC');
                                })->with('presensi')->get();

        $data_pegawai = Pegawai::select("*")->orderBy('nama_depan','ASC')->orderBy('nama_belakang','ASC')
                            ->whereDoesntHave('presensi', function ($query) {
                            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', $today);
                            })->get();

        // $data_pegawai = Pegawai::doesnthave('presensi')->get();


        return view('presensi.indexIn',compact('data_pegawai'));
    }

    public function indexOut(Request $request)
    {

        // $data_presensi = Presensi::where('nomor_pegawai', 'LIKE', '%'.$request->search.'%')->orderBy('id','DESC')->take(1)->get();


        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        // $data_presensi = DB::table('presensi')
        //                             ->where('tanggal' ,'=', $today )
        //                             ->where('jam_keluar' , '=', null)
        //                             ->get();

        // $data_presensi = Presensi::whereHas('pegawai', function ($query) {
        //     $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //     $query->where('tanggal', '=', $today)
        //     ->where('jam_keluar' , '=', null);
        //     })->with('pegawai')->get();

        $data_presensi = Pegawai::select("*")->orderBy('nama_depan','ASC')->orderBy('nama_belakang','ASC')->whereHas('presensi', function ($query) {
            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
            $query->where('tanggal', '=', $today)
            ->where('jam_keluar' , '=', null);
            })->get();

        // return $data_presensi;
        // $data_presensi = Presensi::all();
        return view('presensi.indexOut',compact('data_presensi'));
    }

    public function checkIn($id)
    {
        $id_pegawai = Crypt::decryptString($id);

        $data_pegawai = Pegawai::find($id_pegawai);

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('D, d-m-Y');

        return view ('presensi.checkin',compact('data_pegawai','today'));
    }

    public function checkOut($id)
    {
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');

        $id_pegawai = Crypt::decryptString($id);

        // return $id_pegawai;

        $data_presensi = Presensi::where('tanggal', '=', $today)->where('pegawai_id', '=', $id_pegawai)->first();

        // return $data_presensi;

        // $data_presensi = Presensi::whereHas('pegawai', function ($query) {
        //     $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //     $query->where('tanggal', '=', $today)
        //     ->where('pegawai_id', '=', $id_pegawai);
        //     })->with('pegawai')->get();

        // return $data_presensi;

        return view ('presensi.checkout',compact('data_presensi','today'));
    }

    public function history()
    {
        $data_presensi = Presensi::orderBy('updated_at','DESC')->get();

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
        $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('d F Y');
        $jml_pegawai= Pegawai::all()->count();

        $today_presensi = Presensi::orderBy('updated_at','DESC')->where('tanggal', '=', $today)->get();

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


        $data_pegawai = Pegawai::all();


        $data_belum_hadir = Pegawai::select("*")->orderBy('nama_depan','ASC')->orderBy('nama_belakang','ASC')
                        ->whereDoesntHave('presensi', function ($query) {
                            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', $today);
                        })
                        ->get();

        $data_hadir = Presensi::whereHas('pegawai', function ($query) {
                                $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                $query->where('tanggal', '=', $today)
                                ->where('jam_masuk', '!=', '00:00:00')
                                ->where('catatan_masuk', '!=', '-');
                                })->with('pegawai')->get();

        $data_bolos = Pegawai::whereHas('presensi', function ($query) {
                                $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                $query->where('tanggal', '=', $today)
                                ->where('catatan_masuk', '=', '-')
                                ->where('keterangan', '=', 'Bolos');
                                })->get();

        $data_lain2 = Pegawai::whereHas('presensi', function ($query) {
                            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', '=', $today)
                            ->where('catatan_masuk', '=', '-')
                            ->where('keterangan', '!=', 'Bolos');
                            })->get();

        $data_lain = Presensi::whereHas('pegawai', function ($query) {
                            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', '=', $today)
                            ->where('catatan_masuk', '=', '-')
                            ->where('keterangan', '!=', 'Bolos');
                            })->with('pegawai')->get();

        $a = Presensi::select('created_at')->where('pegawai_id', 1 )->where('tanggal', '=', $kemarin)->get();
        $b = Presensi::select('updated_at')->where('pegawai_id', 1 )->where('tanggal', '=', $kemarin)->get();

        $x = Presensi::where('pegawai_id', 1 )->where('tanggal', '=', $kemarin)->value('created_at');
        $y = Presensi::where('pegawai_id', 1 )->where('tanggal', '=', $kemarin)->value('updated_at');

        $izin = $jml_cuti+$jml_izin+$jml_sakit;
        $belum_hadir = $jml_pegawai-$jml_hadir-$jml_bolos-$jml_cuti-$jml_izin-$jml_sakit;

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

        // dd(json_encode($categories));

        return view('presensi.history', compact('data_presensi',
                                                'belum_hadir',
                                                'jml_hadir',
                                                'jml_bolos',
                                                'jml_cuti','jml_izin',
                                                'jml_sakit',
                                                'izin',
                                                'hari_ini',
                                                'today_presensi',
                                                'data_pegawai',
                                                'data_hadir',
                                                'data_belum_hadir',
                                                'data_bolos',
                                                'data_lain',
                                                'categories',
                                                'data1',
                                                'data2',
                                                'data3',
                                                'data4',
                                                'data5'
                                                ));
    }

    public function activity()
    {
        $data_presensi = Presensi::orderBy('updated_at','DESC')->get()->groupBy(function($item) {
            return $item->created_at->format('d F Y');
        });

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
        $besok = Carbon::tomorrow()->timezone('Asia/Jakarta')->format('Y-m-d');
        // return $data_presensi;
        $tanggal = Presensi::select('tanggal')->get();
        // return $tanggal;

        $data_hari_ini = Presensi::orderBy('updated_at','DESC')->whereHas('pegawai', function ($query) {
                        $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $query->where('tanggal', '=', $hari_ini);
                        })->with('pegawai')->get();


        $data_kemarin = Presensi::orderBy('updated_at','DESC')->whereHas('pegawai', function ($query) {
                        $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $query->where('tanggal', '=', $kemarin);
                        })->with('pegawai')->get();

        $data_lain = Presensi::orderBy('updated_at','DESC')->whereHas('pegawai', function ($query) {
                            $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                            $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', '!=', $kemarin)
                            ->where('tanggal', '!=', $hari_ini);
                            })->with('pegawai')->get();


        return view('presensi.activity', compact('data_presensi','hari_ini','kemarin','besok','tanggal','data_hari_ini','data_kemarin','data_lain'));
    }

    public function store(Request $request)
    {
        $date = date("Y-m-d");

        $batas_awal_waktu_masuk = Carbon::createFromFormat('H:i:s', '05:40:00')->format('H'.'i'.'s');
        $batas_akhir_waktu_masuk = Carbon::createFromFormat('H:i:s', '07:00:00')->format('H'.'i'.'s');
        $batas_awal_waktu_keluar = Carbon::createFromFormat('H:i:s', '16:30:00')->format('H'.'i'.'s');
        $batas_akhir_waktu_keluar = Carbon::createFromFormat('H:i:s', '17:30:00')->format('H'.'i'.'s');

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $current_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');
        $check_time = Carbon::createFromFormat('H:i:s', $current_time)->format('H'.'i'.'s');
        $yesterday = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->timezone('Asia/Jakarta')->format('Y-m-d');

        // $time > $batas_awal_waktu_keluar && $time < $batas_akhir_waktu_keluar


        $check_date = Presensi::where('tanggal','=',$current_time)->count();

        $presensi = new Presensi();

        // Awal Fungsi Absen Masuk

        if(isset($request->btn_masuk))
        {

            $check_for_double = DB::table('presensi')
                                    ->where('tanggal' ,'=', $today )
                                    ->where('pegawai_id' ,'=', $request->id)
                                    ->count();

            if ($check_for_double > 0) {
                return redirect()->route('presensi.history')->with('notifikasi_gagal','Pegawai hanya bisa absen masuk sekali dalam sehari !');
            }

            if( $today )
            {

                if( $check_time > $batas_awal_waktu_masuk && $check_time < $batas_akhir_waktu_masuk )
                {
                    $note = 'Datang Tepat Waktu ';
                } elseif( $check_time > $batas_akhir_waktu_masuk)
                {
                    $note = 'Datang Telat ';
                } else
                {
                    return redirect('/presensi/riwayat')->with('notifikasi_gagal','Belum bisa absen');
                }
                $nama = $request->nama_lengkap;
                $presensi->pegawai_id = $request->id;
                $presensi->tanggal = $today;
                $presensi->jam_masuk = $current_time;
                $presensi->catatan_masuk = $note;
                $presensi->keterangan = "Hadir";

                $id_peg = $request->id;
                $find_pegawai = Pegawai::find($id_peg);
                $find_pegawai->status = "Sudah Hadir";
                $find_pegawai->update();

                // dd($presensi);

                $simpan = $presensi->save();

                if( $simpan )
                {
                    return redirect('/presensi/riwayat')->with('notifikasi_sukses', $nama.' sudah datang !');
                }
            } else {
                return redirect('/presensi/riwayat')->with('notifikasi_gagal','Pegawai hanya bisa absen masuk sekali dalam sehari !');
            }
        }

        elseif(isset($request->btn_absen))
        {
            $id_pegawai = $request->id;

            $data_pegawai = Pegawai::find($id_pegawai);

            $validator = Validator::make($request->all(), [
                'keterangan' => 'required',
            ]);

            if($validator->fails()) {
                return redirect()->route('presensi.checkin', Crypt::encryptString($data_pegawai->id))
                                    ->withErrors($validator)
                                    ->withInput();
            }


            $nama = $request->nama_lengkap;
            $ket = $request->keterangan;

            $presensi->pegawai_id = $request->id;
            $presensi->tanggal = $today;
            $presensi->jam_masuk = "-";
            $presensi->catatan_masuk = "-";
            $presensi->catatan_keluar = "-";
            $presensi->jam_keluar = "-";
            $presensi->keterangan = $request->keterangan;

            $id_peg = $request->id;
            $find_pegawai = Pegawai::find($id_peg);
            $find_pegawai->status ="Tidak Hadir";
            $find_pegawai->update();

            // dd($presensi);

            $simpan = $presensi->save();

            if( $simpan )
            {
                return redirect()->route('presensi.history')->with('notifikasi_tidak_masuk', $nama." hari ini ".$ket );
            }

        } else {
            return "Gagal";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_pegawai = Pegawai::find($id);
        return view ('presensi.checkin',compact('data_pegawai'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $presensi = Presensi::findOrFail($id);


        $batas_awal_waktu_keluar = Carbon::createFromFormat('H:i:s', '16:30:00')->format('H'.'i'.'s');
        $batas_akhir_waktu_keluar = Carbon::createFromFormat('H:i:s', '17:30:00')->format('H'.'i'.'s');

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $current_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');
        $check_time = Carbon::createFromFormat('H:i:s', $current_time)->format('H'.'i'.'s');

        // $time > $batas_awal_waktu_keluar && $time < $batas_akhir_waktu_keluar

        if(isset($request->btn_keluar))
        {
            $check_for_double = DB::table('presensi')
                                    ->where('tanggal' ,'=', $today )
                                    ->where('pegawai_id' ,'=', $request->id)
                                    ->whereNotNull('jam_keluar')
                                    ->count();

            // return $check_for_double;

            if ($check_for_double > 0 ) {
                return redirect()->route('presensi.history')->with('notifikasi_gagal','Pegawai hanya bisa absen keluar sekali dalam sehari !');
            }

                if( $check_time < $batas_awal_waktu_keluar)
                {
                    $note = 'Izin Pulang Lebih Awal';
                } elseif ( $check_time > $batas_awal_waktu_keluar && $check_time < $batas_akhir_waktu_keluar ) {
                    $note = 'Pulang Tepat Waktu';
                } else {
                    $note = 'Pulang Telat';
                }
                // $presensi->$check_nopeg;
                // $presensi->where(['tanggal'=>$today, 'nomor_pegawai' => $nomor_pegawai]);
                $nama = $request->nama_lengkap;

                $presensi->jam_keluar = $current_time;
                $presensi->catatan_keluar = $note;

                $id_peg = $request->id;
                $find_pegawai = Pegawai::find($id_peg);
                $find_pegawai->status ="Sudah Pulang";
                $find_pegawai->update();

                $simpan = $presensi->update();

                if( $simpan )
                {
                    return redirect('/presensi/riwayat')->with('notifikasi_sukses', $nama.' sudah pulang !');
                }
        }


    }

    public function absen(Request $request)
    {
        $data = Pegawai::select("*")->whereDoesntHave('presensi', function ($query) {
            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
            $query->where('tanggal', $today);
        })->get();

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');

        $timestamp = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        Pegawai::whereDoesntHave('presensi', function ($query) {
            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
            $query->where('tanggal', $today);
            })->update([
            'status' => 'Tidak Hadir'
            ]);

        foreach ( $data as $item ) {
            DB::table('presensi')->insert([
                                        'pegawai_id' => $item->id,
                                        'tanggal' => $today,
                                        'jam_masuk' => '-',
                                        'jam_keluar' => '-',
                                        'catatan_masuk' => '-',
                                        'catatan_keluar' => '-',
                                        'keterangan' => 'Bolos',
                                        'created_at' => $timestamp,
                                        'updated_at' => $timestamp
                                        ]);
        }

        return redirect()->intended('/presensi/riwayat')->with('notifikasi_sukses', 'Sudah di catat Bolos!');
    }


    public function destroy($id)
    {
        $data_presensi = Presensi::findOrFail($id);
        $data_presensi->delete();
        return redirect()->route('presensi.history')->with('notifikasi_delete','Data sudah dihapus !');
    }

    public function exportExcel()
    {
        return Excel::download(new PresensiExport, 'Presensi.xlsx');
        // return Excel::download(new PresensiMultiSheetExport(2021), 'Presensi.xlsx');
    }

    public function exportPdf()
    {
        $presensi = Presensi::all();
        $pdf = PDF::loadView('export.presensi.presensipdf',[ 'presensi' => $presensi]);
        return $pdf->download('presensi.pdf');
    }
}
