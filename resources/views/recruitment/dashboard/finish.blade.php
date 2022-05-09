<x-app-layout title="Penerimaan Yayasan Sendikasih Sandika">
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/recruitment-dashboard.css') }}">
    @endpush

    <x-app-recruitment-header></x-app-recruitment-header>
    
    <main>
        @if (Auth::guard('recruitment')->user()->recruitment->result == 0)
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
                        <li class="finish">
                            <div class="step-number">✓</div>
                            <div class="step-content">
                                <h4>Konfirmasi Data</h4>
                                <small>Konfirmasi Data</small>
                            </div>
                            <div class="step-border"></div>
                        </li>
                        <li class="active">
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
                        <h5>Selesai!</h5>
                        <p>Pendaftaran anda telah selesai, data yang anda kirim akan di cek terlebih dahulu. Untuk informasi selanjutnya silakan cari informasi melalui website resmi Yayasan Sendikah Sandika. Terimakasih.</p>
                    </div>
                    <div>
                        <a href="{{ route('recruitment.finish') }}" class="btn btn-primary">Refresh</a>
                    </div>
                </div>

            </div>
        @else
        <div class="breadcrumb-container">
            <h1>Pengumuman</h1>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="#">Dashboard</a>
                <a class="breadcrumb-item" href="#">Pendaftaran</a>
                <span class="breadcrumb-item active">Pengumuman</span>
            </nav>
        </div>

        <div class="main-body border">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ Auth::guard('recruitment')->user()->student->photo ?? Auth::guard('recruitment')->user()->teacher->photo ??  Auth::guard('recruitment')->user()->staff->photo ?? '' }}" width="100%" alt="">
                </div>
                <div class="col-md-10">
                    <h5>Biodata</h5>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-2">No Pendaftaran</div>
                        <div class="col-md-7">{{ Auth::guard('recruitment')->user()->recruitment->no_registration ?? '' }}</div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-2">Nama</div>
                        <div class="col-md-7">{{ Auth::guard('recruitment')->user()->student->name ?? Auth::guard('recruitment')->user()->teacher->name ??  Auth::guard('recruitment')->user()->staff->name ?? '' }}</div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-2">Jenis Kelamin</div>
                        <div class="col-md-7" style="text-transform: capitalize;">{{ Auth::guard('recruitment')->user()->student->gender ?? Auth::guard('recruitment')->user()->teacher->gender ??  Auth::guard('recruitment')->user()->staff->gender ?? '' }}</div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-2">Tempat & Tanggal Lahir</div>
                        <div class="col-md-7" style="text-transform: capitalize;">
                            {{ 
                                Auth::guard('recruitment')->user()->student->birthday_at ?? Auth::guard('recruitment')->user()->teacher->birthday_at ??  Auth::guard('recruitment')->user()->staff->birthday_at ?? ''
                            }}, 
                            {{
                                Auth::guard('recruitment')->user()->student->birthday ?? Auth::guard('recruitment')->user()->teacher->birthday ??  Auth::guard('recruitment')->user()->staff->birthday ?? '' 
                            }}
                        </div>
                    </div>
                    <div class="form-grup row align-items-center mb-2">
                        <div class="col-md-2">No. Handphone</div>
                        <div class="col-md-7">{{ Auth::guard('recruitment')->user()->student->phone ?? Auth::guard('recruitment')->user()->teacher->phone ??  Auth::guard('recruitment')->user()->staff->phone ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-4">
                    @if (Auth::guard('recruitment')->user()->recruitment->result == 1)
                        <div class="alert alert-success">
                            <strong>Selamat!</strong> anda dinyatakan lolos seleksi penerimaan {{ Auth::guard('recruitment')->user()->unit_id == 1 ? 'Guru & Karyawan' : 'Peserta Didik' }} Yayasan Sendikasih Sandika. Silakan lakukan pendaftaran ulang secara offline di Yayasan Sendikasih Sandika. 
                        </div>
                        <a href="{{ route('recruitment.print') }}" class="btn btn-primary"><i class="bi bi-printer"></i> Cetak Kartu Pendaftaran</a>
                    @else 
                        <div class="alert alert-danger">
                            <strong>Mohon Maaf,</strong> anda dinyatakan tidak lolos seleksi penerimaan {{ Auth::guard('recruitment')->user()->unit_id == 1 ? 'Guru & Karyawan' : 'Peserta Didik' }} Yayasan Sendikasih Sandika. Tetap semangat dan jangan menyerah. 
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </main>

    <x-app-recruitment-footer></x-app-recruitment-footer>

</x-app-layout>