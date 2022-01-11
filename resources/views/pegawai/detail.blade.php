@extends('layouts.main')

@section('title')
    Menu Pegawai
@endsection

@section('sub-title')
    Profil {{$data_pegawai->nama_lengkap()}}
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
        <h1>Profil - {{$data_pegawai->nama_lengkap()}}</h1>
        <a href="/pegawai" class="btn btn-danger ml-4">
            <span class="icon">
                <i class="fas fa-chevron-left mr-2"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pegawai.index') }}">Menu Pegawai </a></div>
            <div class="breadcrumb-item">Profil Pegawai </div>
        </div>
    </div>

    <div class="section-body">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Space%20Mono">

        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="/pegawai" class="btn btn-danger ">
                <span class="icon">
                    <i class="fas fa-chevron-left mr-2"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div> --}}
        <div class="row mt-sm-4">
            @if ( auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin" )
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                        <img alt="image" src="{{$data_pegawai->getFotoPegawai()}}" class="profile-widget-picture" style="height: 100px; width: 100px; border-radius: 100%; border: 3px solid #6777EF; object-fit: cover;">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Hadir</div>
                                <div class="profile-widget-item-value text-success">{{$hadir}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Bolos</div>
                                <div class="profile-widget-item-value text-danger">{{$bolos}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Cuti</div>
                                <div class="profile-widget-item-value text-muted">{{$cuti}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Sakit</div>
                                <div class="profile-widget-item-value text-warning">{{$sakit}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Izin</div>
                                <div class="profile-widget-item-value text-warning">{{$izin}}</div>
                            </div>
                        </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{$data_pegawai->nama_lengkap()}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{$data_pegawai->jabatan}}</div></div>
                            {{$data_pegawai->nama_lengkap()}} adalah pegawai dengan jabatan <b>{{$data_pegawai->jabatan}}</b> di sektor {{$data_pegawai->sektor_area}}. {{$data_pegawai->nama_depan}}  diterima bekerja pada tanggal {{date('d F Y', strtotime($data_pegawai->tanggal_diterima))}}. Dia berdomisili di kota <b>{{$data_pegawai->kota_kabupaten}}</b>.
                            </div>
                        <div class="card-footer text-center">
                            <div class="font-weight-bold mb-2">{{$data_pegawai->nama_lengkap()}} QR's Code</div>
                            <div style="border: solid 1px #6777EF; background-color: #FFFFFF ;padding: 10px; border-radius: 10px; width: 170px; margin: auto; position: relative; ">
                                {!! QrCode::size(140)->generate($data_pegawai->id); !!}
                            </div>
                            <hr>
                            <div id="detailChart" class="mt-4 mb-4"></div>
                            <hr>
                            <div class="mt-4">
                                <h2 class="text-center text-success">Tanggal</h2>
                                <h3 class="text-center">{{date('D, d-M-Y', strtotime($today))}}</h3>
                                <h2 class="text-center text-success" style="margin-top: 20px">Jam</h2>
                                <h3 id="currentTime"></h3>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <a href="{{ route('presensi.checkin', Crypt::encryptString($data_pegawai->id)) }}" class="btn btn-sm btn-success" type="button">Presensi Masuk</a>
                                </div>
                                @foreach ($data_presensi as $pegawai)
                                <div class="col d-flex justify-content-center">
                                    <a href="{{ route('presensi.checkout', Crypt::encryptString($pegawai->id)) }}" class="btn btn-sm btn-warning" type="button">Presensi Keluar</a>
                                </div>
                                @endforeach
                                {{-- <div class="col d-flex justify-content-center">
                                    <a href="{{ route('presensi.checkout', Crypt::encryptString($data_presensi->id)) }}" class="btn btn-sm btn-warning" type="button">Presensi Keluar</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        {!! Form::model($data_pegawai ,['route'=>['pegawai.update', $data_pegawai->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="section-title mt-1 mb-4"><h5>Informasi Pribadi</h5></div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama_depan" class="form-label"> Nama Depan : </label>
                                            {!! Form::text('nama_depan', null, ['class'=>'form-control','id'=>'nama_depan']) !!}
                                            @if($errors->has('nama_depan'))
                                                <span class="help-block text-danger">{{$errors->first('nama_depan')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
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
                                                <div class="form-group ">
                                                    <label for="tempat_lahir" class="form-label"> Tempat Lahir : </label>
                                                    {!! Form::text('tempat_lahir', null, ['class'=>'form-control','id'=>'tempat_lahir']) !!}
                                                    @if($errors->has('tempat_lahir'))
                                                        <span class="help-block text-danger">{{$errors->first('tempat_lahir')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group ">
                                                    <label for="tanggal_lahir" class="form-label"> Tanggal Lahir : </label>
                                                    {!! Form::text('tanggal_lahir', null, ['class'=>'datepicker form-control','id'=>'tanggal_lahir']) !!}
                                                    @if($errors->has('tanggal_lahir'))
                                                        <span class="help-block text-danger">{{$errors->first('tanggal_lahir')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin" class="mb-2"> Jenis Kelamin : </label>
                                                    {{-- {!! Form::select('jenis_kelamin', $data_pegawai->jenis_kelamin, 'Pilih', ['class'=>'form-control', 'id'=>'jenis_kelamin']) !!} --}}
                                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('jenis_kelamin', $data_pegawai->jenis_kelamin)=="L"? 'selected':''}} value="L">Laki-Laki</option>
                                                    <option {{old('jenis_kelamin', $data_pegawai->jenis_kelamin)=="P"? 'selected':''}} value="P">Perempuan</option>
                                                    </select>
                                                    @if($errors->has('jenis_kelamin'))
                                                        <span class="help-block text-danger">{{$errors->first('jenis_kelamin')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="agama" class="mb-2"> Agama  : </label>
                                                    <select name="agama" class="form-control" id="agama" >
                                                    <option selected="true" style='display: none' value="">Pilih</option>
                                                    <option {{old('agama', $data_pegawai->agama)=="Islam"? 'selected':''}} value="Islam">Islam</option>
                                                    <option {{old('agama', $data_pegawai->agama)=="Kristen"? 'selected':''}} value="Kristen">Kristen</option>
                                                    <option {{old('agama', $data_pegawai->agama)=="Katolik"? 'selected':''}} value="Katolik">Katolik</option>
                                                    <option {{old('agama', $data_pegawai->agama)=="Hindu"? 'selected':''}} value="Hindu">Hindu</option>
                                                    <option {{old('agama', $data_pegawai->agama)=="Buddha"? 'selected':''}} value="Buddha">Buddha</option>
                                                    <option {{old('agama', $data_pegawai->agama)=="Konghucu"? 'selected':''}} value="Konghucu">Konghucu</option>
                                                    </select>
                                                    @if($errors->has('agama'))
                                                        <span class="help-block text-danger">{{$errors->first('agama')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kelurahan" > Kelurahan : </label>
                                                    {!! Form::text('kelurahan', null, ['class'=>'form-control','id'=>'kelurahan']) !!}
                                                    @if($errors->has('kelurahan'))
                                                        <span class="help-block text-danger">{{$errors->first('kelurahan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kecamatan" > Kecamatan : </label>
                                                    {!! Form::text('kecamatan', null, ['class'=>'form-control','id'=>'kecamatan']) !!}
                                                    @if($errors->has('kecamatan'))
                                                        <span class="help-block text-danger">{{$errors->first('kecamatan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kota_kabupaten" > Kota/Kabupaten : </label>
                                                    {!! Form::text('kota_kabupaten', null, ['class'=>'form-control','id'=>'kota_kabupaten']) !!}
                                                    @if($errors->has('kota_kabupaten'))
                                                        <span class="help-block text-danger">{{$errors->first('kota_kabupaten')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="provinsi" > Provinsi : </label>
                                                    {!! Form::text('provinsi', null, ['class'=>'form-control','id'=>'provinsi']) !!}
                                                    @if($errors->has('provinsi'))
                                                        <span class="help-block text-danger">{{$errors->first('provinsi')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="alamat"> Alamat : </label>
                                        {!! Form::textarea('alamat', null, ['class'=>'form-control','id'=>'alamat','rows'=>'2']) !!}
                                        @if($errors->has('alamat'))
                                            <span class="help-block text-danger">{{$errors->first('alamat')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="section-title mt-1 mb-4"><h5>Informasi Pegawai</h5></div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="penempatan" > Lokasi Penempatan : </label>
                                                    <select name="penempatan" class="form-control" id="penempatan" >
                                                    <option>Pilih</option>
                                                    <option {{old('penempatan', $data_pegawai->penempatan)=="Mabes TNI AD"? 'selected':''}} value="Mabes TNI AD">Mabes TNI AD</option>
                                                    </select>
                                                    @if($errors->has('penempatan'))
                                                        <span class="help-block text-danger">{{$errors->first('penempatan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="sektor_area" > Sektor Kerja : </label>
                                                    <select name="sektor_area" class="form-control" id="sektor_area" >
                                                    <option>Pilih</option>
                                                    <option {{old('sektor_area', $data_pegawai->sektor_area)=="1"? 'selected':''}} value="1">Sektor 1</option>
                                                    <option {{old('sektor_area', $data_pegawai->sektor_area)=="2"? 'selected':''}} value="2">Sektor 2</option>
                                                    <option {{old('sektor_area', $data_pegawai->sektor_area)=="3"? 'selected':''}} value="3">Sektor 3</option>
                                                    <option {{old('sektor_area', $data_pegawai->sektor_area)=="4"? 'selected':''}} value="4">Sektor 4</option>
                                                    </select>
                                                    @if($errors->has('sektor_area'))
                                                        <span class="help-block text-danger">{{$errors->first('sektor_area')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="row">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="jabatan" > Jabatan : </label>
                                                    <select name="jabatan" class="form-control" id="jabatan" >
                                                    <option>Pilih</option>
                                                    <option {{old('jabatan', $data_pegawai->jabatan)=="Manajer"? 'selected':''}} value="Manajer">Manajer</option>
                                                    <option {{old('jabatan', $data_pegawai->jabatan)=="Staff"? 'selected':''}} value="Staff">Staff</option>
                                                    <option {{old('jabatan', $data_pegawai->jabatan)=="Mandor"? 'selected':''}} value="Mandor">Mandor</option>
                                                    <option {{old('jabatan', $data_pegawai->jabatan)=="Cleaning Service"? 'selected':''}} value="Cleaning Service">Cleaning Service</option>
                                                    </select>
                                                    @if($errors->has('jabatan'))
                                                        <span class="help-block text-danger">{{$errors->first('jabatan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
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
                                                    @if($errors->has('pendidikan'))
                                                        <span class="help-block text-danger">{{$errors->first('pendidikan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group" >
                                            <label for="tanggal_diterima" class="form-label"> Tanggal Diterima : </label>
                                            {!! Form::text('tanggal_diterima', $data_pegawai->tanggal_diterima , ['class'=>'datepicker form-control','id'=>'tanggal_diterima','disabled']) !!}
                                            @if($errors->has('tanggal_diterima'))
                                                <span class="help-block text-danger">{{$errors->first('tanggal_diterima')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
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
                        <img alt="image" src="{{$data_pegawai->getFotoPegawai()}}" class="profile-widget-picture" style="height: 100px; width: 100px; border-radius: 100%; border: 3px solid #6777EF; object-fit: cover;">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Hadir</div>
                                <div class="profile-widget-item-value text-success">{{$hadir}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Bolos</div>
                                <div class="profile-widget-item-value text-danger">{{$bolos}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Cuti</div>
                                <div class="profile-widget-item-value text-muted">{{$cuti}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Sakit</div>
                                <div class="profile-widget-item-value text-warning">{{$sakit}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Izin</div>
                                <div class="profile-widget-item-value text-warning">{{$izin}}</div>
                            </div>
                        </div>
                        </div>
                        <div class="profile-widget-description">
                        <div class="profile-widget-name">{{$data_pegawai->nama_lengkap()}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{$data_pegawai->jabatan}}</div></div>
                        {{$data_pegawai->nama_lengkap()}} adalah pegawai dengan jabatan <b>{{$data_pegawai->jabatan}}</b> di sektor {{$data_pegawai->sektor_area}}. {{$data_pegawai->nama_depan}}  diterima bekerja pada tanggal {{date('d F Y', strtotime($data_pegawai->tanggal_diterima))}}. Dia berdomisili di kota <b>{{$data_pegawai->kota_kabupaten}}</b>.
                        </div>
                        <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">{{$data_pegawai->nama_lengkap()}} QR's Code</div>
                        <div style="border: solid 1px #6777EF; background-color: #FFFFFF ;padding: 10px; border-radius: 10px; width: 170px; margin: auto; position: relative; ">
                            {!! QrCode::size(140)->generate($data_pegawai->id); !!}
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Presensi Pegawai</h6>
                        </div>
                        <div class="card-body" >
                            <h1 class="text-center text-success">Tanggal</h1>
                            <h3 class="text-center">{{date('D, d-M-Y', strtotime($today))}}</h3>
                            <h1 class="text-center text-success" style="margin-top: 40px">Jam</h1>
                            <h3 id="currentTime"></h3>

                            <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <a href="{{ route('presensi.checkin', $data_pegawai->id) }}" class="btn btn-lg btn-success" type="button">Presensi Masuk</a>
                                </div>
                                @foreach ($data_presensi as $pegawai)
                                <div class="col d-flex justify-content-center">
                                    <a href="{{ route('presensi.checkout', $pegawai->id) }}" class="btn btn-lg btn-warning" type="button">Presensi Keluar</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</section>

<script type="text/javascript">
    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd'
     });
</script>
@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script>Highcharts.chart('detailChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Presensi Mingguan'
    },
    xAxis: {
        categories: {!! json_encode($categories) !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Hadir',
        color: '#47C363',
        data: {!! json_encode($data1) !!}

    }, {
        name: 'Bolos',
        color: '#FC544B',
        data: {!! json_encode($data2) !!}

    }, {
        name: 'Cuti',
        color: '#6777EF',
        data: {!! json_encode($data3) !!}

    }, {
        name: 'Sakit',
        color: '#F67A3D',
        data: {!! json_encode($data4) !!}

    }, {
        name: 'Izin',
        color: '#FFB44C',
        data: {!! json_encode($data5) !!}

    },
    ]
});

</script>
@endsection
