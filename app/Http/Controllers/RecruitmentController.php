<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;
class RecruitmentController extends Controller
{
    public function index()
    {
        if(Auth::guard('recruitment')->user()->recruitment->step == 4){
            return redirect(route('recruitment.finish'));
        }

        return view('recruitment.dashboard.index');
    }
    
    public function bidota_prosess(Request $request)
    {
        if(Auth::guard('recruitment')->user()->recruitment->step == 4){
            return redirect(route('recruitment.finish'));
        }

        if(Auth::guard('recruitment')->user()->student){
            $rules = [
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
            ];

            if(!Auth::guard('recruitment')->user()->student->kk){
                $rules['kk'] = 'required';
            }

            $message = [
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
            ];
            
            if(Auth::guard('recruitment')->user()->unit_id > 2){
                $rules['nisn'] = 'required';
                $rules['previous_school'] = 'required';
                $rules['previous_school_address'] = 'required';

                $message['nisn.required'] = "NISN tidak boleh kosong";
                $message['previous_school.required'] = "Nama Sekolah Sebelumnya tidak boleh kosong";
                $message['previous_school_address.required'] = "Alamat Sekolah Sebelumnya tidak boleh kosong";
                $message['ijazah.required'] = 'Ijazah tidak boleh kosong';
            
                if(!Auth::guard('recruitment')->user()->student->ijazah){
                    $rules['ijazah'] = 'required';
                }
            }

            $validation = Validator::make($request->all(), $rules, $message);

            if($validation->fails()){
                return back()->withErrors($validation->errors())->withInput($request->all());
            }

            if($file = $request->file('kk')){
                $file_name = $file->getClientOriginalName();
                $file_rename = rand(0,999) . time() . '-' . Str::slug($file_name) . '.' . $file->getClientOriginalExtension();
                $file->move('file', $file_rename);
                $kk = asset('file/' . $file_rename);
            }

            if(Auth::guard('recruitment')->user()->unit_id > 2){
                if($file = $request->file('ijazah')){
                    $file_name = $file->getClientOriginalName();
                    $file_rename = rand(0,999) . time() . '-' . Str::slug($file_name) . '.' . $file->getClientOriginalExtension();
                    $file->move('file', $file_rename);
                    $ijazah = asset('file/' . $file_rename);
                }
            }

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
            $student['kk'] = $kk ?? Auth::guard('recruitment')->user()->student->kk;

            if(Auth::guard('recruitment')->user()->unit_id > 2){
                $student['nisn'] = $request->nisn;
                $student['previous_school'] = $request->previous_school;
                $student['previous_school_address'] = $request->previous_school_address;
                $student['ijazah'] = $ijazah ?? Auth::guard('recruitment')->user()->student->ijazah;
            }

            Recruitment::where('user_id', Auth::guard('recruitment')->user()->id)->update(['step' => 2]);
            Student::where('user_id', Auth::guard('recruitment')->user()->id)->update($student);

            Session::flash('success', 'Berhasil menyimpan informasi biodata');
            return back();
        }elseif(Auth::guard('recruitment')->user()->teacher){
            $rules = [
                'name' => 'required|max:100',
                'gender' => 'required',
                'birthday_at' => 'required|max:255',
                'birthday' => 'required',
                'address' => 'required|max:350',
                'phone' => 'required|numeric',
            ];

            $message = [
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
            ];
            
            $validation = Validator::make($request->all(), $rules, $message);

            if($validation->fails()){
                return back()->withErrors($validation->errors())->withInput($request->all());
            }

            $teacher['name'] = $request->name;
            $teacher['gender'] = $request->gender;
            $teacher['birthday_at'] = $request->birthday_at;
            $teacher['birthday'] = $request->birthday;
            $teacher['address'] = $request->address;
            $teacher['phone'] = $request->phone;
            $teacher['nip'] = $request->nip ?? '';

            Recruitment::where('user_id', Auth::guard('recruitment')->user()->id)->update(['step' => 2]);
            Teacher::where('user_id', Auth::guard('recruitment')->user()->id)->update($teacher);

            Session::flash('success', 'Berhasil menyimpan informasi biodata');
            return back();
        }else{
            $rules = [
                'name' => 'required|max:100',
                'gender' => 'required',
                'birthday_at' => 'required|max:255',
                'birthday' => 'required',
                'address' => 'required|max:350',
                'phone' => 'required|numeric',
            ];

            $message = [
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
            ];
            
            $validation = Validator::make($request->all(), $rules, $message);

            if($validation->fails()){
                return back()->withErrors($validation->errors())->withInput($request->all());
            }

            $staff['name'] = $request->name;
            $staff['gender'] = $request->gender;
            $staff['birthday_at'] = $request->birthday_at;
            $staff['birthday'] = $request->birthday;
            $staff['address'] = $request->address;
            $staff['phone'] = $request->phone;
            $staff['nip'] = $request->nip ?? '';

            Recruitment::where('user_id', Auth::guard('recruitment')->user()->id)->update(['step' => 2]);
            Staff::where('user_id', Auth::guard('recruitment')->user()->id)->update($staff);

            Session::flash('success', 'Berhasil menyimpan informasi biodata');
            return back();
        }

    }

    public function photo()
    {
        if(Auth::guard('recruitment')->user()->recruitment->step == 4){
            return redirect(route('recruitment.finish'));
        }

        if(Auth::guard('recruitment')->user()->recruitment->step < 2){
            return redirect(route('recruitment.dashboard'));
        }

        return view('recruitment.dashboard.photo');
    }

    public function photo_prosess(Request $request)
    {
        if(Auth::guard('recruitment')->user()->recruitment->step == 4){
            return redirect(route('recruitment.finish'));
        }

        if(Auth::guard('recruitment')->user()->recruitment->step < 2){
            return redirect(route('recruitment.dashboard'));
        }
        
        $rules = [
            'photo' => 'required|image|dimensions:width=384,height=576',
        ];

        $message = [
            'photo.required' => 'Foto tidak boleh kosong',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.dimensions' => 'Pastikan ukuran foto sesuai dengan yang diminta',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        $file = $request->file('photo');
        $file_name = $file->getClientOriginalName();
        $file_rename = rand(1,999999) . time() . '-' . Str::slug($file_name) . '.' . $file->getClientOriginalExtension();
        $file->move('img', $file_rename);

        $photo = asset('img/' . $file_rename);

        Recruitment::where('user_id', Auth::guard('recruitment')->user()->id)->update(['step' => 3]);
        
        if(Auth::guard('recruitment')->user()->student){
            Student::where('user_id', Auth::guard('recruitment')->user()->id)->update(['photo' => $photo]);
        }

        if(Auth::guard('recruitment')->user()->staff){
            Staff::where('user_id', Auth::guard('recruitment')->user()->id)->update(['photo' => $photo]);
        }

        if(Auth::guard('recruitment')->user()->teacher){
            Teacher::where('user_id', Auth::guard('recruitment')->user()->id)->update(['photo' => $photo]);
        }

        Session::flash('success', 'Berhasil menyimpan informasi foto.');
        return back();
    }

    public function confirmation()
    {
        if(Auth::guard('recruitment')->user()->recruitment->step == 4){
            return redirect(route('recruitment.finish'));
        }

        if(Auth::guard('recruitment')->user()->recruitment->step < 3){
            return redirect(route('recruitment.photo'));
        }

        return view('recruitment.dashboard.confirmation');
    }

    public function confirmation_prosess()
    {
        if(Auth::guard('recruitment')->user()->recruitment->step == 4){
            return redirect(route('recruitment.finish'));
        }

        if(Auth::guard('recruitment')->user()->recruitment->step < 3){
            return redirect(route('recruitment.photo'));
        }
        
        Recruitment::where('user_id', Auth::guard('recruitment')->user()->id)->update(['step' => 4]);

        return redirect(route('recruitment.finish'));
    }

    public function finish()
    {
        if(Auth::guard('recruitment')->user()->recruitment->step < 4){
            return redirect(route('recruitment.dashboard'));
        }

        return view('recruitment.dashboard.finish');
    }

    public function print()
    {
        if(Auth::guard('recruitment')->user()->recruitment->step < 4){
            return redirect(route('recruitment.dashboard'));
        }

        if(Auth::guard('recruitment')->user()->recruitment->result != 1){
            return redirect(route('recruitment.dashboard'));
        }
        
        $pdf = PDF::loadview('recruitment.dashboard.print');
        return $pdf->download('Kartu Pendaftaran Yayasan Sendikasih Sandika');
    }

    public function setting()
    {
        return view('recruitment.dashboard.setting');
    }
    public function setting_prosess(Request $request)
    {
        $rules = ['username' => 'required|alpha_dash|unique:users,username,'.Auth::guard('recruitment')->user()->id];
        $message = ['username.required' => 'Username tidak boleh kosong', 'username.alpha_dash' => 'Username hanya boleh menggunakan huruf dan angka', 'username.unique' => 'Username telah terdaftar, silakan cari username lain'];

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        $data['username'] = $request->username;
        
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        User::where('id', Auth::guard('recruitment')->user()->id)->update($data);

        Session::flash('success', 'Berhasil mengubah informasi akun');
        return back();
    }
    public function logout()
    {
        Auth::guard('recruitment')->logout();
        return back();
    }
}
