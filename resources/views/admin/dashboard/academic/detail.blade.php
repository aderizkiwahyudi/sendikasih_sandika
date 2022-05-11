<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @endpush

    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                <div class="p-4 shadow-sm border rounded">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="max-height-200">
                                <img src="{{ $user->student->photo ?? $user->teacher->photo ?? $user->staff->photo }}" alt="Photo" width="100%"/>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>{{ strtoupper($user->student->name ?? $user->teacher->name ?? $user->staff->name ?? '') }}</h5>
                                    <p>{{$user->student ? 'NISN.' : 'NIP.'}} {{ $user->student->nisn ?? $user->staff->nip ?? $user->staff->nip ??  '' }} · {{ $user->email }} · <span class="statusID">{{ strtoupper(get_status($user->student->status_id ?? $user->teacher->status_id ?? $user->staff->status_id ?? '1')) }}</span></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.users.academic.edit', [Request::segment(3), Request::segment(4), $user->unit_id]) }}" data-bs-toggle="modal" data-bs-target="#edit-'.$year->id.'" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.users.academic.delete', [Request::segment(3), Request::segment(4)]) }}" class="btn btn-danger" onclick="return confirm(`Hapus Siswa?`)"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="bio-label">Tempat, Tanggal Lahir</small>
                                    <p>{{$user->student->birthday_at ?? $user->teacher->birthday_at ?? $user->staff->birthday_at ?? ''}}, {{ date('d/m/Y', strtotime($user->student->birthday ?? $user->teacher->birthday ?? $user->staff->birthday)) }}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="bio-label">JENIS KELAMIN</small>
                                    <p>{{ ucwords($user->student->gender ?? $user->teacher->gender ?? $user->staff->gender ?? '')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="bio-label">UNIT</small>
                                    <p>{{ $user->unit_id == 1 ? 'Belum Memiliki Unit' : unit_name($user->unit_id)  }}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="bio-label">STATUS AKUN</small>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchUserStatus" {{ get_status($user->student->status_id ?? $user->teacher->status_id ?? $user->staff->status_id ?? '1') == 'aktif' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="switchUserStatus"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="alert" class="mt-3"></div>
                <div class="menus-detail-user mt-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link active" href="#">KEUANGAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BIODATA</a>
                        </li>
                    </ul>
                </div>
            </div>

        </main>
    </div>

    @push('script')
        <script>
            $('#switchUserStatus').on('change', function(){
                const btn = $(this);
                let statusID = $('.statusID').html();

                btn.attr('disabled', true);
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.users.academic.change.status', Request::segment(4)) }}",
                    success: function (response) {
                        btn.removeAttr('disabled');
                        if(response.success){
                            return $('#alert').html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                Berhasil mengubah status akun
                            </div>
                            `);
                            if(statusID == 'NONAKTIF'){ $('.statusID').html('AKTIF'); } else { $('.statusID').html('NONAKTIF'); }
                        }else{
                            return $('#alert').html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                Gagal mengubah status akun
                            </div>
                            `);
                        }
                    }
                });
            })
        </script>
    @endpush

</x-app-layout>