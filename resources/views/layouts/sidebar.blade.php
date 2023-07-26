<ul class="menu-inner py-1">
    <!-- Home -->
    <li class="menu-item active">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Home</div>
      </a>
    </li>

    <!-- Halaman Data Pegawai -->
    <li class="menu-item">
      <a href="/" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-user"> </i>
        <div data-i18n="Data Pegawai">Data Pegawai</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('pegawai.index') }}" class="menu-link">
            <div data-i18n="Without menu">Daftar PNS</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('show.pegawai') }}" class="menu-link">
            <div data-i18n="Without navbar">Profile Pegawai</div>
          </a>
        </li>
      </ul>
    </li>

     <!-- Halaman Master Data  -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text"></span>
    </li>
    <li class="menu-item">
      <a href="/" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Data Master">Master Data</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pages-account-settings-account.html" class="menu-link">
            <div data-i18n="Data Jabatan">Data Jabatan</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-account-settings-notifications.html" class="menu-link">
            <div data-i18n="Data Golongan">Data Golongan</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('pangkat.index') }}" class="menu-link">
            <div data-i18n="Data Pangkat">Data Pangkat</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('gaji.index') }}" class="menu-link">
            <div data-i18n="Data Pangkat">Data Gaji</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
        <a href="/" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-user-badge"></i>
          <div data-i18n="Data Master">Kepegawaian</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('data.naikPangkat') }}" class="menu-link">
              <div data-i18n="Data Jabatan">Data Kenaikan Pangkat PNS</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('berkala.admin') }}" class="menu-link">
              <div data-i18n="Data Golongan">Data Kenaikan Gaji Berkala PNS</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('menu.naik.pangkat') }}" class="menu-link">
              <div data-i18n="Data Pangkat">Usul Kenaikan Pangkat</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('index.berkala') }}" class="menu-link">
              <div data-i18n="Data Pangkat">Usul Kenaikan Gaji Berkala</div>
            </a>
          </li>
        </ul>
      </li>
  </ul>
