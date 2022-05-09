<x-app-layout>
    
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/academic-dashboard.css') }}">
        <style>
            .form-control {
                pointer-events: none;
            }
        </style>
    @endpush

    <x-app-header-academic></x-app-header-academic>

    <main>
        <div class="container">
            <div class="row">

                <x-app-aside-academic></x-app-aside-academic>
                
                <div class="col-md-8">
                    <div>
                        <h5 class="mb-1">Data Pribadi</h5>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Data Pribadi</span>
                        </nav>
                    </div>
                    <div class="content-body">
                        <div class="alert alert-warning">
                            Jika terdapat kesalahan data, silakan hubungi admin untuk melakukan perubahan.
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box shadow-sm border">
                                    @if (Auth::guard('academic')->user()->student)
                                        @include('academic.personal.student')                                        
                                    @elseif (Auth::guard('academic')->user()->teacher)
                                        @include('academic.personal.teacher')                                        
                                    @else 
                                        @include('academic.personal.staff')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>