@extends('layouts.main')

@section('title')
    Menu Inventori
@endsection

@section('sub-title')
    Detail Barang {{$stok_barang->nama}}
@endsection

@section('inventori.active')
active
@endsection 

@section('inventoriindex.active')
active
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Barang - {{$stok_barang->nama}}</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('inventori.index') }}">Menu Inventori</a></div>
            <div class="breadcrumb-item">Detail Barang</div>
      </div>
        </div>

        <div class="section-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('inventori.index') }}" class="btn btn-primary ">
                    <span class="icon">
                        <i class="fas fa-chevron-left mr-2"></i>
                    </span>
                    <span class="text">Index Barang</span>
                </a>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Barang {{$stok_barang->nama}}</h6>
                        </div>
                   
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 text-center card-split">
                                    <img class="img" style="margin-top: 50px; margin-bottom: 25px; width:250px; height:250px" src="{{$stok_barang->getGambarBarang()}}" alt="">
                                    <h3 class="mt-2 mb-2"><strong>{{$stok_barang->nama}}</strong></h3>
                                    <p class="mt-2" >{{$stok_barang->jenis}}</p>
        
                                </div>
                                <div class="col">
                                    <div class="table-responsive">  
                                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <tr>
                                                <td>Nama </td><td>{{$stok_barang->nama}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Merk</td><td>{{$stok_barang->merk}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis</td><td>{{$stok_barang->jenis}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td><td>{{$stok_barang->deskripsi}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Kuantitas</td><td>{{$stok_barang->kuantitas}} {{$stok_barang->satuan}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Satuan</td><td> Rp {{number_format($stok_barang->harga, 2, ',', '.')}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Update Terakhir</td><td>{{$stok_barang->updated_at->format('d-m-Y') }}</a></td>
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