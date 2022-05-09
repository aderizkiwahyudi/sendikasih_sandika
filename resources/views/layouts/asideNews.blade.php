<ul>
    <li class="{{ Request::segment(1) == 'berita' ? 'active' : '' }}"><a href="{{ url('berita') }}">Berita</a></li>
    <li class="{{ Request::segment(1) == 'kategori' && Request::segment(2) == 'beasiswa' ? 'active' : '' }}"><a href="{{ url('kategori/beasiswa') }}">Beasiswa</a></li>
    <li class="{{ Request::segment(1) == 'galeri' ? 'active' : '' }}"><a href="{{ url('galeri') }}">Galeri</a></li>
    <li class="{{ Request::segment(1) == 'kategori'  && Request::segment(2) == 'akademik' ? 'active' : '' }}"><a href="{{ url('kategori/akademik') }}">Akademik</a></li>
    <li class="{{ Request::segment(1) == 'kategori'  && Request::segment(2) == 'nonakademik' ? 'active' : '' }}"><a href="{{ url('kategori/nonakademik') }}">Non Akademik</a></li>
    <li class="{{ Request::segment(1) == 'kategori'  && Request::segment(2) == 'publikasi-karya' ? 'active' : '' }}"><a href="{{ url('kategori/publikasi-karya') }}">Publikasi Karya</a></li>
</ul>