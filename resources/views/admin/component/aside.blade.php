<aside>
    <div class="header">
        <a href="{{ route('admin.dashboard') }}">
            <h5>Administrator</h5>
        </a>
    </div>
    <div class="menus">
        <ul>
            <div class="menu-name">DASHBOARD</div>
            <li {{  Request::segment(2) == 'dashboard' ? 'class=active' : '' }}>
                <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer me-2"></i> DASHBOARD</a>
            </li>
            <li class="sub {{  Request::segment(2) == 'berita' || Request::segment(2) == 'kategori' ? 'active' : '' }}">
                <a href="#"><i class="bi bi-stars me-2"></i> BERITA</a>
                <ul class="submenus">
                    <li class="{{  Request::segment(2) == 'berita' ? 'active' : '' }}">
                        <a href="{{ route('admin.news') }}">BERITA</a>
                    </li>
                    <li class="{{  Request::segment(2) == 'kategori' ? 'active' : '' }}">
                        <a href="{{ route('admin.category') }}">KATEGORI</a>
                    </li>
                </ul>
            </li>
            <li class="sub {{ Request::segment(2) =='halaman' ? 'active' : '' }}">
                <a href="#"><i class="bi bi-file-break-fill me-2"></i> HALAMAN</a>
                <ul class="submenus">
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='tepak-sirih' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'tepak-sirih') }}">TEPAK SIRIH</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='sejarah' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'sejarah') }}">SEJARAH</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='visi-misi' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'visi-misi') }}">VISI & MISI</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='lambang' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'lambang') }}">LAMBANG</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='struktur-pimpinan' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'struktur-pimpinan') }}">STRUKTUR PIMPINAN</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='lokasi-kantor-pusat' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'lokasi-kantor-pusat') }}">LOKASI KANTOR PUSAT</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='rencana-strategis' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'rencana-strategis') }}">RENCANA STRATEGIS</a>
                    </li>
                    <li class="{{ Request::segment(2) =='halaman' && Request::segment(3) =='perjanjian-kerja' ? 'active' : ''}}">
                        <a href="{{ route('admin.pages', 'perjanjian-kerja') }}">PERJANJIAN KERJA</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::segment(2) =='gallery' ? 'active' : '' }}">
                <a href="{{ route('admin.gallery') }}"><i class="bi bi-images me-2"></i> GALERI</a>
            </li>
            <div class="menu-name">AKADEMIK</div>
            <li class="{{ Request::segment(2) =='tahun-akademik' ? 'active' : '' }}">
                <a href="{{ route('admin.year') }}"><i class="bi bi-calendar-event-fill me-2"></i> TAHUN AKADEMIK</a>
            </li>
            <li class="sub {{  Request::segment(2) == 'kelas' ? 'active' : '' }}">
                <a href="#"><i class="bi bi-broadcast me-2"></i> DAFTAR KELAS</a>
                <ul class="submenus">
                    <li class="{{  Request::segment(2) == 'kelas' && Request::segment(3) == 'mi' ? 'active' : '' }}">
                        <a href="{{ route('admin.class', 'mi') }}">MI</a>
                    </li>
                    <li class="{{  Request::segment(2) == 'kelas' && Request::segment(3) == 'smp' ? 'active' : '' }}">
                        <a href="{{ route('admin.class', 'smp') }}">SMP</a>
                    </li>
                    <li class="{{  Request::segment(2) == 'kelas' && Request::segment(3) == 'sma' ? 'active' : '' }}">
                        <a href="{{ route('admin.class', 'sma') }}">SMA</a>
                    </li>
                </ul>
            </li>
            <li class="sub {{ Request::segment(2) =='user' ? 'active' : '' }}">
                <a href="#"><i class="bi bi-people me-2"></i> SISWA, GURU & STAFF</a>
                <ul class="submenus">
                    <li class="{{ Request::segment(2) =='user' && Request::segment(3) =='siswa' ? 'active' : '' }}">
                        <a href="{{ route('admin.users.academic', ['siswa', 'semua']) }}">DAFTAR SISWA</a>
                    </li>
                    <li class="{{ Request::segment(2) =='user' && Request::segment(3) =='guru' ? 'active' : '' }}">
                        <a href="{{ route('admin.users.academic', ['guru', 'semua']) }}">DAFTAR GURU</a>
                    </li>
                    <li class="{{ Request::segment(2) =='user' && Request::segment(3) =='staff' ? 'active' : '' }}">
                        <a href="{{ route('admin.users.academic', ['staff', 'semua']) }}">DAFTAR STAFF</a>
                    </li>
                </ul>
            </li>
            <li class="sub {{  Request::segment(2) == 'biaya' ? 'active' : '' }}">
                <a href="#"><i class="bi bi-wallet me-2"></i> JENIS BIAYA</a>
                <ul class="submenus">
                    @foreach ($contributions as $item)
                        <li class="{{ Request::segment(2) == 'biaya' && Request::segment(3) == $item->id ? 'active' : '' }}">
                            <a href="{{ route('admin.contribution', $item->id) }}">{{ strtoupper($item->name) }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            {{-- <li class="sub {{  Request::segment(2) == 'pembayaran' ? 'active' : '' }}">
                <a href="{{ route('admin.payment') }}"><i class="bi bi-wallet-fill me-2"></i> PEMBAYARAN</a>
            </li> --}}
            <div class="menu-name">PPDB & PPDP</div>
            <li class="sub {{  Request::segment(2) == 'pendaftaran' && Request::segment(3) == 'ppdb' || Request::segment(3) == 'ppdp' ? 'active' : '' }}">
                <a href="#"><i class="bi bi-person me-2"></i> PESERTA DIDIK</a>
                <ul class="submenus">
                    <li class="{{  Request::segment(2) == 'pendaftaran' && Request::segment(3) == 'ppdb' ? 'active' : '' }}">
                        <a href="{{ route('admin.recruitment', ['ppdb']) }}">PPDB</a>
                    </li>
                    <li class="{{  Request::segment(2) == 'pendaftaran' && Request::segment(3) == 'ppdp' ? 'active' : '' }}">
                        <a href="{{ route('admin.recruitment', ['ppdp']) }}">PPDP</a>
                    </li>
                </ul>
            </li>
            <li class="sub {{  Request::segment(2) == 'pendaftaran' && (Request::segment(3) == 'guru' || Request::segment(3) == 'staff') ? 'active' : '' }}">
                <a href="#"><i class="bi bi-person me-2"></i> GURU & STAFF</a>
                <ul class="submenus">
                    <li class="{{  Request::segment(2) == 'pendaftaran' && Request::segment(3) == 'guru' ? 'active' : '' }}">
                        <a href="{{ route('admin.recruitment', ['guru']) }}">Guru</a>
                    </li>
                    <li class="{{  Request::segment(2) == 'pendaftaran' && Request::segment(3) == 'staff' ? 'active' : '' }}">
                        <a href="{{ route('admin.recruitment', ['staff']) }}">Staff</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::segment(2) =='pendaftaran' && Request::segment(3) =='pengaturan' ? 'active' : '' }}">
                <a href="{{ route('admin.recruitment.setting') }}"><i class="bi bi-gear me-2"></i> PENGATURAN</a>
            </li>
            <div class="menu-name">WEBSITE</div>
            <li class="{{ Request::segment(2) =='website' ? 'active' : '' }}">
                <a href="{{ route('admin.website.setting') }}"><i class="bi bi-globe me-2"></i> PENGATURAN WEBSITE</a>
            </li>
            <li class="{{ Request::segment(2) =='slides' ? 'active' : '' }}">
                <a href="{{ route('admin.website.slide') }}"><i class="bi bi-images me-2"></i> SLIDE</a>
            </li>
            <div class="menu-name">AKUN</div>
            <li class="{{ Request::segment(2) =='pengaturan' ? 'active' : '' }}">
                <a href="{{ route('admin.setting') }}"><i class="bi bi-gear me-2"></i> PENGATURAN</a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-left me-2"></i> KELUAR</a>
            </li>
        </ul>
    </div>
</aside>

@push('script')
    <script>
        const active = $('.menus').find('.active').offset();
        $('.menus').scrollTop(active.top - 200);
    </script>
@endpush