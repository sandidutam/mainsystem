@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('dashboard.active')
active
@endsection


@section('content')
<section class="section">
    <div class="section-header">
      <h1>Dahshboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('pegawai.index')}}">Menu Dashboard</a></div>
        <div class="breadcrumb-item">Dashboard</div>
      </div>
    </div>

    <div class="section-body">
        {{-- Kartu Informasi Transaksi --}}
        <div class="row">
            @if( $balance > 0 )
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-success card-statistic-1">
                        <div class="card-icon bg-success text-white">
                            <h2 class="mt-3">
                                <i class="fas fa-chevron-up"></i>
                            </h2>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                Saldo
                            </div>
                            <div class="card-body text-success">
                                Rp {{number_format($balance, 2, ',', '.') }} <i class="fas fa-arrow-circle-up" style="color: green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-danger card-statistic-1">
                        <div class="card-icon bg-danger text-white">
                            <h2 class="mt-3">
                                <i class="fas fa-chevron-down"></i>
                            </h2>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                Saldo
                            </div>
                            <div class="card-body text-danger">
                                Rp {{number_format($balance, 2, ',', '.') }} <i class="fas fa-arrow-circle-down" style="color: red"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-dark card-statistic-1">
                    <div class="card-icon bg-dark text-white">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            Jumlah Pegawai
                        </div>
                        <div class="card-body">
                            {{$jml_pegawai}} <span>Orang</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-warning card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum Hadir</h4>
                        </div>
                        <div class="card-body">
                            {{$belum_hadir}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-success card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sudah Hadir</h4>
                        </div>
                        <div class="card-body">
                            {{$jml_hadir}}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Diagram Grafik Presensi dan Neraca --}}
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Neraca</h4>
                    </div>
                    <div class="card-body">
                        <div id="neracaChart">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Presensi</h4>
                    </div>
                    <div class="card-body">
                        <div id="presensiChart">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Manajemen Lokasi Penempatan dan Sektor</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <form action="{{route('new.penempatan')}}" method="POST">
                            @csrf
                            <div class="section-title mt-1 mb-4"><h5>Buat Lokasi Baru</h5></div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('nama_lokasi') ? 'has-error' : ''}} ">
                                        <label for="nama_lokasi" class="form-label"> Nama Lokasi Penempatan <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" placeholder="Isi Nama Lokasi" value="{{old('nama_lokasi')}}" style="text-transform:uppercase" autocomplete="off">
                                        @if($errors->has('nama_lokasi'))
                                            <span class="help-block text-danger">{{$errors->first('nama_lokasi')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('tanggal') ? 'has-error' : ''}} ">
                                        <label for="tanggal" class="form-label"> Tanggal Didirikan <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <input type="text" autocomplete="off" class="datepicker form-control" name="tanggal" id="tanggal" placeholder="01/01/1970" value="{{old('tanggal')}}" autocomplete="off">
                                        @if($errors->has('tanggal'))
                                            <span class="help-block text-danger">{{$errors->first('tanggal')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('kota') ? 'has-error' : ''}} ">
                                        <label for="kota" class="form-label"> Kota <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <input type="text" class="form-control" name="kota" id="kota" placeholder="Isi Kota" value="{{old('kota')}}" style="text-transform:uppercase" autocomplete="off">
                                        @if($errors->has('kota'))
                                            <span class="help-block text-danger">{{$errors->first('kota')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('provinsi') ? 'has-error' : ''}} ">
                                        <label for="provinsi" class="form-label"> Provinsi <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <input type="text" class="form-control" name="provinsi" id="provinsi" placeholder="Isi Provinsi" value="{{old('provinsi')}}" style="text-transform:uppercase" autocomplete="off">
                                        @if($errors->has('provinsi'))
                                            <span class="help-block text-danger">{{$errors->first('provinsi')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="text-danger"><strong><em>*Wajib diisi!</em></strong></span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary mt-4 mb-4">Submit</button>
                        </form>

                        <div class="row mt-4">
                            <div class="table-responsive mx-4">
                                <table class="table table-hover table-striped" id="table-1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Lokasi</th>
                                            <th>Nama</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @forelse( $penempatan as $item)
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td>{{$item->kode_lokasi}}</td>
                                            <td>{{$item->nama_lokasi}}</td>
                                            <td>{{$item->kota}}, {{$item->provinsi}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('destroy.role', $item->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">
                        <form action="{{route('new.sektor')}}" method="POST">
                            @csrf
                            <div class="section-title mt-1 mb-4"><h5>Buat Sektor Baru</h5></div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('nama_sektor') ? 'has-error' : ''}} ">
                                        <label for="nama_sektor" class="form-label"> Nama Sektor <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <input type="text" class="form-control" name="nama_sektor" id="nama_sektor" placeholder="Isi Nama Sektor" value="{{old('nama_sektor')}}" style="text-transform:uppercase" autocomplete="off">
                                        @if($errors->has('nama_sektor'))
                                            <span class="help-block text-danger">{{$errors->first('nama_sektor')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('penempatan') ? 'has-error' : ''}}">
                                        <label for="penempatan" > Lokasi Penempatan <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <select name="penempatan" class="form-control" id="penempatan">
                                            @foreach ($penempatan as $item)
                                                <option selected="true" style='display: none' value="">Pilih</option>
                                                <option value="{{ $item->id }}">{{ $item->nama_lokasi }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('penempatan'))
                                            <span class="help-block text-danger">{{$errors->first('penempatan')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('tanggal') ? 'has-error' : ''}} ">
                                        <label for="tanggal" class="form-label"> Tanggal Ditetapkan <span class="text-danger"><strong><em>*</em></strong></span> </label>
                                        <input type="text" autocomplete="off" class="datepicker form-control" name="tanggal" id="tanggal" placeholder="01/01/1970" value="{{old('tanggal')}}" autocomplete="off">
                                        @if($errors->has('tanggal'))
                                            <span class="help-block text-danger">{{$errors->first('tanggal')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <span class="text-danger"><strong><em>*Wajib diisi!</em></strong></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary mt-4 mb-4">Submit</button>
                        </form>

                        <div class="row mt-4">
                            <div class="table-responsive mx-4">
                                <table class="table table-hover table-striped" id="table-2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Sektor</th>
                                            <th>Nama Sektor</th>
                                            <th>Lokasi Sektor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @forelse( $sektor as $item)
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td>{{$item->kode_sektor}}</td>
                                            <td>{{$item->nama_sektor}}</td>
                                            <td>{{$item->penempatan->nama_lokasi}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('destroy.role', $item->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
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

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('new.role')}}" method="POST">
                            @csrf
                            <div class="section-title mt-1 mb-4"><h5>Buat Role Baru</h5></div>

                            <div class="form-group {{$errors->has('nama_role') ? 'has-error' : ''}} ">
                                <label for="nama_role" class="form-label"> Nama Role : </label>
                                <input type="text" class="form-control" name="nama_role" id="nama_role" placeholder="Isi Nama Role" value="{{old('nama_role')}}">
                                <span class="text-danger"><strong><em>*Wajib diisi!</em></strong></span>
                                @if($errors->has('nama_role'))
                                    <span class="help-block text-danger">{{$errors->first('nama_role')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-2 {{$errors->has('deskripsi') ? 'has-error' : ''}} ">
                                <label for="deskripsi"> Deskripsi Role : </label>
                                <textarea name="deskripsi" class="form-control" placeholder="Isikan deskripsi Role" id="deskripsi" rows="2">{{old('deskripsi')}}</textarea>
                                @if($errors->has('deskripsi'))
                                    <span class="help-block text-danger">{{$errors->first('deskripsi')}}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary mt-4 mb-4">Submit</button>
                        </form>

                        <div class="row mt-4">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="table-1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Role</th>
                                            <th>Deskripsi Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @forelse( $role as $item)
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td>{{$item->nama_role}}</td>
                                            <td>{{$item->deskripsi}}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('destroy.role', $item->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
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

    </div>

    <script type="text/javascript">
        $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
         });

         $(function(){
            $('.noblank').bind('input', function(){
                $(this).val(function(_, v){
                return v.replace(/\s+/g, '');
                });
            });
            });
    </script>


</section>

@endsection

@section('footer')

<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script>
    Highcharts.chart('neracaChart', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Grafik Saldo Bulanan'
    },
    subtitle: {
        text: 'Data Tahun 2021'
    },
    xAxis: {
        categories: {!! json_encode($monthcategories) !!},
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Jumlah (Dalam Rupiah)'
        },
        labels: {
            formatter: function () {
                return 'Rp' + this.value ;
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">Bulan {point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>Rp {point.y:.f},00</b></td></tr>',
        footerFormat: '</table>',
        crosshairs: true,
        shared: true,
        useHTML: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Saldo',
        color: '#6777EF',
        marker: {
            symbol: 'square'
        },
        data: {!! json_encode($databalance) !!}

    }, {
        name: 'Debit',
        color: '#47C363',
        marker: {
            symbol: 'diamond'
        },
        data: {!! json_encode($datadebit) !!}
    }, {
        name: 'Kredit',
        color: '#FC544B',
        marker: {
            symbol: 'diamond'
        },
        data: {!! json_encode($datakredit) !!}
    }]
    });

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

@section('footer')

    <script>
        swal("Good job!", "You clicked the button!", "success");
    </script>

@endsection
