@extends('layouts.main')

@section('title')
    Menu Presensi
@endsection

@section('sub-title')
    Presensi Masuk
@endsection

@section('presensi.active')
active
@endsection

@section('indexin.active')
active
@endsection

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Menu Presensi Masuk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('presensi.history')}}">Menu Presensi</a></div>
                <div class="breadcrumb-item">Presensi Masuk</div>
            </div>
        </div>

        <div class="section-body">
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

                    {{-- <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <form action="{{route('presensi.indexin')}} " method="GET">
                                <div class="row">
                                    <label for="search" class="text-danger ml-3" style="">*Masukkan Nomor Pegawai</label>
                                </div>
                                <div class="row {{$errors->has('search') ? 'has-error' : ''}} ">
                                    <div class="col">
                                        <input type="text" name="search" id="search" class="form-control" placeholder="contoh : PGW-2020001" aria-describedby="helpId" autocomplete="off">
                                    </div>
                                    <div class="col ml-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                            Cari
                                        </button>
                                    </div>
                                    @if($errors->has('search'))
                                        <span class="help-block text-danger">{{$errors->first('search')}}</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div> --}}

                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="table-1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR PEGAWAI</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>JABATAN</th>
                                    <th>SEKTOR</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse($data_pegawai as $pegawai )

                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>{{$pegawai->nomor_pegawai}}</td>
                                    <td>{{$pegawai->nama_lengkap()}}</td>
                                    <td>{{$pegawai->jabatan}}</td>
                                    <td>{{$pegawai->sektor_area}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('presensi.checkin', Crypt::encryptString($pegawai->id)) }}" class="btn btn-md btn-success" type="button">Presensi Masuk</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @empty
                                {{-- <tr>
                                    <td colspan="11" class="text-center text-white bg-secondary"><i><b>TIDAK ADA DATA UNTUK DITAMPILKAN</b></i></td>
                                </tr> --}}
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
