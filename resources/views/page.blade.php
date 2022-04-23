<x-app-layout>

    <x-app-header></x-app-header>
    
    <section class="breadcrumb">
        <div class="container">
            <h4 class="text-white">{{ $page->title ?? ucwords(str_replace('-', ' ', Request::segment(2))) }}</h4>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="/">Home</a>
                <a class="breadcrumb-item" href="#">Halaman</a>
                <span class="breadcrumb-item active">{{ $page->title ?? ucwords(str_replace('-', ' ', Request::segment(2))) }}</span>
            </nav>
        </div>
    </section>

    @if ($page)
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside">
                        <x-app-aside-page></x-app-aside-page>
                    </div>
                    <div class="col-md-9">
                        <h2>{{ $page->title }}</h2>
                        {{-- <p class="info">{{ tanggal_berita($page->created_at) }}, ditulis oleh admin</p> --}}
                        <div class="article-text my-3">
                            {!! $page->content !!}
                        </div>

                        @if (Request::segment(2) == 'struktur-pimpinan')                            
                            @forelse ($structures as $item)
                                <h5 class="">{{ $item->name }}</h5>
                                <div class="row justify-content-center">
                                    @foreach ($item->list as $list)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img src="{{$list->photo }}" alt="Photo" width="100%"/>
                                                <div class="card-footer text-center">
                                                    <p class="m-0">{{ $list->name }}</p>
                                                    <small>{{ $list->description }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @empty
                                <p>Belum terdapat struktur</p>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @else
        @push('styles')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">   
        @endpush

        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside">
                        <x-app-aside-page></x-app-aside-page>
                    </div>
                    <div class="col-md-9">
                        <h2>{{ ucwords(str_replace('-', ' ', Request::segment(2))) }}</h2>
                        <div class="article-text my-3">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tahun</th>
                                        <th>Keterangan</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->year }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td><a href="{{ $item->url }}"><i class="bi bi-file-earmark-pdf"></i>Download</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        @push('script')
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready( function () {
                    $('#myTable').DataTable();
                });
            </script>
        @endpush
    @endif

    <x-app-footer></x-app-footer>

</x-app-layout>