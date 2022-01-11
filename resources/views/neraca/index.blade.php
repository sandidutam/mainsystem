@extends('layouts.main')

@section('title')
    Menu Neraca
@endsection

@section('sub-title')
    Index Neraca
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
        <h1>Index Neraca</h1>

        <a href="{{ route('neraca.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm ml-4">
        <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>

        @if ( auth()->user()->role == "SuperAdmin" )
            <form action="{{route('neraca.update_akun')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <button type="submit" class="btn btn-md btn-success shadow-sm ml-4">
                <i class="fas fa-recycle fa-sm text-white-50 mr-2"></i></i> Update Status
            </button>
            </form>
        @endif

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('neraca.index')}}">Menu Neraca</a></div>
            <div class="breadcrumb-item">Index Neraca</div>
        </div>
    </div>

    <div class="section-body">

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

        <div class="card">
            <div class="card-header">
                <h4>
                    Grafik Pergerakan Saldo
                </h4>
            </div>
            <div class="card-body">
                <div id="neracaChart">

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Katalog Neraca</h4>
                <div class="group">
                <a href="{{route('neraca.exportexcel')}}" class="btn btn-success mr-2"><i class="fas fa-file-excel mr-3"></i>Download Excel</a>
                <a href="{{route('neraca.exportpdf')}}" class="btn btn-danger"><i class="fas fa-file-excel mr-3"></i>Download PDF</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#neraca1" role="tab" aria-controls="home" aria-selected="true" style="font-size: 18px">
                                    <i class="fas fa-history"></i> Riwayat Transaksi
                                </a>
                            </li>
                            <li class="nav-item ml-4">
                                <a class="nav-link" data-toggle="tab" href="#neraca2" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px">
                                    <i class="fas fa-table"></i> Tabel Neraca <span class="badge badge-success"><i class="fas fa-chevron-up"></i></span>
                                    <span class="badge badge-danger"><i class="fas fa-chevron-down"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content " id="myTabContent2">
                    <div class="tab-pane fade show active" id="neraca1" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>Riwayat Transaksi Per Tanggal {{date('d-m-Y', strtotime($today))}}</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1" width="100%" cellspacing="0">
                            <thead hidden>
                                <tr>
                                    <th>Icon</th>
                                    <th>Detail</th>
                                    <th>Nominal</th>
                                    <th>Nomor Akun</th>
                                    @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $item)
                                    <tr>
                                        @if ( $item->kredit == null )
                                            <td>
                                                <div class="mt-4 text-success">
                                                    <i class="fas fa-chevron-up"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('neraca.detail', Crypt::encryptString($item->id)) }}">
                                                            <h4>
                                                                {{$item->akun}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> {{$item->deskripsi}}</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #47C363">
                                                            Rp {{number_format($item->debit, 2, ',', '.') }}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$item->nomor_akun}}
                                                        </span>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17;">
                                                            {{date('d F Y', strtotime($item->tanggal))}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Akuntan" )
                                            <td>
                                                <div class="row mt-2">
                                                    <a href="{{ route('neraca.edit', Crypt::encryptString($item->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>
                                                    <button class="btn btn-md btn-danger m-2 delete" id_neraca="{{$item->id}}" nama_akun="{{$item->akun}}" nomor_akun="{{$item->nomor_akun}}">
                                                        <i class="fas fa-trash mr-2"></i> Hapus
                                                    </button>
                                                    {{-- <form action="{{ route('neraca.destroy', Crypt::encryptString($item->id)) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                            @endif

                                        @elseif ( $item->debit == Null )
                                            <td>
                                                <div class="mt-4 text-danger">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <a style="color: black;" href="{{ route('neraca.detail', Crypt::encryptString($item->id)) }}">
                                                            <h4>
                                                                {{$item->akun}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div class="row">
                                                        <h6>
                                                            <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> {{$item->deskripsi}}</div>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #FC544B">
                                                            Rp {{number_format($item->kredit, 2, ',', '.') }}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mt-4">
                                                    <h5>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                                            {{$item->nomor_akun}}
                                                        </span>
                                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17;">
                                                            {{date('d F Y', strtotime($item->tanggal))}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </td>
                                            @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Akuntan" )
                                            <td>
                                                <div class="row mt-2">
                                                    <a href="{{ route('neraca.edit', Crypt::encryptString($item->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>
                                                    <button class="btn btn-md btn-danger m-2 delete" id_neraca="{{$item->id}}" nama_akun="{{$item->akun}}" nomor_akun="{{$item->nomor_akun}}">
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

                    <div class="tab-pane fade" id="neraca2" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="row justify-content-start mx-1 my-4">
                            <h5>Tabel Neraca</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="table-2" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No.Transaksi</th>
                                    <th>Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Update Terakhir</th>
                                    @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan")
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse($neraca as $item)
                                    <tr >
                                        <td><?= $i; ?></td>
                                        <td>{{$item->nomor_akun}}</td>
                                        <td><a href="{{ route('neraca.detail', Crypt::encryptString($item->id)) }}">{{$item->akun}}</a></td>
                                        @if ($item->debit != null && $item->kredit == null)
                                        <td>Rp {{number_format($item->debit, 2, ',', '.') }} <i class="fas fa-arrow-circle-up" style="color: green"></i></td>
                                        <td> 0,0 </td>
                                        @elseif ($item->kredit != null && $item->debit == null)
                                        <td> 0,0 </td>
                                        <td>Rp {{number_format($item->kredit, 2, ',', '.') }} <i class="fas fa-arrow-circle-down" style="color: red"></i></td>
                                        @endif

                                        <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                        <td>
                                            Jam : {{$item->updated_at->format('H:i') }} <br>
                                            Tanggal : {{$item->updated_at->format('d F Y') }}
                                        </td>
                                        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan")
                                        <td>
                                            <div class="row">
                                            <a href="{{ route('neraca.edit',Crypt::encryptString($item->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-1"></i></a>
                                            <button class="btn btn-md btn-danger m-2 delete" id_neraca="{{$item->id}}" nama_akun="{{$item->akun}}" nomor_akun="{{$item->nomor_akun}}">
                                                <i class="fas fa-trash mr-2"></i> Hapus
                                            </button>
                                            {{-- <form action="{{ route('neraca.destroy', $item->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-1"></i></button>
                                            </form> --}}
                                            </div>
                                        </td>
                                        @endif
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

    $('.delete').click(function() {
        var id = $(this).attr('id_neraca');
        var nama_akun = $(this).attr('nama_akun');
        var nomor_akun = $(this).attr('nomor_akun');
        swal({
            title: 'Ingin menghapus data '+nama_akun+' ??',
            text: 'Langkah ini akan menghapus data transaksi '+nama_akun+' dengan nomor transaksi '+nomor_akun+' secara permanen.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/neraca/"+id+"/destroy";
            }
            });
    });

</script>

@endsection
