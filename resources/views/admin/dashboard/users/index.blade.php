<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @endpush

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
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>{{ strtoupper(str_replace('-', ' ', Request::segment(3))) }}</h4>
                    <div>
                        <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-struktur">+ Tambah</a>
                        <!-- Modal -->
                        <div class="modal fade text-dark" id="tambah-struktur" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" action="{!! route('admin.users.admin.add') !!}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Masukan username" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Masukan email" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="********" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Unit</label>
                                                <select name="unit_id" id="" class="form-control">
                                                    <option value="">Pilih Unit</option>
                                                    {{-- <option value="1">Yayasan Sendikasih Sandika</option> --}}
                                                    <option value="2">MI Sendikasih Sandika</option>
                                                    <option value="3">SMP Sendikasih Sandika</option>
                                                    <option value="4">SMA Sendikasih Sandika</option>
                                                </select>
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
                                <th>Username</th>
                                <th>Unit</th>
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
        <script>
            $(function() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.users.data') !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'username', name: 'username' },
                        { data: 'unit', name: 'unit' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    columnDefs: [
                        {
                            "targets": 0,
                            "className": "text-center",
                            "width": "5%",
                        },
                        {
                            "targets": 3,
                            "className": "text-center",
                            "width": "20%",
                        }
                    ],
                });
            });
        </script>
    @endpush    

</x-app-layout>