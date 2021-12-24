<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_pegawai = Pegawai::paginate(100);
        // $data_pegawai = Pegawai::all();
        // return view('pegawai.index',compact('data_pegawai'));


        $s1 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->where('sektor_area','1')->get();
        $s2 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->where('sektor_area','2')->get();
        $s3 = Pegawai::where('sektor_area','3')->orderBy('nama_depan','ASC')->orderBy('nama_belakang','ASC')->get();
        $s4 = Pegawai::where('sektor_area','4')->orderBy('nama_depan','ASC')->orderBy('nama_belakang','ASC')->get();

        $jml_s1 = Pegawai::where('sektor_area','1')->count();
        $jml_s2 = Pegawai::where('sektor_area','2')->count();
        $jml_s3 = Pegawai::where('sektor_area','3')->count();
        $jml_s4 = Pegawai::where('sektor_area','4')->count();


        // return $s2;
        $data_hadir = Presensi::whereHas('pegawai', function ($query) {
                                $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                $query->where('tanggal', '=', $today)
                                ->where('jam_masuk', '!=', '00:00:00')
                                ->where('catatan_masuk', '!=', '-');
                                })->with('pegawai')->get();

        // $s1_belum_hadir = Pegawai::select("*")
        //                     ->where('sektor_area','1')
        //                     ->whereDoesntHave('presensi', function ($query) {
        //                     $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //                     $query->where('tanggal', $today);
        //                     })
        //                     ->get();

        // return $s1_belum_hadir;

        $data_pegawai = Pegawai::all();

        return view('pegawai.index', compact('data_pegawai',
                                                's1',
                                                's2',
                                                's3',
                                                's4',
                                                'jml_s1',
                                                'jml_s2',
                                                'jml_s3',
                                                'jml_s4'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                        'nama_depan' => 'required|min:2|max:25',
                        'nama_belakang' => 'required|min:2|max:25',
                        'tempat_lahir' => 'required',
                        'tanggal_lahir' => 'required',
                        'jenis_kelamin' => 'required',
                        'agama' => 'required',
                        'alamat' => 'required',
                        'kelurahan' => 'required',
                        'kecamatan' => 'required',
                        'kota_kabupaten' => 'required',
                        'provinsi' => 'required',
                        'penempatan' => 'required',
                        'sektor_area' => 'required',
                        'jabatan' => 'required',
                        'pendidikan' => 'required',
                        'tanggal_diterima' => 'required',
                        'foto_pegawai' => 'required'
            ]);

            if($validator->fails()) {
                return redirect()->route('pegawai.create')
                                    ->withErrors($validator)
                                    ->withInput();
            }

            // dd($request->all());

            // Proses otomatisasi nomor pegawai
            $id = Pegawai::getId();
            $index = Pegawai::all();

            if($index->isEmpty()) {

                $idbaru = 0;
                $tgl_sertijab = Carbon::createFromFormat('Y-m-d', $request->tanggal_diterima)->format('Y'.'m');

                $no_pegawai= 'PGW-'.$tgl_sertijab.str_pad($idbaru+1, 4, '0', STR_PAD_LEFT);
            } else {
                foreach ($id as $value);
                $idlama = $value->id;
                $idbaru = $idlama + 1;
                $tgl_sertijab = Carbon::createFromFormat('Y-m-d', $request->tanggal_diterima)->format('Y'.'m');

                $no_pegawai= 'PGW-'.$tgl_sertijab.str_pad($idbaru, 4, '0', STR_PAD_LEFT);
            }

            $nama_depan = $request->nama_depan;
            $nama_belakang = $request->nama_belakang;
            $nama_lengkap = $nama_depan.' '.$nama_belakang;

            $protoqr = QrCode::generate('http://192.168.100.109:8000/api/presensi/'.$idbaru.'/get');


            // return $protoqr;

            // Hasil Input dimasukkan ke database
            $data = new Pegawai();
            $data->nomor_pegawai = $no_pegawai;
            $data->nama_depan = $nama_depan;
            $data->nama_belakang = $nama_belakang;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->agama = $request->agama;
            $data->alamat = $request->alamat;
            $data->provinsi = $request->provinsi;
            $data->kota_kabupaten = $request->kota_kabupaten;
            $data->kecamatan = $request->kecamatan;
            $data->kelurahan = $request->kelurahan;
            $data->pendidikan = $request->pendidikan;
            $data->jabatan = $request->jabatan;
            $data->penempatan = $request->penempatan;
            $data->sektor_area = $request->sektor_area;
            $data->tanggal_diterima = $request->tanggal_diterima ;
            // $data->qr_code = $protoqr;
            // $data->foto_pegawai = $request->foto_pegawai;

            // return $postqr;
            // return $protoqr;

            if($request->hasFile('foto_pegawai')) {
                $request->file('foto_pegawai')->move('images/pegawai/',$request->file('foto_pegawai')->getClientOriginalName());
                $data->foto_pegawai = $request->file('foto_pegawai')->getClientOriginalName();
                $simpan = $data->save();

            }

            // $request->file('foto_pegawai')->move('images/',$request->file('foto_pegawai'));
            // $data->foto_pegawai = $request->file('foto_pegawai');

            if($simpan)
            {
                return redirect('/pegawai')->with('notifikasi_success','Data '.$nama_lengkap.' sudah diinput!' );
                // return redirect()->route('pegawai.index');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $current_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');

        $id_pegawai = Crypt::decryptString($id);
        $data_pegawai = Pegawai::find($id_pegawai);

        $name = $data_pegawai->nama_lengkap();
        $pegawai_id = $data_pegawai->id;

        $data_presensi = DB::table('presensi')
                                    ->where('pegawai_id', '=', $pegawai_id)
                                    ->where('tanggal' ,'=', $today )
                                    ->get();
        // return $data_presensi;

        // $data_presensi = Presensi::whereHas('pegawai', function ($query) {
        //                         $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //                         $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
        //                         $query->where('tanggal', '!=', $kemarin)
        //                         ->where('tanggal', '!=', $hari_ini)
        //                         ->orderBy('id','DESC');
        //                         })->with('pegawai')->get();

        // dd($data_presensi);
        // return $data_presensi;

        // $data_pegawai = Pegawai::where('id',$id)->get();
        return view('pegawai.detail', compact('data_pegawai','data_presensi','today'));
    }

    public function edit($id)
    {
        $id_pegawai = Crypt::decryptString($id);
        $data_pegawai = Pegawai::find($id_pegawai);
        return view ('pegawai.edit',compact('data_pegawai'));
    }

    public function update(Request $request, $id)
    {
        $id_pegawai = Crypt::decryptString($id);
        $data_pegawai = Pegawai::findOrFail($id_pegawai);

        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|min:2|max:25',
            'nama_belakang' => 'required|min:2|max:25',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota_kabupaten' => 'required',
            'provinsi' => 'required',
            'penempatan' => 'required',
            'sektor_area' => 'required',
            'jabatan' => 'required',
            'pendidikan' => 'required',
            'tanggal_diterima' => 'required',
            'foto_pegawai' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('pegawai.edit',  Crypt::encryptString($data_pegawai->id))
                                ->withErrors($validator)
                                ->withInput();
        }

        $nama_depan = $request->nama_depan;
        $nama_belakang = $request->nama_belakang;

         // Hasil Input dimasukkan ke database

         $data_pegawai->nama_depan = $nama_depan;
         $data_pegawai->nama_belakang = $nama_belakang;
         $data_pegawai->tempat_lahir = $request->tempat_lahir;
         $data_pegawai->tanggal_lahir = $request->tanggal_lahir;
         $data_pegawai->jenis_kelamin = $request->jenis_kelamin;
         $data_pegawai->agama = $request->agama;
         $data_pegawai->alamat = $request->alamat;
         $data_pegawai->provinsi = $request->provinsi;
         $data_pegawai->kota_kabupaten = $request->kota_kabupaten;
         $data_pegawai->kecamatan = $request->kecamatan;
         $data_pegawai->kelurahan = $request->kelurahan;
         $data_pegawai->pendidikan = $request->pendidikan;
         $data_pegawai->jabatan = $request->jabatan;
         $data_pegawai->penempatan = $request->penempatan;
         $data_pegawai->sektor_area = $request->sektor_area;
         $data_pegawai->update();

        if($request->hasFile('foto_pegawai')) {
            $request->file('foto_pegawai')->move('images/pegawai/',$request->file('foto_pegawai')->getClientOriginalName());
            $data_pegawai->foto_pegawai = $request->file('foto_pegawai')->getClientOriginalName();

            $data_pegawai->update();
        }
        return redirect()->route('pegawai.index')->with('notifikasi_success','Data '.$data_pegawai->nama_lengkap().' sudah diupdate!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_pegawai = Crypt::decryptString($id);
        $data_pegawai = Pegawai::findOrFail($id_pegawai);
        $data_pegawai->delete();
        return redirect()->route('pegawai.index')->with('notifikasi_delete','Data sudah dihapus!' );
    }
}
