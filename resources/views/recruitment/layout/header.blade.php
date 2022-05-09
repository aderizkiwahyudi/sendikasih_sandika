<header class="bg-white border-bottom">
    <div class="header d-flex align-items-center justify-content-between">
        <div class="logo">
            <a href="{{ url('penerimaan') }}">
                <h1><strong>Penerimaan</strong> Yayasan Sendikasih Sandika</h1>
            </a>
        </div>
        <div class="nav">
            <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('recruitment.dashboard') }}">Halaman Utama</a></li>
                <li><a class="dropdown-item" href="{{ route('recruitment.setting') }}">Pengaturan</a></li>
                <li class="border-top"><a class="dropdown-item text-danger" href="{{ route('recruitment.logout') }}">Keluar</a></li>
            </ul>
        </div>
    </div>
</header>