@extends('layouts.main')

@section('title')
    Menu Neraca
@endsection

@section('sub-title')
    Index Debit
@endsection

@section('neraca.active')
active
@endsection

@section('neracadebit.active')
active
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Index Neraca - Debit</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{route('neraca.index')}}">Menu Neraca</a></div>
          <div class="breadcrumb-item">Index Neraca</div>
      </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan")
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <a href="{{ route('neraca.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
              <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>
          </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h4>Tabel Neraca Debit</h4>
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
                    <th>No.Transaksi</th>
                    <th>Akun</th>
                    <th>Debit</th>
                    <th>Tanggal</th>
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
                        <td>Rp {{number_format($item->debit, 2, ',', '.') }}</td>
                        <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                        <td>
                                Jam : {{date('H:i', strtotime($item->updated_at))}} <br>
                                Tanggal : {{date('d F Y', strtotime($item->updated_at))}}
                        </td>
                        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan")
                        <td>
                            <div class="row">
                              <a href="{{ route('neraca.edit', Crypt::encryptString($item->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-1"></i> Update</a>
                              <form action="{{ route('neraca.destroy', $item->id) }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-1"></i> Hapus</button>
                              </form>
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
                    <tr style="background-color: rgb(221, 221, 221)" class="text-primary">
                        <td><h6><?= $i; ?></h6></td>
                        <td></td>
                        <td><h6>Total</h6></td>
                        <td>
                            <h6>
                                Rp {{number_format($sum, 2, ',', '.') }}
                            </h6>
                        </td>
                        <td><h6>{{date('d F Y', strtotime($today))}}</h6></td>
                        <td>
                            <h6>
                                Tanggal : {{date('d F Y', strtotime($today))}}
                            </h6>
                        </td>
                        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan")
                        <td>

                        </td>
                        @endif
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</section>

@endsection
