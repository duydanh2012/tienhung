<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        $title = 'Người dùng';      

        return view('admin.users.list')->with(compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));

        $user = User::create($data);

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);

        return view('admin.users.form')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->email !== $request->input('email')) {
            $users = User::where('email', $request->input('email'))
                            ->where('id', '<>', $user->id)
                            ->count();
            if ($users) {
                return redirect()->back()->with('alert_error','Đã tồn tại email này!');
            }
        }

        $user->fill($request->input());
        $user->save();

        return redirect(route('users.index'))->with('alert_success', 'Sửa người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect(route('users.index'))->with('alert_success', 'Xóa thành công!');
    }

    public function forget($id)
    {
        $data = User::find($id);
        // $2y$10$29QL98AWSY6OpxM5KH3STel7ev3cJXieYDSi3pUNiq4xm6zA6RKAe
        if($data){

            try {
                $pass = rand(1000000,9999999);
                $data->update(['password'=> Hash::make($pass)]);

                $datas = [
                    'password' => $pass,
                ];

                Mail::send('base.sendEmailPass',$datas ,function($mail) use($data){
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

    public function search(Request $request)
    {
        $rq = $request->input('q');
        $users = User::where('id', 'LIKE', '%' . $rq . '%')
                        ->orWhere('name', 'LIKE', '%' . $rq . '%')
                        ->orWhere('email', 'LIKE', '%' . $rq . '%')
                        ->orWhere('phone', 'LIKE', '%' . $rq . '%')
                        ->paginate(10);
        
        $title = 'Tìm kiếm với từ khóa ' . $rq;                

        return view('admin.users.list')->with(compact('users', 'title'));
    }
}
