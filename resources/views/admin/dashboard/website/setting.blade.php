<x-app-layout>

    <div id="content-wrapper bg-white">

        <x-app-admin-aside></x-app-admin-aside>

        <main>

            <x-app-admin-navigation></x-app-admin-navigation>
                
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                Terdapat Kesalahan :
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>Pengaturan Website</h4>
                            <div>
                                {{-- <a href="#" class="btn btn-success">+ Tambah</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Facebook</label>
                                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $web->facebook }}" placeholder="Masukan url instagram"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Twitter</label>
                                    <input type="text" name="twitter" id="twitter" class="form-control" value="{{ $web->twitter }}" placeholder="Masukan url twitter"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Youtube</label>
                                    <input type="text" name="youtube" id="youtube" class="form-control" value="{{ $web->youtube }}" placeholder="Masukan url youtube"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Tahun Akademik</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="year" id="year" class="form-control">
                                                @foreach ($year as $item)
                                                    <option value="{{ $item->name }}" {{ $web->year_id == $item->id ? 'selected' : '' }}>{{ $item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="semester" id="semester" class="form-control">
                                                <option value="">Belum Ditentukan</option>
                                                <option value="ganjil" {{ $web->year->status == 'Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                                <option value="genap" {{ $web->year->status == 'Genap' ? 'selected' : '' }}>Semester Genap</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary px-5 w-100">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>

    </div>

</x-app-layout>