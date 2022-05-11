<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Classroom;
use App\Models\Gallery;
use App\Models\News;
use App\Models\PageFile;
use App\Models\Recruitment;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UnitNameStructure;
use App\Models\UnitStructureItem;
use App\Models\Year;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    private $unit_id;
    public function __construct()
    {
        $this->unit_id = 1;
    }

    public function category()
    {
        $categories = Category::where('unit_id', $this->unit_id)->where('id', '>', 4)->latest()->get();
        return DataTables::of($categories)
                        ->addIndexColumn()
                        ->addColumn('action', function($categories){
                            return 
                            '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-kategori-'. $categories->id .'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                            '<a href="'.route('admin.category.delete', $categories->id).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Kategori?`)" <i class="bi bi-trash"></i> Hapus</a>' .
                            '
                            <div class="modal fade text-dark" id="edit-kategori-'. $categories->id .'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="'. route('admin.category.edit.prosess', $categories->id) .'">
                                            <input disabled type="hidden" name="_token" value="'. csrf_token() .'"/>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group text-start">
                                                    <label class="text-dark mb-2">Nama</label>
                                                    <input disabled type="text" class="form-control" name="name" value="' . $categories->name . '" placeholder="Masukan nama kategori" required/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>                            
                            ';
                        })
                        ->make(true);
    }
    public function news()
    {
        $news = News::where('unit_id', $this->unit_id)->latest()->get();
        return Datatables::of($news)
               ->addIndexColumn()
               ->addColumn('category', function($news) {
                   return $news->category->name ?? 'Tidak ada Kategori';
               })
               ->addColumn('action', function ($news) {
                    return 
                    '<a href="'.route('admin.news.edit', $news->id).'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                    '<a href="'.route('admin.news.delete', $news->id).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Berita?`)" <i class="bi bi-trash"></i> Hapus</a>';
               })
               ->make(true);
    }
    public function page_rspk(Request $request)
    {
        $files = PageFile::where('category', $request->slug)->latest()->where('unit_id', $this->unit_id)->get();
        return DataTables::of($files)
                        ->addIndexColumn()
                        ->addColumn('file', function($files){
                            return 
                            "<a href=$files->url><i class='bi bi-file-pdf'></i> Download</a>";
                        })
                        ->addColumn('action', function($files) use ($request){
                            return 
                            '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-page-'. $files->id .'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                            '<a href="'.route('admin.pages.file.delete', [$request->slug, $files->id]).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Data?`)" <i class="bi bi-trash"></i> Hapus</a>' .
                            '
                            <div class="modal fade text-dark" id="edit-page-'. $files->id .'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content text-start">
                                    <form method="post" action="'. route('admin.pages.file.edit', [$request->slug, $files->id]) .'" enctype="multipart/form-data">
                                        <input disabled type="hidden" name="_token" value="'. csrf_token() .'"/>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Judul</label>
                                                <input disabled type="text" class="form-control" name="title" value="'. $files->title .'" placeholder="Masukan judul" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Tahun</label>
                                                <input disabled type="number" class="form-control" name="year" value="'. $files->year .'" placeholder="Masukan tahun" maxlength="5" required/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Keterangan</label>
                                                <textarea name="description" id="description" class="form-control w-100" maxlength="255">'. $files->description .'</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">File</label>
                                                <input disabled type="file" class="form-control" name="file" placeholder="Masukan file"/>
                                                <div class="mt-2">
                                                    <a href="'. $files->url .'"><i class="bi bi-file-pdf"></i> Download</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            ';
                        })
                        ->rawColumns(['file', 'action'])
                        ->make(true);
    }
    public function structures(Request $request)
    {
        $structures = UnitNameStructure::where('unit_id', $this->unit_id)->get();
        return DataTables::of($structures)
                        ->addIndexColumn()
                        ->addColumn('name', function($structures){
                            return '<a href="'. route('admin.structures.item', $structures->id) .'">'.$structures->name.'</a>';
                        })
                        ->addColumn('action', function($structures) use ($request){
                            return 
                            '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-page-'. $structures->id .'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                            '<a href="'.route('admin.structures.delete', $structures->id).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Data?`)" <i class="bi bi-trash"></i> Hapus</a>' .
                            '
                            <div class="modal fade text-dark" id="edit-page-'. $structures->id .'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content text-start">
                                    <form method="post" action="'. route('admin.structures.edit', $structures->id) .'" enctype="multipart/form-data">
                                        <input disabled type="hidden" name="_token" value="'. csrf_token() .'"/>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="text-dark mb-2">Nama</label>
                                                <input disabled type="text" class="form-control" name="name" value="'. $structures->name .'" placeholder="Masukan nama struktur" required/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            ';
                        })
                        ->rawColumns(['name', 'action'])
                        ->make(true);
    }
    public function structures_item(Request $request)
    {
        $structure = UnitStructureItem::where('unit_name_structure_id', $request->id)->get();
        return DataTables::of($structure)
                        ->addIndexColumn()
                        ->addColumn('photo', function($structure){
                            return '<div class="photo"><img src="'.$structure->photo.'" alt="Photo"></div>';
                        })
                        ->addColumn('action', function($structure){
                            return 
                            '<a href="javascript:void(0)" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#edit-'.$structure->id.'"><i class="bi bi-pencil-square"></i> Edit</a>' .
                            '<a href="'.route('admin.structures.item.delete', $structure->id).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Data?`)" <i class="bi bi-trash"></i> Hapus</a>' . 
                            '<div class="modal fade text-dark" id="edit-'.$structure->id.'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-start">
                                        <form method="post" action="'.route('admin.structures.item.edit', $structure->id).'" enctype="multipart/form-data">
                                            <input disabled type="hidden" name="_token" value="'.csrf_token().'"/>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label class="text-dark mb-2">Nama</label>
                                                    <input disabled type="text" class="form-control" name="name" value="'.$structure->name.'" placeholder="Masukan nama" required/>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="text-dark mb-2">Keterangan</label>
                                                    <textarea name="description" class="form-control" placeholder="Masukan keterangan">'.$structure->description.'</textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="text-dark mb-2">Photo</label>
                                                    <input disabled type="file" class="form-control mb-4" name="photo"/>
                                                    <div class="photo" style="margin:0; width:100px; height:100px;"><img src="'.$structure->photo.'" alt="Photo"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        
                        })
                        ->rawColumns(['photo', 'action'])
                        ->make(true);
    }
    public function galleries()
    {
        $galleries = Gallery::where('unit_id', $this->unit_id)->latest()->get();
        return Datatables::of($galleries)
               ->addIndexColumn()
               ->addColumn('action', function ($galleries) {
                    return 
                    '<a href="'.route('admin.gallery.edit', $galleries->id).'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                    '<a href="'.route('admin.gallery.delete', $galleries->id).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Galeri?`)" <i class="bi bi-trash"></i> Hapus</a>';
               })
               ->make(true);
    }
    public function users_academic(Request $request)
    {
        if($request->role == 'siswa'){
            $users = Student::where('status_id', '!=', 3)->latest()->get();
        }elseif($request->role == 'guru'){
            $users = Teacher::where('status_id', '!=', 3)->latest()->get();
        }else{
            $users = Staff::where('status_id', '!=', 3)->latest()->get();
        }

        if($request->unit != 'semua'){
            $users = $users->filter(function($user) use ($request){
                return $user->account->unit_id == unit_name($request->unit);
            });
        }

        return DataTables::of($users)
                        ->addIndexColumn()
                        ->addColumn('photo', function($users){
                            return '<div class="photo"><img src="'.$users->photo.'" alt="Photo"></div>';
                        })
                        ->addColumn('nomor_induk', function($users){
                            return $users->nip ?? $users->nisn;
                        })
                        ->addColumn('status', function($users){
                            return strtolower($users->status->name) == 'active' ? '<i class="bi bi-check2-circle text-success"></i>' : '<i class="bi bi-x-circle text-danger"></i>' ;
                        })
                        ->addColumn('unit', function($users){
                            return ucwords(unit_name($users->account->unit_id));
                        })
                        ->addColumn('action', function($users) use ($request){
                            return '<a href="'.route('admin.users.academic.detail', [$request->segment(4) , $users->user_id]).'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>';
                        })
                        ->rawColumns(['photo', 'status', 'action'])
                        ->make(true);
    }
    public function classroom(Request $request)
    {
        $unit_id = unit_name($request->unit);
        $classroom = Classroom::where('unit_id', $unit_id)->get();
        return DataTables::of($classroom)
                        ->addIndexColumn()
                        ->addColumn('student', function($classroom){
                            return count($classroom->student);
                        })
                        ->addColumn('action', function($classroom) use ($request){
                            return  '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-'.$classroom->id.'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                                    '<a href="'.route('admin.class.delete', [$request->segment(3), $classroom->id]).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Kelas?`)" <i class="bi bi-trash"></i> Hapus</a>' .
                                    '
                                    <div class="modal fade" id="edit-'.$classroom->id.'" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="post" action="'.route('admin.class.edit', [$request->segment(3), $classroom->id]).'">
                                            '.csrf_field().'
                                            <div class="modal-content text-dark text-start">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Kelas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="" class="mb-2">Nama Kelas</label>
                                                        <input disabled type="text" name="name" value="'.$classroom->name.'" class="form-control" placeholder="Masukan Nama Kelas" required/>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                    ';
                        })
                        ->make(true);
    }
    public function year()
    {
        return DataTables::of($year = Year::where('id', '>', 1)->get())
                        ->addIndexColumn()
                        ->addColumn('action', function($year){
                            $year_explode = explode('/', $year->name);
                            $selected_ganjil = $year->status == 'Ganjil' ? 'selected' : '';
                            $selected_genap = $year->status == 'Genap' ? 'selected' : '';

                            return  '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-'.$year->id.'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit</a>' .
                                '<a href="'.route('admin.year.delete', $year->id).'" class="btn btn-sm btn-danger" onclick="return confirm(`Hapus Tahun Akademik?`)" <i class="bi bi-trash"></i> Hapus</a>' .
                                '
                                <div class="modal fade" id="edit-'.$year->id.'" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="'.route('admin.year.edit', $year->id).'">
                                        '.csrf_field().'
                                        <div class="modal-content text-dark text-start">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Kelas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="" class="mb-2">Tahun</label>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input disabled type="text" name="year_1" value="'.$year_explode[0].'" class="form-control" placeholder="Masukan Tahun Akademik" maxlength="5" required/>
                                                        </div>
                                                        <div class="col-md-2 text-center">/</div>
                                                        <div class="col-md-5">
                                                            <input disabled type="text" name="year_2" value="'.$year_explode[1].'" class="form-control" placeholder="Masukan Tahun Akademik" maxlength="5" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-2">Semester</label>
                                                    <select name="semester" id="semester" class="form-control">
                                                        <option value="">Pilih Semester</option>
                                                        <option value="Ganjil"'.$selected_ganjil.'>Semester Ganjil</option>
                                                        <option value="Genap"'.$selected_genap.'>Semester Genap</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                                ';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }

    public function recruitment(Request $request)
    {
        $user = $request->role == 'guru' ? Teacher::where('status_id', get_status('recruitment'))->orderBy('created_at', 'ASC')->get() : ($request->role == 'staff' ? Staff::where('status_id', get_status('recruitment'))->orderBy('created_at', 'ASC')->get() : Student::where('status_id', get_status('recruitment'))->orderBy('created_at', 'ASC')->get());
        
        if($request->role == 'ppdp'){
            $user = $user->filter(function($item){
                $item->student_status == 2;
            });
        }

        if($request->query('unit')){
            $user = $user->filter(function($item) use ($request){
                return $item->account->unit_id == unit_name($request->query('unit'));
            });
        }
        
        $user = $user->filter(function($item){
            return $item->recruitment->step == 4;
        });

        return DataTables::of($user)
                        ->addIndexColumn()
                        ->addColumn('no_registration', function($user){
                            return $user->recruitment->no_registration;
                        })
                        ->addColumn('photo', function($user){
                            return '<div class="photo"><img src="'.$user->photo.'" alt="Photo"></div>';
                        })
                        ->addColumn('email', function($user){
                            return $user->account->email;
                        })
                        ->addColumn('status', function($user){
                            return $user->recruitment->result == 0 ? '<span class="badge rounded-pill bg-warning text-dark">Pending</span>' : ($user->recruitment->result == 1 ? '<span class="badge rounded-pill bg-success text-white">Lolos</span>' : '<span class="badge rounded-pill bg-danger text-white">Tidak Lolos</span>');
                        })
                        ->addColumn('action', function($user) use ($request){
                            return '<a href="'.route('admin.recruitment.detail', [$request->role, $user->user_id]).'" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i></a>';
                        })
                        ->rawColumns(['photo', 'action', 'status'])
                        ->make(true);
    }
}
