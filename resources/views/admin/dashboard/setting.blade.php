<x-app-layout>

    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        Terdapat kesalahan untuk menyimpan data :
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>PENGATURAN AKUN</h4>
                            <div>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">USERNAME</label>
                                    <input type="text" class="form-control" name="username" value="{{ Auth::guard('admin')->user()->username }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">EMAIL</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::guard('admin')->user()->email }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-1">PASSWORD</label>
                                    <input type="password" class="form-control" name="password"/>
                                    <small class="text-danger">*Kosongkan jika tidak ingin mengubah</small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</x-app-layout>