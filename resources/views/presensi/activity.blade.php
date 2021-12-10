@extends('layouts.main')

@section('title')
    Menu Presensi
@endsection

@section('sub-title')
    Linimasa
@endsection

@section('presensi.active')
active
@endsection

@section('presensiactivity.active')
active
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Linimasa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Menu Presensi</a></div>
                <div class="breadcrumb-item">Linimasa</div>
            </div>
        </div>

        <div class="section-body">
            <div class="section-title mt-1 mb-4"><h5>{{date('d F Y', strtotime($hari_ini))}}, <span id="currentTime" style="font-size: 18px; margin: 0; color: green;"></span></h5></div>

            <div class="row align-items-top justify-content-start">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card chat-box" id="mychatbox" style="height : 600px;">
                        <div class="card-header">
                            <h4>Aktifitas Hari Ini</h4>
                        </div>
                        <div class="card-body chat-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="activities" style="font-size : 18px;">
                                        <h6>{{date('d F Y', strtotime($hari_ini))}}</h6>
                                        @foreach ($data_hari_ini as $item)
                                            @if ($item->keterangan == null && $item->catatan_masuk == !null && $item->catatan_keluar == null)
                                                <div class="activity">
                                                    <div class="activity-icon bg-success text-white shadow-primary">
                                                        <i class="fas fa-sign-in-alt"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-success" style="font-size : 14px;" href="#">Masuk</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #47C363; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> sudah masuk ke kantor.</p>
                                                    </div>
                                                </div>
                                            @elseif ($item->keterangan == null && $item->catatan_masuk == !null && $item->catatan_keluar == !null)
                                                <div class="activity">
                                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-primary" style="font-size : 14px;" href="#">Shift Selesai</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #6777EF; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;">
                                                            <a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> masuk pada jam <span class="text-success">{{date('H:i', strtotime($item->jam_masuk))}}</span> dan pulang pada jam <span class="text-success">{{date('H:i', strtotime($item->jam_keluar))}}</span>.
                                                            Dia bekerja selama {{\Carbon\Carbon::parse($item->created_at)->diffInHours($item->updated_at)}} jam {{\Carbon\Carbon::parse($item->created_at)->diff($item->updated_at)->i}} menit.
                                                        </p>
                                                    </div>
                                                </div>
                                            @elseif ($item->keterangan == 'Bolos')
                                                <div class="activity">
                                                    <div class="activity-icon bg-danger text-white shadow-primary">
                                                        <i class="fas fa-thumbtack"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-danger" style="font-size : 14px;" href="#">{{$item->keterangan}}</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #FC544B; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> hari ini bolos.</p>
                                                    </div>
                                                </div>
                                            @elseif ($item->keterangan != 'Bolos' && $item->catatan_masuk == "-")
                                                <div class="activity">
                                                    <div class="activity-icon bg-warning text-white shadow-primary">
                                                        <i class="fas fa-thumbtack"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-danger" style="font-size : 14px;" href="#">{{$item->keterangan}}</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #FFA426; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> hari ini {{$item->keterangan}}.</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card chat-box" id="mychatbox"  style="height : 600px;">
                        <div class="card-header">
                            <h4>Aktifitas Kemarin</h4>
                        </div>
                        <div class="card-body chat-content" style="background-color: green;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="activities" style="font-size : 18px;">
                                        <h6>{{date('d F Y', strtotime($kemarin))}}</h6>
                                        @foreach ($data_kemarin as $item)
                                            @if ($item->keterangan == null && $item->catatan_masuk == !null && $item->catatan_keluar == null)
                                                <div class="activity">
                                                    <div class="activity-icon bg-success text-white shadow-primary">
                                                        <i class="fas fa-sign-in-alt"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-success" style="font-size : 14px;" href="#">Masuk</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #47C363; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> sudah masuk ke kantor.</p>
                                                    </div>
                                                </div>
                                            @elseif ($item->keterangan == null && $item->catatan_masuk == !null && $item->catatan_keluar == !null)
                                                <div class="activity">
                                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-primary" style="font-size : 14px;" href="#">Shift Selesai</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #6777EF; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;">
                                                            <a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> masuk pada jam <span class="text-success">{{date('H:i', strtotime($item->jam_masuk))}}</span> dan pulang pada jam <span class="text-success">{{date('H:i', strtotime($item->jam_keluar))}}</span>.
                                                            Dia bekerja selama {{\Carbon\Carbon::parse($item->created_at)->diffInHours($item->updated_at)}} jam {{\Carbon\Carbon::parse($item->created_at)->diff($item->updated_at)->i}} menit.
                                                        </p>
                                                    </div>
                                                </div>
                                            @elseif ($item->keterangan == 'Bolos')
                                                <div class="activity">
                                                    <div class="activity-icon bg-danger text-white shadow-primary">
                                                        <i class="fas fa-thumbtack"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-danger" style="font-size : 14px;" href="#">{{$item->keterangan}}</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #FC544B; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> hari ini bolos.</p>
                                                    </div>
                                                </div>
                                            @elseif ($item->keterangan != 'Bolos' && $item->catatan_masuk == "-")
                                                <div class="activity">
                                                    <div class="activity-icon bg-warning text-white shadow-primary">
                                                        <i class="fas fa-thumbtack"></i>
                                                    </div>
                                                    <div class="activity-detail">
                                                        <div class="mb-2">
                                                            <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                            <span class="bullet"></span>
                                                            <a class="text-job text-danger" style="font-size : 14px;" href="#">{{$item->keterangan}}</a>
                                                        </div>
                                                        <div class="row d-flex justify-content-center">
                                                            <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #FFA426; object-fit: cover;">
                                                        </div>
                                                        <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> hari ini {{$item->keterangan}}.</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card chat-box" id="mychatbox"  style="height : 600px;">
                        <div class="card-header">
                            <h4>Riwayat Seluruhnya</h4>
                        </div>
                        <div class="card-body chat-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="activities" style="font-size : 18px;">
                                        @foreach ($data_presensi as $hari => $hari_list)
                                            {{-- <h6 class="mt-2">{{date('d F Y', strtotime($item->tanggal))}}</h6> --}}
                                            <h6>{{$hari}}</h6>
                                            @foreach ($hari_list as $item)
                                                @if ($item->keterangan == null && $item->catatan_masuk == !null && $item->catatan_keluar == null)
                                                    <div class="activity">
                                                        <div class="activity-icon bg-success text-white shadow-primary">
                                                            <i class="fas fa-sign-in-alt"></i>
                                                        </div>
                                                        <div class="activity-detail">
                                                            <div class="mb-2">
                                                                <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                                <span class="bullet"></span>
                                                                <a class="text-job text-success" style="font-size : 14px;" href="#">Masuk</a>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #47C363; object-fit: cover;">
                                                            </div>
                                                            <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> sudah masuk ke kantor.</p>
                                                        </div>
                                                    </div>
                                                @elseif ($item->keterangan == null && $item->catatan_masuk == !null && $item->catatan_keluar == !null)
                                                    <div class="activity">
                                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                        <div class="activity-detail">
                                                            <div class="mb-2">
                                                                <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                                <span class="bullet"></span>
                                                                <a class="text-job text-primary" style="font-size : 14px;" href="#">Shift Selesai</a>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #6777EF; object-fit: cover;">
                                                            </div>
                                                            <p style="font-weight: bold;">
                                                                <a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> masuk pada jam <span class="text-success">{{date('H:i', strtotime($item->jam_masuk))}}</span> dan pulang pada jam <span class="text-success">{{date('H:i', strtotime($item->jam_keluar))}}</span>.

                                                                Dia bekerja selama {{\Carbon\Carbon::parse($item->created_at)->diffInHours($item->updated_at)}} jam {{\Carbon\Carbon::parse($item->created_at)->diff($item->updated_at)->i}} menit.
                                                            </p>

                                                        </div>
                                                    </div>
                                                @elseif ($item->keterangan == 'Bolos')
                                                    <div class="activity">
                                                        <div class="activity-icon bg-danger text-white shadow-primary">
                                                            <i class="fas fa-thumbtack"></i>
                                                        </div>
                                                        <div class="activity-detail">
                                                            <div class="mb-2">
                                                                <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                                <span class="bullet"></span>
                                                                <a class="text-job text-danger" style="font-size : 14px;" href="#">{{$item->keterangan}}</a>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #FC544B; object-fit: cover;">
                                                            </div>
                                                            <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> hari ini bolos.</p>
                                                        </div>
                                                    </div>
                                                @elseif ($item->keterangan != 'Bolos' && $item->catatan_masuk == "-")
                                                    <div class="activity">
                                                        <div class="activity-icon bg-warning text-white shadow-primary">
                                                            <i class="fas fa-thumbtack"></i>
                                                        </div>
                                                        <div class="activity-detail">
                                                            <div class="mb-2">
                                                                <span class="text-job text-primary" style="font-size : 14px;">{{date('H:i', strtotime($item->updated_at))}}</span>
                                                                <span class="bullet"></span>
                                                                <a class="text-job text-danger" style="font-size : 14px;" href="#">{{$item->keterangan}}</a>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <img src="{{$item->pegawai->getFotoPegawai()}}" style="height: 100px; width: 100px; border-radius: 100px; border: 2px solid #FFA426; object-fit: cover;">
                                                            </div>
                                                            <p style="font-weight: bold;"><a href="{{ route('pegawai.show', $item->pegawai_id) }}">{{$item->pegawai->nama_lengkap()}}</a> hari ini {{$item->keterangan}}.</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection
