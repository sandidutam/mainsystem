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
                <h4>Tabel Neraca</h4>
                {{-- <div class="group">
                <a href="{{route('neraca.exportexcel')}}" class="btn btn-success mr-2"><i class="fas fa-file-excel mr-3"></i>Download Excel</a>
                <a href="{{route('neraca.exportpdf')}}" class="btn btn-danger"><i class="fas fa-file-excel mr-3"></i>Download PDF</a>
                </div> --}}
                <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Download File
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="{{route('neraca.exportexcel')}}"><i class="far fa-file-excel" style="color: green"></i> Excel</a>
                        <a class="dropdown-item has-icon" href="{{route('neraca.exportpdf')}}"><i class="far fa-file-pdf" style="color: red"></i> PDF</a>
                    </div>
                </div>
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
                              <form action="{{ route('neraca.destroy', $item->id) }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-1"></i></button>
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
                      <td><h6>Saldo</h6></td>
                      <td><h6>Total</h6></td>
                      <td>
                          <h6>
                              Rp {{number_format($sumdebit, 2, ',', '.') }}
                          </h6>
                      </td>
                      <td>
                          <h6>
                              Rp {{number_format($sumkredit, 2, ',', '.') }}
                          </h6>
                      </td>

                      @if ($balance > 0 )
                      <td class="text-white" style="background-color: green">
                          <h6>
                              Rp {{number_format($balance, 2, ',', '.') }}
                          </h6>
                      </td>
                      @elseif ($balance <= 0)
                      <td class="text-white" style="background-color: red">
                          <h6>
                              Rp {{number_format($balance, 2, ',', '.') }}
                          </h6>
                      </td>
                      @endif
                      <td>
                          <h6>
                              Tanggal : {{date('d F Y', strtotime($today))}}
                          </h6>
                      </td>
                      @if(auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan")
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
