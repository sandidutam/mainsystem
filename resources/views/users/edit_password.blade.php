@extends('layouts.main')

@section('title')
    Menu User
@endsection

@section('sub-title')
    Edit Data 
@endsection

{{-- @if($data_user)
    @section('authuser.active')
    active
    @endsection 

    @section('authusereditpassword.active')
    active
    @endsection

@else 

    @section('user.active')
    active
    @endsection 

    @section('userindex.active')
    active
    @endsection

@endif --}}


@section('content')
<section class="section">
    <div class="section-header">
      <h1>Edit Data </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.index') }}">Menu User</a></div>
        <div class="breadcrumb-item">Formulir Edit Data User</div>
      </div>
    </div>

    <div class="section-body">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('user.index') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
                <i class="fas fa-chevron-left mr-2"></i> Kembali</a>
        </div>
        <div class="row d-flex justify-content-center ">
            <div class="card">
                <div class="card-header">
                <h4>Ubah Password</h4>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('user.updatepass') }}" method="PUT" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="section-title mt-1 mb-4"><h5>Password Lama</h5></div>
                                <div class="form-group {{$errors->has('password_lama') ? 'has-error' : ''}} "> 
                                    <label for="password_lama" class="form-label"> Masukkan Password Lama : </label> 
                                    <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Isi Password Lama">
                                    @if($errors->has('password_lama'))
                                        <span class="help-block text-danger">{{$errors->first('password_lama')}}</span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}} invisible"> 
                                    <label for="email" class="form-label"> Email : </label> 
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Isi Password Baru" value="{{$email}}">
                                    @if($errors->has('email'))
                                        <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                
                                <hr>

                                <div class="section-title mt-1 mb-4"><h5>Password Baru</h5></div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('password_baru') ? 'has-error' : ''}} "> 
                                            <label for="password_baru" class="form-label"> Masukkan Password Baru : </label> 
                                            <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Isi Password Baru">
                                            @if($errors->has('password_baru'))
                                                <span class="help-block text-danger">{{$errors->first('password_baru')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('konfirmasi_password') ? 'has-error' : ''}} "> 
                                            <label for="konfirmasi_password" class="form-label"> Konfirmasi Password : </label> 
                                            <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Isi Password Baru">
                                            @if($errors->has('konfirmasi_password'))
                                                <span class="help-block text-danger">{{$errors->first('konfirmasi_password')}}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('user.index') }}" class="btn btn-lg btn-danger">Batal</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                     
                </form>
                </div>
            </div>
        </div>
        




    
</section>
@endsection