<ul>
    <li class="{{ Request::segment(2) == 'tepak-sirih' ? 'active' : '' }}"><a href="{{ url('/halaman/tepak-sirih') }}">Tepak Sirih</a></li>
    <li class="{{ Request::segment(2) == 'sejarah' ? 'active' : '' }}"><a href="{{ url('/halaman/sejarah') }}">Sejarah</a></li>
    <li class="{{ Request::segment(2) == 'visi-misi' ? 'active' : '' }}"><a href="{{ url('/halaman/visi-misi') }}">Visi & Misi</a></li>
    <li class="{{ Request::segment(2) == 'lambang' ? 'active' : '' }}"><a href="{{ url('/halaman/lambang') }}">Lambang</a></li>
    <li class="{{ Request::segment(2) == 'struktur-pimpinan' ? 'active' : '' }}"><a href="{{ url('/halaman/struktur-pimpinan') }}">Struktur Pimpinan</a></li>
    <li class="{{ Request::segment(2) == 'lokasi-kantor-pusat' ? 'active' : '' }}"><a href="{{ url('/halaman/lokasi-kantor-pusat') }}">Lokasi Kantor Pusat</a></li>
    <li class="{{ Request::segment(2) == 'rencana-strategis' ? 'active' : '' }}"><a href="{{ url('/halaman/rencana-strategis') }}">Rencana Strategis</a></li>
    <li class="{{ Request::segment(2) == 'perjanjian-kerja' ? 'active' : '' }}"><a href="{{ url('/halaman/perjanjian-kerja') }}">Perjanjian Kerja</a></li>
</ul>