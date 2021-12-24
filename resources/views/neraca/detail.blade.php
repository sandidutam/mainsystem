@extends('layouts.main')

@section('title')
    Menu Neraca
@endsection

@section('sub-title')
    Detail Transaksi {{$neraca->akun}}
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
            <h1> Detail Transaksi {{$neraca->akun}}</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('neraca.index') }}">Menu Neraca</a></div>
            <div class="breadcrumb-item">Detail Neraca</div>
      </div>
        </div>

        <div class="section-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('neraca.index') }}" class="btn btn-danger ">
                    <span class="icon">
                        <i class="fas fa-chevron-left mr-2"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Detail Transaksi {{$neraca->akun}}</h6>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 text-center card-split">
                                    {{-- <img class="img" style="margin-top: 50px; margin-bottom: 25px; width:250px; height:250px" src="{{$stok_barang->getGambarBarang()}}" alt=""> --}}
                                    <h3 class="mt-2 mb-2"><strong>{{$neraca->akun}}</strong></h3>
                                    <p class="mt-2" >{{$neraca->deskripsi}}</p>

                                </div>
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <tr>
                                                <td>Nomor Transaksi </td><td>{{$neraca->nomor_akun}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Transaksi </td><td>{{$neraca->akun}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td><td>{{$neraca->deskripsi}}</a></td>
                                            </tr>
                                            @if ($neraca->debit != null && $neraca->kredit == null)
                                            <tr>
                                                <td>Jenis</td><td class="text-success"><strong>Debit</strong></a></td>
                                            </tr>
                                            @elseif ($neraca-> kredit != null && $neraca->debit == null )
                                            <tr>
                                                <td>Jenis</td><td class="text-danger"><strong>Kredit</strong></a></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Tanggal</td><td>{{date('d F Y', strtotime($neraca->tanggal))}}</a></td>

                                            </tr>

                                            <tr>
                                                <td>Update Terakhir</td><td>{{$neraca->updated_at->format('d-m-Y') }}</a></td>
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
