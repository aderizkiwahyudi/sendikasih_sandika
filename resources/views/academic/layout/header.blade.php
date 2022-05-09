<header class="shadow-sm">
    <div class="container">
        <div class="header">
            <div class="logo d-flex align-items-center">
                <a href="{{ url('akademik') }}">
                    <img src="{{ asset('img/icon.png') }}" width="40px" alt="Logo"/>
                </a>
                <a href="{{ url('akademik') }}">
                    <h5 class="text-white mb-0 ms-3">SISTEM AKADEMIK</h5>
                </a>
            </div>
            <div class="nav">
                <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('academic.dashboard') }}">Halaman Utama</a></li>
                    @if (Auth::guard('academic')->user()->student)
                        <li><a class="dropdown-item" href="{{ route('academic.finance') }}">Pembayaran Saya</a></li>
                    @endif
                    <li><a class="dropdown-item" href="{{ route('academic.setting') }}">Pengaturan</a></li>
                    <li class="border-top"><a class="dropdown-item text-danger" href="{{ route('academic.logout') }}">Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>