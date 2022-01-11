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
                    @forelse($data_user as $user)
                    <tr>
                        <td>
                            <a href="{{ route('user.show', Crypt::encryptString($user->id)) }}">
                                <img class="img" style="margin-right: 0px; margin-left: 60px; height: 75px; width: 75px; border-radius: 100%; border: 3px solid #6777EF; object-fit: cover;" src="{{$user->getFotoUser()}}" alt="">
                            </a>
                        </td>
                        <td>
                            <div class="mt-2">
                                <div class="row">
                                    <a style="color: black;" href="{{ route('user.show', Crypt::encryptString($user->id)) }}">
                                        <h4>
                                            {{$user->nama_lengkap()}}
                                        </h4>
                                    </a>
                                </div>
                                {{-- <div class="row">
                                    <h6>
                                        <div class="text-muted text-small font-600-bold"><i class="fas fa-circle"></i> Belum Hadir</div>
                                    </h6>
                                </div> --}}
                            </div>
                        </td>
                        <td>
                            <div class="mt-4">
                                <h5>
                                    <span class="badge text-white" style="margin-left: 20px; background-color: #161b17">
                                        #{{$user->nomor_pegawai}}
                                    </span>
                                </h5>
                            </div>
                        </td>
                        <td>
                            <div class="mt-4">
                                <h5>
                                    <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                        {{$user->jabatan}}
                                    </span>
                                </h5>
                            </div>
                        </td>
                        <td>
                            <div class="mt-4">
                                <h5>
                                    <span class="badge text-white" style="margin-left: 20px; background-color: #6777EF;">
                                        {{$user->role}}
                                    </span>
                                </h5>
                            </div>
                        </td>
                        @if(auth()->user()->role == "SuperAdmin")
                            <td>
                                <div class="row mt-2">
                                {{-- <a href="{{ route('user.edit', Crypt::encryptString($user->id)) }}" class="btn btn-md btn-warning m-2" type="button"><i class="fas fa-edit mr-2"></i> Edit</a> --}}

                                {{-- <form action="{{ route('user.destroy',  Crypt::encryptString($user->id)) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-md btn-danger m-2"><i class="fas fa-trash mr-2"></i> Hapus</button>
                                </form> --}}
                                @if( $user->role == "SuperAdmin" )

                                @else
                                    <button class="btn btn-md btn-danger m-2 delete" id_user="{{Crypt::encryptString($user->id)}}" nama_lengkap="{{$user->nama_lengkap()}}">
                                        <i class="fas fa-trash mr-2"></i> Hapus
                                    </button>
                                @endif

                                </div>
                            </td>
                        @endif
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

<script>
        $('.delete').click(function() {
        var id = $(this).attr('id_user');
        var nama_lengkap = $(this).attr('nama_lengkap');
        swal({
            title: 'Ingin menghapus data '+nama_lengkap+' ??',
            text: 'Langkah ini akan menghapus data '+nama_lengkap+' secara permanen.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/user/"+id+"/destroy";
            }
            });
    });

</script>

@endsection
