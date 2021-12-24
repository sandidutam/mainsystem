@extends('layouts.main')

@section('title')
    Menu Pegawai
@endsection

@section('sub-title')
    Tambah Data Baru
@endsection

@section('pegawai.active')
active
@endsection

@section('addpegawai.active')
active
@endsection


@section('content')
<section class="section">
    <div class="section-header">
      <h1>Tambah Data Baru</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pegawai.index') }}">Menu Pegawai</a></div>
        <div class="breadcrumb-item">Formulir Data Pegawai</div>
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
                <h4>Tambah Data Baru</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            {{-- Awal Card Informasi Pribadi --}}
                            <div class="section-title mt-1 mb-4"><h5>Informasi Pribadi</h5></div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}} ">
                                        <label for="nama_depan" class="form-label"> Nama Depan : </label>
                                        <input type="text" class="form-control" name="nama_depan" id="nama_depan" placeholder="Isi Nama Depan" value="{{old('nama_depan')}}">
                                        @if($errors->has('nama_depan'))
                                            <span class="help-block text-danger">{{$errors->first('nama_depan')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}} ">
                                        <label for="nama_belakang" class="form-label"> Nama Belakang : </label>
                                        <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" placeholder="Isi Nama Belakang" value="{{old('nama_belakang')}}" >
                                        @if($errors->has('nama_belakang'))
                                            <span class="help-block text-danger">{{$errors->first('nama_belakang')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('tempat_lahir') ? 'has-error' : ''}} ">
                                        <label for="tempat_lahir" class="form-label"> Tempat Lahir : </label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Isi Tempat Lahir" value="{{old('tempat_lahir')}}">
                                        @if($errors->has('tempat_lahir'))
                                            <span class="help-block text-danger">{{$errors->first('tempat_lahir')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('tanggal_lahir') ? 'has-error' : ''}} ">
                                        <label for="tanggal_lahir" class="form-label"> Tanggal Lahir : </label>
                                        <input type="text" autocomplete="off" class="datepicker form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="01/01/1970" value="{{old('tanggal_lahir')}}">
                                        @if($errors->has('tanggal_lahir'))
                                            <span class="help-block text-danger">{{$errors->first('tanggal_lahir')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group  {{$errors->has('jenis_kelamin') ? 'has-error' : ''}} ">
                                        <label for="jenis_kelamin" class="mb-2"> Jenis Kelamin : </label>
                                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" >
                                        <option>Pilih</option>
                                        <option value="L" {{(old('jenis_kelamin')=='L')? 'selected' :''}}>Laki-Laki</option>
                                        <option value="P" {{(old('jenis_kelamin')=='P')? 'selected' :''}}>Perempuan</option>
                                        </select>
                                        @if($errors->has('jenis_kelamin'))
                                            <span class="help-block text-danger">{{$errors->first('jenis_kelamin')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}} ">
                                        <label for="agama" class="mb-2"> Agama  : </label>
                                        <select name="agama" class="form-control" id="agama" >
                                        <option>Pilih</option>
                                        <option value="Islam" {{(old('agama')=='Islam')? 'selected' :''}}>Islam</option>
                                        <option value="Kristen" {{(old('agama')=='Kristen')? 'selected' :''}}>Kristen</option>
                                        <option value="Katolik" {{(old('agama')=='Katolik')? 'selected' :''}}>Katolik</option>
                                        <option value="Hindu" {{(old('agama')=='Hindu')? 'selected' :''}}>Hindu</option>
                                        <option value="Buddha" {{(old('agama')=='Buddha')? 'selected' :''}}>Buddha</option>
                                        <option value="Konghucu" {{(old('nagama')=='Konghucu')? 'selected' :''}}>Konghucu</option>
                                        @if($errors->has('agama'))
                                            <span class="help-block text-danger">{{$errors->first('agama')}}</span>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2 {{$errors->has('alamat') ? 'has-error' : ''}} ">
                                <label for="alamat"> Alamat : </label>
                                <textarea name="alamat" class="form-control" placeholder="Isikan Alamat Tempat Tinggal" id="alamat" rows="2">{{old('alamat')}}</textarea>
                                @if($errors->has('alamat'))
                                    <span class="help-block text-danger">{{$errors->first('alamat')}}</span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('kelurahan') ? 'has-error' : ''}}">
                                        <label for="kelurahan" > Kelurahan : </label>
                                        <input type="text" name="kelurahan" class="form-control" placeholder="Isikan Kelurahan" id="kelurahan" value="{{old('kelurahan')}}">
                                        @if($errors->has('kelurahan'))
                                            <span class="help-block text-danger">{{$errors->first('kelurahan')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('kecamatan') ? 'has-error' : ''}} ">
                                        <label for="kecamatan" > Kecamatan : </label>
                                        <input type="text" name="kecamatan" class="form-control" placeholder="Isikan Kecamatan" id="kecamatan" value="{{old('kecamatan')}}">
                                        @if($errors->has('kecamatan'))
                                            <span class="help-block text-danger">{{$errors->first('kecamatan')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('kota_kabupaten') ? 'has-error' : ''}} ">
                                        <label for="kota_kabupaten" > Kota/Kabupaten : </label>
                                        <input type="text" name="kota_kabupaten" class="form-control" placeholder="Isikan Kota/Kabupaten" id="kota_kabupaten" value="{{old('kota_kabupaten')}}">
                                        @if($errors->has('kota_kabupaten'))
                                            <span class="help-block text-danger">{{$errors->first('kota_kabupaten')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('provinsi') ? 'has-error' : ''}} ">
                                        <label for="provinsi" > Provinsi : </label>
                                        <input type="text" name="provinsi" class="form-control" placeholder="Isikan Provinsi" id="provinsi" value="{{old('provinsi')}}">
                                        @if($errors->has('provinsi'))
                                            <span class="help-block text-danger">{{$errors->first('provinsi')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Akhir Card Informasi Pribadi --}}

                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            {{-- Awal Card Informasi Pegawai --}}
                            <div class="section-title mt-1 mb-4"><h5>Informasi Pegawai</h5></div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('penempatan') ? 'has-error' : ''}} ">
                                        <label for="penempatan" > Lokasi Penempatan : </label>
                                        <select name="penempatan" class="form-control" id="penempatan" >
                                        <option>Pilih</option>
                                        <option value="Mabes TNI AD" {{(old('penempatan')=='Mabes TNI AD')? 'selected' :''}}>Mabes TNI AD</option>
                                        </select>
                                        @if($errors->has('penempatan'))
                                            <span class="help-block text-danger">{{$errors->first('penempatan')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('sektor_area') ? 'has-error' : ''}} ">
                                        <label for="sektor_area" > Sektor Kerja : </label>
                                        <select name="sektor_area" class="form-control" id="sektor_area" >
                                        <option>Pilih</option>
                                        <option value="1" {{(old('sektor_area')=='1')? 'selected' :''}}>Sektor 1</option>
                                        <option value="2" {{(old('sektor_area')=='2')? 'selected' :''}}>Sektor 2</option>
                                        <option value="3" {{(old('sektor_area')=='3')? 'selected' :''}}>Sektor 3</option>
                                        <option value="4" {{(old('sektor_area')=='4')? 'selected' :''}}>Sektor 4</option>
                                        </select>
                                        @if($errors->has('sektor_area'))
                                            <span class="help-block text-danger">{{$errors->first('sektor_area')}}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
                                        <label for="jabatan" > Jabatan : </label>
                                        <select name="jabatan" class="form-control" id="jabatan" >
                                        <option>Pilih</option>
                                        <option value="Manajer" {{(old('jabatan')=='Manajer')? 'selected' :''}}>Manajer</option>
                                        <option value="Staff" {{(old('jabatan')=='Staff')? 'selected' :''}}>Staff</option>
                                        <option value="Mandor" {{(old('jabatan')=='Mandor')? 'selected' :''}}>Mandor</option>
                                        <option value="Cleaning Service" {{(old('jabatan')=='Cleaning Service')? 'selected' :''}}>Cleaning Service</option>
                                        </select>
                                        @if($errors->has('jabatan'))
                                            <span class="help-block text-danger">{{$errors->first('jabatan')}}</span>
                                        @endif
                                </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group {{$errors->has('pendidikan') ? 'has-error' : ''}}">
                                        <label for="pendidikan" class="form-label" > Tingkat Pendidikan : </label>
                                        <select name="pendidikan" class="form-control" id="pendidikan" >
                                        <option>Pilih</option>
                                        <option value="SD" {{(old('pendidikan')=='SD')? 'selected' :''}}>SD</option>
                                        <option value="SMP" {{(old('pendidikan')=='SMP')? 'selected' :''}}>SMP</option>
                                        <option value="SMA" {{(old('pendidikan')=='SMA')? 'selected' :''}}>SMA/SMK/STM</option>
                                        <option value="Diploma" {{(old('pendidikan')=='Diploma')? 'selected' :''}}>Diploma</option>
                                        <option value="S-1" {{(old('pendidikan')=='S-1')? 'selected' :''}}>Sarjana 1</option>
                                        <option value="S-2" {{(old('pendidikan')=='S-2')? 'selected' :''}}>Sarjana 2</option>
                                        </select>
                                        @if($errors->has('pendidikan'))
                                            <span class="help-block text-danger">{{$errors->first('pendidikan')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('tangal_diterima') ? 'has-error' : ''}} ">
                                <label for="tanggal_diterima" class="form-label"> Tanggal Diterima : </label>
                                <input type="text" autocomplete="off" class="datepicker form-control" name="tanggal_diterima" id="tanggal_diterima" placeholder="01/01/2019" value="{{old('tanggal_diterima')}}">
                                @if($errors->has('tanggal_diterima'))
                                    <span class="help-block text-danger">{{$errors->first('tanggal_diterima')}}</span>
                                @endif
                            </div>

                            <div class="form-group {{$errors->has('foto_pegawai') ? 'has-error' : ''}} ">
                                <div class="mb-3">
                                    <label for="foto_pegawai" class="form-label">Unggah Foto Pegawai :</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto_pegawai" id="foto_pegawai">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @if($errors->has('foto_pegawai'))
                                        <span class="help-block text-danger">{{$errors->first('foto_pegawai')}}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- Akhir Card Informasi Pegawai --}}

                        </div>
                    </div>
            </div>

            <div class="d-sm-flex align-items-center justify-content-start mb-4 ml-4">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('pegawai.index') }}" class=" btn btn-lg btn-danger">Batal</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
                </form>
        </div>

    </div>


    <script type="text/javascript">
        $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
         });
    </script>
</section>
@endsection
