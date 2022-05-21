<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <style>
            .card-body {
                position: relative;
            }
            .preview-user {
                position: absolute;
                top: 75px;
                left: 0;
                width: 100%;
                padding: 20px;
            }
            .preview-item {
                background: #fff;
                border: 1px solid #ddd;
            }
            .preview-user-item {
                display: flex;
                align-items: center;
                justify-content: left;
                border-top: 1px solid #ddd;
                padding: 15px;
            }
            .preview-user-item:nth-child(1){
                border: 0;
            }
            .preview-user-item .photo {
                width: 10%;
                background-size: cover;
                background-position: top;
                background-repeat: no-repeat;
            }
            .preview-user-item .name {
                width: 90%;
                padding-left:10px;
            }
            .preview-user-item .name p {
                margin: 0;
            }
            .preview-user-item .name small {
                font-size: 13px;
            }
            .preview-user-item:hover {
                cursor: pointer;
            }
        </style>
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
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>INFORMASI BIAYA</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="" class="mb-0"><small>Nama Biaya</small></label>
                                <p>{{ $contribution->name }}</p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="mb-0"><small>Keterangan</small></label>
                                <p>{{ $contribution->description }}</p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="mb-0"><small>Total</small></label>
                                <p>Rp.{{ number_format($contribution->nominal,0,'.','.') }}</p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="mb-0"><small>Dibuat pada tanggal</small></label>
                                <p>{{ tanggal($contribution->created_at) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>TAMBAH PEMBAYARAN</h4>
                        </div>
                        <div class="card-body">
                            <form id="form" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">NISN</label>
                                    <input type="text" name="nisn" class="form-control" placeholder="Masukan NISN" autocomplete="off"/>
                                    <div class="preview-user"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Tanggal Pembayaran</label>
                                    <input type="date" name="created_at" value="{{date('Y-m-d')}}" class="form-control" autocomplete="off"/>
                                    <div class="preview-user"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">NOMINAL</label>
                                    <input type="text" name="nominal" class="form-control" placeholder="Masukan Nominal"/>
                                </div>
                                <div class="form-group text-end">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h4>DAFTAR PEMBAYARAN</h4>
                                <small>Daftar pembayaran siswa yang baru ditambahkan</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
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

                $('input[name="nisn"]').on('keyup', function(){
                    $('.preview-user').html(`
                        <div class="preview-item">
                            <div class="preview-user-item">
                                Loading
                            </div>
                        </div>
                    `);

                    let val = $(this).val();
                    let template = '';
                    
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.users.search.active.data') }}?nisn=" + val,
                        success: function (response) {
                            if(response.length == 0){
                                template = '<div class="preview-item p-3">Siswa tidak ditemukan</div>';
                            }else{
                                response.forEach(e => {
                                    template  += `<div class="preview-item">
                                                    <div class="preview-user-item" data-nisn=${e.nisn}>
                                                        <div class="photo" style="background-image: url('${e.photo}')"></div>
                                                        <div class="name">
                                                            <p>${e.name}</p>
                                                            <small>${e.nisn}</small>
                                                        </div>
                                                    </div>
                                                </div>`;
                                });
                            }
                            $('.preview-user').html(template);
                            selectStudent();
                        }
                    });

                    function selectStudent(){
                        $('.preview-user-item').on('click', function(){
                            $('input[name="nisn"]').val($(this).data('nisn'));
                            $('.preview-user').html('');
                        })
                    }
                });
                
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.data.student.payment.contribution', Request::segment(4)) }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'id' },
                        { data: 'photo', name: 'photo' },
                        { data: 'name', name: 'name' },
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
                            "targets": 1,
                            "width": "10%",
                        },
                        {
                            "targets": 2,
                            "className": "text-center",
                            "width": "35%",
                        },
                        {
                            "targets": 3,
                            "className": "text-center",
                            "width": "10%",
                        },
                        {
                            "targets": 4,
                            "className": "text-center",
                            "width": "15%",
                        },
                        {
                            "targets": 5,
                            "className": "text-center",
                            "width": "10%",
                        }
                    ],
                });
            });
        </script>
    @endpush    

</x-app-layout>