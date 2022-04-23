<x-app-layout>
    
    <x-app-header></x-app-header>
    
    <section class="breadcrumb" style="background-image: url('{{ $news->thumbnail }}')">
        <div class="container">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="/">Home</a>
                <a class="breadcrumb-item" href="{{ url('berita') }}">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</a>
                <span class="breadcrumb-item active">{{ $news->title }}</span>
            </nav>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 aside">
                    <x-app-aside-news></x-app-aside-news>
                </div>
                <div class="col-md-9">
                    <h2>{{ $news->title }}</h2>
                    <p class="news-info">
                        {!! $news->category->name == 'Berita' ? '' : '<a href="' . url('kategori/' . $news->category->slug) . '">' . $news->category->name . '</a> | ' !!}
                        {{ tanggal_berita($news->created_at) }} ditulis oleh admin
                    </p>
                    <img src="{{ $news->thumbnail }}" alt="Gambar" width="100%"/>
                    <div class="article-text my-3">
                        {!! $news->text !!}
                    </div>
                    <div class="more-news mt-5">
                        <h5 class="mb-3">Mungkin anda tertarik dengan :</h5>
                        <div class="row">
                            @forelse ($news_more as $item)
                                <div class="col-md-4">
                                    <div class="card card-news-item">
                                        <img src="{{ $item->thumbnail }}" alt="Gambar"/>
                                        <div class="card-body">
                                            <h4><a href="{{ url('berita/' . $item->slug) }}">{{ $item->title }}</a></h4>
                                            <p class="info">
                                                {!! $item->category->name == 'Berita' ? '' : '<a href="' . url('kategori/' . $item->category->slug) . '">' . $item->category->name . '</a> | ' !!}
                                                {{ tanggal_berita($item->created_at) }}
                                            </p>
                                            <p>{{ htmlspecialchars(strip_tags(substr($item->text, 0, 150))) }}</p>
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
        </div>
    </section>

    <x-app-footer></x-app-footer>

</x-app-layout>