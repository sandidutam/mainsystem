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
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-friends"></i> <span>Pegawai</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('pegawaiindex.active')"><a class="nav-link" href="{{route('pegawai.index')}}">Index</a></li>
            <li class="@yield('addpegawai.active')"><a class="btn btn-icon icon-left" href="{{ route('pegawai.create') }}"><i class="fas fa-plus-circle"></i> Tambah Data Baru</a></li>
          </ul>
        </li>
        {{-- Menu Presensi --}}
        <li class="nav-item dropdown @yield('presensi.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-check"></i> <span>Presensi</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('presensiindex.active')"><a class="nav-link" href="{{route('presensi.history')}}">Index</a></li>
            <li class="@yield('presensiactivity.active')"><a class="nav-link" href="{{route('presensi.activity')}}">Linimasa</a></li>
            <li class="@yield('indexin.active')"><a class="nav-link" href="{{route('presensi.indexin')}}">Presensi Masuk</a></li>
            <li class="@yield('indexout.active')"><a class="nav-link" href="{{route('presensi.indexout')}}">Presensi Keluar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown @yield('inventori.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-warehouse"></i> <span>Inventori</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('inventoriindex.active')"><a class="nav-link" href="{{route('inventori.index')}}">Index</a></li>
            <li class="@yield('priceindex.active')"><a class="nav-link" href="{{route('inventori.price')}}">Tabel Harga</a></li>
            <li class="@yield('stokinventori.active')"><a class="nav-link" href="{{route('inventori.stock')}}">Stok</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown @yield('neraca.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Neraca</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('neracaindex.active')"><a class="nav-link" href="{{route('neraca.index')}}">Index</a></li>
            <li class="@yield('neracadebit.active')"><a class="nav-link" href="{{route('neraca.debit')}}">Debitur</a></li>
            <li class="@yield('neracakredit.active')"><a class="nav-link" href="{{route('neraca.kredit')}}">Kreditur</a></li>
          </ul>
        </li>

        {{-- User --}}
        <li class="menu-header">User</li>
        <li class="nav-item dropdown @yield('user.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-circle"></i> <span>All User</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('userindex.active')"><a class="nav-link" href="{{route('user.index')}}">Index</a></li>
            <li class="@yield('adduser.active')"><a class="btn btn-icon icon-left" href="{{ route('user.create') }}"><i class="fas fa-plus-circle"></i> Buat User Baru</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown @yield('authuser.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <figure class="avatar avatar-xs ml-2 mr-4">
              <img src="{{(auth()->user()->getFotoUser())}}" alt="...">
            </figure>
            <span>{{(auth()->user()->nama_depan)}}</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('authuserprofile.active')"><a class="btn btn-icon icon-left" href="{{ route('user.show', Crypt::encryptString(auth()->user()->id)) }}"><i class="fas fa-info-circle"></i>Profil</a></li>
            <li class="@yield('authuseredit.active')"><a class="btn btn-icon icon-left" href="{{ route('user.edit', Crypt::encryptString(auth()->user()->id)) }}"><i class="fas fa-edit mr-2"></i>Ubah Data Akun</a></li>
            <li class="@yield('authusereditpassword.active')"><a class="btn btn-icon icon-left" href="{{ route('user.edit_password_buffer')}}"><i class="fas fa-lock"></i>Ubah Password</a></li>
          </ul>
        </li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        {{-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Documentation
        </a> --}}
      </div>
  </aside>
