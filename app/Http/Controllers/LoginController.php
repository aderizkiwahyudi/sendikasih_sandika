<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\RecruitmentEmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view('login');
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
}
