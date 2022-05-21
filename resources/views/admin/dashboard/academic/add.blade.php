<x-app-layout>

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
                    <div class="col-md-12">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4>{{ Request::segment(5) == 'edit' ? 'EDIT' : 'TAMBAH' }} DATA {{ strtoupper(Request::segment(3)) }}</h4>
                            <div>
                               
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Request::segment(3) == 'guru')
                                @include('admin.dashboard.academic.biodata.teacher')
                            @elseif(Request::segment(3) == 'staff')
                                @include('admin.dashboard.academic.biodata.staff')
                            @else 
                                @include('admin.dashboard.academic.biodata.student')
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</x-app-layout>