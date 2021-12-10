@extends('layouts.main')

@section('title')
    Menu User
@endsection

@section('sub-title')
    Index User
@endsection

@section('user.active')
active
@endsection

@section('userindex.active')
active
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Index User</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('user.index')}}">Menu User</a></div>
        <div class="breadcrumb-item">Index User</div>
      </div>
    </div>

    <div class="section-body">
      <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>
        </div>

      <div class="card">
        <div class="card-header">
          <h4>Data Pegawai</h4>
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
                    <tr >
                        <th>No</th>
                        <th>Nomor Pegawai</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @forelse($data_user as $user)
                    <tr >
                        <td><?= $i; ?></td>
                        <td>{{$user->nomor_pegawai}}</td>
                        <td><a href="{{ route('user.show', Crypt::encryptString($user->id)) }}">{{$user->nama_lengkap()}}</a></td>
                        <td>{{$user->jabatan}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <div class="row">
                              <a href="{{ route('user.edit', Crypt::encryptString($user->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>

                              <form action="{{ route('user.destroy',  Crypt::encryptString($user->id)) }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                              </form>

                            </div>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-white bg-secondary"><i><b>TIDAK ADA DATA UNTUK DITAMPILKAN</b></i></td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">

        </div>
      </div>
    </div>
</section>

@endsection
