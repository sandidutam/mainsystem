<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\Neraca;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NeracaExport;
use PDF;
use Alert;

class NeracaController extends Controller
{
    public function index()
    {
        $neraca = Neraca::orderBy('tanggal', 'DESC')->get();
        $riwayat = Neraca::orderBy('tanggal', 'DESC')->get();
        $sumneraca = Neraca::all()->count();

        $data_neraca = Neraca::orderBy('tanggal','DESC')->get()->groupBy(function($item) {
            return $item->tanggal;
        });

        $debit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->get();

        $kredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->get();

        $sumdebit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        $sumkredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        $balance = $sumdebit - $sumkredit;

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

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        return view('neraca.index', compact('neraca',
                                            'today',
                                            'debit',
                                            'kredit',
                                            'sumdebit',
                                            'sumkredit',
                                            'balance',
                                            'data_neraca',
                                            'riwayat',
                                            'sumneraca',
                                            'databalance',
                                            'datadebit',
                                            'datakredit',
                                            'monthcategories'
                                            ));
    }

    public function show($id)
    {
        $id_neraca = Crypt::decryptString($id);

        $neraca = Neraca::find($id_neraca);
        return view ('neraca.detail',compact('neraca'));
    }

    public function create()
    {
        return view('neraca.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaksi' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('neraca.create')
                                ->withErrors($validator)
                                ->withInput();
        }

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $this_month = Carbon::now()->timezone('Asia/Jakarta')->format('Y'.'m');

        $index = Neraca::all();

        $check_debit = DB::table('neraca')
                                ->where('tanggal','=', $this_month)
                                ->whereNotNull('debit')
                                ->count();

        $check_kredit = DB::table('neraca')
                                ->where('tanggal','=', $this_month)
                                ->whereNotNull('kredit')
                                ->count();

        $tgl_transaksi = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y-m-d');
        $tahun = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y');
        $bulan = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y-m');
        $hari = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d');

        if($request->filled('debit')) {

            if($index->isEmpty()) {
                $idbaru = 0;
                $no_trans= 'TR/DBIT/'.$tahun.'/'.$bulan.'/'.str_pad($idbaru+1, 4, '0', STR_PAD_LEFT);
                // return "noldebit";
            }
            elseif ( $check_debit == 0 ) {
                $idbaru = 0;
                $no_trans= 'TR/DBIT/'.$tahun.'/'.$bulan.'/'.str_pad($idbaru+1, 4, '0', STR_PAD_LEFT);
                // return "noldebit";
            }
            elseif ( $check_debit > 0 ) {
                $idlama = $check_debit;
                $idbaru = $idlama + 1;

                $no_trans= 'TR/DBIT/'.$tahun.'/'.$bulan.'/'.str_pad($idbaru, 4, '0', STR_PAD_LEFT);
                // return "satudebit";
            }

            // return "debit ada";

        }
        elseif ($request->filled('kredit')) {

            if($index->isEmpty()) {
                $idbaru = 0;
                $no_trans= 'TR/KDIT/'.$tahun.'/'.$bulan.'/'.str_pad($idbaru+1, 4, '0', STR_PAD_LEFT);
                // return "nolkredit";
            }
            elseif ( $check_kredit == 0 ) {
                $idbaru = 0;
                $no_trans= 'TR/KDIT/'.$tahun.'/'.$bulan.'/'.str_pad($idbaru+1, 4, '0', STR_PAD_LEFT);
                // return "nolkredit";
            }
            elseif ( $check_kredit > 0 ) {
                $idlama = $check_kredit;
                $idbaru = $idlama + 1;

                $no_trans= 'TR/KDIT/'.$tahun.'/'.$bulan.'/'.str_pad($idbaru, 4, '0', STR_PAD_LEFT);
                // return "satukredit";

            }

            // return "kredit ada";

        }

        $data = new Neraca();
        $data->nomor_akun = $no_trans;
        $data->akun = $request->transaksi;
        $data->deskripsi = $request->deskripsi;
        $data->debit = $request->debit;
        $data->kredit = $request->kredit;
        $data->tanggal = $tgl_transaksi;
        $data->bulan = $bulan;
        $data->tahun = $tahun;
        $simpan = $data->save();

        if($request->hasFile('foto_bukti')) {
            $request->file('foto_bukti')->move('images/transaksi/',$request->file('foto_bukti')->getClientOriginalName());
            $data->foto_bukti = $request->file('foto_bukti')->getClientOriginalName();
            $simpan = $data->save();
        }

        if($request->hasFile('file_bukti')) {
            $request->file('file_bukti')->move('docs/transaksi/',$request->file('file_bukti')->getClientOriginalName());
            $data->file_bukti = $request->file('file_bukti')->getClientOriginalName();
            $simpan = $data->save();
        }

        if($simpan)
        {
            Alert::success('Input Data Transaksi Berhasil', 'Data transaksi '.$data->akun.' dengan nomor transaksi '.$data->nomor_akun.' sudah berhasil diinput!');

            return redirect()->intended('/neraca');
        }
    }

    public function edit($id)
    {
        $id_neraca = Crypt::decryptString($id);

        $neraca = Neraca::find($id_neraca);
        return view ('neraca.edit',compact('neraca'));
    }

    public function update(Request $request, $id)
    {
        $neraca= Neraca::findOrFail($id);
        // $data_pegawai->update($request->all());

         // Hasil Input dimasukkan ke database


        // $tgl_transaksi = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y-m-d');

        $neraca->akun = $request->akun;
        $neraca->debit = $request->debit;
        $neraca->kredit = $request->kredit;
        // $neraca->tanggal = $tgl_transaksi;
        $simpan = $neraca->update();

        if($request->hasFile('foto_bukti')) {
            $request->file('foto_bukti')->move('images/transaksi/',$request->file('foto_bukti')->getClientOriginalName());
            $data->gambar = $request->file('foto_bukti')->getClientOriginalName();

        }

        if($request->hasFile('file_bukti')) {
            $request->file('file_bukti')->move('docs/transaksi/',$request->file('file_bukti')->getClientOriginalName());
            $neraca->gambar = $request->file('file_bukti')->getClientOriginalName();
            $simpan = $neraca->update();
        }

        Alert::success('Update Data Transaksi Berhasil', 'Data transaksi '.$neraca->akun.' dengan nomor transaksi '.$neraca->nomor_akun.' sudah berhasil di update!');

        return redirect()->intended('/neraca');
    }

    public function destroy($id)
    {
        $neraca = Neraca::findOrFail($id);

        $neraca->delete();

        Alert::success('Data Transaksi Berhasil Dihapus!', 'Data transaksi '.$neraca->akun.' dengan nomor transaksi '.$neraca->nomor_akun.' sudah berhasil di hapus!');

        return redirect()->intended('/neraca');
    }

    public function exportExcel()
    {
        // return Excel::download(new PresensiExport, 'Presensi.xlsx');
        return Excel::download(new NeracaExport, 'Neraca.xlsx');
    }

    public function exportPdf()
    {
        $neraca = Neraca::orderBy('tanggal')->get();
        $sumdebit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        $sumkredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        $balance = $sumdebit - $sumkredit;
        $pdf = PDF::loadView('export.neraca.neracapdf',[ 'neraca' => $neraca, 'sumdebit' => $sumdebit, 'sumkredit' => $sumkredit, 'balance' => $balance]);
        return $pdf->download('neraca.pdf');
    }

    public function updateAkun(Request $request)
    {
        $check_debit = DB::table('neraca')->where('akun', 'Transaksi Debit')->get();
        $check_kredit = DB::table('neraca')->where('akun', 'Transaksi Kredit')->get();

        $data = Neraca::all();

        foreach ( $data as $idx ) {
            if ( $idx->akun ==  'Transaksi Debit' ) {
                    $idx->nomor_akun = 'TR/DBIT/'.$idx->tahun.'/'.$idx->bulan.'/'.random_int(1000, 9999);
                    $idx->debit = random_int(10000, 999999999);
                    $idx->created_at = $idx->tanggal;
                    $idx->updated_at = $idx->tanggal;
                    $idx->update();
            } elseif ( $idx->akun == 'Transaksi Kredit' ) {
                    $idx->nomor_akun = 'TR/KDIT/'.$idx->tahun.'/'.$idx->bulan.'/'.random_int(1000, 9999);
                    $idx->kredit = random_int(10000, 99999999);
                    $idx->created_at = $idx->tanggal;
                    $idx->updated_at = $idx->tanggal;
                    $idx->update();
            }
        }

        return redirect()->intended('/neraca');
    }
}
