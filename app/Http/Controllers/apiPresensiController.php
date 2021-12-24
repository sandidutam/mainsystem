<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class apiPresensiController extends Controller
{

    public function getpresent(Request $request)
    {
        $id = $request->formid;
        // $pegawai_id = $request->formid;

        $data_pegawai = Pegawai::where('id', '=', $id)->pluck('id', 'nomor_pegawai', 'jabatan', 'sektor_area')->first();
        $pegawai_id = Pegawai::select('id')->where('id', '=', $id)->pluck('id')->first();
        $nomor_pegawai = Pegawai::select('nomor_pegawai')->where('id', '=', $id)->pluck('nomor_pegawai')->first();
        $nama_depan = Pegawai::select('nama_depan')->where('id', '=', $id)->pluck('nama_depan')->first();
        $nama_belakang = Pegawai::select('nama_belakang')->where('id', '=', $id)->pluck('nama_belakang')->first();
        $jabatan = Pegawai::select('jabatan')->where('id', '=', $id)->pluck('jabatan')->first();
        $sektor_area = Pegawai::select('sektor_area')->where('id', '=', $id)->pluck('sektor_area')->first();
        $status = Pegawai::select('status')->where('id', '=', $id)->pluck('status')->first();
        $full = Pegawai::where('id', '=', $id)->first();


        // strval($nama_lengkap);
        // return $nama_lengkap;
        // $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        // $data_presensi = Presensi::where('pegawai_id', '=', $pegawai_id)->where('tanggal', '=', $today)->first();

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

        // $check_nopeg = Presensi::where('nomor_pegawai','=',$request->nomor_pegawai)->get();
        $check_date = Presensi::where('tanggal','=',$current_time)->count();

        $presensi = new Presensi();

        $check_for_double = DB::table('presensi')
                                    ->where('tanggal' ,'=', $today)
                                    ->where('pegawai_id' ,'=', $id)
                                    ->count();

        $intendedresponse = [
            'nomor_pegawai' => $nomor_pegawai,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'nama_lengkap' => $nama_depan." ".$nama_belakang,
            'jabatan' => $jabatan,
            'sektor' => $sektor_area,
            'status' => $status,
        ];


        // return response()->json($check_for_double);

        if ($check_for_double > 0) {
            // return redirect()->route('absent', ['id' => $id]);
            return response()->json( $intendedresponse);
        } else {

            // return response()->json( $intendedresponse);
            if( $today )
            {
                if( $check_time > $batas_awal_waktu_masuk && $check_time < $batas_akhir_waktu_masuk )
                {
                    $note = 'Datang Tepat Waktu ';

                }
                elseif( $check_time > $batas_akhir_waktu_masuk)
                {
                    $note = 'Datang Telat ';
                }
                else
                {
                    return response()->json('Belum bisa absen!');
                }

                $presensi->pegawai_id = $pegawai_id;
                $presensi->tanggal = $today;
                $presensi->jam_masuk = $current_time;
                $presensi->catatan_masuk = $note;

                $id_peg = $request->formid;
                $find_pegawai = Pegawai::find($id_peg);
                $find_pegawai->status = "Sudah Hadir";
                $find_pegawai->update();

                // dd($presensi);

                // return $presensi;

                $simpan = $presensi->save();

                $response = [
                    // 'getin' => $data_pegawai,
                    // 'getout' => $data_presensi
                    'pegawai_id' => $pegawai_id,
                    'nomor_pegawai' => $nomor_pegawai,
                    'nama_lengkap' => $nama_depan." ".$nama_belakang,
                    'jabatan' => $jabatan,
                    'sektor_area' => $sektor_area
                ];


                if( $simpan )
                {
                    // return redirect('/presensi/riwayat')->with('notifikasi_sukses', $nama.' sudah datang !');
                    return response()->json('Sudah Datang');
                }
            }


        }

    }

    public function getupdate(Request $request)
    {
        $pegawai_id = $request->formid;
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



        $nomor_pegawai = Pegawai::select('nomor_pegawai')->where('id', '=', $pegawai_id)->pluck('nomor_pegawai')->first();
        $nama_depan = Pegawai::select('nama_depan')->where('id', '=', $pegawai_id)->pluck('nama_depan')->first();
        $nama_belakang = Pegawai::select('nama_belakang')->where('id', '=', $pegawai_id)->pluck('nama_belakang')->first();
        $jabatan = Pegawai::select('jabatan')->where('id', '=', $pegawai_id)->pluck('jabatan')->first();
        $sektor_area = Pegawai::select('sektor_area')->where('id', '=', $pegawai_id)->pluck('sektor_area')->first();
        $status = Pegawai::select('status')->where('id', '=', $pegawai_id)->pluck('status')->first();

        // $id = Presensi::select('id')->where('pegawai_id', $pegawai_id)->value('id');


        $id = DB::table('presensi')
        ->where('tanggal' ,'=', $today )
        ->where('pegawai_id' ,'=', $pegawai_id)
        ->value('id');

        // $id = Presensi::where('pegawai_id', '=', $pegawai_id)->where('tanggal', '=', $today)->value('id');
        // $presensi_id = Presensi::select('*')->where('pegawai_id', $pegawai_id)->where('tanggal', $today)->get();
        // return response()->json($xy);

        $check_for_double = DB::table('presensi')
                                    ->where('tanggal' ,'=', $today )
                                    ->where('pegawai_id' ,'=', $pegawai_id)
                                    ->whereNotNull('jam_keluar')
                                    ->count();

        $intendedresponse = [
            'nomor_pegawai' => $nomor_pegawai,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'nama_lengkap' => $nama_depan." ".$nama_belakang,
            'jabatan' => $jabatan,
            'sektor' => $sektor_area,
            'status' => $status,
        ];


        if ($check_for_double > 0 ) {
                // return redirect()->route('presensi.history')->with('notifikasi_gagal','Pegawai hanya bisa absen keluar sekali dalam sehari !');
                return response()->json( $intendedresponse);
        } else {
            // return response()->json('Bisa');

            if( $check_time < $batas_awal_waktu_keluar)
                {
                    $note = 'Izin Pulang Lebih Awal';
                } elseif ( $check_time > $batas_awal_waktu_keluar && $check_time < $batas_akhir_waktu_keluar ) {
                    $note = 'Pulang Tepat Waktu';
                } else {
                    $note = 'Pulang Telat';
                }

                $presensi = Presensi::find($id);
                $presensi->jam_keluar = $current_time;
                $presensi->catatan_keluar = $note;


                $id_peg = $request->formid;
                $find_pegawai = Pegawai::find($id_peg);
                $find_pegawai->status ="Sudah Pulang";
                $find_pegawai->update();

                $simpan = $presensi->update();

                if( $simpan )
                {
                    // return redirect('/presensi/riwayat')->with('notifikasi_sukses', $nama.' sudah pulang !');
                    return response()->json('Pulang');
                }

        }
    }

    public function present(Request $request)
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

        $check_nopeg = Presensi::where('nomor_pegawai','=',$request->nomor_pegawai)->get();
        $check_date = Presensi::where('tanggal','=',$current_time)->count();
        $nama = $request->nama_lengkap;


        // $id = Presensi::getId();
        // $index = Presensi::all();

        // if($index->isEmpty()) {

        //     $idbaru = 0;
        //     // $tgl_sertijab = Carbon::createFromFormat('Y-m-d', $request->tanggal_diterima)->format('Y'.'m');
        //     // $no_pegawai= 'PGW-'.$tgl_sertijab.str_pad($idbaru+1, 4, '0', STR_PAD_LEFT);
        //     $presensi_id = $idbaru+1;
        // } else {
        //     foreach ($id as $value);
        //     $idlama = $value->id;
        //     $idbaru = $idlama+1;
        //     // $tgl_sertijab = Carbon::createFromFormat('Y-m-d', $request->tanggal_diterima)->format('Y'.'m');
        //     // $no_pegawai= 'PGW-'.$tgl_sertijab.str_pad($idbaru, 4, '0', STR_PAD_LEFT);
        //     $presensi_id = $idbaru;
        // }

        // return $presensi_id;

        $presensi = new Presensi();
        // $id = 1;
        // Awal Fungsi Absen Masuk

        $check_for_double = DB::table('presensi')
                                ->where('tanggal' ,'=', $today )
                                ->where('nomor_pegawai' ,'=', $request->nomor_pegawai)
                                ->count();

        if ($check_for_double > 0) {
            // return redirect()->route('absent', ['id' => $id]);
            return response()->json('Pegawai '.$nama.' hanya bisa absen masuk sekali dalam sehari !');
        }

        if( $today )
        {

            if( $check_time > $batas_awal_waktu_masuk && $check_time < $batas_akhir_waktu_masuk )
            {
                $note = 'Datang Tepat Waktu ';

            }
            elseif( $check_time > $batas_akhir_waktu_masuk)
            {
                $note = 'Datang Telat ';
            }
            else
            {
                return response()->json('Belum bisa absen!');
            }

            // $presensi->presensi_id = $presensi_id;
            $presensi->pegawai_id = $request->pegawai_id;
            $presensi->nomor_pegawai = $request->nomor_pegawai;
            $presensi->nama_lengkap = $request->nama_lengkap;
            $presensi->jabatan = $request->jabatan;
            $presensi->sektor_area = $request->sektor_area;
            $presensi->tanggal = $today;
            $presensi->jam_masuk = $current_time;
            $presensi->catatan_masuk = $note;
            // dd($presensi);

            // return $presensi;

            $simpan = $presensi->save();


            if( $simpan )
            {
                // return redirect('/presensi/riwayat')->with('notifikasi_sukses', $nama.' sudah datang !');
                return response()->json($nama);
            }
        }

    }

    public function absent(Request $request)
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

        $check_nopeg = Presensi::where('nomor_pegawai','=',$request->nomor_pegawai)->get();
        $check_date = Presensi::where('tanggal','=',$current_time)->count();


        $nama = $request->nama_lengkap;
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $check_for_double = DB::table('presensi')
                            ->where('tanggal' ,'=', $today )
                            ->where('nomor_pegawai' ,'=', $request->nomor_pegawai)
                            ->count();

        if ($check_for_double > 0) {
        return response()->json('Pegawai '.$nama.' hanya bisa absen masuk sekali dalam sehari !');
        }

        $presensi = new Presensi();
        $ket = $request->keterangan;

        $presensi->pegawai_id = $request->id;
        $presensi->nomor_pegawai = $request->nomor_pegawai;
        $presensi->nama_lengkap = $request->nama_lengkap;
        $presensi->jabatan = $request->jabatan;
        $presensi->sektor_area = $request->sektor_area;
        $presensi->tanggal = $today;
        $presensi->jam_masuk = "-";
        $presensi->catatan_masuk = "-";
        $presensi->jam_keluar = "-";
        $presensi->keterangan = $request->keterangan;

        // $ahay = $presensi->id;

        // return $ahay;
        // dd($presensi);

        $simpan = $presensi->save();

        if( $simpan )
        {

        return response()->json($nama." pada tanggal ".$today.$ket );
        }

    }

    public function update(Request $request, $id)
    {

        $batas_awal_waktu_keluar = Carbon::createFromFormat('H:i:s', '16:30:00')->format('H'.'i'.'s');
        $batas_akhir_waktu_keluar = Carbon::createFromFormat('H:i:s', '17:30:00')->format('H'.'i'.'s');

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $current_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');
        $check_time = Carbon::createFromFormat('H:i:s', $current_time)->format('H'.'i'.'s');

        // $time > $batas_awal_waktu_keluar && $time < $batas_akhir_waktu_keluar
        $getid = $request->id;
        $pegawai_id = $request->pegawai_id;

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $data_presensi = Presensi::select('id')->where('pegawai_id', '=', $pegawai_id)->where('tanggal', '=', $today)->first();

        // return $data_presensi;

        // $id = $data_presensi;

        $check_for_double = DB::table('presensi')
                                ->where('id', '=', $getid)
                                ->where('tanggal' ,'=', $today )
                                ->whereNotNull('jam_keluar')
                                ->count();

        // debug

        // if ($check_for_double == 0) {
        //     return $check_for_double;

        // }   else  {
        //     return "empty";
        // }

        $nama = $request->nama_lengkap;

        $presensi = Presensi::find($id);

        // return $presensi;

        if ($check_for_double > 0 ) {
            return response()->json('Pegawai '.$nama.' hanya bisa absen keluar sekali dalam sehari !');
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

        $presensi->jam_keluar = $current_time;
        $presensi->catatan_keluar = $note;
        $simpan = $presensi->update();

        // return $presensi;
        // $presensi->update();


        if( $simpan )
        {
            return response()->json($nama.' sudah pulang pada jam '.$current_time);
        }


    }
}
