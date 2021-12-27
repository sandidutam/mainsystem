@extends('layouts.main')

@section('title')
    Menu Inventori
@endsection

@section('sub-title')
    Index Harga
@endsection

@section('inventori.active')
active
@endsection

@section('priceindex.active')
active
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Index Harga</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('inventori.index')}}">Menu Inventori</a></div>
        <div class="breadcrumb-item">Index Harga</div>
      </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
          {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <a href="{{ route('inventori.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
              <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>
          </div> --}}

        <div class="card">
          <div class="card-header">
            <h4>Tabel Harga</h4>
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
                    <th>NO</th>
                    <th>GAMBAR</th>
                    <th>NAMA</th>
                    <th>MERK</th>
                    <th>SATUAN</th>
                    <th>HARGA</th>
                    <th>UPDATE TERAKHIR</th>
                    @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
                    <th>AKSI</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @forelse($stok_barang as $barang)
                    <tr >
                        <td><?= $i; ?></td>
                        <td><a href="{{ route('inventori.detail', Crypt::encryptString($barang->id)) }}"><img class="img" style="height: 75px; width:75px" src="{{$barang->getGambarBarang()}}" alt=""></a></td>
                        <td><a href="{{ route('inventori.detail', Crypt::encryptString($barang->id)) }}">{{$barang->nama}}</a></td>
                        <td>{{$barang->merk}}</td>
                        <td>{{$barang->satuan}}</td>
                        <td>Rp {{number_format($barang->harga, 2, ',', '.') }}</td>
                        <td>  Jam : {{$barang->updated_at->format('H:i') }} <br>
                              Tanggal : {{$barang->updated_at->format('d-m-Y') }}</td>
                        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
                        <td>
                          <div class="row">
                            {!! Form::model($barang ,['route'=>['inventori.price_update', $barang->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            <div class="col">
                                <div hidden>
                                    {{$harga = number_format($barang->harga, 2, ',', '.') }}
                                    {{$harga2 = $barang->harga}}
                                </div>
                                <div class="form-group {{$errors->has('harga') ? 'has-error' : ''}} ">
                                    <label for="harga" class="form-label"> Harga : </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="background-color: #F5F5F5;">
                                              Rp
                                            </div>
                                          </div>
                                        <input type="text" class="form-control" name="harga" id="harga" value="{{$barang->harga}}">
                                    </div>
                                    @if($errors->has('harga'))
                                        <span class="help-block text-danger">{{$errors->first('harga')}}</span>
                                    @endif
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

<script>
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, " ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
    }

</script>

@endsection
