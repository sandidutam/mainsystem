<?php

namespace App\Http\Controllers;

use Alert;
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

        // $s1 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->whereHas('presensi', function ($query){
        //     $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //     $query->where('sektor_area','1');
        // })->get();

        $s1 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->where('sektor_area','1')->get();

        $s2 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->where('sektor_area','2')->get();

        $s3 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->where('sektor_area','3')->get();

        $s4 = Pegawai::orderBy('nama_depan','ASC')->orderBy('nama_depan','ASC')->where('sektor_area','4')->get();

        $jml_s1 = Pegawai::where('sektor_area','1')->count();
        $jml_s2 = Pegawai::where('sektor_area','2')->count();
        $jml_s3 = Pegawai::where('sektor_area','3')->count();
        $jml_s4 = Pegawai::where('sektor_area','4')->count();


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


        $data_pegawai = Pegawai::all();
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');

        return view('pegawai.index', compact('data_pegawai',
                                                'today',
                                                's1',
                                                's2',
                                                's3',
                                                's4',
                                                'jml_s1',
                                                'jml_s2',
                                                'jml_s3',
                                                'jml_s4'
                                            ));
    }

    public function resetStatus(Request $request)
    {
        $reset = DB::table('pegawai')->update(['status' => 'Belum Hadir']);

        // $look = Pegawai::all();

        // dd($look);

        return redirect()->intended('/pegawai')->with('notifikasi_sukses','Status telah berhasil di reset');
    }

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
            $data->status = "Belum Hadir";
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
                Alert::success('Input Data Pegawai Berhasil', 'Data '.$nama_lengkap.' sudah berhasil diinput!');

                // return redirect('/pegawai')->with('notifikasi_success','Data '.$nama_lengkap.' sudah diinput!' );
                return redirect()->intended('/pegawai');
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

        // $data_presensi = DB::table('presensi')
        //                             ->where('pegawai_id', '=', $pegawai_id)
        //                             ->where('tanggal' ,'=', $today )
        //                             ->get();

        $data_presensi = Pegawai::select("*")->where('id', $id_pegawai)->whereHas('presensi', function ($query) {
                                        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                        $query->where('tanggal', '=', $today)
                                        ->where('jam_keluar' , '=', null);
                                        })->get();

        $hadir = Presensi::where('pegawai_id', $pegawai_id)->where('keterangan','Hadir')->count();
        $bolos = Presensi::where('pegawai_id', $pegawai_id)->where('keterangan','Bolos')->count();
        $cuti = Presensi::where('pegawai_id', $pegawai_id)->where('keterangan','Cuti')->count();
        $sakit = Presensi::where('pegawai_id', $pegawai_id)->where('keterangan','Sakit')->count();
        $izin = Presensi::where('pegawai_id', $pegawai_id)->where('keterangan','Izin')->count();

        $date0v2 = Carbon::now()->subDays(0)->timezone('Asia/Jakarta')->format('d M Y');
        $date1v2 = Carbon::now()->subDays(1)->timezone('Asia/Jakarta')->format('d M Y');
        $date2v2 = Carbon::now()->subDays(2)->timezone('Asia/Jakarta')->format('d M Y');
        $date3v2 = Carbon::now()->subDays(3)->timezone('Asia/Jakarta')->format('d M Y');
        $date4v2 = Carbon::now()->subDays(4)->timezone('Asia/Jakarta')->format('d M Y');
        $date5v2 = Carbon::now()->subDays(5)->timezone('Asia/Jakarta')->format('d M Y');
        $date6v2 = Carbon::now()->subDays(6)->timezone('Asia/Jakarta')->format('d M Y');
        $date7v2 = Carbon::now()->subDays(7)->timezone('Asia/Jakarta')->format('d M Y');

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

        $group1sumhadir = Presensi::where('tanggal', '=', $today)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group1sumbolos = Presensi::where('tanggal', '=', $today)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group1sumcuti = Presensi::where('tanggal', '=', $today)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group1sumsakit = Presensi::where('tanggal', '=', $today)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group1sumizin = Presensi::where('tanggal', '=', $today)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

        $group2sumhadir = Presensi::where('tanggal', '=', $date1)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group2sumbolos = Presensi::where('tanggal', '=', $date1)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group2sumcuti = Presensi::where('tanggal', '=', $date1)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group2sumsakit = Presensi::where('tanggal', '=', $date1)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group2sumizin = Presensi::where('tanggal', '=', $date1)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

        $group3sumhadir = Presensi::where('tanggal', '=', $date2)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group3sumbolos = Presensi::where('tanggal', '=', $date2)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group3sumcuti = Presensi::where('tanggal', '=', $date2)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group3sumsakit = Presensi::where('tanggal', '=', $date2)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group3sumizin = Presensi::where('tanggal', '=', $date2)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

        $group4sumhadir = Presensi::where('tanggal', '=', $date3)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group4sumbolos = Presensi::where('tanggal', '=', $date3)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group4sumcuti = Presensi::where('tanggal', '=', $date3)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group4sumsakit = Presensi::where('tanggal', '=', $date3)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group4sumizin = Presensi::where('tanggal', '=', $date3)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

        $group5sumhadir = Presensi::where('tanggal', '=', $date4)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group5sumbolos = Presensi::where('tanggal', '=', $date4)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group5sumcuti = Presensi::where('tanggal', '=', $date4)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group5sumsakit = Presensi::where('tanggal', '=', $date4)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group5sumizin = Presensi::where('tanggal', '=', $date4)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

        $group6sumhadir = Presensi::where('tanggal', '=', $date5)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group6sumbolos = Presensi::where('tanggal', '=', $date5)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group6sumcuti = Presensi::where('tanggal', '=', $date5)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group6sumsakit = Presensi::where('tanggal', '=', $date5)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group6sumizin = Presensi::where('tanggal', '=', $date5)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

        $group7sumhadir = Presensi::where('tanggal', '=', $date6)->where('pegawai_id', $id_pegawai)->where('keterangan','Hadir')->count();
        $group7sumbolos = Presensi::where('tanggal', '=', $date6)->where('pegawai_id', $id_pegawai)->where('keterangan','Bolos')->count();
        $group7sumcuti = Presensi::where('tanggal', '=', $date6)->where('pegawai_id', $id_pegawai)->where('keterangan','Cuti')->count();
        $group7sumsakit = Presensi::where('tanggal', '=', $date6)->where('pegawai_id', $id_pegawai)->where('keterangan','Sakit')->count();
        $group7sumizin = Presensi::where('tanggal', '=', $date6)->where('pegawai_id', $id_pegawai)->where('keterangan','Izin')->count();

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

        // $data_presensi = Presensi::whereHas('pegawai', function ($query) {
        //                         $hari_ini = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        //                         $kemarin = Carbon::yesterday()->timezone('Asia/Jakarta')->format('Y-m-d');
        //                         $query->where('tanggal', '!=', $kemarin)
        //                         ->where('tanggal', '!=', $hari_ini)
        //                         ->orderBy('id','DESC');
        //                         })->with('pegawai')->get();


        return view('pegawai.detail', compact(
                                                'data_pegawai',
                                                'data_presensi',
                                                'today',
                                                'hadir',
                                                'bolos',
                                                'cuti',
                                                'sakit',
                                                'izin',
                                                'categories',
                                                'data1',
                                                'data2',
                                                'data3',
                                                'data4',
                                                'data5'
                                            ));
    }

    public function edit($id)
    {
        $id_pegawai = Crypt::decryptString($id);
        $data_pegawai = Pegawai::find($id_pegawai);
        return view ('pegawai.edit',compact('data_pegawai'));
    }

    public function update(Request $request, $id)
    {
        // $id_pegawai = Crypt::decryptString($id);
        $data_pegawai = Pegawai::findOrFail($id);

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
            // 'tanggal_diterima' => 'required',
            // 'foto_pegawai' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('pegawai.show',  Crypt::encryptString($data_pegawai->id))
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

        Alert::success('Update Berhasil', 'Data '.$data_pegawai->nama_lengkap().' sudah diupdate!');

        return redirect()->route('pegawai.show', Crypt::encryptString($data_pegawai->id));
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
        $nama_lengkap = $data_pegawai->nama_lengkap();
        $data_pegawai->delete();

        Alert::success('Hapus Data Pegawai Berhasil', 'Data '.$nama_lengkap.' sudah berhasil dihapus!');

        return redirect()->intended('/pegawai');
    }
}
