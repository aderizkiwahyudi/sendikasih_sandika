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
                            <div class="max-height-200 photo-user">
                                <img src="{{ $user->photo ?? "" }}" alt="Photo" width="100%"/>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>{{ strtoupper($user->name ?? '') }}</h5>
                                    <p>{{$user->account->student ? 'NISN.' : 'NIP.'}} {{ $user->nisn ?? $user->nip ??  '' }} · {{ $user->account->email }} · <span class="statusID">{{ strtoupper(get_status($user->status_id ?? '1')) }}</span></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex justify-content-end button-edit-delete">
                                        <a href="{{ route('admin.users.academic.edit', [Request::segment(3), Request::segment(4), $user->account->unit_id]) }}" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.users.academic.delete', [Request::segment(3), Request::segment(4)]) }}" class="btn btn-danger" onclick="return confirm(`Hapus Siswa?`)"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="bio-label">Tempat, Tanggal Lahir</small>
                                    <p>{{$user->birthday_at ?? ''}}, {{ date('d/m/Y', strtotime($user->birthday ?? "")) }}</p>
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
                                    <small class="bio-label">STATUS AKUN</small>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchUserStatus" {{ get_status($user->status_id ?? '1') == 'aktif' ? 'checked' : '' }}>
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
                            <a class="nav-link {{ Request::segment(5) == 'biodata' ? 'active' : '' }}" href="biodata" >BIODATA</a>
                        </li>
                        @if (Request::segment(3) == 'siswa')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(5) == 'detail' ? 'active' : '' }}" href="detail">KEUANGAN</a>
                            </li>
                        @endif
                    </ul>
                    <div class="my-0">
                        @if (Request::segment(5) == 'biodata')
                            <div class="p-4 border" style="border-top: 0px !important;">
                                @if (Request::segment(3) == 'guru')
                                    @include('admin.dashboard.academic.biodata.teacher')
                                @elseif(Request::segment(3) == 'staff')
                                    @include('admin.dashboard.academic.biodata.staff')
                                @else
                                    @include('admin.dashboard.academic.biodata.student')
                                @endif

                                @push('styles')
                                    <style>
                                        .main-form button, .main-form input[type='file'], .main-form small.text-danger, .main-form .form-group:nth-child(4), .main-form .form-group:nth-child(15) {
                                            display: none;
                                        }
                                        .main-form {
                                            text-transform: uppercase;
                                        }
                                        .main-form .username {
                                            text-transform: lowercase;
                                        }
                                    </style>
                                @endpush
                                @push('script')
                                    <script>
                                        const elInput = $('.main-form').find('input');
                                        for(e of elInput){
                                            $(e).replaceWith(`<div>${$(e).val()}</div>`);
                                        }

                                        const elSelect = $('.main-form').find('select');
                                        for(e of elSelect){
                                            $(e).replaceWith(`<div>${$(e).val()}</div>`);
                                        }

                                        const elTextArea = $('.main-form').find('textarea');
                                        for(e of elTextArea){
                                            $(e).replaceWith(`<div>${$(e).val()}</div>`);
                                        }
                                    </script>
                                @endpush
                            </div>
                        @elseif (Request::segment(3) == 'siswa')
                            <div class="my-3">
                                <div>
                                    <h5 class="mb-1">Keuangan Pribadi</h5>
                                </div>
                                <div class="content-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <form method="get">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2 mb-2">
                                                        <strong>Tahun :</strong>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <select name="tahun" class="form-control">
                                                            @foreach ($year as $item)
                                                                <option value="{{ $item->name }}" {{ $item->name == $yearNow ? 'selected' : '' }}>{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <select name="status" class="form-control">
                                                            <option value="ganjil" {{ strtolower($semester) == 'ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                                            <option value="genap" {{ strtolower($semester) == 'genap' ? 'selected' : '' }}>Semester Genap</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <div class="d-flex justify-content-between">
                                                            <button type="submit" class="btn btn-primary w-100 me-1">Cek</button>
                                                            <a href="print?tahun={{ $yearNow }}&status={{ strtolower($semester) }}" class="btn btn-success w-100"><i class="bi bi-printer"></i> Print</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                            @foreach ($contributions as $key => $contribution)
                                                <div class="box shadow-sm mb-4 border p-3">
                                                    <h5 class="mb-0">{{ $contribution->name }}</h5>
                                                    <small>{{ $contribution->description }}</small>
                                                    <table class="table table-stripped">
                                                        <thead>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Nama</td>
                                                                <td class="text-center">Keterangan</td>
                                                                <td class="text-center">Nominal</td>
                                                                <td class="text-center">Dibayar</td>
                                                                <td class="text-center">Status</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $contributionOnYear = $contribution->item->filter(function($val, $key) use ($year_id){
                                                                    return $val['year_id'] == $year_id;
                                                                });
            
                                                                #Pembayaran PPDB Hanya muncul satu kali ditahun pertama
                                                                if($key == 0){
                                                                    $contributionOnYear = $contribution->item->filter(function($val) use ($user){
                                                                        return $val['year_id'] == $user->year_id ?? 1;
                                                                    });
                                                                }
            
                                                                $lunas = 0;
                                                            ?>
                                                            @forelse ($contributionOnYear->values() as $i => $item)
                                                                <?php
                                                                    $sum = 0;
                                                                    foreach ($item->payment as $key => $payment) {
                                                                        $sum += $payment->nominal;
                                                                    }
            
                                                                    if($item->nominal == $sum) $lunas +=1;
                                                                ?>  
                                                                <tr class="vertical-align:middle;">
                                                                    <td>{{ $i + 1 }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>{{ $item->description }}</td>
                                                                    <td class="text-center">Rp{{ number_format($item->nominal,0,'.','.') }}</td>
                                                                    <td>Rp{{ number_format($sum,0,'.','.') }}</td>
                                                                    <td class="text-center">
                                                                            {!! $item->nominal == $sum ? '<small class="text-success">Lunas</small>' : '<small class="text-danger">Belum Lunas</small>'; !!}
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center">Belum ada data</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="4">Status Keseluruhan</td>
                                                                <td colspan="2" class="text-end">
                                                                    {!! count($contributionOnYear) == 0 ? '-' : (count($contributionOnYear) == $lunas ? '<small class="text-success">Lunas</small>' : '<small class="text-danger">Belum Lunas</small>'); !!}
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
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