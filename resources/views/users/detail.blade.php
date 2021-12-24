@extends('layouts.main')

@section('title')
    Menu User
@endsection

@section('sub-title')
    Profil {{$data_user->nama_lengkap()}}
@endsection

@if($data_user)
    @section('authuser.active')
    active
    @endsection

    @section('authuserprofile.active')
    active
    @endsection

@else

    @section('user.active')
    active
    @endsection

    @section('userindex.active')
    active
    @endsection

@endif


@section('content')
<section class="section">
    <div class="section-header">
      <h1>Profil {{$data_user->nama_lengkap()}}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.index') }}">Menu User</a></div>
        <div class="breadcrumb-item">Profil User</div>
      </div>
    </div>

    <div class="section-body">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('user.index') }}" class="btn btn-danger ">
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
                        <h6 class="m-0 font-weight-bold text-primary">Profil {{$data_user->nama_lengkap()}}</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center card-split">
                                <img class="img-profil-pegawai img-thumbnail" style="margin-top: 50px; margin-bottom: 25px; width: 140px; height: 140px" src="{{$data_user->getFotoUser()}}" alt="">
                                <h3 class="mt-2 mb-2"><strong>{{$data_user->nama_lengkap()}}</strong></h3>
                                <p class="mt-2" >{{$data_user->jabatan}} dengan role {{$data_user->role}}</p>

                            </div>
                            <div class="col">
                                <div class="table">
                                    <table class="table table-borderless table-sm" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <td>Nomor Pegawai</td><td>{{$data_user->nomor_pegawai}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td><td>{{$data_user->nama_lengkap()}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td><td>{{date('d F Y', strtotime($data_user->tanggal_lahir))}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td><td>{{$data_user->jabatan}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Role</td><td>{{$data_user->role}}</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

</section>
@endsection
