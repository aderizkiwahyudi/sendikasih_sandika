<x-app-layout title="Penerimaan Yayasan Sendikasih Sandika">
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/recruitment-dashboard.css') }}">
    @endpush

    <x-app-recruitment-header></x-app-recruitment-header>
    
    <main>
        <div class="breadcrumb-container">
            <h1>Pendaftaran</h1>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="#">Dashboard</a>
                <a class="breadcrumb-item" href="#">Pendaftaran</a>
                <span class="breadcrumb-item active">Pengisian Biodata</span>
            </nav>
        </div>
        
        <div class="main-body border">
            <div class="step-container">
                <ul class="step">
                    <li class="active">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Pengisian Biodata</h4>
                            <small>Isi Biodata Diri Anda</small>
                        </div>
                        <div class="step-border"></div>
                    </li>
                    <li>
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Unggah Foto</h4>
                            <small>Unggah Foto Anda</small>
                        </div>
                        <div class="step-border"></div>
                    </li>
                    <li>
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Konfirmasi Data</h4>
                            <small>Konfirmasi Data</small>
                        </div>
                        <div class="step-border"></div>
                    </li>
                    <li>
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Selesai</h4>
                            <small>Pendaftaran Selesai</small>
                        </div>
                    </li>
                </ul>
            </div>

            @if (Auth::guard('recruitment')->user()->student)
                @include('recruitment.dashboard.biodata.student')
            @elseif(Auth::guard('recruitment')->user()->teacher)
                @include('recruitment.dashboard.biodata.teacher')
            @else 
                @include('recruitment.dashboard.biodata.staff')
            @endif

        </div>
    </main>
    
    <x-app-recruitment-footer></x-app-recruitment-footer>

</x-app-layout>