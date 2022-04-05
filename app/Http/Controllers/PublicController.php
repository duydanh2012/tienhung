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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;

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
                        ->with('categories')->first();
         
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
}
