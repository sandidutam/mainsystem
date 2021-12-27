@extends('layouts.main')

@section('title')
    Menu Inventori
@endsection

@section('sub-title')
    Index Inventori
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
      <h1>Index Inventori</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{route('inventori.index')}}">Menu Inventori</a></div>
          <div class="breadcrumb-item">Index Inventori</div>
      </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <a href="{{ route('inventori.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
              <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>
          </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h4>Data Inventori</h4>
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
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Update Terakhir</th>
                    @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
                    <th>Aksi</th>
                    @endif
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
                        <td>{{$barang->kuantitas}} {{$barang->satuan}}</td>
                        <td>Rp {{number_format($barang->harga, 2, ',', '.') }}</td>
                        <td>Rp {{number_format(($barang->kuantitas)*($barang->harga), 2, ',', '.' )}}</td>
                        @if($barang->status == 'Aman')

                            <td class="text-white" style="background-color: green"><h6>Stok Aman</h6></td>

                        @elseif($barang->status == 'Tidak Aman')

                            <td class="text-white" style="background-color: orange"><h6>Stok Tinggal Sedikit</h6></td>

                        @elseif($barang->status == 'Habis')

                            <td class="text-white" style="background-color: red"><h6>Stok Habis</h6></td>

                        @endif

                        <td>
                              Jam : {{$barang->updated_at->format('H:i') }} <br>
                              Tanggal : {{$barang->updated_at->format('d-m-Y') }}
                        </td>
                        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Admin")
                        <td>
                            <div class="row">
                                <a href="{{ route('inventori.edit', Crypt::encryptString($barang->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-1"></i> Update</a>
                                <button class="btn btn-md btn-danger m-2 delete" id_barang="{{Crypt::encryptString($barang->id)}}" nama="{{$barang->nama}}">
                                    <i class="fas fa-trash mr-2"></i> Hapus
                                </button>
                                {{-- <form action="{{ route('inventori.destroy', Crypt::encryptString($barang->id)) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-1"></i> Hapus</button>
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
</section>

<script>
     $('.delete').click(function() {
        var id = $(this).attr('id_barang');
        var nama = $(this).attr('nama');
        swal({
            title: 'Ingin menghapus data '+nama+' ??',
            text: 'Langkah ini akan menghapus data '+nama+' secara permanen.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/inventori/"+id+"/destroy";
            }
            });
    });
</script>

@endsection
