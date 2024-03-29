<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <h5 class="mt-4"><a href="{{route('dashboard.index')}}">ALKATA<br><span class="text-primary"><h6>KUSUMA JAYA</h6></span></a></h5>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">A<span class="text-primary">KJ</span></a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="@yield('dashboard.active')"><a class="nav-link" href="{{route('dashboard.index')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

        {{-- Menu --}}
        <li class="menu-header">Menu</li>
        {{-- Menu Pegawai--}}
        <li class="@yield('pegawai.active')"><a class="nav-link" href="{{route('pegawai.index')}}"><i class="fas fa-user-friends"></i> <span>Pegawai</span></a></li>

        {{-- Menu Presensi --}}
        <li class="nav-item dropdown @yield('presensi.active')">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-check"></i> <span>Presensi</span></a>
          <ul class="dropdown-menu">
            <li class="@yield('presensiindex.active')"><a class="nav-link" href="{{route('presensi.history')}}">Index</a></li>
            <li class="@yield('presensiactivity.active')"><a class="nav-link" href="{{route('presensi.activity')}}">Linimasa</a></li>
            @if(auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Mandor" )
            <li class="@yield('indexin.active')"><a class="nav-link" href="{{route('presensi.indexin')}}">Presensi Masuk</a></li>
            <li class="@yield('indexout.active')"><a class="nav-link" href="{{route('presensi.indexout')}}">Presensi Keluar</a></li>
            @endif
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

        @if (auth()->user()->role == "SuperAdmin" | auth()->user()->role == "Akuntan" | auth()->user()->role == "Admin")
        <li class="@yield('neraca.active')"><a class="nav-link" href="{{route('neraca.index')}}"><i class="fas fa-book"></i> <span>Neraca Keuangan</span></a></li>
        @endif

        {{-- User --}}
        <li class="menu-header">User</li>
        <li class="@yield('user.active')">
            <a class="nav-link" href="{{route('user.index')}}">
                <i class="fas fa-users"></i> <span>All User</span>
            </a>
        </li>

        <li class="@yield('authuser.active')">
            <a class="nav-link" href="{{route('user.show', Crypt::encryptString(auth()->user()->id))}}">
                @if ( auth()->user()->role == "SuperAdmin" )
                <i class="fas fa-crown" style="color: #6777EF"></i>
                @else
                <i class="fas fa-user"></i>
                @endif
                <span style="font-weight: bold;">{{(auth()->user()->nama_lengkap())}}</span>
            </a>
        </li>

      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        {{-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Documentation
        </a> --}}
      </div>
  </aside>
