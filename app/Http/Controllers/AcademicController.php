<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\MoreSetting;
use App\Models\Staff;
use App\Models\Student;
use App\Models\StudentPaymentContribution;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AcademicController extends Controller
{
    public function index()
    {
        $setting = MoreSetting::first();
        return view('academic.index', compact('setting'));
    }
    public function personal()
    {
        return view('academic.personal');
    }
    public function setting()
    {
        return view('academic.setting');
    }
    public function setting_prosess(Request $request)
    {
        $rules = [
            'name' => 'required|max:100',
            'username' => 'required|alpha_dash|max:100|unique:users,username,' . Auth::guard('academic')->user()->id,
        ];

        $message = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama terlalu pajang maksimal 100 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.alpha_dash' => 'Username hanya boleh menggunakan huruf dan angka',
            'username.max' => 'Username terlalu panjang',
            'username.unique' => 'Username telah terdaftar, pilih username lain',
        ];

        $validation = Validator::make($request->all(), $rules, $message);

        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        $data['username'] = $request->username;

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user = User::where('id', Auth::guard('academic')->user()->id)->update($data);
        
        if(Auth::guard('academic')->user()->student){
            $profile = Student::where('user_id', Auth::guard('academic')->user()->id)->update(['name' => $request->name]);
        }elseif(Auth::guard('academic')->user()->teacher){
            $profile = Teacher::where('user_id', Auth::guard('academic')->user()->id)->update(['name' => $request->name]);
        }else{
            $profile = Staff::where('user_id', Auth::guard('academic')->user()->id)->update(['name' => $request->name]);
        }

        Session::flash('success', 'Berhasil menyimpan perubahan informasi');
        return back();
    }
    public function finance(Request $request)
    {
        $years = Year::where('id', '>=', Auth::guard('academic')->user()->student->year_id)->groupBy('name')->get();
        
        #Ambil Tahun Pelajaran Sekarang
        $setting = MoreSetting::first();
        
        $year = Year::where('id', $request->query('t') ?? $setting->year_id)->first();
        $semester = $year->status;
        $yearNow = $year->id;

        $contributions = Contribution::get();
        foreach($contributions as $i => $contribution){
            foreach($contribution->item as $j => $item){
                $contributions[$i]->item[$j]->payment = StudentPaymentContribution::where('contribution_item_id', $item->id)->where('user_id', Auth::guard('academic')->user()->id)->get();
            }
        }

        return view('academic.finance', compact('contributions', 'years', 'yearNow', 'semester'));
    }
    public function finance_filter(Request $request)
    {
        $tahun = Year::where('name', 'like', '%' . $request->tahun . '%')->where('status', 'like', '%' . $request->status . '%')->firstOrFail();
        return redirect(url('akademik/keuangan-pribadi?t=' . $tahun->id));
    }
    public function logout()
    {
        Auth::guard('academic')->logout();
        return back();
    }
    public function test()
    {
        return 'tes';
    }
}
