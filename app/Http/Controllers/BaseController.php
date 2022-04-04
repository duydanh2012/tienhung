<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

class BaseController extends Controller
{
    public function login()
    {
        return view('base.login');
    }

    public function auth(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' =>$request->input('password')])) {

            if(Auth::user()->admin == 0){
                return redirect()->back();
            }elseif(Auth::user()->admin == 1){
                return redirect(route('dashboard'));
            }
        }else {
            return redirect(route('public.login'))->with('alert_error','Sai Tài Khoản Hoặc Mật Khẩu!');
        }
    }

    public function registration()
    {
        return view('base.registration');
    }

    public function registrationPost(RegistrationRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));

        $user = User::create($data);

        return redirect(route('public.login'))->with('alert_success','Đăng ký thành công!');
    }

    public function forget()
    {
        return view('base.forget');
    }

    public function forgetPost(Request $request)
    {
        $data = User::where('email', $request->email)->first();
        // $2y$10$29QL98AWSY6OpxM5KH3STel7ev3cJXieYDSi3pUNiq4xm6zA6RKAe
        if($data){
            $data->password = rand(1000000,9999999);

            try {
                User::find($data->id)->update(['password'=> Hash::make($data->password)]);

                $datas = [
                    'password' => $data->password
                ];

                Mail::send('base.sendEmailPass',$datas ,function($mail) use($data, $request){
                    $mail->from('abc2012199@gmail.com', 'Support ');
                    $mail->to($data->email, $data->name)->subject('Forget Pass');
                });

                return redirect()->back()->with('alert_success','Mật Khẩu Đã Gửi Đến Email Này!');
            } catch (\Throwable $th) {
                return redirect()->back()->with('alert_error',$th);
            }
        }else{
            return redirect()->back()->with('alert_error','Không Tìm Thấy Người Dùng Có Email Này!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('public.login'));
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('admin.dashboard');
        } else {
            return view('base.login');
        }

    }
}
