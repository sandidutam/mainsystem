<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use App\Models\Inventori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class InventoriController extends Controller
{
    public function index()
    {
        $stok_barang = Inventori::all();

        return view('inventori.index', compact('stok_barang'));
    }

    public function priceindex()
    {
        $stok_barang = Inventori::all();
        return view('inventori.price', compact('stok_barang'));
    }

    public function stock()
    {
        $stok_barang = Inventori::all();
        return view('inventori.stocknum', compact('stok_barang'));
    }

    public function show($id)
    {
        // $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        // $jam = Carbon::now()->isoFormat('H:i:s:u');
        $current_time = Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s');
        // return $current_time;

        $id_barang = Crypt::decryptString($id);

        $stok_barang = Inventori::find($id_barang);


        // $data_pegawai = Pegawai::where('id',$id)->get();
        return view('inventori.detail', compact('stok_barang','today'));
    }

    public function create()
    {
        return view('inventori.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'kuantitas' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'stok_minimal' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->route('inventori.create')
                                ->withErrors($validator)
                                ->withInput();

        }

        $data = new Inventori();
        $data->nama = $request->nama;
        $data->merk = $request->merk;
        $data->jenis = $request->jenis;
        $data->deskripsi = $request->deskripsi;
        $data->kuantitas = $request->kuantitas;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;
        $data->stok_minimal = $request->stok_minimal;
        $data->harga = $request->harga;

        $stok_minimal = $request->stok_minimal;
        $kuantitas = $request->kuantitas;

        if($kuantitas >= $stok_minimal) {
            $data->status = "Aman";
        } elseif($kuantitas <= $stok_minimal && $kuantitas > 0) {
            $data->status = "Tidak Aman";
        }

        if($request->hasFile('gambar')) {
            $request->file('gambar')->move('images/inventori/',$request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $simpan = $data->save();

        }

        if($simpan)
        {
            Alert::success('Input Data Inventori Berhasil', 'Data '.$data->nama.' sudah berhasil diinput!');

            // return redirect()->route('inventori.index')->with('notifikasi_sukses', 'Stok '.$data->nama.' sudah diinput!');
            return redirect()->intended('/inventori');
        }
    }

    public function edit($id)
    {
        $id_barang = Crypt::decryptString($id);

        $stok_barang = Inventori::find($id_barang);

        return view ('inventori.edit',compact('stok_barang'));
    }

    public function editstock($id)
    {
        $stok_barang = Inventori::find($id);
        return view ('inventori.edit',compact('stok_barang'));
    }

    public function update(Request $request, $id)
    {
        $stok_barang= Inventori::findOrFail($id);
        // $data_pegawai->update($request->all());

         // Hasil Input dimasukkan ke database

        $stok_barang->nama= $request->nama;
        $stok_barang->merk= $request->merk;
        $stok_barang->jenis= $request->jenis;
        $stok_barang->deskripsi= $request->deskripsi;
        $stok_barang->kuantitas= $request->kuantitas;
        $stok_barang->satuan= $request->satuan;
        $stok_barang->harga= $request->harga;
        $stok_barang->update();

        //  $stok_barang->update();

        if($request->hasFile('gambar')) {
            $request->file('gambar')->move('images/inventori/',$request->file('gambar')->getClientOriginalName());
            $stok_barang->gambar = $request->file('gambar')->getClientOriginalName();

            $stok_barang->update();
        }
        Alert::success('Update Data Inventori Berhasil', 'Data '.$stok_barang->nama.' sudah berhasil di update!');

        return redirect()->intended('/inventori');
    }

    public function stock_update(Request $request, $id)
    {
        $stok_barang= Inventori::findOrFail($id);
        $stok_barang->kuantitas= $request->kuantitas;
        $stok_minimal = $stok_barang->stok_minimal;

        $kuantitas = $request->kuantitas;
        $habis = 0;

        if($kuantitas >= $stok_minimal) {
            $status = $stok_barang->status = "Aman";
        } elseif($kuantitas <= $stok_minimal && $kuantitas> $habis){
            $status = $stok_barang->status = "Tidak Aman";
        } elseif($kuantitas == $habis) {
            $status = $stok_barang->status = "Habis";
        }

        $stok_barang->update();

        Alert::success('Update Stok '.$stok_barang->nama.' Berhasil', 'Stok '.$stok_barang->nama.' sudah berhasil di update!');

        // return redirect()->route('inventori.stock')->with('notifikasi_sukses', 'Stok '.$stok_barang->nama.' sudah diupdate!');
        return redirect()->intended('/inventori/stok');
    }

    public function minimum_stock_update(Request $request, $id)
    {
        $stok_barang= Inventori::findOrFail($id);
        $stok_minimal = $request->stok_minimal;
        $stok_barang->stok_minimal= $stok_minimal;

        $kuantitas = $stok_barang->kuantitas;
        $habis = 0;

        if($kuantitas >= $stok_minimal) {
            $status = $stok_barang->status = "Aman";
        } elseif($kuantitas <= $stok_minimal && $kuantitas> $habis){
            $status = $stok_barang->status = "Tidak Aman";
        } elseif($kuantitas == $habis) {
            $status = $stok_barang->status = "Habis";
        }

        $stok_barang->update();

        Alert::success('Update Jumlah Stok Minimum '.$stok_barang->nama.' Berhasil', 'Limit minimum stok '.$stok_barang->nama.' sudah berhasil di update!');

        return redirect()->intended('/inventori/stok');
    }

    public function price_update(Request $request, $id)
    {
        $stok_barang= Inventori::findOrFail($id);
        $stok_barang->harga= $request->harga;
        $stok_barang->update();

        Alert::success('Update Harga '.$stok_barang->nama.' Berhasil', 'Harga '.$stok_barang->nama.' sudah berhasil di update!');

        return redirect()->intended('/inventori/priceindex');

    }


    public function destroy($id)
    {
        $id_barang = Crypt::decryptString($id);

        $stok_barang = Inventori::find($id_barang);
        // $stok_barang = Inventori::findOrFail($id);
        $stok_barang->delete();

        Alert::success('Data Inventori Berhasil Dihapus!', 'Data inventori '.$stok_barang->nama.' sudah berhasil di hapus!');

        return redirect()->intended('/inventori');

    }
}
