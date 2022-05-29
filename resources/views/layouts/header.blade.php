<div class="background-navigation"></div>
<header>
    <div class="header container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('img/logo-white.png') }}" alt="Logo" width="110px"/>
                </a>
            </div>
            <a href="javascript:void(0)" class="bars text-white"><i class="bi bi-list"></i></a>
            <div class="navigation">
                <nav>
                    <ul>
                        <li class="active">
                            <a href="/"><i class="bi bi-house-door-fill"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">PROFILE</a>
                            <ul class="submenu">
                                <li><a href="{{ url('/halaman/tepak-sirih') }}">Tepak Sirih</a></li>
                                <li><a href="{{ url('/halaman/sejarah') }}">Sejarah</a></li>
                                <li><a href="{{ url('/halaman/visi-misi') }}">Visi & Misi</a></li>
                                <li><a href="{{ url('/halaman/lambang') }}">Lambang</a></li>
                                <li><a href="{{ url('/halaman/struktur-pimpinan') }}">Struktur Pimpinan</a></li>
                                <li><a href="{{ url('/halaman/lokasi-kantor-pusat') }}">Lokasi Kantor Pusat</a></li>
                                <li><a href="{{ url('/halaman/rencana-strategis') }}">Rencana Strategis</a></li>
                                <li><a href="{{ url('/halaman/perjanjian-kerja') }}">Perjanjian Kerja</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">UNIT TUGAS</a>
                            <ul class="submenu">
                                <li><a href="#">Tata Usaha</a></li>
                                <li><a href="https://mi.yayasansendikasihsandika.or.id/">MI Sendikasih Sandika</a></li>
                                <li><a href="https://smp.yayasansendikasihsandika.or.id/">MTS Sendikasih Sandika</a></li>
                                <li><a href="https://sma.yayasansendikasihsandika.or.id/">SMA Sendikasih Sandika</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">PRESTASI</a>
                            <ul class="submenu">
                                <li><a href="{{ url('kategori/akademik') }}">Akademik</a></li>
                                <li><a href="{{ url('kategori/nonakademik') }}">Non Akademik</a></li>
                                <li><a href="{{ url('kategori/publikasi-karya') }}">Publikasi Karya</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">PENGUMUMAN</a>
                            <ul class="submenu">
                                <li><a href="{{ url('kategori/beasiswa') }}">Beasiswa</a></li>
                                <li><a href="{{ url('berita') }}">Berita</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">PENERIMAAN</a>
                            <ul class="submenu">
                                <li><a href="{{ url('pendaftaran/peserta-didik') }}">MI/SMP/SMA</a></li>
                                <li><a href="{{ url('pendaftaran/guru-karyawan') }}">Guru & Karyawan</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('galeri') }}">GALERI</a>
                        </li>
                        <li class="mobile-display">
                            <a href="{{ url('masuk') }}">MASUK</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-login">
                <a href="{{ url('masuk') }}" class="btn btn-login">MASUK</a>
            </div>
        </div>
    </div>
</header>

@push('script')
<script>
    $('.bars').on('click', () => {
        $('.background-navigation').show();
        $('.header').find('.navigation').show();
    })
    
    $('.background-navigation').on('click', () => {
        $('.header').find('.navigation').addClass('navigation-out');
        setTimeout(() => {
            $('.header').find('.navigation').removeClass('navigation-out');
            $('.header').find('.navigation').hide();
            $('.background-navigation').hide();
        }, 350);
    })

    headerFixed($(window).scrollTop());

    $(window).scroll(function(){
        let scroll = $(this).scrollTop();
        headerFixed(scroll);
    });

    function headerFixed(scroll){
        if(scroll > 100){
            $('header').addClass('header-fixed header-fixed-remove');
        }else if(scroll < 100){
            $('header').removeClass('header-fixed');
        }
    }
</script>
@endpush