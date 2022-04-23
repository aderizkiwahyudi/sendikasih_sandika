<x-app-layout>
    
    <x-app-header></x-app-header>

    <section class="jumbotron">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>Selamat Datang di Website Resmi Yayasan Sendikasi Sandika</h2>
                    <a href="{{ url('halaman/sejarah') }}" class="btn btn-jumbotron">Tentang Kami</a>
                </div>
            </div>
        </div>
    </section>
    <section class="unit">
        <div class="container">
            <h4 class="headsection">Unit Tugas</h4>
            <p class="descsection">Yayasan Sendikasih Sandika memiliki beberapa unit tugas</p>
            <div class="row my-5">
                <div class="col-md-4 mb-4">
                    <div class="unit-box shadow-sm">
                        <div class="icon"><i class="bi bi-house"></i></div>
                        <h4>MI Sendikasih Sandika</h4>
                        <p>Madrasah Ibtidaiyah Yayasan Sendikasi Sandika merupakan pendidikan tingkat sekolah dasar.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="unit-box shadow-sm">
                        <div class="icon"><i class="bi bi-house"></i></div>
                        <h4>MTS Sendikasih Sandika</h4>
                        <p>Madrasah Tsanawiyah Yayasan Sendikasi Sandika merupakan pendidikan tingkat sekolah menengah pertama.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="unit-box shadow-sm">
                        <div class="icon"><i class="bi bi-house"></i></div>
                        <h4>SMA Sendikasih Sandika</h4>
                        <p>SMS Yayasan Sendikasi Sandika merupakan pendidikan tingkat sekolah menengah atas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card-news">
                        <h5><a href="{{ url('berita') }}" class="text-dark">BERITA</a></h5>
                        <h2>
                            Jelajah & Temukan Informasi terbaru Yayasan Sendikasih Sandika
                        </h2>
                        <a href="{{ url('berita') }}" class="readmore">LIHAT SELENGKAPNYA</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        @forelse ($news as $item)
                            <div class="col-md-6">
                                <div class="card card-news-item">
                                    <img src="{{ $item->thumbnail }}" alt="Gambar"/>
                                    <div class="card-body">
                                        <h4><a href="{{ url('berita/' . $item->slug) }}">{{ $item->title }}</a></h4>
                                        <p class="info">
                                            {!! $item->category->name == 'Berita' ? '' : '<a href="' . url('kategori/' . $item->category->slug) . '">' . $item->category->name . '</a> | ' !!}
                                            {{ tanggal_berita($item->created_at) }}
                                        </p>
                                        <p>{{ htmlspecialchars(strip_tags(substr($item->content, 0, 150))) }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Belum ada berita</p>
                        @endforelse 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ppdb">
        <div class="container">
            <div class="box">
                <h3>Pendaftaran Siswa & Siswi Baru Yayasan Sendikasi Sandika</h3>
                <p>Daftar menjadi peserta didik baru Yayasan Sendikasi Sandika</p>
                <a href="{{ url('ppdb/peserta-didik') }}" class="btn btn-ppdb">Daftar Sekarang</a>
            </div>
        </div>
    </section>

    <x-app-footer></x-app-footer>

</x-app-layout>