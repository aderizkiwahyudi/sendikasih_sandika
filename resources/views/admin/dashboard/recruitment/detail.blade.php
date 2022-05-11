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
                                <img src="{{ $user->photo ?? '' }}" alt="Photo" width="100%"/>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>{{ strtoupper($user->name ?? '') }}</h5>
                                    <p>{{$user->student ? 'NISN.' : 'NIP.'}} {{ $user->nisn ?? $user->nip ?? '' }} · {{ $user->account->email }}</span></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.users.academic.edit', [Request::segment(3) == 'ppdb' || Request::segment(3) == 'ppdp' ? 'siswa' : Request::segment(3), $user->account->id, $user->account->unit_id]) }}" data-bs-toggle="modal" data-bs-target="#edit-'.$year->id.'" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.users.academic.delete', [Request::segment(3) == 'ppdb' || Request::segment(3) == 'ppdp' ? 'siswa' : Request::segment(3), $user->account->id]) }}" class="btn btn-danger" onclick="return confirm(`Hapus Data Pendaftaran?`)"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="bio-label">Tempat, Tanggal Lahir</small>
                                    <p>{{$user->birthday_at ?? ''}}, {{ date('d/m/Y', strtotime($user->birthday ?? '')) }}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="bio-label">JENIS KELAMIN</small>
                                    <p>{{ ucwords($user->gender ?? '')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="bio-label">UNIT</small>
                                    <p>{{ $user->account->unit_id == 1 ? 'Belum Memiliki Unit' : unit_name($user->account->unit_id)  }}</p>
                                </div>
                                <div class="col-md-3">
                                    <small class="bio-label">STATUS PENDAFTARAN</small>
                                    <div>
                                        {!! $user->recruitment->result == 0 ? '<span class="badge rounded-pill bg-warning text-dark">Pending</span>' : ($user->recruitment->result == 1 ? '<span class="badge rounded-pill bg-success text-white">Lolos</span>' : '<span class="badge rounded-pill bg-danger text-white">Tidak Lolos</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
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
                </div>
                <div class="menus-detail-user mt-3">
                    <div class="p-4 shadow-sm border rounded">
                        @if (Request::segment(3) == 'guru')
                            @include('admin.dashboard.recruitment.biodata.teacher')
                        @elseif(Request::segment(3) == 'staff')
                            @include('admin.dashboard.recruitment.biodata.staff')
                        @else
                            @include('admin.dashboard.recruitment.biodata.student')
                        @endif
                    </div>
                </div>
                <div class="p-3 rounded border mt-3">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <h5>HASIL PENDAFTARAN</h5>
                        <select name="result" class="form-control" id="result">
                            <option value="0" {{ $user->recruitment->result == 0 ? 'selected' : '' }}>Belum Bisa Ditentukan</option>
                            <option value="1" {{ $user->recruitment->result == 1 ? 'selected' : '' }}>Lulus</option>
                            <option value="2" {{ $user->recruitment->result == 2 ? 'selected' : '' }}>Tidak Lulus</option>
                        </select>
                        <div class="form-group text-end mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-3">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    @push('script')
    @endpush

</x-app-layout>