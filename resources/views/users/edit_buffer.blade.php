@extends('layouts.main')

@section('title')
    Menu User
@endsection

@section('sub-title')
    Edit Data
@endsection

@if($data_user)
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

@endif


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
            <div class="card card-primary">
                <div class="card-header">
                <h4>Reset Password</h4>
                </div>

                @if(session('notifikasi_gagal'))
                <div class="alert alert-success alert-dismissible m-3 show fade" role="alert">
                  <div class="alert-body">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="fas fa-check"></i>
                    {{session('notifikasi_gagal')}}
                  </div>  
                </div>
                @endif
            
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                             <form action="{{ route('user.postbuffer') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="section-title mt-1 mb-4"><h5>Konfirmasi Akun</h5></div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}} ">
                                            <label for="email" class="form-label"> Email : </label> 
                                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                            @if($errors->has('email'))
                                            <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group {{$errors->has('password_lama') ? 'has-error' : ''}} ">
                                            <label for="password_lama" class="form-label"> Password Lama : </label> 
                                            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
                                            @if($errors->has('password_lama'))
                                            <span class="help-block text-danger">{{$errors->first('password_lama')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" onclick="showPasswordLama()" name="remember_old" class="custom-control-input" tabindex="3" id="show-password">
                                        <label class="custom-control-label" for="show-password">Show Password</label>
                                    </div>
                                </div>
                                
                                <br>
                                <hr>
                                <br>

                                <div class="section-title mt-1 mb-4"><h5>Password Baru</h5></div>
                                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}} ">
                                    <label for="password" class="form-label"> Password Baru : </label> 
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
                                    @if($errors->has('password'))
                                    <span class="help-block text-danger">{{$errors->first('password')}}</span>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('konfirmasi_password') ? 'has-error' : ''}} ">
                                    <label for="konfirmasi_password" class="form-label"> Konfirmasi Password : </label> 
                                    <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password">
                                    @if($errors->has('konfirmasi_password'))
                                    <span class="help-block text-danger">{{$errors->first('konfirmasi_password')}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" onclick="showPasswordBaru()" name="remember_neo" class="custom-control-input" tabindex="3" id="show-password-new">
                                        <label class="custom-control-label" for="show-password-new">Show Password</label>
                                    </div>
                                </div>
                                {{-- <div class="form-group {{$errors->has('id') ? 'has-error' : ''}} ">
                                    <label for="id" class="form-label"> Id : </label> 
                                    <input type="number" class="form-control" id="id" name="id" placeholder="Password" value="{{auth()->user()->id }}">
                                    @if($errors->has('id'))
                                    <span class="help-block text-danger">{{$errors->first('id')}}</span>
                                    @endif
                                </div> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('user.show', auth()->user()->id) }}" class="btn btn-lg btn-danger">Batal</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        




    <!-- Page Specific JS File -->
    <script>
        function showPasswordLama() {
        var x = document.getElementById("password_lama");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
        
        function showPasswordBaru() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        var y = document.getElementById("konfirmasi_password");
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
        }

        
    </script>
</section>
@endsection