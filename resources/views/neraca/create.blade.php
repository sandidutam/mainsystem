@extends('layouts.main')

@section('title')
    Menu Neraca
@endsection

@section('sub-title')
    Tambah Data
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
      <h1>Catat Transaksi Baru</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('neraca.index')}}">Menu Neraca</a></div>
        <div class="breadcrumb-item">Transaksi Baru</div>
      </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('neraca.index') }}" class="d-none d-sm-inline-block btn btn-md btn-danger shadow-sm">
            <i class="fas fa-chevron-left mr-2"></i> Kembali</a>
        </div>

        <div class="row d-flex justify-content-center ">
            <div class="card">
                <div class="card-header">
                    <h4>Form Isi Data Transaksi Baru</h4>
                </div>

                {{-- Alert Notification --}}

                @if(session('notifikasi_sukses'))
                    <div class="alert alert-success alert-dismissible m-3 show fade" role="alert">
                    <div class="alert-body">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fas fa-check"></i>
                        {{session('notifikasi_sukses')}}
                    </div>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('neraca.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group {{$errors->has('Transaksi') ? 'has-error' : ''}} ">
                                    <label for="transaksi" class="form-label">Nama Transaksi : </label>
                                    <input type="text" class="form-control" name="transaksi" id="transaksi" placeholder="Isi Nama Transaksi" value="{{old('transaksi')}}">
                                    @if($errors->has('transaksi'))
                                        <span class="help-block text-danger">{{$errors->first('transaksi')}}</span>
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
                                        <div class="form-group {{$errors->has('debit') ? 'has-error' : ''}} ">
                                            <label for="debit" class="form-label"> Debit : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                      Rp
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" name="debit" id="debit" placeholder="Isi Nominal" value="{{old('debit')}}">
                                            </div>
                                            @if($errors->has('debit'))
                                                <span class="help-block text-danger">{{$errors->first('debit')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('kredit') ? 'has-error' : ''}} ">
                                            <label for="kredit" class="form-label"> Kredit : </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                      Rp
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control" name="kredit" id="kredit" placeholder="Isi Nominal" value="{{old('kredit')}}">
                                            </div>
                                            @if($errors->has('kredit'))
                                                <span class="help-block text-danger">{{$errors->first('kredit')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{$errors->has('tanggal') ? 'has-error' : ''}} ">
                                    <label for="tanggal" class="form-label"> Tanggal Transaksi : </label>
                                    <input type="text" autocomplete="off" class="datepicker form-control" name="tanggal" id="tanggal" placeholder="01/01/2021" value="{{old('tanggal')}}">
                                    @if($errors->has('tanggal'))
                                        <span class="help-block text-danger">{{$errors->first('tanggal')}}</span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('foto_bukti') ? 'has-error' : ''}} ">
                                    <div class="mb-3">
                                        <label for="foto_bukti" class="form-label">Unggah Gambar Transaksi :</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto_bukti" id="foto_bukti">
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
                                            <input type="file" class="custom-file-input" name="file_bukti" id="file_bukti">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('file_bukti'))
                                            <span class="help-block text-danger">{{$errors->first('file_bukti')}}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="d-sm-flex align-items-center justify-content-start">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('neraca.index') }}" class=" btn btn-lg btn-danger">Batal</a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                </div>

                    </form>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
         });
    </script>
</section>

@endsection
