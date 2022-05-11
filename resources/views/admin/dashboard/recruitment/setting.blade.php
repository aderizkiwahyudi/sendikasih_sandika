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
                            <h4>PENGATURAN PENERIMAAN</h4>
                            <div>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                @foreach ($setting as $item)
                                    <div class="form-group mb-3 d-flex align-items-center justify-content-between">
                                        <label for="" class="mb-1">{{ $item->unit_id == 1 ? 'PPDB MI' : ($item->unit_id == 2 ? 'PPDB SMP' : ($item->unit_id == 3 ? 'PPDB SMA' : 'PENERIMAAN GURU'))  }}</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="ppdb_{{ $item->unit_id }}" {{ $item->active == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <a href="{{ route('admin.recruitment.reset') }}" class="btn btn-danger" onclick="return confirm('Reset PPDB? Jika Ya, Semua data yang berkaitan dengan PPDB akan hilang.')">RESET PPDB</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</x-app-layout>