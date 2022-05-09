<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
    @endpush

    <div class="main">
        <aside class="shadow">
            <div class="login-wrapper row align-items-center justify-content-center">
                <div class="col-md-12">
                    <div class="mb-4">
                        <a href="{{ route('admin.login') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="100px"/>
                        </a>
                    </div>
                    <h5><strong>Login</strong></h5>
                    <p>Masukan akun untuk mengakses halaman selanjutnya</p>
                    <form method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Username atau Email</label>
                            <input type="text" class="form-control" name="username" placeholder="Masukan username atau email"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukan password"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">MASUK</button>
                        </div>
                        @if (Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ Session::get('failed') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </aside>
    </div>

</x-app-layout>