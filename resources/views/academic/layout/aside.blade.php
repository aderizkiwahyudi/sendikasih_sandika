<div class="col-md-4">
    <div class="profile shadow-sm border d-flex align-items-center">
        <div class="photo">
            <img src="{{ Auth::guard('academic')->user()->student->photo ?? Auth::guard('academic')->user()->teacher->photo ?? Auth::guard('academic')->user()->staff->photo ?? '' }}" alt="Foto"/>
        </div>
        <div class="info">
            <p>{{ Auth::guard('academic')->user()->student->name ?? Auth::guard('academic')->user()->teacher->name ?? Auth::guard('academic')->user()->staff->name ?? '' }}</p>
            <small>{{ Auth::guard('academic')->user()->student ? 'NISN.' : 'NIP.' }} {{ Auth::guard('academic')->user()->student->nisn ?? Auth::guard('academic')->user()->teacher->nip ?? Auth::guard('academic')->user()->staff->nip ?? '00000000' }}</small>
        </div>
    </div>
    <div class="menus shadow-sm border">
        <ul>
            <li {{ Request::segment(2) == '' ? 'class=active' : '' }}>
                <a href="{{ route('academic.dashboard') }}">Dashboard</a>
            </li>
            @if (Auth::guard('academic')->user()->student)
                <li {{ Request::segment(2) == 'data-pribadi' ? 'class=active' : '' }}>
                    <a href="{{ route('academic.personal') }}">Data Pribadi</a>
                </li>
                <li {{ Request::segment(2) == 'keuangan-pribadi' ? 'class=active' : '' }}>
                    <a href="{{ route('academic.finance') }}">Informasi Keuangan Pribadi</a>
                </li>
            @endif
            <li {{ Request::segment(2) == 'pengaturan' ? 'class=active' : '' }}>
                <a href="{{ route('academic.setting') }}">Pengaturan</a>
            </li>
        </ul>
    </div>
    <div class="text-center mobile-none">
        <small>Yayasan Sendikasih Sandika © 2022</small>
    </div>
</div>