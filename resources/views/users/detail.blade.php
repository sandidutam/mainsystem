@extends('layouts.main')

@section('title')
    Menu User
@endsection

@section('sub-title')
    Profil {{$data_user->nama_lengkap()}}
@endsection

@if($data_user)
    @section('authuser.active')
    active
    @endsection

    @section('authuserprofile.active')
    active
    @endsection

@else

    @section('user.active')
    active
    @endsection

    @section('userindex.active')
    active
    @endsection

@endif


@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profil {{$data_user->nama_lengkap()}}</h1>
        <a href="{{ route('user.index') }}" class="btn btn-danger ml-4">
            <span class="icon">
                <i class="fas fa-chevron-left mr-2"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
        @if ( auth()->user()->id == $data_user->id )
            <a class="btn btn-icon icon-left btn-dark ml-4" href="{{ route('user.edit_password_buffer')}}"><i class="fas fa-lock"></i>Ubah Password</a>
        @endif

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('user.index') }}">Menu User</a></div>
            <div class="breadcrumb-item">Profil User</div>
        </div>
    </div>

    <div class="section-body">
        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('user.index') }}" class="btn btn-danger ">
                <span class="icon">
                    <i class="fas fa-chevron-left mr-2"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div> --}}

        <div class="row mt-sm-4">
            @if ( auth()->user()->role == "SuperAdmin")
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                        <img alt="image" src="{{$data_user->getFotoUser()}}" class="profile-widget-picture" style="height: 100px; width: 100px; border-radius: 100%; border: 3px solid #6777EF; object-fit: cover;">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Nomor Pegawai</div>
                                <div class="profile-widget-item-value text-success">{{$data_user->nomor_pegawai}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Email</div>
                                <div class="profile-widget-item-value text-danger">{{$data_user->email}}</div>
                            </div>
                        </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{$data_user->nama_lengkap()}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{$data_user->jabatan}}</div></div>
                            {{$data_user->nama_lengkap()}} adalah pegawai dengan jabatan <b>{{$data_user->jabatan}}</b>.
                            </div>
                        <div class="card-footer text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        {!! Form::model($data_user ,['route'=>['user.update', $data_user->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="section-title mt-1 mb-4"><h5>Informasi Pribadi</h5></div>
                                <div class="form-group {{$errors->has('nomor_pegawai') ? 'has-error' : ''}}">
                                    <label for="nomor_pegawai" class="form-label"> Nomor Pegawai : </label>
                                    {!! Form::text('nomor_pegawai', null, ['class'=>'form-control','id'=>'nomor_pegawai']) !!}
                                    @if($errors->has('nama_depan'))
                                        <span class="help-block text-danger">{{$errors->first('nama_depan')}}</span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                                            <label for="nama_depan" class="form-label"> Nama Depan : </label>
                                            {!! Form::text('nama_depan', null, ['class'=>'form-control','id'=>'nama_depan']) !!}
                                            @if($errors->has('nama_depan'))
                                                <span class="help-block text-danger">{{$errors->first('nama_depan')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
                                            <label for="nama_belakang" class="form-label"> Nama Belakang : </label>
                                            {!! Form::text('nama_belakang', null, ['class'=>'form-control','id'=>'nama_belakang']) !!}
                                            @if($errors->has('nama_belakang'))
                                                <span class="help-block text-danger">{{$errors->first('nama_belakang')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('tanggal_lahir') ? 'has-error' : ''}}">
                                                    <label for="tanggal_lahir" class="form-label"> Tanggal Lahir : </label>
                                                    {!! Form::text('tanggal_lahir', null, ['class'=>'datepicker form-control','id'=>'tanggal_lahir']) !!}
                                                    @if($errors->has('tanggal_lahir'))
                                                        <span class="help-block text-danger">{{$errors->first('tanggal_lahir')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                                                    <label for="jenis_kelamin" class="mb-2"> Jenis Kelamin : </label>
                                                    {{-- {!! Form::select('jenis_kelamin', $data_pegawai->jenis_kelamin, 'Pilih', ['class'=>'form-control', 'id'=>'jenis_kelamin']) !!} --}}
                                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('jenis_kelamin', $data_user->jenis_kelamin)=="L"? 'selected':''}} value="L">Laki-Laki</option>
                                                    <option {{old('jenis_kelamin', $data_user->jenis_kelamin)=="P"? 'selected':''}} value="P">Perempuan</option>
                                                    </select>
                                                    @if($errors->has('jenis_kelamin'))
                                                        <span class="help-block text-danger">{{$errors->first('jenis_kelamin')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                                                    <label for="role" > Role : </label>
                                                    <select name="role" class="form-control" id="role" >
                                                        @foreach ($role as $item)
                                                            <option {{old('role', $data_user->role)==$item->nama_role? 'selected':''}} value="{{ $item->nama_role }}">{{ $item->nama_role }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('role'))
                                                        <span class="help-block text-danger">{{$errors->first('role')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
                                                    <label for="jabatan" > Jabatan : </label>
                                                    <select name="jabatan" class="form-control" id="jabatan" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Manajer"? 'selected':''}} value="Manajer">Manajer</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Staff"? 'selected':''}} value="Staff">Staff</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Mandor"? 'selected':''}} value="Mandor">Mandor</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Cleaning Service"? 'selected':''}} value="Cleaning Service">Cleaning Service</option>
                                                    </select>
                                                    @if($errors->has('jabatan'))
                                                        <span class="help-block text-danger">{{$errors->first('jabatan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title mt-1 mb-4"><h5>Informasi Akun</h5></div>

                                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                    <label for="email" class="form-label"> Email : </label>
                                    {!! Form::email('email', null, ['class'=>'form-control','id'=>'email']) !!}
                                    @if($errors->has('email'))
                                        <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>


                                <div class="form-group {{$errors->has('foto_user') ? 'has-error' : ''}} ">
                                    <div class="mb-3">
                                        <label for="foto_user" class="form-label">Unggah foto user :</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto_user" id="foto_user" value="{{old('foto_user')}}">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('foto_user'))
                                            <span class="help-block text-danger">{{$errors->first('foto_user')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            @elseif ( auth()->user()->id == $data_user->id )
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                        <img alt="image" src="{{$data_user->getFotoUser()}}" class="profile-widget-picture" style="height: 100px; width: 100px; border-radius: 100%; border: 3px solid #6777EF; object-fit: cover;">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Nomor Pegawai</div>
                                <div class="profile-widget-item-value text-success">{{$data_user->nomor_pegawai}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Email</div>
                                <div class="profile-widget-item-value text-danger">{{$data_user->email}}</div>
                            </div>
                        </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{$data_user->nama_lengkap()}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{$data_user->jabatan}}</div></div>
                            {{$data_user->nama_lengkap()}} adalah pegawai dengan jabatan <b>{{$data_user->jabatan}}</b>.
                            </div>
                        <div class="card-footer text-center">

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        {!! Form::model($data_user ,['route'=>['pegawai.update', $data_user->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="section-title mt-1 mb-4"><h5>Informasi Pribadi</h5></div>
                                <div class="form-group">
                                    <label for="nomor_pegawai" class="form-label"> Nomor Pegawai : </label>
                                    {!! Form::text('nomor_pegawai', null, ['class'=>'form-control','id'=>'nomor_pegawai', 'disabled']) !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                                            <label for="nama_depan" class="form-label"> Nama Depan : </label>
                                            {!! Form::text('nama_depan', null, ['class'=>'form-control','id'=>'nama_depan']) !!}
                                            @if($errors->has('nama_depan'))
                                                <span class="help-block text-danger">{{$errors->first('nama_depan')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
                                            <label for="nama_belakang" class="form-label"> Nama Belakang : </label>
                                            {!! Form::text('nama_belakang', null, ['class'=>'form-control','id'=>'nama_belakang']) !!}
                                            @if($errors->has('nama_belakang'))
                                                <span class="help-block text-danger">{{$errors->first('nama_belakang')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('tanggal_lahir') ? 'has-error' : ''}}">
                                                    <label for="tanggal_lahir" class="form-label"> Tanggal Lahir : </label>
                                                    {!! Form::text('tanggal_lahir', null, ['class'=>'datepicker form-control','id'=>'tanggal_lahir']) !!}
                                                    @if($errors->has('tanggal_lahir'))
                                                        <span class="help-block text-danger">{{$errors->first('tanggal_lahir')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                                                    <label for="jenis_kelamin" class="mb-2"> Jenis Kelamin : </label>
                                                    {{-- {!! Form::select('jenis_kelamin', $data_pegawai->jenis_kelamin, 'Pilih', ['class'=>'form-control', 'id'=>'jenis_kelamin']) !!} --}}
                                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('jenis_kelamin', $data_user->jenis_kelamin)=="L"? 'selected':''}} value="L">Laki-Laki</option>
                                                    <option {{old('jenis_kelamin', $data_user->jenis_kelamin)=="P"? 'selected':''}} value="P">Perempuan</option>
                                                    </select>
                                                    @if($errors->has('jenis_kelamin'))
                                                        <span class="help-block text-danger">{{$errors->first('jenis_kelamin')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                                                    <label for="role" > Role : </label>
                                                    <select name="role" class="form-control" id="role" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('role', $data_user->role)=="SuperAdmin"? 'selected':''}} value="SuperAdmin">SuperAdmin</option>
                                                    <option {{old('role', $data_user->role)=="Admin"? 'selected':''}} value="Admin">Admin</option>
                                                    <option {{old('role', $data_user->role)=="Akuntan"? 'selected':''}} value="Akuntan">Akuntan</option>
                                                    <option {{old('role', $data_user->role)=="Mandor"? 'selected':''}} value="Mandor">Mandor</option>
                                                    </select>
                                                    @if($errors->has('role'))
                                                        <span class="help-block text-danger">{{$errors->first('role')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
                                                    <label for="jabatan" > Jabatan : </label>
                                                    <select name="jabatan" class="form-control" id="jabatan" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Manajer"? 'selected':''}} value="Manajer">Manajer</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Staff"? 'selected':''}} value="Staff">Staff</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Mandor"? 'selected':''}} value="Mandor">Mandor</option>
                                                    <option {{old('jabatan', $data_user->jabatan)=="Cleaning Service"? 'selected':''}} value="Cleaning Service">Cleaning Service</option>
                                                    </select>
                                                    @if($errors->has('jabatan'))
                                                        <span class="help-block text-danger">{{$errors->first('jabatan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title mt-1 mb-4"><h5>Informasi Akun</h5></div>

                                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                    <label for="email" class="form-label"> Email : </label>
                                    {!! Form::email('email', null, ['class'=>'form-control','id'=>'email']) !!}
                                    @if($errors->has('email'))
                                        <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>


                                <div class="form-group {{$errors->has('foto_user') ? 'has-error' : ''}} ">
                                    <div class="mb-3">
                                        <label for="foto_user" class="form-label">Unggah foto user :</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto_user" id="foto_user" value="{{old('foto_user')}}">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @if($errors->has('foto_user'))
                                            <span class="help-block text-danger">{{$errors->first('foto_user')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            @else
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                        <img alt="image" src="{{$data_user->getFotoUser()}}" class="profile-widget-picture" style="height: 100px; width: 100px; border-radius: 100%; border: 3px solid #6777EF; object-fit: cover;">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Nomor Pegawai</div>
                                <div class="profile-widget-item-value text-success">{{$data_user->nomor_pegawai}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Email</div>
                                <div class="profile-widget-item-value text-danger">{{$data_user->email}}</div>
                            </div>
                        </div>
                        </div>
                        <div class="profile-widget-description">
                        <div class="profile-widget-name">{{$data_user->nama_lengkap()}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{$data_user->jabatan}}</div></div>
                        {{$data_user->nama_lengkap()}} adalah pegawai dengan jabatan <b>{{$data_user->jabatan}}</b>.
                        </div>
                        <div class="card-footer text-center">

                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>

</section>
@endsection
