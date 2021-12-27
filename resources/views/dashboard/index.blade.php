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
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-primary card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <h2 class="mt-3">
                            {{-- <i class="far fa-calendar-alt"></i> --}}
                            {{date('d', strtotime($today))}}
                            <span><h6>{{date('M Y', strtotime($today))}}</h6></span>

                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            Update terakhir
                        </div>
                        <div class="card-body">
                            {{$sumneraca}} Transaksi
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-success card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <h2 class="mt-3">
                            <i class="fas fa-plus"></i>
                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            Total Debit
                        </div>
                        <div class="card-body">
                            Rp {{number_format($sumdebit, 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-danger card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <h2 class="mt-3">
                            <i class="fas fa-minus"></i>
                        </h2>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            Total Kredit
                        </div>
                        <div class="card-body">
                            Rp {{number_format($sumkredit, 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

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
                                Rp {{number_format($balance, 2, ',', '.') }}
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
                                Rp {{number_format($balance, 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Informasi Jumlah Pegawai --}}
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
                        <div class="card-body mb-5">
                            {{$belum_hadir}}
                        </div>
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
                        <div class="card-body mb-5">
                            {{$jml_hadir}}
                        </div>
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
                        <div class="card-body mb-5">
                            {{$jml_bolos}}
                        </div>
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
                        <div class="card-body mb-5">
                            {{$izin}}
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

    </div>
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
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
