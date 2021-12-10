@extends('layouts.main')

@section('title')
    Menu Inventori
@endsection

@section('sub-title')
    Update Inventori - {{$stok_barang->nama}}
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
            <h1>Update Inventori - {{$stok_barang->nama}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('inventori.index')}}">Menu Inventori</a></div>
                <div class="breadcrumb-item">Update Inventori</div>
            </div>
        </div>    
    
        <div class="section-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('inventori.index') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
                <i class="fas fa-chevron-left mr-2"></i> Kembali</a>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="card" >
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-primary">Form Update Data Barang - {{$stok_barang->nama}}</h4>
                    </div>
                
                    <div class="card-body">
                        {!! Form::model($stok_barang ,['route'=>['inventori.update', $stok_barang->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="nama" class="form-label"> Nama Barang : </label> 
                                                {!! Form::text('nama', null, ['class'=>'form-control','id'=>'nama']) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="merk" class="form-label"> Merk : </label> 
                                                {!! Form::text('merk', null, ['class'=>'form-control','id'=>'merk']) !!}
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group {{$errors->has('jenis') ? 'has-error' : ''}} "> 
                                        <label for="jenis" class="form-label"> Jenis : </label> 
                                        {!! Form::text('jenis', null, ['class'=>'form-control','id'=>'jenis']) !!}
                                    </div>
                                    
                                    <div class="form-group {{$errors->has('deskripsi') ? 'has-error' : ''}} ">
                                        <label for="deskripsi"> Deskripsi : </label>
                                        {!! Form::textarea('deskripsi', null, ['class'=>'form-control','id'=>'deskripsi']) !!}
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} "> 
                                                <label for="kuantitas" class="form-label"> Kuantitas : </label> 
                                                {!! Form::number('kuantitas', null, ['class'=>'form-control','id'=>'kuantitas']) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group ">
                                                <label for="satuan" > Satuan : </label>
                                                <select name="satuan" class="form-control" id="satuan" >
                                                    <option>Pilih</option>
                                                    <option value="pcs" {{(old('satuan',$stok_barang->satuan)=='pcs')? 'selected' :''}}>pcs</option>
                                                    <option value="cc" {{(old('satuan',$stok_barang->satuan)=='cc')? 'selected' :''}}>cc</option>
                                                    <option value="ml" {{(old('satuan',$stok_barang->satuan)=='ml')? 'selected' :''}}>mililiter</option>
                                                    <option value="liter" {{(old('satuan',$stok_barang->satuan)=='liter')? 'selected' :''}}>liter</option>
                                                    <option value="gr" {{(old('satuan',$stok_barang->satuan)=='gr')? 'selected' :''}}>gram</option>
                                                    <option value="Kg" {{(old('satuan',$stok_barang->satuan)=='Kg')? 'selected' :''}}>kilogram</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
    
                                    <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} "> 
                                        <label for="stok_minimal" class="form-label">Jumlah Stok Minimal : </label> 
                                        {!! Form::number('stok_minimal', null, ['class'=>'form-control','id'=>'stok_minimal']) !!}
                                    </div>
    
                                    <div class="form-group {{$errors->has('harga') ? 'has-error' : ''}} "> 
                                        <label for="harga" class="form-label"> Harga : </label> 
                                        {!! Form::number('harga', null, ['class'=>'form-control','id'=>'harga']) !!}
                                    </div>
    
                                    <div class="form-group {{$errors->has('gambar') ? 'has-error' : ''}} "> 
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Unggah Gambar Barang:</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="gambar" id="gambar" value="{{old('gambar')}}">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            @if($errors->has('gambar'))
                                                <span class="help-block text-danger">{{$errors->first('gambar')}}</span>
                                            @endif
                                        </div>
                                    </div>   
                                </div>
    
                                
                                
                            </div>
                            <div class="d-flex justify-content-start mb-3 ">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{route('inventori.index')}}" class="btn btn-danger" role="button">Batal</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
                    {!! Form::close() !!}



        </div>

    </section>    

@endsection