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
        <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm ml-4">
            <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i>Buat User Baru</a>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('user.index')}}">Menu User</a></div>
            <div class="breadcrumb-item">Index User</div>
        </div>
    </div>

    <div class="section-body">
      <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('user.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i>Buat User Baru</a>
        </div> --}}

      <div class="card">
        {{-- <div class="card-header">
          <h4>Data User</h4>
        </div> --}}

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
                <table class="table table-hover" id="table-1" width="100%" cellspacing="0">
                <thead hidden>
                    <tr>
                        <th>Avatar</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor Pegawai</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_user as $pegawai)
                    <tr>
                        <td>
                            <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #838383; object-fit: cover;" src="{{$pegawai->getFotoUser()}}" alt="">
                            </a>
                        </td>
                        <td>
                            <div class="mt-2">
                                <div class="row">
                                    <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                        <h4>
                                            {{$pegawai->nama_lengkap()}}
                                        </h4>
                                    </a>
                                </div>
                                <div class="row">
                                    <h6>
                                        <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                    </h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mt-4">
                                <h5>
                                    <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                        #{{$pegawai->nomor_pegawai}}
                                    </span>
                                </h5>
                            </div>
                        </td>
                        <td>
                            <div class="mt-4">
                                <h5>
                                    <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                        {{$pegawai->jabatan}}
                                    </span>
                                </h5>
                            </div>
                        </td>
                        <td>
                            <div class="mt-4">
                                <h5>
                                    <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                        {{$pegawai->role}}
                                    </span>
                                </h5>
                            </div>
                        </td>
                        @if(auth()->user()->role == "SuperAdmin")
                        <td>
                            <div class="row mt-2">
                              <a href="{{ route('user.edit', Crypt::encryptString($pegawai->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>

                              <form action="{{ route('user.destroy',  Crypt::encryptString($pegawai->id)) }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                              </form>

                            </div>
                        </td>
                        @endif

                        {{-- @if ( $pegawai->status == "Belum Hadir" )
                            <td>
                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #838383; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                </a>
                            </td>
                            <td>
                                <div class="mt-2">
                                    <div class="row">
                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                            <h4>
                                                {{$pegawai->nama_lengkap()}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <h6>
                                            <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                            #{{$pegawai->nomor_pegawai}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                            {{$pegawai->jabatan}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            @if(auth()->user()->role == "SuperAdmin")
                            <td>
                                <div class="row mt-2">
                                    <a href="{{ route('pegawai.edit', Crypt::encryptString($pegawai->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>

                                    <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endif

                        @elseif ( $pegawai->status == "Sudah Hadir" )
                            <td>
                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #47C363; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                </a>
                            </td>
                            <td>
                                <div class="mt-2">
                                    <div class="row">
                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                            <h4>
                                                {{$pegawai->nama_lengkap()}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <h6>
                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Hadir</div>
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                            #{{$pegawai->nomor_pegawai}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                            {{$pegawai->jabatan}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            @if(auth()->user()->role == "SuperAdmin")
                            <td>
                                <div class="row mt-2">
                                    <a href="{{ route('pegawai.edit', Crypt::encryptString($pegawai->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>

                                    <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endif

                        @elseif ( $pegawai->status == "Tidak Hadir" )
                            <td>
                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FC544B; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                </a>
                            </td>
                            <td>
                                <div class="mt-2">
                                    <div class="row">
                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                            <h4>
                                                {{$pegawai->nama_lengkap()}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <h6>
                                            <div class="text-danger text-small font-600-bold"><i class="fas fa-circle"></i> Tidak Hadir</div>
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                            #{{$pegawai->nomor_pegawai}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                            {{$pegawai->jabatan}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            @if(auth()->user()->role == "SuperAdmin")
                            <td>
                                <div class="row mt-2">
                                    <a href="{{ route('pegawai.edit', Crypt::encryptString($pegawai->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>

                                    <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endif

                        @elseif ( $pegawai->status == "Sudah Pulang" )
                            <td>
                                <a href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                    <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #FFA426; object-fit: cover;" src="{{$pegawai->getFotoPegawai()}}" alt="">
                                </a>
                            </td>
                            <td>
                                <div class="mt-2">
                                    <div class="row">
                                        <a style="color: black;" href="{{ route('pegawai.show', Crypt::encryptString($pegawai->id)) }}">
                                            <h4>
                                                {{$pegawai->nama_lengkap()}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <h6>
                                            <div class="text-warning text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Pulang</div>
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                            #{{$pegawai->nomor_pegawai}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            <td>
                                <div class="mt-4">
                                    <h5>
                                        <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                            {{$pegawai->jabatan}}
                                        </span>
                                    </h5>
                                </div>
                            </td>
                            @if(auth()->user()->role == "SuperAdmin")
                            <td>
                                <div class="row mt-2">
                                    <a href="{{ route('pegawai.edit', Crypt::encryptString($pegawai->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a>

                                    <form action="{{ route('pegawai.destroy', Crypt::encryptString($pegawai->id)) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endif

                        @endif --}}

                    </tr>
                    @empty
                    @endforelse
                </tbody>
                </table>
            </div>

        </div>
      </div>
    </div>
</section>

@endsection
