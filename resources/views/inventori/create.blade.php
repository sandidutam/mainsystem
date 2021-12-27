@extends('layouts.main')

@section('title')
    Menu Inventori
@endsection

@section('sub-title')
    Tambah Inventori
@endsection

@section('inventori.active')
active
@endsection

@section('inventoriindex.active')
active
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Tambah Barang Baru</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('inventori.index')}}">Menu Inventori</a></div>
        <div class="breadcrumb-item">Tambah Inventori</div>
      </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('inventori.index') }}" class="d-none d-sm-inline-block btn btn-md btn-danger shadow-sm">
            <i class="fas fa-chevron-left mr-2"></i> Kembali</a>
        </div>

        <div class="row d-flex justify-content-center ">
            <div class="card">
                <div class="card-header">
                    <h4>Form Isi Data Inventori Baru</h4>
                </div>

                {{-- Alert Notification --}}
                @if(session('notifikasi_update'))
                    <div class="alert alert-success alert-dismissible m-3 show fade" role="alert">
                    <div class="alert-body">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fas fa-check"></i>
                        {{session('notifikasi_update')}}
                    </div>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('inventori.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}} ">
                                            <label for="nama" class="form-label"> Nama Barang : </label>
                                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Isi Nama Barang" value="{{old('nama')}}">
                                            @if($errors->has('nama'))
                                                <span class="help-block text-danger">{{$errors->first('nama')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('merk') ? 'has-error' : ''}} ">
                                            <label for="merk" class="form-label"> Merk : </label>
                                            <input type="text" class="form-control" name="merk" id="merk" placeholder="Isi Merk Barang" value="{{old('merk')}}">
                                            @if($errors->has('merk'))
                                                <span class="help-block text-danger">{{$errors->first('merk')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{$errors->has('jenis') ? 'has-error' : ''}} ">
                                    <label for="jenis" class="form-label"> Jenis : </label>
                                    <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Isi Jenis Barang" value="{{old('jenis')}}">
                                    @if($errors->has('jenis'))
                                        <span class="help-block text-danger">{{$errors->first('jenis')}}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-2 {{$errors->has('deskripsi') ? 'has-error' : ''}} ">
                                    <label for="deskripsi"> Deskripsi : </label>
                                    <textarea name="deskripsi" class="form-control" placeholder="Isikan Deskripsi" id="deskripsi" rows="2">{{old('deskripsi')}}</textarea>
                                    @if($errors->has('deskripsi'))
                                    <span class="help-block text-danger">{{$errors->first('deskripsi')}}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} ">
                                            <label for="kuantitas" class="form-label"> Kuantitas : </label>
                                            <input type="number" class="form-control" name="kuantitas" id="kuantitas" placeholder="Isi Kuantitas" value="{{old('kuantitas')}}">
                                            @if($errors->has('kuantitas'))
                                                <span class="help-block text-danger">{{$errors->first('kuantitas')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('satuan') ? 'has-error' : ''}} ">
                                            <label for="satuan" > Satuan : </label>
                                            <select name="satuan" class="form-control" id="satuan" >
                                                <option>Pilih</option>
                                                <option value="pcs" {{(old('satuan')=='pcs')? 'selected' :''}}>pcs</option>
                                                <option value="cc" {{(old('satuan')=='cc')? 'selected' :''}}>cc</option>
                                                <option value="ml" {{(old('satuan')=='ml')? 'selected' :''}}>mililiter</option>
                                                <option value="liter" {{(old('satuan')=='liter')? 'selected' :''}}>liter</option>
                                                <option value="gr" {{(old('satuan')=='gr')? 'selected' :''}}>gram</option>
                                                <option value="Kg" {{(old('satuan')=='Kg')? 'selected' :''}}>kilogram</option>
                                            </select>
                                            @if($errors->has('satuan'))
                                            <span class="help-block text-danger">{{$errors->first('satuan')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{$errors->has('stok_minimal') ? 'has-error' : ''}} ">
                                    <label for="stok_minimal" class="form-label"> Jumlah Stok Minimal: </label>
                                    <input type="number" class="form-control" name="stok_minimal" id="stok_minimal" placeholder="Isi Stok Minimal" value="{{old('stok_minimal')}}">
                                    @if($errors->has('stok_minimal'))
                                        <span class="help-block text-danger">{{$errors->first('stok_minimal')}}</span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('harga') ? 'has-error' : ''}} ">
                                    <label for="harga" class="form-label"> Harga : </label>
                                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Isi Harga Barang" value="{{old('harga')}}" autocomplete="off">
                                    @if($errors->has('harga'))
                                        <span class="help-block text-danger">{{$errors->first('harga')}}</span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('gambar') ? 'has-error' : ''}} ">
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Unggah Gambar Barang:</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="gambar" id="foto_pegawai">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('gambar'))
                                                <span class="help-block text-danger">{{$errors->first('gambar')}}</span>
                                            @endif
                                    </div>
                                </div>


                            </div>
                        </div>

                </div>

                <div class="d-sm-flex align-items-center justify-content-start mb-4 ml-4">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('inventori.index') }}" class=" btn btn-lg btn-danger">Batal</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                    </form>

            </div>

        </div>
    </div>
</section>

@endsection
