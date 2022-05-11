<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @endpush

    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{!Request::query('unit') ? 'active' : ''}}" href="{{ route('admin.recruitment', [Request::segment(3)]) }}">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::query('unit') == 'mi' ? 'active' : ''}}" href="{{ route('admin.recruitment', [Request::segment(3), 'unit' => 'mi']) }}">MI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::query('unit') == 'smp' ? 'active' : ''}}" href="{{ route('admin.recruitment', [Request::segment(3), 'unit' => 'smp']) }}">SMP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::query('unit') == 'sma' ? 'active' : ''}}" href="{{ route('admin.recruitment', [Request::segment(3), 'unit' => 'sma']) }}">SMA</a>
                    </li>
                </ul>
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>DAFTAR PESERTA {{ strtoupper(Request::segment(3)) }}</h4>
                    {{-- <div>
                        <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-kategori">+ Tambah</a>
                        <!-- Modal -->
                        <div class="modal fade text-dark" id="tambah-kategori" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="text-dark mb-2">Nama</label>
                                                <input type="text" class="form-control" name="name" placeholder="Masukan nama kategori" required/>
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
                    </div> --}}
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>No. Reg</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
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
                    ajax: '{!! route('admin.recruitment.data', ['role' => Request::segment(3), 'unit' => Request::query('unit') ?? '']) !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'photo', name: 'photo' },
                        { data: 'no_registration', name: 'no_registration' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    columnDefs: [
                        {
                            "targets": 0,
                            "className": "text-center",
                            "width": "5%",
                        },
                        {
                            "targets": 1,
                            "className": "text-center",
                            "width": "10%",
                        },
                        {
                            "targets": 2,
                            "className": "text-center",
                            "width": "15%",
                        },
                        {
                            "targets": 4,
                            "width": "25%",
                        },
                        {
                            "targets": 5,
                            "className": "text-center",
                            "width": "10%",
                        },
                        {
                            "targets": 6,
                            "className": "text-center",
                            "width": "5%",
                        }
                    ],
                });
            });
        </script>
    @endpush    

</x-app-layout>