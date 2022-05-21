<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @endpush

    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                <form method="post" action="{{ route('admin.contribution.filter', $id) }}">
                    @csrf
                    <div class="fiter row align-items-center">
                        <div class="col-md-3 mb-3">Tahun Akademik :</div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <select name="year" id="year" class="form-control">
                                    <option value="">Pilih Tahun Akademik</option>
                                    @foreach ($year as $item)
                                        <option value="{{ $item->name }}" {{ $yearNow->name == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <select name="semester" id="year" class="form-control">
                                    <option value="">Pilih Semester Akademik</option>
                                    <option value="Ganjil" {{ $yearNow->status == 'Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                    <option value="Genap" {{ $yearNow->status == 'Genap' ? 'selected' : '' }}>Semester Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button type="submit" class="btn btn-primary">FILTER</button>
                        </div>
                    </div>
                </form>
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
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>PEMBAYARAN {{$pageName}}</h4>
                    <div>
                        <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-kategori">+ Tambah</a>
                        <!-- Modal -->
                        <div class="modal fade text-dark" id="tambah-kategori" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Nama</label>
                                                <input type="text" class="form-control" name="name" placeholder="Masukan nama" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Keterangan</label>
                                                <input type="text" class="form-control" name="description" placeholder="Masukan keterangan" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Nominal</label>
                                                <input type="text" class="form-control" name="nominal" placeholder="Masukan nominal" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Dibuat pada tanggal</label>
                                                <input type="date" class="form-control" name="created_at" value="{{ date('Y-m-d') }}" required/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Dibuat pada tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </main>
    </div>

    @push('script')
        <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/rupiah.js') }}"></script>
        <script>
            $(function() {

                $('input[name="nominal"]').on('keyup', function(){
                    $(this).val(rupiah($(this).val()));
                });
                
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.contribution.data', [$id, "y" => Request::query("y") ?? ""]) !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'description', name: 'description' },
                        { data: 'nominal', name: 'nominal' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    columnDefs: [
                        {
                            "targets": 0,
                            "className": "text-center",
                            "width": "5%",
                        },
                        {
                            "targets": 2,
                            "width": "20%",
                        },
                        {
                            "targets": 3,
                            "className": "text-center",
                            "width": "10%",
                        },
                        {
                            "targets": 4,
                            "className": "text-center",
                        },
                        {
                            "targets": 5,
                            "className": "text-center",
                            "width": "15%",
                        }
                    ],
                });
            });
        </script>
    @endpush    

</x-app-layout>