@extends('layouts.main')

@section('title')
    Menu Neraca
@endsection

@section('sub-title')
    Update Neraca - {{$neraca->akun}}
@endsection

@section('neraca.active')
active
@endsection 

@section('neracaindex.active')
active
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Neraca - Transaksi {{$neraca->akun}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('inventori.index')}}">Menu Neraca</a></div>
                <div class="breadcrumb-item">Edit Neraca</div>
            </div>
        </div>    
    
        <div class="section-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('neraca.index') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
                <i class="fas fa-chevron-left mr-2"></i> Kembali</a>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="card" >
                    <div class="card-header">
                        <h4 class="m-0 font-weight-bold text-primary">Form Edit Transaksi - {{$neraca->akun}}</h4>
                    </div>
                
                    <div class="card-body">
                        {!! Form::model($neraca ,['route'=>['neraca.update', $neraca->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        
                            <div class="row">
                                <div class="col">
                                    <div class="form-group {{$errors->has('akun') ? 'has-error' : ''}} "> 
                                        <label for="akun" class="form-label"> Nama Transaksi : </label> 
                                        {!! Form::text('akun', null, ['class'=>'form-control','id'=>'akun']) !!}
                                    </div>
                                    
                                    <div class="form-group {{$errors->has('deskripsi') ? 'has-error' : ''}} ">
                                        <label for="deskripsi"> Deskripsi : </label>
                                        {!! Form::textarea('deskripsi', null, ['class'=>'form-control','id'=>'deskripsi']) !!}
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            @if (!empty($neraca->debit))
                                            <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} "> 
                                                <label for="kuantitas" class="form-label"> Debit : </label> 
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                          Rp
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control" name="debit" id="debit" placeholder="Isi Nominal" value="{{old('debit',$neraca->debit)}}">
                                                </div>
                                                @if($errors->has('debit'))
                                                    <span class="help-block text-danger">{{$errors->first('debit')}}</span>
                                                @endif
                                            </div>
                                            @else 
                                            <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} "> 
                                                <label for="kuantitas" class="form-label"> Debit : </label> 
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                          Rp
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control" name="debit" id="debit" placeholder="Isi Nominal" value="{{old('debit',$neraca->debit)}}" disabled>
                                                </div>
                                                @if($errors->has('debit'))
                                                    <span class="help-block text-danger">{{$errors->first('debit')}}</span>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            @if (!empty($neraca->kredit))
                                            <div class="form-group ">
                                                <label for="satuan" > Kredit : </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                          Rp
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control" name="kredit" id="kredit" placeholder="Isi Nominal" value="{{old('kredit',$neraca->kredit)}}">
                                                </div>
                                                @if($errors->has('kredit'))
                                                    <span class="help-block text-danger">{{$errors->first('kredit')}}</span>
                                                @endif
                                            </div>
                                            @else
                                            <div class="form-group ">
                                                <label for="satuan" > Kredit : </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                          Rp
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control" name="kredit" id="kredit" placeholder="Isi Nominal" value="{{old('kredit',$neraca->kredit)}}" disabled>
                                                </div>
                                                @if($errors->has('kredit'))
                                                    <span class="help-block text-danger">{{$errors->first('kredit')}}</span>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group" > 
                                        <label for="tanggal" class="form-label"> Tanggal Transaksi : </label> 
                                        {!! Form::text('tanggal', date('d-m-Y', strtotime($neraca->tanggal)) , ['class'=>'datepicker form-control','id'=>'tanggal','disabled']) !!}
                                    </div>
    
                                    <div class="form-group {{$errors->has('foto_bukti') ? 'has-error' : ''}} "> 
                                    <div class="mb-3">
                                        <label for="foto_bukti" class="form-label">Unggah Gambar Transaksi :</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto_bukti" id="foto_bukti" value="{{old('foto_bukti',$neraca->foto_bukti)}}">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('foto_bukti'))
                                            <span class="help-block text-danger">{{$errors->first('foto_bukti')}}</span>
                                        @endif
                                    </div>
                                </div>   

                                <div class="form-group {{$errors->has('file_bukti') ? 'has-error' : ''}} "> 
                                    <div class="mb-3">
                                        <label for="file_bukti" class="form-label">Unggah File Bukti Transaksi :</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file_bukti" id="file_bukti" value="{{old('file_bukti',$neraca->file_bukti)}}">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('file_bukti'))
                                            <span class="help-block text-danger">{{$errors->first('file_bukti')}}</span>
                                        @endif
                                    </div>
                                </div>   
                                </div>
    
                                
                                
                            </div>
                            <div class="d-flex justify-content-start mb-3 ">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{route('neraca.index')}}" class="btn btn-danger" role="button">Batal</a>
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
        <script type="text/javascript">
            $('.datepicker').datepicker({  
               format: 'yyyy-mm-dd'
             });  
        </script> 
    </section>    

@endsection