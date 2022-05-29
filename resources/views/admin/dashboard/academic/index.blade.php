<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @endpush

    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                @if (auth('admin')->user()->unit_id == 1)
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                            <a class="nav-link {{Request::segment(4) == 'semua' ? 'active' : ''}}" href="{{ route('admin.users.academic', [Request::segment(3), 'semua']) }}">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::segment(4) == 'mi' ? 'active' : ''}}" href="{{ route('admin.users.academic', [Request::segment(3), 'mi']) }}">MI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::segment(4) == 'smp' ? 'active' : ''}}" href="{{ route('admin.users.academic', [Request::segment(3), 'smp']) }}">SMP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::segment(4) == 'sma' ? 'active' : ''}}" href="{{ route('admin.users.academic', [Request::segment(3), 'sma']) }}">SMA</a>
                        </li>
                    </ul>
                @endif
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>DAFTAR {{strtoupper(Request::segment(3))}}</h4>
                    <div>
                        <a href="{{ route('admin.users.academic.add', [Request::segment(3), Request::segment(4)]) }}" class="btn btn-success">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>{{ Request::segment(3) == 'siswa' ? 'NISN' : 'NIP' }}</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Unit</th>
                                <th>Kelas</th>
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
                    ajax: '{!! route('admin.users.academic.data', [Request::segment(3), Request::segment(4)]) !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'photo', name: 'photo' },
                        { data: 'nomor_induk', name: 'nomor_induk' },
                        { data: 'name', name: 'name' },
                        { data: 'status', name: 'status' },
                        { data: 'unit', name: 'unit' },
                        { data: 'class', name: 'class' },
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
                            "width": "20%",
                        },
                        {
                            "targets": 4,
                            "className": "text-center",
                            "width": "5%",
                        },
                        {
                            "targets": 5,
                            "className": "text-center",
                            "width": "10%",
                        },
                        {
                            "targets": 6,
                            "className": "text-center",
                            "width": "10%",
                        }
                    ],
                });
            });
        </script>
    @endpush    

</x-app-layout>