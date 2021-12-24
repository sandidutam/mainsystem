@extends('layouts.main')

@section('title')
    Menu Pegawai
@endsection

@section('sub-title')
    Edit Data {{$data_pegawai->nama_lengkap()}}
@endsection

@section('pegawai.active')
active
@endsection

@section('index.active')
active
@endsection

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Edit Data {{$data_pegawai->nama_lengkap()}}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pegawai.index') }}">Menu Pegawai</a></div>
        <div class="breadcrumb-item">Formulir Edit Data Pegawai</div>
      </div>
    </div>

    <div class="section-body">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ route('pegawai.index') }}" class="d-none d-sm-inline-block btn btn-md btn-danger shadow-sm">
            <i class="fas fa-chevron-left mr-2"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
          <h4>Formulir Edit Data {{$data_pegawai->nama_lengkap()}}</h4>
        </div>

        <div class="card-body">
            {!! Form::model($data_pegawai ,['route'=>['pegawai.update', $data_pegawai->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    {{-- Awal Card Informasi Pribadi --}}
                    <div class="section-title mt-1 mb-4"><h5>Informasi Pribadi</h5></div>
                    <div class="form-group">
                        <label for="nama_depan" class="form-label"> Nama Depan : </label>
                        {!! Form::text('nama_depan', null, ['class'=>'form-control','id'=>'nama_depan']) !!}
                    </div>
                    <div class="form-group">
                        <label for="nama_belakang" class="form-label"> Nama Belakang : </label>
                        {!! Form::text('nama_belakang', null, ['class'=>'form-control','id'=>'nama_belakang']) !!}
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir" class="form-label"> Tempat Lahir : </label>
                        {!! Form::text('tempat_lahir', null, ['class'=>'form-control','id'=>'tempat_lahir']) !!}
                    </div>
                    <div class="form-group ">
                        <label for="tanggal_lahir" class="form-label"> Tanggal Lahir : </label>
                        {!! Form::text('tanggal_lahir', null, ['class'=>'datepicker form-control','id'=>'tanggal_lahir']) !!}
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="mb-2"> Jenis Kelamin : </label>
                        {{-- {!! Form::select('jenis_kelamin', $data_pegawai->jenis_kelamin, 'Pilih', ['class'=>'form-control', 'id'=>'jenis_kelamin']) !!} --}}
                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" >
                        <option>Pilih</option>
                        <option {{old('jenis_kelamin', $data_pegawai->jenis_kelamin)=="L"? 'selected':''}} value="L">Laki-Laki</option>
                        <option {{old('jenis_kelamin', $data_pegawai->jenis_kelamin)=="P"? 'selected':''}} value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="agama" class="mb-2"> Agama  : </label>
                        <select name="agama" class="form-control" id="agama" >
                        <option>Pilih</option>
                        <option {{old('agama', $data_pegawai->agama)=="Islam"? 'selected':''}} value="Islam">Islam</option>
                        <option {{old('agama', $data_pegawai->agama)=="Kristen"? 'selected':''}} value="Kristen">Kristen</option>
                        <option {{old('agama', $data_pegawai->agama)=="Katolik"? 'selected':''}} value="Katolik">Katolik</option>
                        <option {{old('agama', $data_pegawai->agama)=="Hindu"? 'selected':''}} value="Hindu">Hindu</option>
                        <option {{old('agama', $data_pegawai->agama)=="Buddha"? 'selected':''}} value="Buddha">Buddha</option>
                        <option {{old('agama', $data_pegawai->agama)=="Konghucu"? 'selected':''}} value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat"> Alamat : </label>
                        {!! Form::textarea('alamat', null, ['class'=>'form-control','id'=>'alamat','rows'=>'2']) !!}
                    </div>

                    <div class="form-group">
                        <label for="kelurahan" > Kelurahan : </label>
                        {!! Form::text('kelurahan', null, ['class'=>'form-control','id'=>'kelurahan']) !!}
                    </div>

                    <div class="form-group">
                        <label for="kecamatan" > Kecamatan : </label>
                        {!! Form::text('kecamatan', null, ['class'=>'form-control','id'=>'kecamatan']) !!}
                    </div>

                    <div class="form-group">
                        <label for="kota_kabupaten" > Kota/Kabupaten : </label>
                        {!! Form::text('kota_kabupaten', null, ['class'=>'form-control','id'=>'kota_kabupaten']) !!}
                    </div>

                    <div class="form-group">
                        <label for="provinsi" > Provinsi : </label>
                        {!! Form::text('provinsi', null, ['class'=>'form-control','id'=>'provinsi']) !!}
                    </div>
                    {{-- Akhir Card Informasi Pribadi --}}

                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    {{-- Awal Card Informasi Pegawai --}}
                    <div class="section-title mt-1 mb-4"><h5>Informasi Pegawai</h5></div>
                    <div class="form-group">
                        <label for="penempatan" > Lokasi Penempatan : </label>
                        <select name="penempatan" class="form-control" id="penempatan" >
                        <option>Pilih</option>
                        <option {{old('penempatan', $data_pegawai->penempatan)=="Mabes TNI AD"? 'selected':''}} value="Mabes TNI AD">Mabes TNI AD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sektor_area" > Sektor Kerja : </label>
                        <select name="sektor_area" class="form-control" id="sektor_area" >
                        <option>Pilih</option>
                        <option {{old('sektor_area', $data_pegawai->sektor_area)=="1"? 'selected':''}} value="1">Sektor 1</option>
                        <option {{old('sektor_area', $data_pegawai->sektor_area)=="2"? 'selected':''}} value="2">Sektor 2</option>
                        <option {{old('sektor_area', $data_pegawai->sektor_area)=="3"? 'selected':''}} value="3">Sektor 3</option>
                        <option {{old('sektor_area', $data_pegawai->sektor_area)=="4"? 'selected':''}} value="4">Sektor 4</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="jabatan" > Jabatan : </label>
                            <select name="jabatan" class="form-control" id="jabatan" >
                            <option>Pilih</option>
                            <option {{old('jabatan', $data_pegawai->jabatan)=="Manajer"? 'selected':''}} value="Manajer">Manajer</option>
                            <option {{old('jabatan', $data_pegawai->jabatan)=="Staff"? 'selected':''}} value="Staff">Staff</option>
                            <option {{old('jabatan', $data_pegawai->jabatan)=="Mandor"? 'selected':''}} value="Mandor">Mandor</option>
                            <option {{old('jabatan', $data_pegawai->jabatan)=="Cleaning Service"? 'selected':''}} value="Cleaning Service">Cleaning Service</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan" class="form-label" > Tingkat Pendidikan : </label>
                        <select name="pendidikan" class="form-control" id="pendidikan" >
                        <option>Pilih</option>
                        <option {{old('pendidikan', $data_pegawai->pendidikan)=="SD"? 'selected':''}} value="SD">SD</option>
                        <option {{old('pendidikan', $data_pegawai->pendidikan)=="SMP"? 'selected':''}} value="SMP">SMP</option>
                        <option {{old('pendidikan', $data_pegawai->pendidikan)=="SMA"? 'selected':''}} value="SMA">SMA/SMK/STM</option>
                        <option {{old('pendidikan', $data_pegawai->pendidikan)=="Diploma"? 'selected':''}} value="Diploma">Diploma</option>
                        <option {{old('pendidikan', $data_pegawai->pendidikan)=="S-1"? 'selected':''}} value="S-1">Sarjana 1</option>
                        <option {{old('pendidikan', $data_pegawai->pendidikan)=="S-2"? 'selected':''}} value="S-2">Sarjana 2</option>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label for="tanggal_diterima" class="form-label"> Tanggal Diterima : </label>
                        {!! Form::text('tanggal_diterima', $data_pegawai->tanggal_diterima , ['class'=>'datepicker form-control','id'=>'tanggal_diterima','disabled']) !!}
                    </div>

                    <div class="form-group {{$errors->has('foto_pegawai') ? 'has-error' : ''}} ">
                        <div class="mb-3">
                            <label for="foto_pegawai" class="form-label">Unggah Foto Pegawai :</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto_pegawai" id="foto_pegawai" value="{{old('foto_pegawai')}}">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if($errors->has('foto_pegawai'))
                                <span class="help-block text-danger">{{$errors->first('foto_pegawai')}}</span>
                            @endif
                        </div>
                    </div>
                    {{-- Akhir Card Informasi Pegawai --}}

                </div>

                <div class="d-sm-flex align-items-center justify-content-start mb-4 ml-3">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('pegawai.index') }}" class=" btn btn-lg btn-danger">Batal</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

            {!! Form::close() !!}
    {{-- Akhir Form --}}

    <script type="text/javascript">
        $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
         });
    </script>
</section>
@endsection
