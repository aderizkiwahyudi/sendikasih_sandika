<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/academic-dashboard.css') }}">
    @endpush

    <x-app-header-academic></x-app-header-academic>

    <main>
        <div class="container">
            <div class="row">

                <x-app-aside-academic></x-app-aside-academic>
                
                <div class="col-md-8">
                    <div>
                        <h5 class="mb-1">Dashboard</h5>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Dashboard</span>
                        </nav>
                    </div>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box shadow-sm border mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <div class="icon-active text-success">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="headline">STATUS</h5>
                                            <p class="mb-0">AKTIF</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box shadow-sm border">
                                    <table border="0">
                                        <tr>
                                            <td>Nama</td>
                                            <td class="px-2">:</td>
                                            <td>{{ Auth::guard('academic')->user()->student->name ?? Auth::guard('academic')->user()->teacher->name ?? Auth::guard('academic')->user()->staff->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit</td>
                                            <td class="px-2">:</td>
                                            <td>{{ Auth::guard('academic')->user()->unit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td class="px-2">:</td>
                                            <td>
                                                {{ Auth::guard('academic')->user()->student ? 'Siswa' : (Auth::guard('academic')->user()->teacher ? 'Guru' : 'Staff') }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box shadow-sm border mb-4">
                                    <div class="align-items-center">
                                        <div>
                                            <h5 class="headline">Tahun Ajaran</h5>
                                            <p class="mb-0">{{ $setting->year->name }} - Semester {{ $setting->year->status }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::guard('academic')->user()->student)
                                    <div class="box shadow-sm border">
                                        <div>
                                            <h5 class="mb-0">Keungan Pribadi</h5>
                                            <small>Keuangan yang belum dibayar</small>
                                        </div>
                                        
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>