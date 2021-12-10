<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <h3 class="mt-4"><a href="index.html">Main<span class="text-primary">2X</span></a></h3>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">M<span class="text-primary">2X</span></a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul>
        </li>

        {{-- Menu --}}
        <li class="menu-header">Menu</li>
        {{-- Menu Pegawai--}}
        <li class="nav-item dropdown @yield('pegawai.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ul"></i></i> <span>Pegawai</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('pegawaiindex.active')"><a class="nav-link" href="{{route('pegawai.index')}}">Index</a></li>
            <li class="@yield('addpegawai.active')"><a class="btn btn-icon icon-left" href="{{ route('pegawai.create') }}"><i class="fas fa-plus-circle"></i> Tambah Data Baru</a></li>
          </ul>
        </li>
        {{-- Menu Presensi --}}
        <li class="nav-item dropdown @yield('presensi.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ul"></i></i> <span>Presensi</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('presensiindex.active')"><a class="nav-link" href="{{route('presensi.history')}}">Index</a></li>
            <li class="@yield('indexin.active')"><a class="nav-link" href="{{route('presensi.indexin')}}">Presensi Masuk</a></li>
            <li class="@yield('indexout.active')"><a class="nav-link" href="{{route('presensi.indexout')}}">Presensi Keluar</a></li>
            <li class="@yield('addpegawai.active')"><a class="btn btn-icon icon-left" href="{{ route('pegawai.create') }}"><i class="fas fa-plus-circle"></i> Tambah Data Baru</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown @yield('presensi.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-ul"></i></i> <span>Inventori</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('presensiindex.active')"><a class="nav-link" href="{{route('presensi.history')}}">Index</a></li>
            <li class="@yield('indexin.active')"><a class="nav-link" href="{{route('presensi.indexin')}}">Presensi Masuk</a></li>
            <li class="@yield('indexout.active')"><a class="nav-link" href="{{route('presensi.indexout')}}">Presensi Keluar</a></li>
            <li class="@yield('addpegawai.active')"><a class="btn btn-icon icon-left" href="{{ route('pegawai.create') }}"><i class="fas fa-plus-circle"></i> Tambah Data Baru</a></li>
          </ul>
        </li>


        <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

        {{-- User --}}
        <li class="menu-header">User</li>
        <li class="nav-item dropdown @yield('user.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-circle"></i></i> <span>User</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('userindex.active')"><a class="nav-link" href="{{route('user.index')}}">Index</a></li>
            <li class="@yield('adduser.active')"><a class="btn btn-icon icon-left" href="{{ route('user.create') }}"><i class="fas fa-plus-circle"></i> Buat User Baru</a></li>
          </ul>
        </li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        {{-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Documentation
        </a> --}}
      </div>
  </aside>
