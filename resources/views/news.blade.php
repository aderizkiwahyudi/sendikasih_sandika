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
                {{ Request::segment(2) ? '<a class="breadcrumb-item" href="/">' . ucwords(str_replace('-', ' ', Request::segment(2))) . '</a>' : '' }}
                <span class="breadcrumb-item active" href="{{ url('berita') }}">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</span>
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
                    @forelse ($news as $item)
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <img src="{{ $item->thumbnail }}" alt="Gambar" width="100%"/>
                            </div>
                            <div class="col-md-9">
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
                        <p>Belum ada informasi</p>
                    @endforelse
                    {!! $news->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </section>
    <x-app-footer></x-app-footer>
</x-app-layout>