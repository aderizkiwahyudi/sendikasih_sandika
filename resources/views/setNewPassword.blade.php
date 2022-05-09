<x-app-layout title="Sistem Akademik">

    @push('styles')
        <link rel="stylesheet" href="css/recruitment-register-login.css">
    @endpush

    <div class="container">
        <main class="d-flex align-items-center justify-content-center">
            <div>
                <div class="main-header text-center">
                    <a href="/"><img src="{{ asset('img/logo.png') }}" alt="Logo" width="135px"/></a>
                    <div class="my-5">
                        <h4>SISTEM <strong>AKADEMIK</strong></h4>
                        <p>Masuk password baru anda untuk mengubah password lama</p>
                    </div>
                </div>
                @if (Session::has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('failed') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="main-body">
                    <form method="post">
                        @csrf
                        <div class="rounded border">
                            <div class="form-group">
                                <label for="">PASSWORD BARU</label>
                                <input type="password" name="password" placeholder="Masukan password baru anda" class="form-control-custom"/>
                            </div>
                            <div class="form-group">
                                <label for="">KONFIRMASI PASSWORD BARU</label>
                                <input type="password" name="repassword" placeholder="Masukan kembali password baru anda" class="form-control-custom"/>
                            </div>
                        </div>
                        <div class="form-group my-4">
                            <button type="submit" class="btn btn-primary w-100 py-3">SIMPAN</button>
                        </div>
                    </form>
                </div>
                <div class="main-footer">
                    <p>Yayasan Sendikasih Sandika © 2022</p>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>