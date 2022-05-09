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
                    <li class="active">
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
            <div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="main-form">
                        <div class="alert alert-warning">
                            <strong>Perhatian!</strong> Gunakan ukuran foto 384px x 576px
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <strong>Terdapat kesalahan, berikut :</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="form-group form-group-input">
                            <span><i class="bi bi-upload"></i></span>
                            <input type="file" name="photo" id="photo" class="file-upload"/>
                        </div>
                        <div class="preview-image">
                            <img src="{{Auth::guard('recruitment')->user()->student->photo ?? Auth::guard('recruitment')->user()->teacher->photo ?? Auth::guard('recruitment')->user()->staff->photo ?? ''}}" width="100%"/>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('recruitment.dashboard') }}" class="btn btn-danger">Kembali</a>
                        @if (Auth::guard('recruitment')->user()->recruitment->step > 2)
                            <a href="{{ route('recruitment.confirmation') }}" class="btn btn-success">Selanjutnya</a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </main>
    
    @push('script')
        <script>
            $('#photo').on('change', function() {
                const src = URL.createObjectURL(this.files[0]);
                $('.preview-image').html(`<img src='${src}' width='100%'/>`);
            });
        </script>
    @endpush

    <x-app-recruitment-footer></x-app-recruitment-footer>

</x-app-layout>