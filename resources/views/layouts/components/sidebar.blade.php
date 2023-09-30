<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <img src="{{ asset('image/logo-bp.png') }}" style="width: 30%;" alt="Logo BP">
      <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: capitalize">
        Bina Putra
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
        <div data-i18n="Analytics">Dashboard </div>
      </a>
    </li>

    <li class="menu-item @if (request()->route()->named('guru.index')) active @endif">

      <a href="{{ route('guru.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Analytics">Guru </div>
      </a>
    </li>

    <li class="menu-item @if (request()->route()->named('kehadiran.index')) active @endif">

      <a href="{{ route('kehadiran.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-clipboard"></i>
        <div data-i18n="Analytics">List Kehadiran </div>
      </a>
    </li>

    <li class="menu-item @if (request()->route()->named('attendance.statistics')) active @endif">

      <a href="{{ route('attendance.statistics') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-clipboard"></i>
        <div data-i18n="Analytics">Statistik Kehadiran </div>
      </a>
    </li>

    <li class="menu-item @if (request()->route()->named('izin.index')) active @endif">

      <a href="{{ route('izin.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Analytics">Pengajuan Izin</div>
      </a>
    </li>

    @if (Auth::user()->role->id == 2)
      <li class="menu-item @if (request()->route()->named('admin.index')) active @endif">

        <a href="{{ route('admin.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user-circle"></i>
          <div data-i18n="Analytics">Admin</div>
        </a>
      </li>
    @endif

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Konfigurasi</span>
    </li>

    <li class="menu-item @if (request()->route()->named('limit.index')) active @endif">

      <a href="{{ route('limit.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx bxs-timer"></i>
        <div data-i18n="Analytics">Batas Keterlambatan</div>
      </a>
    </li>

    <li class="menu-item @if (request()->route()->named('allowed-ip.index')) active @endif">

      <a href="{{ route('allowed-ip.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-broadcast"></i>
        {{-- <box-icon name='broadcast'></box-icon> --}}
        <div data-i18n="Analytics">IP Absensi</div>
      </a>
    </li>

  </ul>
</aside>
<!-- / Menu -->