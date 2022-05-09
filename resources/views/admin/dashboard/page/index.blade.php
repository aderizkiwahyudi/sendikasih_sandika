<x-app-layout>
    
    @push('styles')
        <style>
            .breadcrumb-wrapper {
                display: none;
            }
            .content {
                margin-top: 40px;
            }
        </style>
    @endpush

    <div id="content-wrapper bg-white">
        
        <x-app-admin-aside></x-app-admin-aside>

        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}"/>
                    <div class="form-group form-header mb-4">
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <input type="text" value="{{ old('title', $page->title ?? '') }}" class="form-control" name="title" placeholder="Apa yang ingin anda tulis hari ini?"/>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
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
                                <textarea name="content" id="editor">{{ old('content', $page->content ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </main>
    </div>

    @push('script')
        <script src="{{ asset('plugin/ckeditor/build/ckeditor.js') }}"></script>
        <script src="{{ asset('plugin/ckeditor/build/myUploadAdapter.js') }}"></script>
        <script>
            ClassicEditor
            .create( document.querySelector( '#editor' ), {
                extraPlugins: [ MyCustomUploadAdapterPlugin ],
            } )
            .catch( error => {
                console.log( error );
            } );
        </script>
    @endpush    

</x-app-layout>