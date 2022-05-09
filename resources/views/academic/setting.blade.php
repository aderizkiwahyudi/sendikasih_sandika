<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/academic-dashboard.css') }}">
    @endpush

    <x-app-header-academic></x-app-header-academic>

    <main>
        <div class="container">
            <div class="row">

                <x-app-aside-academic></x-app-aside-academic>
                
                <div class="col-md-8">
                    <div>
                        <h5 class="mb-1">Pengaturan</h5>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Pengaturan</span>
                        </nav>
                    </div>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-8">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <div class="box shadow-sm border">
                                    <form method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" class="form-control" placeholder="Masukan nama anda" name="name" value="{{ Auth::guard('academic')->user()->student->name ??  Auth::guard('academic')->user()->teacher->name ??  Auth::guard('academic')->user()->staff->name ?? '' }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" class="form-control" placeholder="Masukan username anda" name="username" value="{{ Auth::guard('academic')->user()->username }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" placeholder="Masukan email anda" name="email" value="{{ Auth::guard('academic')->user()->email }}" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" placeholder="Masukan password anda" name="password"/>
                                            <small class="text-danger">Kosongkan jika tidak ingin mengubah password</small>
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>