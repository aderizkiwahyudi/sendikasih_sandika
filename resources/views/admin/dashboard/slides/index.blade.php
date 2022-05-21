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
                        <a href="{{ route('admin.website.slide.add') }}" class="btn btn-success">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
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
                    ajax: '{!! route('admin.slides') !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'photo', name: 'photo' },
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
                            "className": "text-center",
                            "width": "20%",
                        }
                    ],
                });
            });
        </script>
    @endpush    

</x-app-layout>