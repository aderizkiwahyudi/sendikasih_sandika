<x-app-layout>
    <x-app-header></x-app-header>
    <section class="breadcrumb">
        <div class="container">
            <h4 class="text-white">
                {{ ucwords(str_replace('-', ' ', Request::segment(1))) }}
                {{ Request::segment(2) ? ucwords(str_replace('-', ' ', Request::segment(2))) : '' }}
            </h4>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="/">Home</a>
                <a class="breadcrumb-item" href="/galeri">Galeri</a>
                {!! Request::segment(2) ? '<span class="breadcrumb-item active" href="' . url('berita') . '">' . ucwords(str_replace('-', ' ', Request::segment(2)))  . '</span>' : '' !!}
            </nav>
        </div>
    </section>
    @if (Request::segment(2))
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.min.css" integrity="sha512-OgbWuZ8OyVQxlWHea0T9Bdy1oDhs380WxLMaLZbuitQ/mdntHBPnApxbTebB9N5KoHZd3VMkk3G2cTY563nu5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.min.js" integrity="sha512-2HLzgJH7ZNywnEDB1HqijieFxszStt3QXS8Qk9m/VMUV/asMWlz9PmibHsvWIz9rtKOOr28z8zu1iJ3pf/TTHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                const gallery = new Viewer(document.getElementById('images'));
            });
        </script>
    @endpush

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 aside">
                    <x-app-aside-news></x-app-aside-news>
                </div>
                <div class="col-md-9">
                    <h2>{{ $gallery->title }}</h2>
                    <p class="info">{{ tanggal_berita($gallery->created_at) }}, ditulis oleh admin</p>
                    <div class="article-text my-3">
                        {!! $gallery->content !!}
                    </div>
                    <div class="row" id="images">
                        @forelse ($gallery->photos as $photo)
                            <div class="col-md-4">
                                <div class="gallery-image-item">
                                    <img src="{{ $photo->url }}" alt="{{ $photo->url }}" height="100%"/>
                                </div>
                            </div>    
                        @empty
                            <p>Tidak terdapat foto</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside">
                        <x-app-aside-news></x-app-aside-news>
                    </div>
                    <div class="col-md-9">
                        @forelse ($galleries as $item)
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <img src="{{ $item->photos[0]->url }}" alt="Gambar" width="100%"/>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h4><a href="{{ url('galeri/' . $item->slug) }}">{{ $item->title }}</a></h4>
                                        <p class="info">
                                            {{ tanggal_berita($item->created_at) }}
                                        </p>
                                        <p>{{ htmlspecialchars(strip_tags(substr($item->content, 0, 150))) }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Belum ada foto</p>
                        @endforelse
                        {!! $galleries->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </section>
    @endif
    <x-app-footer></x-app-footer>
</x-app-layout>