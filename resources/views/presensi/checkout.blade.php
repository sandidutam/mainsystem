@extends('layouts.main')

@section('title')
    Presensi Keluar
@endsection

@section('sub-title')
    Check Out
@endsection

@section('presensi.active')
active
@endsection

@section('indexout.active')
active
@endsection


@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Check Out</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('presensi.history')}}">Menu Presensi</a></div>
                <div class="breadcrumb-item active"><a href="{{route('presensi.indexout')}}">Presensi Keluar</a></div>
                <div class="breadcrumb-item">Check Out</div>
            </div>
        </div>

        <div class="section-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{route('presensi.indexout')}}" class="btn btn-primary ">
                    <span class="icon">
                        <i class="fas fa-chevron-left mr-2"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Menu Presensi Masuk</h4>
                </div>

                <div class="card-body">
                    @if(session('notifikasi_sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-check-circle"></i>
                        {{session('notifikasi_sukses')}}
                    </div>
                    @endif

                    @if(session('notifikasi_gagal'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-exclamation-triangle"></i>
                        {{session('notifikasi_gagal')}}
                    </div>
                    @endif

                    {!! Form::model($data_presensi ,['route'=>['presensi.update', $data_presensi->id], 'method'=>'PUT']) !!}

                    {{-- Awal Card Informasi Pribadi --}}

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <h1 class="text-center text-success">Tanggal</h1>
                            <h3 class="text-center">{{date('D, d-M-Y', strtotime($today))}}</h3>
                            <h1 class="text-center text-success" style="margin-top: 40px">Jam</h1>
                            <h3 id="currentTime"></h3>

                            <div class="row mb-2 justify-content-center invisible">
                                <div class="col-12 col-md-6 col-lg-6 ">
                                    <div class="form-group {{$errors->has('id') ? 'has-error' : ''}}">
                                        <label for="id" class="form-label"> ID : </label>
                                        {!! Form::text('id', $data_presensi->pegawai->id, ['class'=>'form-control','id'=>'id','name'=>'id','readonly']) !!}
                                        @if($errors->has('id'))
                                            <span class="help-block text-danger">{{$errors->first('id')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="row mb-2 justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('nomor_pegawai') ? 'has-error' : ''}}">
                                        <label for="nomor_pegawai" class="form-label"> Nomor Pegawai : </label>
                                        {!! Form::text('nomor_pegawai', $data_presensi->pegawai->nomor_pegawai, ['class'=>'form-control','id'=>'nomor_pegawai','name'=>'nomor_pegawai','readonly']) !!}
                                        @if($errors->has('nomor_pegawai'))
                                            <span class="help-block text-danger">{{$errors->first('nomor_pegawai')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('nama_lengkap') ? 'has-error' : ''}}">
                                        <label for="nama_lengkap" class="form-label"> Nama Lengkap : </label>
                                        {!! Form::text('nama_lengkap', $data_presensi->pegawai->nama_lengkap(), ['class'=>'form-control','id'=>'nama_lengkap','name'=>'nama_lengkap','readonly']) !!}
                                        @if($errors->has('nama_lengkap'))
                                            <span class="help-block text-danger">{{$errors->first('nama_lengkap')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
                                        <label for="jabatan" class="form-label"> Jabatan : </label>
                                        {!! Form::text('jabatan', $data_presensi->pegawai->jabatan, ['class'=>'form-control','id'=>'jabatan','name'=>'jabatan','readonly']) !!}
                                        @if($errors->has('jabatan'))
                                            <span class="help-block text-danger">{{$errors->first('jabatan')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('sektor_area') ? 'has-error' : ''}}">
                                        <label for="sektor_area" class="form-label"> Sektor : </label>
                                        {!! Form::text('sektor_area', $data_presensi->pegawai->sektor_area, ['class'=>'form-control','id'=>'sektor_area','name'=>'sektor_area','readonly']) !!}
                                        @if($errors->has('sektor_area'))
                                            <span class="help-block text-danger">{{$errors->first('sektor_area')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 justify-content-center">

                                {{-- <button type="submit" class="btn disabled btn-success mx-3" name="btn_masuk" style="width: 10rem" value="btn_masuk" >PRESENSI MASUK</button> --}}

                                <form action="{{ route('presensi.update', $data_presensi->id ) }}" method="PUT">
                                    <button type="submit" class="btn btn-danger mx-3" name="btn_keluar" style="width: 10rem" value="btn_keluar" >PRESENSI KELUAR</button>
                                </form>

                            </div>
                            {{-- <div class="row mb-2 justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('keterangan') ? 'has-error' : ''}}">
                                        <label for="keterangan" class="mb-2"> Keterangan : </label>
                                        <select name="keterangan" class="form-control" id="keterangan" >
                                        <option>Pilih</option>
                                        <option value="Bolos" {{(old('keterangan')=='Bolos')? 'selected' :''}}>Tidak Hadir / Bolos</option>
                                        <option value="Cuti" {{(old('keterangan')=='Cuti')? 'selected' :''}}>Cuti</option>
                                        <option value="Izin" {{(old('keterangan')=='Izin')? 'selected' :''}}>Izin</option>
                                        <option value="Sakit" {{(old('keterangan')=='Sakit')? 'selected' :''}}>Sakit</option>
                                        </select>
                                        @if($errors->has('keterangan'))
                                            <span class="help-block text-danger">{{$errors->first('keterangan')}}</span>
                                        @endif
                                        <small id="helpId" class="fst-italic text-muted"> <span class=" fw-bold text-danger">Perhatian!</span> Keterangan diisi apabila pegawai tidak masuk kerja</small>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary" name="btn_keterangan" style="width: 22rem" value="btn_keterangan" disabled>SUBMIT KETERANGAN</button>
                                    </div>
                                    <div class="row">
                                        <small id="helpId" class="fst-italic text-center text-muted"> <span class=" fw-bold text-danger">Perhatian!</span> Submit keterangan apabila pegawai tidak masuk kerja</small>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>



                    {{-- Akhir Card Informasi Pribadi --}}

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
         });
    </script>

@endsection
