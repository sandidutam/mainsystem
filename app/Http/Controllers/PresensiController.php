<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exports\PresensiExport;
use App\Exports\PresensiMultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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

        $data_presensi = Presensi::whereHas('pegawai', function ($query) {
            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
            $query->where('tanggal', '=', $today)
            ->where('jam_keluar' , '=', null);
            })->with('pegawai')->get();

        // return $data_presensi;
        // $data_presensi = Presensi::all();
        return view('presensi.indexOut',compact('data_presensi'));
    }


    public function history()
    {
        $data_presensi = Presensi::orderBy('updated_at','DESC')->get();

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
        $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('d F Y');
        $jml_pegawai= Pegawai::all()->count();

        $today_presensi = Presensi::where('tanggal', '=', $today)->orderBy('updated_at','DESC')->get();



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


        $data_belum_hadir = Pegawai::select("*")
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

        // $c = $a->diffInDays($b);
        // return $c;

        $x = Presensi::where('pegawai_id', 1 )->where('tanggal', '=', $kemarin)->value('created_at');
        $y = Presensi::where('pegawai_id', 1 )->where('tanggal', '=', $kemarin)->value('updated_at');

        // $ak =
        // $xs = $y-$x;
        // return $x;

        // return $data_lain;

        $izin = $jml_cuti+$jml_izin+$jml_sakit;
        $belum_hadir = $jml_pegawai-$jml_hadir-$jml_bolos-$jml_cuti-$jml_izin-$jml_sakit;


        return view('presensi.history', compact('data_presensi','belum_hadir','jml_hadir','jml_bolos','jml_cuti','jml_izin','jml_sakit','izin','hari_ini','today_presensi','data_pegawai','data_hadir','data_belum_hadir','data_bolos','data_lain'));
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

    public function create()
    {

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

            $nama = $request->nama_lengkap;
            $ket = $request->keterangan;

            $presensi->pegawai_id = $request->id;
            $presensi->tanggal = $today;
            $presensi->jam_masuk = "-";
            $presensi->catatan_masuk = "-";
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

    public function checkIn($id)
    {
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('D, d-m-Y');
        $data_pegawai = Pegawai::find($id);
        return view ('presensi.checkin',compact('data_pegawai','today'));
    }
    public function checkOut($id)
    {
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');

        $data_presensi = Presensi::find($id);

        // $data_presensi = Presensi::whereHas('pegawai', function ($query) {
        //     $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //     $query->where('tanggal', '=', $today)
        //     ->where('id', '=', $id);
        //     })->with('pegawai')->get();

        return view ('presensi.checkout',compact('data_presensi','today'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
