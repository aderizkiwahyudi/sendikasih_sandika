<?php

namespace App\Http\Controllers;

use App\Mail\RecruitmentEmail;
use App\Models\MoreSetting;
use App\Models\Recruitment;
use App\Models\RecruitmentEmailVerification;
use App\Models\RecruitmentSetting;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Sesssion;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->segment(2) == 'peserta-didik'){
            return view('recruitment.registration');
        }elseif($request->segment(2) == 'guru-karyawan'){
            return view('recruitment.registrationTeacherAndStaff');
        }else{
            abort(404);
        }
    }

    public function create(Request $request){
        if($request->segment(2) != 'peserta-didik' && $request->segment(2) != 'guru-karyawan'){
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam melakukan pendaftaran, silakan coba lagi',
            ]);
        }

        if(!$request->jenis){
            return response()->json([
                'success' => false,
                'message' => 'Mohon maaf, terjadi kesalahan saat melakukan pendaftaran. Silakan coba lagi.',
                'data' => $request->all(),
            ]);
        }

        if($request->segment(2) == 'peserta-didik'){
            if(!$request->jenjang){
                return response()->json([
                    'success' => false,
                    'message' => 'Mohon maaf, terjadi kesalahan saat melakukan pendaftaran. Silakan coba lagi.',
                    'data' => $request->all(),
                ]);
            }

            if($request->jenis == 1){
                if(RecruitmentSetting::where('unit_id', $request->jenjang)->first()->active == 0){
                    return response()->json([
                        'success' => false,
                        'message' => 'Mohon maaf, ppdb sudah ditutup! Silakan tunggu pendaftaran berikutnya.',
                    ]);
                }
            }   
        }

        if($request->segment(2) == 'guru-karyawan'){
            if(RecruitmentSetting::where('unit_id', 1)->first()->active == 0){
                return response()->json([
                    'success' => false,
                    'message' => 'Mohon maaf, ppdb sudah ditutup! Silakan tunggu pendaftaran berikutnya.',
                ]);
            }
        }
        
        $rules = [
            'name' => 'required|max:100',
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];

        $message = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama terlalu panjang, maksimal 100 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.alpha_dash' => 'Username hanya boleh menggunakan huruf dan angka',
            'username.unique' => 'Username telah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Masukan email dengan benar',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Masukan password dengan benar',
        ];

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->first(),
            ]);
        }

        $request->segment(2) == 'peserta-didik' ? $role = 2 : $role = $request->jenis;

        $allowRoles = [2,3,4];
        
        if(!in_array($role, $allowRoles)){
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam melakukan pendaftaran, silakan coba lagi',
            ]);
        }

        $id = rand(1, 999999) . time() . rand(0, 100);

        $user = new User();
        $user->id = $id;
        $user->role_id = $role;
        $user->unit_id = $request->jenjang ?? 1;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $recruitment = new Recruitment();
        $recruitment->user_id = $id;
        $recruitment->no_registration = rand(1,999) . time() .rand(1,999);
        $recruitment->step = 1;
        $recruitment->result = 0;
        $recruitment->verify_at = null;
        $recruitment->save();

        if($role == 2){
            $student = new Student();
            $student->user_id = $id;
            $student->status_id = 3;
            $student->class_id = 1;
            $student->year_id = MoreSetting::first()->year_id;
            $student->name = $request->name;
            $student->student_status = $request->jenis;
            $student->save();
        }elseif($role == 3){
            $teacher = new Teacher();
            $teacher->user_id = $id;
            $teacher->status_id = 3;
            $teacher->year_id = MoreSetting::first()->year_id;
            $teacher->name = $request->name;
            $teacher->save();
        }else{
            $staff = new Staff();
            $staff->user_id = $id;
            $staff->status_id = 3;
            $staff->year_id = MoreSetting::first()->year_id;
            $staff->name = $request->name;
            $staff->save();
        }

        $token = Str::random(16) . time();

        $verify = new RecruitmentEmailVerification();
        $verify->user_id = $id;
        $verify->token = $token;
        $verify->expired_at = date('Y-m-d H:i:s');
        $verify->save();

        Mail::to($request->email)->send(new RecruitmentEmail([
            'name' => $request->name,
            'token' => $token,
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan pendaftaran, silakan periksa email anda untuk melakukan aktivasi akun.',
        ]);
    }

    public function resend()
    {
        return view('recruitment.resendEmail');
    }

    public function resend_prosess(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            Session::flash('failed', 'Email tidak ditemukan');
            return back();
        }

        if($user->student){
            if($user->student->status_id != 3){
                Session::flash('failed', 'Email tidak ditemukan');
                return back();
            }
        }

        if($user->teacher){
            if($user->teacher->status_id != 3){
                Session::flash('failed', 'Email tidak ditemukan');
                return back();
            }
        }
        
        if($user->staff){
            if($user->staffstatus_id != 3){
                Session::flash('failed', 'Email tidak ditemukan');
                return back();
            }
        }

        $verificationData = RecruitmentEmailVerification::where('user_id', $user->id)->first();
        $token = $verificationData->token;

        if(!$verificationData){
            $token = Str::random(16) . time();
            $verify = new RecruitmentEmailVerification();
            $verify->user_id = $user->id;
            $verify->token = $token;
            $verify->expired_at = date('Y-m-d H:i:s');
            $verify->save();
        }

        Mail::to($user->email)->send(new RecruitmentEmail([
            'name' => $user->student->name ?? $user->teacher->name ?? $user->staff->name,
            'token' => $token,
        ]));

        Session::flash('success', 'Berhasil mengirim email aktivasi, periksa email anda sekarang');
        return back();
    }
}
