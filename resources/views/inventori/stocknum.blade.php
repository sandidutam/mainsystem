@extends('layouts.main')

@section('title')
    Menu Inventori
@endsection

@section('sub-title')
    Stok Barang
@endsection

@section('inventori.active')
active
@endsection

@section('stokinventori.active')
active
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Stok Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('inventori.index')}}">Menu Inventori</a></div>
                <div class="breadcrumb-item">Stok Barang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Tabel Stok</h4>
                </div>

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

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table-1" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Gambar</th>
                          <th>Nama</th>
                          <th>Merk</th>
                          <th>Qty</th>
                          <th>Satuan</th>
                          @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
                          <th>Update Terakhir</th>
                          <th>Update Jumlah Stok</th>
                          @endif
                          <th>Set Jumlah Stok Minimal</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          @forelse($stok_barang as $barang)
                          <tr >
                                <td><?= $i; ?></td>
                                <td><a href="{{ route('inventori.detail', Crypt::encryptString($barang->id)) }}"><img class="img" style="height: 75px; width:75px" src="{{$barang->getGambarBarang()}}" alt=""></a></td>
                                @if($barang->status == 'Aman')

                                    <td><a href="{{ route('inventori.detail', Crypt::encryptString($barang->id)) }}">{{$barang->nama}} <i class="fas fa-check" style="color: #47C363;"></i></a></td>

                                @elseif($barang->status == 'Tidak Aman')

                                    <td><a href="{{ route('inventori.detail', Crypt::encryptString($barang->id)) }}">{{$barang->nama}} <i class="fas fa-exclamation-triangle" style="color: #FFA426;"></i></a></td>

                                @elseif($barang->status == 'Habis')

                                    <td><a href="{{ route('inventori.detail', Crypt::encryptString($barang->id)) }}">{{$barang->nama}} <i class="fas fa-exclamation" style="color: #FC544B;"></i></a></td>

                                @endif
                                <td>{{$barang->merk}}</td>
                                <td>{{$barang->kuantitas}}</td>
                                <td>{{$barang->satuan}}</td>
                                <td>  Jam : {{$barang->updated_at->format('H:i') }} <br>
                                        Tanggal : {{$barang->updated_at->format('d-m-Y') }}
                                </td>
                                @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
                                <td>
                                    <div class="row">
                                        {!! Form::model($barang ,['route'=>['inventori.stock_update', $barang->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                                        <div class="col">
                                        <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} ">
                                            <label for="kuantitas" class="form-label"> Kuantitas : </label>
                                            <div class="input-group">
                                                {!! Form::number('kuantitas', null, ['class'=>'form-control','id'=>'kuantitas']) !!}
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style="background-color: #F5F5F5;">
                                                      {{$barang->satuan}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        </div>
                                        <div class="col">
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit mr-1"></i>Update</button>
                                        </div>
                                        {!! Form::close() !!}

                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        {!! Form::model($barang ,['route'=>['inventori.minimum_stock_update', $barang->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                                        <div class="col">
                                        <div class="form-group {{$errors->has('kuantitas') ? 'has-error' : ''}} ">
                                            <label for="stok_minimal" class="form-label"> Stok Minimal : </label>
                                            <div class="input-group">
                                                {!! Form::number('stok_minimal', null, ['class'=>'form-control','id'=>'stok_minimal']) !!}
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style="background-color: #F5F5F5;">
                                                      {{$barang->satuan}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col">
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit mr-1"></i>Update</button>
                                        </div>
                                        {!! Form::close() !!}

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
    </section>
@endsection
