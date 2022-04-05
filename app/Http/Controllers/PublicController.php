<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Slug;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ChangePassRequest;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Hash;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.views.homepage');
    }

    public function getView($key)
    {
        if (empty($key)) {
            return $this->index();
        }

        $slug = Slug::where('key', $key)->first();

        if(!$slug){
            throw new NotFoundHttpException();
        }

        if($slug->reference_type == Post::class){
            $data = Post::find($slug->reference_id)
                        ->with('user')
                        ->with('categories')
                        ->first();
         
            $data->update([
                'views' => $data->views + 1,
            ]);            
            
            return view('public.views.post')->with(compact('data'));            
        }else if($slug->reference_type == Category::class){
            $data = getPostWithCategory($slug->reference_id, 4);
            $category = Category::find($slug->reference_id);

            return view('public.views.blog')->with(compact('data', 'category'));           
        }

        throw new NotFoundHttpException();
    }

    public function blog()
    {
        return view('public.views.blog');
    }

    public function comment(Request $request, $id)
    {
        $data = $request->input();
        $data['post_id'] = $id;
        $comment = Comment::create($data);
        $comment['user'] = User::find($request->input('user_id'))->name;
        $view = view('public.partials.blog.addComment')->with(compact('comment'))->render();

        return response()->json($view, Response::HTTP_OK);
    }

    public function contact()
    {
        return view('public.views.contact');
    }

    public function postContact(ContactRequest $request)
    {
        Contact::create($request->input());

        $data = array(
            'name'    => $request->input('name'),
            'subject' => $request->input('subject'),
            'messageContact' => $request->input('message'),
            'email'   => $request->input('email'),
        );

        try {
            Mail::send('public.email.send-contact', $data, function($mail) use ($data){
                $mail->from($data['email'], $data['name']);
                $mail->to('abc2012199@gmail.com', 'Admin')->subject('Liên hệ');
            });
        } catch (\Throwable $th) {
           dd($th);
        }

        return redirect()->back()->with('alert_success','Gửi thư thành công!');
    }

    public function search(Request $request)
    {
        $rq = $request->input('search');
        $data = Post::where('id', 'LIKE', '%' . $rq . '%')
                        ->orWhere('name', 'LIKE', '%' . $rq . '%')
                        ->orWhereHas('categories', function($q) use($rq){
                            $q->where('name', 'LIKE', '%' . $rq . '%');
                        })
                        ->paginate(10);
        
        $category = (object)[
            'name' => 'Tìm kiếm với từ khóa: '. $rq,
        ]; 

        return view('public.views.blog')->with(compact('data', 'category'));        
    }

    public function user()
    {
        if(Auth::check()){
            $data = User::find(Auth::user()->id);

            return view('public.views.user')->with(compact('data'));
        }

        return redirect(route('public.login'));
    }

    public function updateUser(Request $request)
    {
        if(!Auth::check()){
            return redirect(route('public.login'));
        }

        $user = User::find(Auth::user()->id);

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

        return redirect(route('public.user'))->with('alert_success', 'Chỉnh sửa thông tin thành công');
    }

    public function changePass()
    {
        if(Auth::check()){
            return view('public.views.change-pass');
        }

        return redirect(route('public.login'));
    }

    public function updatePass(ChangePassRequest $request)
    {
        if(Hash::check($request->input('password'), Auth::user()->password)) {
            if ($request->input('password') !== $request->input('passwordNew')) {
                User::find(Auth::user()->id)->update(['password'=> Hash::make($request->input('passwordNew'))]);

                return redirect()->back()->with('alert_success','Thay Đổi Mật Khẩu Thành Công!');
            }else {
                return redirect()->back()->with('alert_error','Mật Khẩu Mới Phải Khác Mật Khẩu Cũ !');
            }
        }else{
            return redirect()->back()->with('alert_error','Sai Mật Khẩu!');
        }
    }

    public function bookmark(Request $request)
    {
        $data = Post::find($request->id);
                 
        $bookmark = Bookmark::create([
                        'user_id' => Auth::user()->id,
                        'post_id' => $data->id,
                    ]);  
                   
        return response()->json($bookmark, Response::HTTP_OK);          
    }

    public function unbookmark(Request $request)
    {
        $bookmark = Bookmark::where('user_id', Auth::user()->id)
                            ->where('post_id', $request->id)
                            ->first();
        $bookmark->delete();
        
        return response()->json(Response::HTTP_OK);    
    }

    public function getBookmark()
    {
        $user = Auth::user();
        $posts = Post::whereHas('bookmark', function($q) use($user){
                            $q->where('user_id', $user->id);
                        })->paginate(6);
        return view('public.views.bookmark')->with(compact('posts'));               
    }
}
