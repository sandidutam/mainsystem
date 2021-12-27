@extends('layouts.main')

@section('title')
    Menu Presensi
@endsection

@section('sub-title')
    Index Presensi
@endsection

@section('presensi.active')
active
@endsection

@section('presensiindex.active')
active
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Index Presensi</h1>

      @if ( auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Mandor" )
            <form action="{{route('presensi.absen')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <button type="submit" class="btn btn-md btn-danger shadow-sm ml-4">
                <i class="fas fa-check fa-sm text-white-50 mr-2"></i></i> Ceklis Pegawai Bolos
            </button>
            </form>
        @endif


      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Menu Presensi</a></div>
        <div class="breadcrumb-item">Index Presensi</div>
      </div>
    </div>

    <div class="section-body">

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
        @if(session('notifikasi_gagal'))
        <div class="alert alert-danger alert-dismissible m-3 show fade" role="alert">
            <div class="alert-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-check"></i>
            {{session('notifikasi_gagal')}}
            </div>
        </div>
        @endif
        @if(session('notifikasi_tidak_masuk'))
        <div class="alert alert-warning alert-dismissible m-3 show fade" role="alert">
            <div class="alert-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-check"></i>
            {{session('notifikasi_tidak_masuk')}}
            </div>
        </div>
        @endif

        <div class="section-title mt-1 mb-4"><h5>{{$hari_ini}}, <span id="currentTime" style="font-size: 18px; margin: 0; color: green;"></span></h5></div>

        {{-- Kartu Informasi Absen Hari Ini --}}
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum Hadir</h4>
                        </div>
                        @if ($belum_hadir == 0)
                        <div class="card-body mb-5">
                            {{$belum_hadir}}
                        </div>
                        @else
                            <div class="card-body mb-5">
                                {{$belum_hadir}}
                                <i class="fas fa-chevron-down" style="color: #6777EF"></i>
                            </div>
                            <div class="card chat-box" id="mychatbox" style="height: 200px;">
                                <div class="card-body chat-content">
                                    <div>
                                        <table>
                                            @foreach ($data_belum_hadir as $item)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img style="height: 45px; width: 45px; border-radius: 30px; border: 2px solid #6777EF; object-fit: cover;" src="{{$item->getFotoPegawai()}}" class="mr-4 mb-4">
                                                    </td>
                                                    <td style="padding-bottom : 25px;">
                                                        {{$item->nama_lengkap()}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sudah Hadir</h4>
                        </div>
                        @if ($jml_hadir == 0)
                        <div class="card-body mb-5">
                            {{$jml_hadir}}
                        </div>
                        @else
                            <div class="card-body mb-5">
                                {{$jml_hadir}}
                                <i class="fas fa-chevron-down" style="color: #47C363"></i>
                            </div>
                            <div class="card chat-box" id="mychatbox" style="height: 200px">
                                <div class="card-body chat-content">
                                    <div>
                                        <table>
                                            @foreach ($data_hadir as $item)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img style="height: 45px; width: 45px; border-radius: 30px; border: 2px solid #47C363; object-fit: cover;" src="{{$item->pegawai->getFotoPegawai()}}" class="mr-4 mb-4">
                                                    </td>
                                                    <td style="padding-bottom : 20px;">
                                                        {{$item->pegawai->nama_lengkap()}} <h4><span class="badge text-white" style="background-color: #47C363">
                                                            {{date('H:i', strtotime($item->jam_masuk))}}
                                                            @if ($item->jam_keluar == null)

                                                            @elseif ($item->jam_keluar != null)
                                                            - {{date('H:i', strtotime($item->jam_keluar))}}
                                                            @endif
                                                             WIB</span></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Absen/Bolos</h4>
                        </div>
                        @if ($jml_bolos == 0)
                        <div class="card-body mb-5">
                            {{$jml_bolos}}
                        </div>
                        @else
                            <div class="card-body mb-5">
                                {{$jml_bolos}}
                                <i class="fas fa-chevron-down" style="color: #FC544B"></i>
                            </div>
                            <div class="card chat-box" id="mychatbox" style="height: 200px">
                                <div class="card-body chat-content">
                                    <div>
                                        <table>
                                            @foreach ($data_bolos as $item)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img style="height: 45px; width: 45px; border-radius: 30px; border: 2px solid #FC544B; object-fit: cover;" src="{{$item->getFotoPegawai()}}" class="mr-4 mb-4">
                                                    </td>
                                                    <td style="padding-bottom : 20px;">
                                                        {{$item->nama_lengkap()}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                    <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Izin/Cuti/Sakit</h4>
                        </div>
                        @if ($izin == 0)
                        <div class="card-body mb-5">
                            {{$izin}}
                        </div>
                        @else
                            <div class="card-body mb-5">
                                {{$izin}}
                                <i class="fas fa-chevron-down" style="color: #FFA426"></i>
                            </div>
                            <div class="card chat-box" id="mychatbox" style="height: 200px">
                                <div class="card-body chat-content">
                                    <div>
                                        <table>
                                            @foreach ($data_lain as $item )
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img style="height: 45px; width: 45px; border-radius: 30px; border: 2px solid #FFA426; object-fit: cover;" src="{{$item->pegawai->getFotoPegawai()}}" class="mr-4 mb-4">
                                                    </td>
                                                    <td style="padding-bottom : 20px;">
                                                        {{$item->pegawai->nama_lengkap()}} <h4><span class="badge text-white" style="background-color: #FFA426">{{$item->keterangan}}</span></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Tabel Presensi</h4>
                <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Download File
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="{{route('presensi.exportexcel')}}"><i class="far fa-file-excel" style="color: green"></i> Excel</a>
                        <a class="dropdown-item has-icon" href="{{route('presensi.exportpdf')}}"><i class="far fa-file-pdf" style="color: red"></i> PDF</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#all-presensi" role="tab" aria-controls="home" aria-selected="true" style="font-size: 18px">Riwayat</a>
                            </li>
                            <li class="nav-item ml-4">
                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#today-presensi" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">Tabel</a>
                            </li>
                            <li class="nav-item ml-4">
                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#grafik-presensi" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">Diagram Grafik</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="all-presensi" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>Riwayat Presensi Hingga Hari Ini , {{$hari_ini}}</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="table-1" width="100%" cellspacing="0">
                                <thead hidden>
                                    <tr>
                                        <th>NAMA LENGKAP</th>
                                        <th>JABATAN DAN SEKTOR</th>
                                        <th>TANGGAL</th>
                                        <th>JAM MASUK ATAU KETERANGAN</th>
                                        @if(auth()->user()->role == "SuperAdmin")
                                        <th>AKSI</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_presensi as $pegawai )
                                    <tr>

                                        <td>
                                            <div class="mt-3" style="margin-left: 20px; width: 50px; margin-right: 10px;">
                                                <span class="badge" style="width: 80px; border-radius: 10px; background-image : linear-gradient(0deg,  #ffffff 50%, #da4439 50%); border: solid 0.5px ;">
                                                    <div class="row justify-content-center text-white">
                                                        <h5>
                                                            {{date('d', strtotime($pegawai->tanggal))}}
                                                        </h5>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <h6>
                                                            {{date('M Y', strtotime($pegawai->tanggal))}}
                                                        </h6>
                                                    </div>
                                                </span>
                                                <h4>
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-3" >
                                                <div class="row">
                                                    <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                                        <h4>
                                                            {{$pegawai->pegawai->nama_lengkap()}}
                                                        </h4>
                                                    </a>
                                                </div>
                                                <div class="row">
                                                    <h6>
                                                        <h6>
                                                            <div class="text-primary text-small font-600-bold"><i class="fas fa-circle"></i>{{$pegawai->pegawai->nomor_pegawai}}</div>
                                                        </h6>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-4">
                                                <h4>
                                                    <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                        {{$pegawai->pegawai->jabatan}} | Sektor {{$pegawai->pegawai->sektor_area}}
                                                    </span>
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($pegawai->keterangan == "Hadir" && $pegawai->jam_masuk != null && $pegawai->jam_keluar == null)
                                                <div class="mt-4">
                                                    <h4>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #47C363;">
                                                            <i class="far fa-clock"></i> Jam Masuk :
                                                            {{\Carbon\Carbon::createFromFormat('H:i:s',$pegawai->jam_masuk)->format('H:i')}}
                                                        </span>
                                                    </h4>
                                                </div>
                                            @elseif ($pegawai->keterangan == "Hadir" && $pegawai->jam_masuk != null && $pegawai->jam_keluar != null)
                                                <div class="mt-4">
                                                    <h4>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #47C363;">
                                                            <i class="far fa-clock"></i> Jam Masuk :
                                                            {{\Carbon\Carbon::createFromFormat('H:i:s',$pegawai->jam_masuk)->format('H:i')}}
                                                            <i class="fas fa-long-arrow-alt-right"></i> Jam Keluar :
                                                            {{\Carbon\Carbon::createFromFormat('H:i:s',$pegawai->jam_keluar)->format('H:i')}}
                                                        </span>
                                                    </h4>
                                                </div>
                                            @elseif ($pegawai->keterangan != "Hadir" && $pegawai->jam_masuk == "00:00:00" && $pegawai->jam_keluar == "00:00:00")
                                                <div class="mt-4">
                                                    <h4>
                                                        @if ($pegawai->keterangan == "Bolos")
                                                            <span class="badge text-white" style="margin-left: 20px; background-color: #FC544B;">
                                                                <i class="fas fa-pen"></i> {{$pegawai->keterangan}}
                                                            </span>
                                                        @elseif ($pegawai->keterangan != "Bolos" || $pegawai->keterangan != "Hadir")
                                                            <span class="badge text-white" style="margin-left: 20px; background-color: #FFA426;">
                                                                <i class="fas fa-pen"></i> {{$pegawai->keterangan}}
                                                            </span>
                                                        @endif
                                                    </h4>
                                                </div>
                                            @endif
                                        </td>
                                        @if(auth()->user()->role == "SuperAdmin")
                                        <td>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <form action="{{ route('presensi.destroy', $pegawai->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="today-presensi" role="tabpanel" aria-labelledby="profile-tab3">
                        <div class="row justify-content-between mx-1 my-4">
                            <h5>Tabel Presensi Keseluruhan</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="table-2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR PEGAWAI</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>JABATAN</th>
                                    <th>SEKTOR</th>
                                    <th>TANGGAL</th>
                                    <th>JAM MASUK</th>
                                    <th>JAM KELUAR</th>
                                    <th>CATATAN</th>
                                    <th>KETERANGAN</th>
                                    @if(auth()->user()->role == "SuperAdmin")
                                    <th>AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse($data_presensi as $pegawai)
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>{{$pegawai->pegawai->nomor_pegawai}}</td>
                                    <td>{{$pegawai->pegawai->nama_lengkap()}}</td>
                                    <td>{{$pegawai->pegawai->jabatan}}</td>
                                    <td>{{$pegawai->pegawai->sektor_area}}</td>
                                    <td>{{date('d F Y', strtotime($pegawai->tanggal))}}</td>
                                    <td>
                                        @if($pegawai->keterangan == "Hadir")
                                        {{$pegawai->jam_masuk}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    {{-- View Tanggal diubah dari Y-m-d ke d-m-Y --}}
                                    <td>
                                        @if($pegawai->keterangan == "Hadir" && $pegawai->jam_keluar != null )
                                        {{$pegawai->jam_keluar}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($pegawai->keterangan == null)
                                        {{$pegawai->catatan_masuk}}dan {{$pegawai->catatan_keluar}}
                                        @else
                                        Tidak hadir
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($pegawai->keterangan))
                                        {{$pegawai->keterangan}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    @if(auth()->user()->role == "SuperAdmin")
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <form action="{{ route('presensi.destroy', $pegawai->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                <?php $i++; ?>
                                @empty
                                @endforelse
                            </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="grafik-presensi" role="tabpanel" aria-labelledby="profile-tab3">

                        <div id="presensiChart">

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>



</section>

@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script>
    Highcharts.chart('presensiChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Presensi Pegawai 7 Hari Terakhir'
    },
    xAxis: {
        categories: {!! json_encode($categories) !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pegawai (orang)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f} orang</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Hadir',
        color: '#47C363',
        data: {!! json_encode($data1) !!}

    }, {
        name: 'Bolos',
        color: '#FC544B',
        data: {!! json_encode($data2) !!}

    }, {
        name: 'Cuti',
        color: '#6777EF',
        data: {!! json_encode($data3) !!}

    }, {
        name: 'Sakit',
        color: '#F67A3D',
        data: {!! json_encode($data4) !!}

    }, {
        name: 'Izin',
        color: '#FFB44C',
        data: {!! json_encode($data5) !!}

    },
    ]
});

</script>

@endsection
