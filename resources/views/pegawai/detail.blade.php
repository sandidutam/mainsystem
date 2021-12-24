@extends('layouts.main')

@section('title')
    Menu Pegawai
@endsection

@section('sub-title')
    Profil {{$data_pegawai->nama_lengkap()}}
@endsection

@section('pegawai.active')
active
@endsection

@section('index.active')
active
@endsection


@section('content')
<section class="section">
    <div class="section-header">
      <h1>Profil - {{$data_pegawai->nama_lengkap()}}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pegawai.index') }}">Menu Pegawai </a></div>
        <div class="breadcrumb-item">Profil Pegawai </div>
      </div>
    </div>

    <div class="section-body">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Space%20Mono">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="/pegawai" class="btn btn-danger ">
                <span class="icon">
                    <i class="fas fa-chevron-left mr-2"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profil - {{$data_pegawai->nama_lengkap()}}</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 text-center ">
                                <img class="img-profil-pegawai img-thumbnail" style=" margin-bottom: 25px; height: 140px; width: 140px" src="{{$data_pegawai->getFotoPegawai()}}" alt="">
                                <h3 class="mt-2 mb-2"><strong>{{$data_pegawai->nama_lengkap()}}</strong></h3>
                                <p class="mt-2" >{{$data_pegawai->jabatan}} di Sektor {{$data_pegawai->sektor_area}}</p>
                                <p class="mt-2" >{!! QrCode::size(140)->generate($data_pegawai->id); !!} </p>

                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                {{-- Could use table-responsive --}}
                                <div class="table">
                                    <table class="table table-borderless table-sm" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <td>Nomor Pegawai</td><td>{{$data_pegawai->nomor_pegawai}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td><td>{{$data_pegawai->nama_lengkap()}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td><td>{{date('d F Y', strtotime($data_pegawai->tanggal_lahir))}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td><td>{{$data_pegawai->agama}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan</td><td>{{$data_pegawai->pendidikan}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td><td>{{$data_pegawai->alamat}}, <br> {{$data_pegawai->kelurahan}}, {{$data_pegawai->kecamatan}}, <br> {{$data_pegawai->kota_kabupaten}}, {{$data_pegawai->provinsi}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td><td>{{$data_pegawai->jabatan}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Penempatan</td><td>{{$data_pegawai->penempatan}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Sektor</td><td>{{$data_pegawai->sektor_area}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal diterima</td><td>{{date('d F Y', strtotime($data_pegawai->tanggal_diterima))}}</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Presensi Pegawai</h6>
                    </div>
                    <div class="card-body" >
                        <h1 class="text-center text-success">Tanggal</h1>
                        <h3 class="text-center">{{date('D, d-M-Y', strtotime($today))}}</h3>
                        <h1 class="text-center text-success" style="margin-top: 40px">Jam</h1>
                        <h3 id="currentTime"></h3>

                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <a href="{{ route('presensi.checkin', $data_pegawai->id) }}" class="btn btn-lg btn-success" type="button">Presensi Masuk</a>
                            </div>
                            @foreach ($data_presensi as $pegawai)
                            <div class="col d-flex justify-content-center">
                                <a href="{{ route('presensi.checkout', $pegawai->id) }}" class="btn btn-lg btn-warning" type="button">Presensi Keluar</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
