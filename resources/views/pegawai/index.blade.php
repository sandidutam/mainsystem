@extends('layouts.main')

@section('title')
    Menu Pegawai
@endsection

@section('sub-title')
    Index Pegawai
@endsection

@section('pegawai.active')
active
@endsection

@section('pegawaiindex.active')
active
@endsection


@section('content')
<section class="section">
    <div class="section-header">
        <h1>Index Pegawai</h1>

        <a href="{{ route('pegawai.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm ml-4">
        <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>

        @if ( auth()->user()->role == "SuperAdmin" )
            <form action="{{route('pegawai.reset_status')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <button type="submit" class="btn btn-md btn-danger shadow-sm ml-4">
                <i class="fas fa-recycle fa-sm text-white-50 mr-2"></i></i> Reset Status
            </button>
            </form>
        @endif


        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        </div> --}}

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('pegawai.index')}}">Menu Pegawai</a></div>
            <div class="breadcrumb-item">Index Pegawai</div>
        </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('pegawai.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>
        </div> --}}

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-success card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <h2 class="mt-3">
                            {{$jml_s1}} <span><h6>Orang</h6></span>
                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            Jumlah Pegawai Sektor 1
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-success card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <h2 class="mt-3">
                            {{$jml_s2}} <span><h6>Orang</h6></span>
                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            Jumlah Pegawai Sektor 2
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-success card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <h2 class="mt-3">
                            {{$jml_s3}} <span><h6>Orang</h6></span>
                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            Jumlah Pegawai Sektor 3
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-success card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <h2 class="mt-3">
                            {{$jml_s4}} <span><h6>Orang</h6></span>
                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            Jumlah Pegawai Sektor 4
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">
            {{-- <div class="card-header">
                <h4>Data Pegawai</h4>
                <ul class="nav nav-pills" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#sektor1" role="tab" aria-controls="home" aria-selected="true" style="font-size: 18px">
                            Sektor <span class="badge badge-light">1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sektor2" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                            Sektor <span class="badge badge-light">2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sektor3" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                            Sektor <span class="badge badge-light">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sektor4" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                            Sektor <span class="badge badge-light">4</span>
                        </a>
                    </li>
                </ul>
            </div> --}}

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#sektor1" role="tab" aria-controls="home" aria-selected="true" style="font-size: 18px">
                                    Sektor <span class="badge badge-light">1</span>
                                </a>
                            </li>
                            <li class="nav-item ml-4">
                                <a class="nav-link" data-toggle="tab" href="#sektor2" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                                    Sektor <span class="badge badge-light">2</span>
                                </a>
                            </li>
                            <li class="nav-item ml-4">
                                <a class="nav-link" data-toggle="tab" href="#sektor3" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                                    Sektor <span class="badge badge-light">3</span>
                                </a>
                            </li>
                            <li class="nav-item ml-4">
                                <a class="nav-link" data-toggle="tab" href="#sektor4" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                                    Sektor <span class="badge badge-light">4</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="tab-content " id="myTabContent2">
                    <div class="tab-pane fade show active" id="sektor1" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>List Pegawai Sektor 1</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1" width="100%" cellspacing="0">
                            <thead hidden>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nomor Pegawai</th>
                                    <th>Jabatan</th>
                                    @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($s1 as $pegawai)
                                    <tr>
                                        @if ( $pegawai->status == "Belum Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #838383; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                    {{-- <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-md btn-danger m-2" onclick="return confirm('Yakin ingin dihapus?')"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                            @endif
                                        @elseif ( $pegawai->status == "Sudah Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #47C363; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Tidak Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FC544B; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        @if ( $pegawai->presensi->pluck('keterangan')->implode(', ') == "Izin" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Cuti" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Sakit" )
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir -
                                                                    <span class="text-warning">
                                                                        {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}
                                                                    </span>
                                                                </div>
                                                            </h6>
                                                        @else
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir - {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}</div>
                                                            </h6>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Sudah Pulang" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FFA426; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-warning text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Pulang</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @endif
                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sektor2" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>List Pegawai Sektor 2</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-2" width="100%" cellspacing="0">
                            <thead hidden>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nomor Pegawai</th>
                                    <th>Jabatan</th>
                                    @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($s2 as $pegawai)
                                    <tr>
                                        @if ( $pegawai->status == "Belum Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #838383; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                    {{-- <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-md btn-danger m-2" onclick="return confirm('Yakin ingin dihapus?')"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                            @endif
                                        @elseif ( $pegawai->status == "Sudah Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #47C363; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Tidak Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FC544B; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        @if ( $pegawai->presensi->pluck('keterangan')->implode(', ') == "Izin" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Cuti" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Sakit" )
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir -
                                                                    <span class="text-warning">
                                                                        {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}
                                                                    </span>
                                                                </div>
                                                            </h6>
                                                        @else
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir - {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}</div>
                                                            </h6>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Sudah Pulang" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FFA426; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-warning text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Pulang</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @endif
                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sektor3" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>List Pegawai Sektor 3</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-3" width="100%" cellspacing="0">
                            <thead hidden>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nomor Pegawai</th>
                                    <th>Jabatan</th>
                                    @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($s3 as $pegawai)
                                    <tr>
                                        @if ( $pegawai->status == "Belum Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #838383; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                    {{-- <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-md btn-danger m-2" onclick="return confirm('Yakin ingin dihapus?')"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                            @endif
                                        @elseif ( $pegawai->status == "Sudah Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #47C363; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Tidak Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FC544B; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        @if ( $pegawai->presensi->pluck('keterangan')->implode(', ') == "Izin" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Cuti" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Sakit" )
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir -
                                                                    <span class="text-warning">
                                                                        {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}
                                                                    </span>
                                                                </div>
                                                            </h6>
                                                        @else
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir - {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}</div>
                                                            </h6>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Sudah Pulang" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FFA426; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-warning text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Pulang</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @endif

                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sektor4" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>List Pegawai Sektor 4</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-4" width="100%" cellspacing="0">
                            <thead hidden>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nomor Pegawai</th>
                                    <th>Jabatan</th>
                                    @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($s4 as $pegawai)
                                    <tr>
                                        @if ( $pegawai->status == "Belum Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #838383; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                    {{-- <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-md btn-danger m-2" onclick="return confirm('Yakin ingin dihapus?')"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                            @endif
                                        @elseif ( $pegawai->status == "Sudah Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #47C363; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Hadir</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Tidak Hadir" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FC544B; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        @if ( $pegawai->presensi->pluck('keterangan')->implode(', ') == "Izin" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Cuti" || $pegawai->presensi->pluck('keterangan')->implode(', ') == "Sakit" )
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir -
                                                                    <span class="text-warning">
                                                                        {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}
                                                                    </span>
                                                                </div>
                                                            </h6>
                                                        @else
                                                            <h6>
                                                                <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir - {{$pegawai->presensi->pluck('keterangan')->implode(', ')}}</div>
                                                            </h6>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $pegawai->status == "Sudah Pulang" )
                                            <td>
                                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FFA426; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                            <h4>
                                                                {{$pegawai->nama_lengkap()}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-warning text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Pulang</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                                            #{{$pegawai->nomor_pegawai}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$pegawai->jabatan}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin")
                                            <td>
                                                <div class="row mt-2">
                                                    <button class="btn btn-md btn-danger m-2 delete" id_pegawai="{{Crypt::encryptString($pegawai->id)}}" nama_lengkap="{{$pegawai->nama_lengkap()}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                            @endif

                                        @endif

                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</section>


<script>

    $('.delete').click(function() {
        var id = $(this).attr('id_pegawai');
        var nama_lengkap = $(this).attr('nama_lengkap');
        swal({
            title: 'Ingin menghapus data '+nama_lengkap+' ??',
            text: 'Langkah ini akan menghapus data '+nama_lengkap+' secara permanen.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/pegawai/"+id+"/destroy";
            }
            });
    });




    // window.onload = function() {
    // document.getElementById("clearButton1").addEventListener("click",clear1);
    // }

    // function sector1() {
    //     var input, filter, ul, li, a, i, txtValue;
    //     input = document.getElementById("myInput1");
    //     filter = input.value.toUpperCase();
    //     ul = document.getElementById("myUL1");
    //     li = ul.getElementsByTagName("td");
    //     for (i = 0; i < li.length; i++) {
    //         a = li[i].getElementsByTagName("div")[0];
    //         txtValue = a.textContent || a.innerText;
    //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //             li[i].style.display = "";
    //         } else {
    //             li[i].style.display = "none";
    //         }
    //     }
    // }

    // function clear1() {
    // // Select the 'myInput' search box, and set it's value to an empty String
    // document.getElementById("myInput1").value = "";
    // // Call seach, which should reset the result list
    // sector1();
    //  }

</script>
@endsection
