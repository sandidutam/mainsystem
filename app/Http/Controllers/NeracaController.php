<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Neraca;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NeracaExport;
use PDF;

class NeracaController extends Controller
{
    public function index()
    {
        $neraca = Neraca::all();
        $sumdebit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        $sumkredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        $balance = $sumdebit - $sumkredit;

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        return view('neraca.index', compact('neraca','today','sumdebit','sumkredit','balance'));
    }

    public function debit()
    {
        $neraca = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->get();

        $sum = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        // return $suma;

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        return view('neraca.debit', compact('neraca','today','sum'));
    }

    public function kredit()
    {
        $neraca = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->get();

        $sum = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        // return $sum;

        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        return view('neraca.kredit', compact('neraca','today','sum'));
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
        $bulan = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('m');
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
            return redirect()->route('neraca.index')->with('notifikasi_sukses', 'Transaksi baru sudah diinput ke neraca!');
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


        $tgl_transaksi = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y-m-d');

        $neraca->akun = $request->akun;
        $neraca->debit = $request->debit;
        $neraca->kredit = $request->kredit;
        $neraca->tanggal = $tgl_transaksi;

        if($request->hasFile('foto_bukti')) {
            $request->file('foto_bukti')->move('images/transaksi/',$request->file('foto_bukti')->getClientOriginalName());
            $data->gambar = $request->file('foto_bukti')->getClientOriginalName();

        }

        if($request->hasFile('file_bukti')) {
            $request->file('file_bukti')->move('docs/transaksi/',$request->file('file_bukti')->getClientOriginalName());
            $neraca->gambar = $request->file('file_bukti')->getClientOriginalName();
            $simpan = $neraca->update();
        }


        return redirect()->route('neraca.index')->with('notifikasi_sukses', 'Transaksi '.$neraca->akun.' sudah diupdate!');
    }

    public function destroy($id)
    {
        $neraca = Neraca::findOrFail($id);
        $neraca->delete();
        return redirect()->route('neraca.index')->with('notifikasi_sukses', 'Data sudah dihapus!');
    }

    public function exportExcel()
    {
        // return Excel::download(new PresensiExport, 'Presensi.xlsx');
        return Excel::download(new NeracaExport, 'Neraca.xlsx');
    }

    public function exportPdf()
    {
        $neraca = Neraca::all();
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

}
