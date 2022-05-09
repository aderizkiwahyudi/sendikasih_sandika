<x-app-layout>
    
    <div id="content-wrapper">
        
        <x-app-admin-aside></x-app-admin-aside>
        
        <main>
        
            <x-app-admin-navigation></x-app-admin-navigation>
            
            <div class="content">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>BERITA</h4>
                    <div>
                        <a href="#" class="btn btn-success">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="users-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </main>
    </div>

    

</x-app-layout>