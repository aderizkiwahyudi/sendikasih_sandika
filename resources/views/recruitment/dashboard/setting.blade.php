<x-app-layout title="Penerimaan Yayasan Sendikasih Sandika">
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/recruitment-dashboard.css') }}">
    @endpush

    <x-app-recruitment-header></x-app-recruitment-header>
    
    <main>
        <div class="breadcrumb-container">
            <h1>Pengaturan</h1>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="#">Dashboard</a>
                <a class="breadcrumb-item" href="#">User</a>
                <span class="breadcrumb-item active">Pengaturan</span>
            </nav>
        </div>
        
        <div class="main-body border">
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
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ Auth::guard('recruitment')->user()->username }}" placeholder="Masukan username anda"/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ Auth::guard('recruitment')->user()->email }}" placeholder="Masukan email anda" disabled/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="mb-2">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="*********"/>
                            <small class="text-danger">Kosongkan jika tidak ingin mengubah</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
    <x-app-recruitment-footer></x-app-recruitment-footer>

</x-app-layout>