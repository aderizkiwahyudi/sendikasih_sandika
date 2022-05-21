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
                <div class="border p-4 rounded">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="label mb-2"><small>Foto</small></label>
                            <input type="file" name="photo" class="form-control"/>
                            @if (isset($slide))
                                <img src="{{ $slide->image }}" alt="Slides" width="30%" class="mt-3"/>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="label mb-2"><small>Keterangan</small></label>
                            <textarea name="description" class="form-control" id="texteditor">{{ $slide->description ?? '' }}</textarea>
                        </div>
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    @push('script')
        <script src="{{ asset('plugin/ckeditor/build/ckeditor.js') }}"></script>
        <script src="{{ asset('plugin/ckeditor/build/myUploadAdapter.js') }}"></script>
        <script>
            ClassicEditor
            .create( document.querySelector( '#texteditor' ), {
                extraPlugins: [ MyCustomUploadAdapterPlugin ],
            } )
            .catch( error => {
                console.log( error );
            } );
        </script>
    @endpush

</x-app-layout>