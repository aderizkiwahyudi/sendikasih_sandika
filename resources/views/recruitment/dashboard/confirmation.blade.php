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
                    <li class="finish">
                        <div class="step-number">✓</div>
                        <div class="step-content">
                            <h4>Pengisian Biodata</h4>
                            <small>Isi Biodata Diri Anda</small>
                        </div>
                        <div class="step-border"></div>
                    </li>
                    <li class="finish">
                        <div class="step-number">✓</div>
                        <div class="step-content">
                            <h4>Unggah Foto</h4>
                            <small>Unggah Foto Anda</small>
                        </div>
                        <div class="step-border"></div>
                    </li>
                    <li class="active">
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
            <div>
                <div class="main-form">
                    <h5>Konfirmasi?</h5>
                    <p>Apakah anda sudah yakin dengan semua data yang sudah di masukan? Setelah anda melakukan konfirmasi data, maka data tidak akan bisa diubah lagi. Jika anda merasa yakin, silakan untuk menekan tombol konfirmasi.</p>
                </div>
                <div>
                    <a href="{{ route('recruitment.confirmation.prosess') }}" class="btn btn-primary">Konfirmasi</a>
                    <a href="{{ route('recruitment.photo') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>

        </div>
    </main>

    <x-app-recruitment-footer></x-app-recruitment-footer>

</x-app-layout>