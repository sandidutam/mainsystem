@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('dashboard.active')
active
@endsection


@section('content')
<section class="section">
    <div class="section-header">
      <h1>Index Pegawai</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('pegawai.index')}}">Menu Pegawai</a></div>
        <div class="breadcrumb-item">Index Pegawai</div>
      </div>
    </div>

    <div class="section-body">

        <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <a href="{{ route('pegawai.create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
              <i class="fas fa-plus-circle fa-sm text-white-50 mr-2"></i> Data Baru</a>
          </div>

        <div class="card">
          <div class="card-header">
            <h4>Data Pegawai</h4>
          </div>

          {{-- Alert Notification --}}

          @if(session('notifikasi_create'))
            <div class="alert alert-success alert-dismissible m-3 show fade" role="alert">
              <div class="alert-body">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fas fa-check"></i>
                {{session('notifikasi_create')}}
              </div>
            </div>
          @endif


          <div class="card-footer bg-whitesmoke">

          </div>
        </div>
    </div>
</section>

@endsection
