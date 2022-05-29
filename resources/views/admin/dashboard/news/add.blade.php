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
        
        <main class="w-100">
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content content-editor">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}"/>
                    <div class="form-group form-header mb-4">
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <input type="text" value="{{ old('title', $news->title ?? '') }}" class="form-control" name="title" placeholder="Apa yang ingin anda tulis hari ini?"/>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
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
                                <textarea name="content" id="editor">{{ old('content', $news->content ?? '') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="p-3">
                                        <input type="file" name="thumbnail" class="form-control"/>
                                        <div class="img-view">
                                            @if (isset($news->thumbnail))
                                                <img src="{{ $news->thumbnail }}" alt="Thumbnail" class="mt-3" width="100%"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="bg-light border-bottom p-3 d-flex align-items-center justify-content-between">
                                        <h5 class="m-0">Kategori</h5>
                                        <!-- Button trigger modal -->
                                        <a href="javascript:void(0)">+</a>
                                    </div>
                                    <div class="p-3">
                                        <select name="category" id="caategory" class="form-control">
                                            <option value="1">Pilih Kategori</option>
                                            @foreach ($categories->filter(function($item){ return $item->unit_id == auth('admin')->user()->unit_id; }) as $category)
                                                @if ($category->name != 'Berita')
                                                    <option value="{{ $category->id }}" {{ old('category', $news->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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