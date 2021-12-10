@extends('layouts.main')

@section('title')
    Menu User
@endsection

@section('sub-title')
    Edit Data {{$data_user->nama_lengkap()}}
@endsection

@if($data_user)
    @section('authuser.active')
    active
    @endsection

    @section('authuseredit.active')
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
      <h1>Edit Data {{$data_user->nama_lengkap()}}</h1>
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
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Formulir Edit Data {{$data_user->nama_lengkap()}}</h4>
                    </div>

                    <div class="card-body">
                        {!! Form::model($data_user ,['route'=>['user.update', Crypt::encryptString($data_user->id)], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}

                        <div class="section-title mt-1 mb-4"><h5>Informasi Pribadi</h5></div>
                        <div class="form-group">
                            <label for="nomor_pegawai" class="form-label"> Nomor Pegawai : </label>
                            {!! Form::text('nomor_pegawai', null, ['class'=>'form-control','id'=>'nomor_pegawai']) !!}
                        </div>
                        <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                            <label for="nama_depan" class="form-label"> Nama Depan : </label>
                            {!! Form::text('nama_depan', null, ['class'=>'form-control','id'=>'nama_depan']) !!}
                            @if($errors->has('nama_depan'))
                                <span class="help-block text-danger">{{$errors->first('nama_depan')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
                            <label for="nama_belakang" class="form-label"> Nama Belakang : </label>
                            {!! Form::text('nama_belakang', null, ['class'=>'form-control','id'=>'nama_belakang']) !!}
                            @if($errors->has('nama_belakang'))
                                <span class="help-block text-danger">{{$errors->first('nama_belakang')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{$errors->has('tanggal_lahir') ? 'has-error' : ''}}">
                            <label for="tanggal_lahir" class="form-label"> Tanggal Lahir : </label>
                            {!! Form::text('tanggal_lahir', null, ['class'=>'datepicker form-control','id'=>'tanggal_lahir']) !!}
                            @if($errors->has('tanggal_lahir'))
                                <span class="help-block text-danger">{{$errors->first('tanggal_lahir')}}</span>
                            @endif
                        </div>
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

                        <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                                <label for="role" > Role : </label>
                                <select name="role" class="form-control" id="role" >
                                <option selected="true" style='display: none' value="">Pilih</option>
                                <option {{old('role', $data_user->role)=="SuperAdmin"? 'selected':''}} value="SuperAdmin">SuperAdmin</option>
                                <option {{old('role', $data_user->role)=="Admin"? 'selected':''}} value="Admin">Admin</option>
                                <option {{old('role', $data_user->role)=="Staff"? 'selected':''}} value="Staff">Staff</option>
                                <option {{old('role', $data_user->role)=="Mandor"? 'selected':''}} value="Mandor">Mandor</option>
                                </select>
                                @if($errors->has('role'))
                                    <span class="help-block text-danger">{{$errors->first('role')}}</span>
                                @endif
                        </div>
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


                        <div class="section-title mt-1 mb-4"><h5>Informasi Akun</h5></div>
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="form-label"> Email : </label>
                            {!! Form::email('email', null, ['class'=>'form-control','id'=>'email']) !!}
                            @if($errors->has('email'))
                                <span class="help-block text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>

                        {{-- <div class="form-group">
                            <label for="password" class="form-label"> Password : </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                       --}}
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
                        <div class="d-flex justify-content-start mt-3">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('user.index') }}" class="btn btn-lg btn-danger">Batal</a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        {{-- Akhir Form --}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <div class="section-title mt-1 mb-4"><h5>Informasi Pegawai</h5></div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-borderless table-hover" id="table-1">
                                <thead>
                                    <tr class="text-center">
                                        <th>NO</th>
                                        <th>NOMOR PEGAWAI</th>
                                        <th>NAMA DEPAN</th>
                                        <th>NAMA BELAKANG</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>JABATAN</th>
                                        <th>AKSI</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse($data_pegawai as $pegawai )

                                    <tr class="text-center">
                                        <td><?= $i; ?></td>
                                        <td>{{$pegawai->nomor_pegawai}}</td>
                                        <td>{{$pegawai->nama_depan}}</td>
                                        <td>{{$pegawai->nama_belakang}}</td>
                                        <td>{{$pegawai->tanggal_lahir}}</td>
                                        <td>{{$pegawai->jenis_kelamin}}</td>
                                        <td>{{$pegawai->jabatan}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn-c btn-sm btn-outline-primary" onmouseout="outFunc()">
                                                    <span class="tooltiptext" id="myTooltip{{$i}}">Copy to clipboard</span>
                                                    </button>
                                                </div>
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
                </div>
            </div>
        </div>

    </div>



    {{-- Page Spesific Script --}}

    <script type="text/javascript">
        $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
         });

        function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
        }

        var table = document.getElementById("table-1"),rIndex;

        for(var i = 0; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
                rIndex = this.rowIndex;
                document.getElementById("nomor_pegawai").value = this.cells[1].innerHTML;
                document.getElementById("nama_depan").value = this.cells[2].innerHTML;
                document.getElementById("nama_belakang").value = this.cells[3].innerHTML;
                document.getElementById("tanggal_lahir").value = this.cells[4].innerHTML;
                document.getElementById("jenis_kelamin").value = this.cells[5].innerHTML;
                document.getElementById("jabatan").value = this.cells[6].innerHTML;

                var nama_depan =  document.getElementById("nama_depan");
                var nama_belakang =  document.getElementById("nama_belakang");

                alert("Data " + nama_depan.value + " " + nama_belakang.value + " berhasil di salin ke form");
                for(var a = 1; a < table.rows.length; a++)
                {
                    var tooltip = document.getElementById("myTooltip"+a);
                    tooltip.innerHTML = "Copied " + name.value + " data";

                }

            }
        }

        function outFunc() {
            for(var a = 1; a < table.rows.length; a++)
            {
                var tooltip = document.getElementById("myTooltip"+a);
                tooltip.innerHTML = "Copy to clipboard";
            }
        }

        function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
        }

    </script>
</section>
@endsection
