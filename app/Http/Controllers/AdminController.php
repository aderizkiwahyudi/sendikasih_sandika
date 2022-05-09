<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Classroom;
use App\Models\ContributionItem;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\MoreSetting;
use App\Models\News;
use App\Models\Page;
use App\Models\PageFile;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UnitNameStructure;
use App\Models\UnitStructureItem;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private $unit_id;
    public function __construct()
    {
        $this->unit_id = 1;   
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }
    public function news()
    {
        return view('admin.dashboard.news.index');
    }
    
    public function news_add()
    {
        $categories = Category::get();
        return view('admin.dashboard.news.add', compact('categories'));
    }
    public function news_edit(Request $request)
    {
        $categories = Category::get();
        $news = News::where('id', $request->id)->firstOrFail();
        return view('admin.dashboard.news.add', compact('categories', 'news'));
    }  
    public function news_prosess(Request $request)
    {
        $rules = [
            'title' => 'required|max:200',
            'thumbnail' => 'image',
        ];

        $message = [
            'title.required' => 'Judul berita tidak boleh kosong',
            'title.max' => 'Judul terlalu panjang, maksimal 200 karakter',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
        ];

        if($request->segment(3) == 'tambah'){
            $rules['thumbnail'] = 'required';
            $message['thumbnail.required'] = 'Thumbnail tidak boleh kosong';
        }

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors())->withInput($request->all());
        }

        if($request->category <= 4){
            $show = 0;
        }else{
            $show = 1;
        }

        if($request->segment(3) == 'tambah'){

            if($thumbnail = file_upload($request->file('thumbnail')))
            {
                $news = new News();
                $news->unit_id = $this->unit_id;
                $news->title = $request->title;
                $news->category_id = $request->category;
                $news->content = $request->content;
                $news->slug = Str::slug($request->title);
                $news->thumbnail = $thumbnail;
                $news->show = $show;
                $news->save();

                return redirect(route('admin.news'));
            }

            return back()->withErrors('Gagal mengupload thumbnail, silakan coba lagi')->withInput($request->all());

        }else{

            if($request->file('thumbnail')){
                $data['thumbnail'] = file_upload($request->file('thumbnail'));
            }

            $data['title'] = $request->title;
            $data['category_id'] = $request->category;
            $data['content'] = $request->content;
            $data['slug'] = Str::slug($request->title);
            $data['show'] = $show;

            $news = News::where('id', $request->id)->update($data);

            return redirect(route('admin.news'));

        }

        return back()->withErrors('Terdapat kesalahan, silakan coba lagi')->withInput($request->all());
    }
    public function news_delete(Request $request)
    {
        News::where('id', $request->id)->delete();
        return back();
    }
    public function category()
    {
        return view('admin.dashboard.category.index');
    }
    public function category_proses(Request $request)
    {
        if(!$request->name){
            return back()->withErrors('Nama kategori tidak boleh kosong');
        }

        if(!$request->segment(3)){
            $categories = new Category();
            $categories->unit_id = $this->unit_id;
            $categories->name = $request->name;
            $categories->slug = Str::slug($request->name);
            $categories->save();
        }else{
            $categories = Category::where('id', $request->id)->update(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        }

        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function category_delete(Request $request)
    {
        Category::where('id', $request->id)->delete();
        return back();
    }
    public function pages(Request $request)
    {
        if($request->slug == 'rencana-strategis' || $request->slug == 'perjanjian-kerja'){
            return view('admin.dashboard.page.file.index');
        }

        if($request->slug == 'struktur-pimpinan'){
            return view('admin.dashboard.structure.index');
        }

        $page = Page::where('slug', $request->slug)->firstOrFail();
        return view('admin.dashboard.page.index', compact('page'));
    }
    public function pages_prosess(Request $request)
    {
        if(!$request->title){
            return back()->withErrors('Judul tidak boleh kosong');
        }

        $page = Page::where('slug', $request->slug)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        Session::flash('success', 'Berhasil menyimpan perubahan informasi');
        return back();
    }
    public function page_file_prosess(Request $request)
    {
        $rules = [
            'title' => 'required|max:100',
            'year' => 'required|max:5',
            'description' => 'required|max:255',
        ];

        $message = [
            'title.required' => 'Judul tidak boleh kosong',
            'title.max' => 'Judul terlalu panjang, maksimal 100 Karakter',
            'year.required' => 'Tahun tidak boleh kosong',
            'year.max' => 'Masukan tahun dengan benar',
            'description.required' => 'Masukan keterangan dengan benar',
            'description.max' => 'Keterangan terlalu panjang, maksimal 255 Karakter',
        ];

        if($request->segment(4) == 'add'){
            $rules['file'] = 'required|mimes:pdf';
            $message['file.required'] = 'File tidak boleh kosong';
            $message['file.mimes'] = 'File harus berupa pdf';
        }
        
        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails())
        {
            return back()->withErrors($validation->errors());
        }

        if($request->file('file')){
            $file = file_upload($request->file('file'));
        }

        if($request->segment(4) == 'add'){
            $data = new PageFile();
            $data->unit_id = $this->unit_id;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->year = $request->year;
            $data->url = $file;
            $data->category = $request->slug;
            $data->save();
        }elseif($request->segment(4) == 'edit'){
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['year'] = $request->year;
            $data['category'] = $request->slug;

            if(isset($file)) $data['url'] = $file;
        
            PageFile::where('id', $request->id)->update($data);
        }
        
        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function page_file_delete(Request $request)
    {
        PageFile::where('id', $request->id)->delete();
        return back();
    }
    public function strtuctures_prosess(Request $request)
    {
        if(!$request->name){
            return back()->withErrors('Nama struktur tidak boleh kosong');
        }

        if($request->segment(3) == 'add'){
            $struktur = new UnitNameStructure();
            $struktur->unit_id = $this->unit_id;
            $struktur->name = $request->name;
            $struktur->save();
        }else{
            $struktur = UnitNameStructure::where('id', $request->id);
            $struktur->firstOrFail();

            $struktur->update([
                'name' => $request->name,
            ]);
        }
        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function structure_delete(Request $request)
    {
        UnitNameStructure::where('id', $request->id)->delete();
        return back();
    }
    public function structures_item()
    {
        return view('admin.dashboard.structure.item');
    }
    public function structures_item_prosess(Request $request)
    {
        $rules = [
            'name' => 'required|max:100',
            'description' => 'required|max:255',
        ];

        $message = [
            'name.required' => "Nama tidak boleh kosong",
            "name.max" => "Nama terlalu panjang, maksimal 100 karakter",
            'description.required' => "Keterangan tidak boleh kosong",
            'description.max' => "Keterangan terlalu panjang, maksimal 255 karakter",
        ];

        if($request->segment(4) == 'add'){
            $rules['photo'] = 'required|image';
            $message['photo.required'] = "Foto tidak boleh kosong";
            $message['photo.image'] = "Foto harus berupa gambar";
        }

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        if($request->segment(4) == 'add'){
            $item = new UnitStructureItem();
            $item->unit_name_structure_id = $request->id;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->photo = file_upload($request->file('photo'));
            $item->save();
        }else{
            $data['name'] = $request->name;
            $data['description'] = $request->description;

            if($request->file('photo')) $data['photo'] = file_upload($request->file('photo'));

            $item = UnitStructureItem::where('id', $request->id)->update($data);
        }

        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function structures_item_delete(Request $request)
    {
        UnitStructureItem::where('id', $request->id)->delete();
        return back();
    }
    public function gallery()
    {
        return view('admin.dashboard.gallery.index');
    }
    public function gallery_editor(Request $request)
    {
        if($request->segment(3) == 'edit')
        {
            $gallery = Gallery::where('id', $request->id)->firstOrFail();
            return view('admin.dashboard.gallery.add', compact('gallery'));
        }
        
        return view('admin.dashboard.gallery.add');
    }
    public function gallery_prosess(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            
        ];

        $message = [
            'title.required' => 'Judul tidak boleh kosong',
            'title.max' => 'Judul terlalu panjang, maksimal 255 Karakter',
            'content.required' => 'Konten tidak boleh kosong',
            'photo.required' => 'Foto tidak boleh kosong',
        ];

        if($request->segment(3) == 'add'){
            $rules['photo'] = 'required';
        }

        $rules['photo.*'] = 'image';
        $message['photo.image'] = 'Foto harus berupa gambar';

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors())->withInput($request->all());
        }

        if($request->segment(3) == 'add'){
            $id = rand(1,999) . time();

            $gallery = new Gallery();
            $gallery->id = $id;
            $gallery->unit_id = $this->unit_id;
            $gallery->title = $request->title;
            $gallery->content = $request->content;
            $gallery->slug = Str::slug($request->title);
            $gallery->save();

            foreach($request->file('photo') as $photo){
                $gallery_photo = new GalleryPhoto();
                $gallery_photo->gallery_id = $id;
                $gallery_photo->url = file_upload($photo);
                $gallery_photo->save();
            }
        }else{
            $data['title'] = $request->title;
            $data['content'] = $request->content;
            $data['slug'] = $request->slug;

            $gallery = Gallery::where('id', $request->id)->update($data);

            if($request->file('photo')){
                foreach($request->file('photo') as $photo){
                    $gallery_photo = new GalleryPhoto();
                    $gallery_photo->gallery_id = $request->id;
                    $gallery_photo->url = file_upload($photo);
                    $gallery_photo->save();
                }
            }

            Session::flash('success', 'Berhasil menyimpan data');
            return redirect(route('admin.gallery.edit', $id ?? $request->id));
        }
        
        Session::flash('success', 'Berhasil menyimpan data');
        return redirect(route('admin.gallery'));
    }
    public function gallery_delete(Request $request)
    {
        if($request->segment(4) == 'item'){
            GalleryPhoto::where('id', $request->id)->delete();
            return back();
        }

        Gallery::where('id', $request->id)->delete();
        return back();
    }
    public function users_academic(Request $request)
    {
        return view('admin.dashboard.academic.index');
    }
    public function users_academic_add(Request $request)
    {
        if($request->unit == 'semua'){
            $class = Classroom::get();
        }else{
            $class = Classroom::where('unit_id', unit_name($request->unit))->get();
        }
        $year = Year::orderBy('id', 'DESC')->where('id', '>', 1)->groupBy('name')->get();
        return view('admin.dashboard.academic.add', compact('class', 'year'));
    }
    public function users_academic_prosess(Request $request)
    {
        $unit_id = $request->unit_id ?? unit_name($request->unit);

        if($request->role == 'siswa'){
            $rules = [
                'username' => 'required|alpha_dash|unique:users',
                'email' => 'required|email|unique:users',
                'name' => 'required|max:100',
                'gender' => 'required',
                'birthday_at' => 'required|max:255',
                'birthday' => 'required',
                'address' => 'required|max:350',
                'phone' => 'required|numeric',
                'father_name' => 'required|max:100',
                'father_job' => 'required',
                'mother_name' => 'required|max:100',
                'mother_job' => 'required',
                'parents_address' => 'required|max:350',
                'parents_phone' => 'required|numeric',
                'class_id' => 'required',
                'year_id' => 'required',
                'semester' => 'required',
                'student_status' => 'required',
            ];
    
            $message = [
                'username.required' => 'Username tidak boleh kosong',
                'username.alpha_dash' => 'Username hanya boleh menggunakan huruf dan angka',
                'username.unique' => 'Username telah terdaftar',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Masukan email dengan benar',
                'email.unique' => 'Email telah terdaftar',
                'password.required' => 'Masukan password dengan benar',
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama terlalu panjang, maksimal 100 Karakter',
                'gender.required' => 'Jenis Kelamin tidak boleh kosong',
                'birthday_at.required' => 'Tempat Tanggal Lahir tidak boleh kosong',
                'birthday_at.max' => 'Tempat Tanggal Lahir terlalu panjang',
                'birthday.required' => 'Tanggal Lahir tidak boleh kosong',
                'address.required' => 'Alamat anda tidak boleh kosong',
                'address.max' => 'Alamat terlalu panjang, masukan dengan benar',
                'phone.required' => 'Masukan No. Handphone anda',
                'phone.numeric' => 'Masukan No. Handphone dengan benar',
                'phone.max' => 'Masukan No. Handphone dengan benar',
                'father_name.required' => 'Nama Ayah tidak boleh kosong',
                'father_job.required' => 'Pekerjaan Ayah tidak boleh kosong',
                'mother_name.required' => 'Nama Ibu tidak boleh kosong',
                'mother_job.required' => 'Pekerjaan Ibu tidak boleh kosong',
                'parents_address.required' => 'Alamat Orang Tua tidak boleh kosong',
                'parents_address.max' => 'Alamat Orang Tua terlalu panjang, masukan dengan benar',
                'parents_phone.required' => 'No. Handphone Orang Tua tidak boleh kosong',
                'parents_phone.numeric' => 'Masukan No. Handphone Orang Tua dengan benar',
                'parents_phone.max' => 'Masukan No. Handphone Orang Tua dengan benar',
                'kk.required' => 'Kartu Keluarga tidak boleh kosong',
                'kk.mimes' => 'Kartu Keluarga harus berupa PDF',
                'ijazah.required' => 'Ijazah tidak boleh kosong',
                'ijazah.mimes' => 'Ijazah harus berupa PDF',
                'photo.required' => 'Foto tidak boleh kosong',
                'photo.image' => 'Foto harus berupa gambar',
                'class_id.required' => 'Kelas tidak boleh kosong',
                'year_id.required' => 'Tahun Masuk tidak boleh kosong',
                'semester.required' => 'Tahun Masuk tidak boleh kosong',
                'student_status.required' => 'Status Siswa tidak boleh kosong',
            ];
            
            if($request->segment(5) == 'add'){
                $rules['kk'] = 'required|mimes:pdf';
                $rules['photo'] = 'required|image';
                $rules['password'] = 'required';
                
                #Jika Bukan MI, Ijazah Wajib
                if($unit_id > 2){
                    $rules['ijazah'] = 'required|mimes:pdf';
                }
            }else{
                $rules['kk'] = 'mimes:pdf';
                $rules['photo'] = 'image';
            }

            #JIKA BUKAN UNIT MI
            if($unit_id > 2){
                $rules['nisn'] = 'required';
                $rules['previous_school'] = 'required';
                $rules['previous_school_address'] = 'required';
    
                $message['nisn.required'] = "NISN tidak boleh kosong";
                $message['previous_school.required'] = "Nama Sekolah Sebelumnya tidak boleh kosong";
                $message['previous_school_address.required'] = "Alamat Sekolah Sebelumnya tidak boleh kosong";
                $message['ijazah.required'] = 'Ijazah tidak boleh kosong';
            }
    
            $validation = Validator::make($request->all(), $rules, $message);
    
            if($validation->fails()){
                return back()->withErrors($validation->errors())->withInput($request->all());
            }
    
            if($file = $request->file('kk')){
                $student['kk'] = file_upload($file);
            }

            if($photo = $request->file('photo')){
                $student['photo'] = file_upload($photo);
            }
    
            if($unit_id > 2){
                if($file = $request->file('ijazah')){
                    $student['ijazah'] = file_upload($file);
                }
            }

            #Tahun Ajaran
            $request->year_id = Year::where('name', $request->year_id)->where('status', $request->semester)->first();

            if($request->year_id) $request->year_id = $request->year_id->id; else return back()->withErrors(['Masukan tahun ajaran dengan benar'])->withInput($request->all());

            $id = rand(1, 999999) . time() . rand(0, 100);
    
            $student['user_id'] = $id;
            $student['status_id'] = get_status('active');
            $student['class_id'] = $request->class_id;
            $student['year_id'] = $request->year_id;
            $student['name'] = $request->name;
            $student['gender'] = $request->gender;
            $student['birthday_at'] = $request->birthday_at;
            $student['birthday'] = $request->birthday;
            $student['address'] = $request->address;
            $student['phone'] = $request->phone;
            $student['father_name'] = $request->father_name;
            $student['father_job'] = $request->father_job;
            $student['mother_name'] = $request->mother_name;
            $student['mother_job'] = $request->mother_job;
            $student['parents_address'] = $request->parents_address;
            $student['parents_phone'] = $request->parents_phone;
            $student['student_status'] = $request->student_status;
            
            $account['id'] = $id;
            $account['role_id'] = get_role($request->role);
            $account['unit_id'] = $unit_id;
            $account['username'] = $request->username;
            $account['email'] = $request->email;
            $account['password'] = bcrypt($request->password);
    
            if($unit_id > 2){
                $student['nisn'] = $request->nisn;
                $student['previous_school'] = $request->previous_school;
                $student['previous_school_address'] = $request->previous_school_address;
            }
            
            if($request->segment(5) == 'add'){
                $student['created_at'] = date('Y-m-d H:i:s');
                $student['updated_at'] = date('Y-m-d H:i:s');
                $account['created_at'] = date('Y-m-d H:i:s');
                $account['updated_at'] = date('Y-m-d H:i:s');

                DB::table('users')->insert($account);
                DB::table('students')->insert($student);
            }else{
                User::where('id',$request->id)->update($account);
                Student::where('user_id',$request->id)->update($student);   
            }
        }elseif($request->role == 'guru'){
            $rules = [
                'username' => 'required|alpha_dash|unique:users',
                'email' => 'required|email|unique:users',
                'name' => 'required|max:100',
                'gender' => 'required',
                'birthday_at' => 'required|max:255',
                'birthday' => 'required',
                'address' => 'required|max:350',
                'phone' => 'required|numeric',
            ];

            $message = [
                'username.required' => 'Username tidak boleh kosong',
                'username.alpha_dash' => 'Username hanya boleh menggunakan huruf dan angka',
                'username.unique' => 'Username telah terdaftar',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Masukan email dengan benar',
                'email.unique' => 'Email telah terdaftar',
                'password.required' => 'Password tidak boleh kosong',
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama terlalu panjang, maksimal 100 Karakter',
                'gender.required' => 'Jenis Kelamin tidak boleh kosong',
                'birthday_at.required' => 'Tempat Tanggal Lahir tidak boleh kosong',
                'birthday_at.max' => 'Tempat Tanggal Lahir terlalu panjang',
                'birthday.required' => 'Tanggal Lahir tidak boleh kosong',
                'address.required' => 'Alamat anda tidak boleh kosong',
                'address.max' => 'Alamat terlalu panjang, masukan dengan benar',
                'phone.required' => 'Masukan No. Handphone anda',
                'phone.numeric' => 'Masukan No. Handphone dengan benar',
                'phone.max' => 'Masukan No. Handphone dengan benar',
                'photo.required' => 'Foto tidak boleh kosong',
                'photo.image' => 'Foto harus berupa gambar',
            ];

            if($request->segment(5) == 'add'){
                $rules['photo'] = 'required|image';
                $rules['password'] = 'required';
            }else{
                $rules['photo'] = 'image';
            }
            
            $validation = Validator::make($request->all(), $rules, $message);

            if($validation->fails()){
                return back()->withErrors($validation->errors())->withInput($request->all());
            }

            #Tahun Ajaran
            $request->year_id = 1;

            $id = rand(1, 999999) . time() . rand(0, 100);

            $account['id'] = $id;
            $account['role_id'] = get_role($request->role);
            $account['unit_id'] = $unit_id;
            $account['username'] = $request->username;
            $account['email'] = $request->email;
            $account['password'] = bcrypt($request->password);

            $teacher['user_id'] = $id;
            $teacher['status_id'] = get_status('active');
            $teacher['year_id'] = $request->year_id;
            $teacher['name'] = $request->name;
            $teacher['gender'] = $request->gender;
            $teacher['birthday_at'] = $request->birthday_at;
            $teacher['birthday'] = $request->birthday;
            $teacher['address'] = $request->address;
            $teacher['phone'] = $request->phone;
            $teacher['nip'] = $request->nip ?? '';

            if($photo = $request->file('photo')){
                $teacher['photo'] = file_upload($photo);
            }

            if($request->segment(5) == 'add'){
                $teacher['created_at'] = date('Y-m-d H:i:s');
                $teacher['updated_at'] = date('Y-m-d H:i:s');

                $account['created_at'] = date('Y-m-d H:i:s');
                $account['updated_at'] = date('Y-m-d H:i:s');

                DB::table('users')->insert($account);
                DB::table('teachers')->insert($teacher);
            }else{
                User::where('id',$request->id)->update($account);
                Teacher::where('user_id',$request->id)->update($teacher);   
            }
        }else{
            $rules = [
                'username' => 'required|alpha_dash|unique:users',
                'email' => 'required|email|unique:users',
                'name' => 'required|max:100',
                'gender' => 'required',
                'birthday_at' => 'required|max:255',
                'birthday' => 'required',
                'address' => 'required|max:350',
                'phone' => 'required|numeric',
            ];

            $message = [
                'username.required' => 'Username tidak boleh kosong',
                'username.alpha_dash' => 'Username hanya boleh menggunakan huruf dan angka',
                'username.unique' => 'Username telah terdaftar',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Masukan email dengan benar',
                'email.unique' => 'Email telah terdaftar',
                'password.required' => 'Password tidak boleh kosong',
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama terlalu panjang, maksimal 100 Karakter',
                'gender.required' => 'Jenis Kelamin tidak boleh kosong',
                'birthday_at.required' => 'Tempat Tanggal Lahir tidak boleh kosong',
                'birthday_at.max' => 'Tempat Tanggal Lahir terlalu panjang',
                'birthday.required' => 'Tanggal Lahir tidak boleh kosong',
                'address.required' => 'Alamat anda tidak boleh kosong',
                'address.max' => 'Alamat terlalu panjang, masukan dengan benar',
                'phone.required' => 'Masukan No. Handphone anda',
                'phone.numeric' => 'Masukan No. Handphone dengan benar',
                'phone.max' => 'Masukan No. Handphone dengan benar',
                'photo.required' => 'Foto tidak boleh kosong',
                'photo.image' => 'Foto harus berupa gambar',
            ];

            if($request->segment(5) == 'add'){
                $rules['photo'] = 'required|image';
                $rules['password'] = 'required';
            }else{
                $rules['photo'] = 'image';
            }
            
            $validation = Validator::make($request->all(), $rules, $message);

            if($validation->fails()){
                return back()->withErrors($validation->errors())->withInput($request->all());
            }

            #Tahun Ajaran
            $request->year_id = 1;

            $id = rand(1, 999999) . time() . rand(0, 100);

            $account['id'] = $id;
            $account['role_id'] = get_role($request->role);
            $account['unit_id'] = $unit_id;
            $account['username'] = $request->username;
            $account['email'] = $request->email;
            $account['password'] = bcrypt($request->password);

            $staff['user_id'] = $id;
            $staff['status_id'] = get_status('active');
            $staff['year_id'] = $request->year_id;
            $staff['name'] = $request->name;
            $staff['gender'] = $request->gender;
            $staff['birthday_at'] = $request->birthday_at;
            $staff['birthday'] = $request->birthday;
            $staff['address'] = $request->address;
            $staff['phone'] = $request->phone;
            $staff['nip'] = $request->nip ?? '';

            if($photo = $request->file('photo')){
                $staff['photo'] = file_upload($photo);
            }

            if($request->segment(5) == 'add'){
                $staff['created_at'] = date('Y-m-d H:i:s');
                $staff['updated_at'] = date('Y-m-d H:i:s');

                $account['created_at'] = date('Y-m-d H:i:s');
                $account['updated_at'] = date('Y-m-d H:i:s');

                DB::table('users')->insert($account);
                DB::table('staff')->insert($staff);
            }else{
                User::where('id',$request->id)->update($account);
                Staff::where('user_id',$request->id)->update($staff);
            }
        }

        return redirect(route('admin.users.academic', [$request->segment(3), $request->segment(4)]));
    }
    public function setting()
    {
        return view('admin.dashboard.setting');
    }
    public function setting_prosess(Request $request)
    {
        $rules = [
            'username' => 'required|max:100',
            'email' => 'required|email',
        ];

        $message = [
            'username.required' => 'Username tidak boleh kosong',
            'username.max' => 'Username terlalu panjang, maksimal 100 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Masukan Email dengan benar',
        ];

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        $data['username'] = $request->username;
        $data['email'] = $request->email;

        if($request->password) $data['password'] = bcrypt($request->password);

        $user = User::where('id', Auth::guard('admin')->user()->id)->update($data);

        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function classroom()
    {
        return view('admin.dashboard.classroom.index');
    }
    public function classroom_proses(Request $request)
    {
        if(!$request->name) return back()->withErrors('Nama Kelas tidak boleh kosong');
        if(Classroom::where('name', $request->name)->first()) return back()->withErrors('Kelas sudah ada, silakan coba lagi');

        if($request->segment(4) == 'add'){
            $classroom = new Classroom();
            $classroom->name = $request->name;
            $classroom->unit_id = unit_name($request->unit);
            $classroom->save();
        }else{
            $classroom = Classroom::where('id', $request->id)->update(['name' => $request->name]);
        }

        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function classroom_delete(Request $request)
    {
        $student = Student::where('class_id', $request->id)->update(['class_id' => 1]);
        $delete_class = Classroom::where('id', $request->id)->delete();
        return back();
    }
    public function year()
    {
        return view('admin.dashboard.year.index');
    }
    public function year_prosess(Request $request)
    {
        $rules = [
            'year_1' => 'required|max:5',
            'year_2' => 'required|max:5',
            'semester' => 'required',
        ];

        $message = [
            'year_1.required' => 'Tahun akademik tidak boleh kosong',
            'year_1.max' => 'Masukan tahun akademik dengan benar',
            'year_2.required' => 'Tahun akademik tidak boleh kosong',
            'year_2.max' => 'Masukan tahun akademik dengan benar',
            'semester.required' => 'Semester tidak boleh kosong', 
        ];

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        $request->name = $request->year_1 . '/' . $request->year_2;

        if($request->segment(3) == 'add'){
            $year = new Year();
            $year->name = $request->name;
            $year->status = $request->semester;
            $year->save();
        }else{
            $year = Year::where('id', $request->id)->update([
                'name' => $request->name,
                'status' => $request->semester,
            ]);
        }

        Session::flash('success', 'Berhasil menyimpan data');
        return back();
    }
    public function year_delete(Request $request)
    {
        ContributionItem::where('year_id', $request->id)->update(['year_id'=> 1]);
        Student::where('year_id', $request->id)->update(['year_id' => 1]);
        MoreSetting::where('year_id', $request->id)->update(['year_id' => 1]);
        Year::where('id', $request->id)->delete();

        return back();
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
