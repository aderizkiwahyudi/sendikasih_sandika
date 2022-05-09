<?php

namespace App\Http\Controllers;

use App\Mail\UserResetPasswordEmail;
use App\Models\Recruitment;
use App\Models\RecruitmentEmailVerification;
use App\Models\Student;
use App\Models\User;
use App\Models\UserResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(Auth::guard('recruitment')->check()){
            return redirect(route('recruitment.dashboard'));
        }elseif(Auth::guard('academic')->check()){
            return redirect(route('academic.dashboard'));
        }

        return view('login');
    }

    public function prosess(Request $request)
    {
        $user = User::where('email', $request->username)
                    ->orWhere('username', $request->username)
                    ->first();
        
        if(!$user){
            Session::flash('failed', 'Akun tidak ditemukan, silakan coba lagi.');
            return back();
        }

        if(password_verify($request->password, $user->password)){
            $status = $user->student->status_id ?? $user->teacher->status_id ?? $user->staff->status_id;
            if($status == 3){
                Auth::guard('recruitment')->login($user);
                return redirect(route('recruitment.dashboard'));
            }elseif($status == 1){
                Auth::guard('academic')->login($user);
                return redirect(route('academic.dashboard'));
            }else{
                Session::flash('failed', 'Akun anda sudah tidak aktif, hubungi admin jika terdapat keperluan penting.');
                return back();
            }
        }

        Session::flash('failed', 'Password yang anda masukan salah, silakan coba lagi.');
        return back();
    }

    public function aktivasi(Request $request)
    {
        $user = RecruitmentEmailVerification::where('token', $request->query('token'))->firstOrFail();
        $user_id = $user->user_id;

        $recruitment = Recruitment::where('user_id', $user_id)->firstOrFail();
        
        if($recruitment->verify_at == null){
            Recruitment::where('user_id', $user_id)->update([
                'verify_at' => date('Y-m-d H:i:s')
            ]);

            Session::flash('success', 'Berhasil melakukan aktivasi akun, silakan masuk sekarang');
        }else{
            Session::flash('failed', 'Akun anda sebelumnya telah di aktivavsi, silakan masuk sekarang');
        }

        return redirect(route('login'));
    }

    public function reset_password(Request $request)
    {
        return view('reset');
    }

    public function reset_password_prosess(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user){
            Session::flash('failed', 'Akun tidak ditemukan');
            return back();
        }

        $token = Str::random(50);
        $expire = date('Y-m-d H:i:s', strtotime('+ 30 minutes'));

        if(UserResetPassword::where('user_id', $user->id)->first()){
            UserResetPassword::where('user_id', $user->id)->delete();
        }

        $saveToUser = new UserResetPassword();
        $saveToUser->user_id = $user->id;
        $saveToUser->token = $token;
        $saveToUser->expired_at = $expire;
        $saveToUser->save();

        Mail::to($user->email)->send(new UserResetPasswordEmail([
            'name' => $request->name,
            'expired_at' => $expire,
            'token' => $token,
        ]));
        
        Session::flash('success', 'Berhasil mengirim permintaan reset password, silakan periksa email anda.');
        return back();
    }

    public function set_new_password(Request $request)
    {
        $user = UserResetPassword::where('token', $request->query('token'))->firstOrFail();
        if(date('Y-m-d H:i:s') > $user->expired_at){
            return abort(404);
        }

        return view('setNewPassword');
    }

    public function set_new_password_prosess(Request $request)
    {
        $user = UserResetPassword::where('token', $request->query('token'))->firstOrFail();
        if(date('Y-m-d H:i:s') > $user->expired_at){
            return abort(404);
        }
        
        if($request->password == ''){
            Session::flash('failed', 'Password tidak boleh kosong');
            return back();
        }

        if($request->password != $request->repassword){
            Session::flash('failed', 'Password tidak sama, silakan ulangi kembali');
            return back();
        }

        $user = UserResetPassword::where('token', $request->query('token'))->first();

        User::where('id', $user->user_id)->update([
            'password' => bcrypt($request->password)
        ]);

        UserResetPassword::where('token', $request->query('token'))->delete();

        Session::flash('success', 'Berhasil merubah password, silakan masuk.');
        return redirect()->route('login');
    }
}
