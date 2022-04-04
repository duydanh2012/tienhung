<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('categories')->paginate(10);

        $title = 'Bài viết';

        return view('admin.posts.list')->with(compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select([
            'id',
            'name',
            'parent_id',
        ])->get();

        $categories = processSort($categories);
        
        return view('admin.posts.form')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->input();
        $data['author_id'] = Auth::user()->id;
        $data['author_type'] = get_class(Auth::user());

        if($request->input('is_featured')){
            $data['is_featured'] = 1;
        }else{
            $data['is_featured'] = 0;
        }

        if($request->hasFile('image')){
            $img_file_name = $this->saveImage($request->file('image'));

            $data['image'] = $img_file_name;
        }else{
            $data['image'] = '';
        }

        $posts = Post::create($data);

        $slug = Str::slug($posts->name);
        createSlug($slug, $posts);

        $categories = $request->input('category');
        if(!empty($categories) && is_array($categories)){
            $posts->categories()->sync($categories);
        }

        return redirect(route('posts.index'))->with('alert_success', 'Thêm bài viết thành công!');
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
        $categories = Category::select([
            'id',
            'name',
            'parent_id',
        ])->get();

        $categories = processSort($categories);

        $data = Post::with('categories')->find($id);

        return view('admin.posts.form')->with(compact('categories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $data = $request->input();
        $data['author_id'] = Auth::user()->id;
        $data['author_type'] = get_class(Auth::user());

        if($request->input('is_featured')){
            $data['is_featured'] = 1;
        }else{
            $data['is_featured'] = 0;
        }

        if($request->hasFile('image')){
            $img_file_name = $this->saveImage($request->file('image'));

            if($post->image){
                unlink($post->image);
            }
           
            $data['image'] = $img_file_name;
        }

        $slug = Str::slug($request->input('name'));
        updateSlug($slug, $post);

        $post->fill($data);
        $post->save();

        $categories = $request->input('category');
        if(!empty($categories) && is_array($categories)){
            $post->categories()->sync($categories);
        }

        return redirect(route('posts.index'))->with('alert_success', 'Sửa bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->categories()->sync([]);

        deleteSlug($post);

        $post->delete();

        return redirect(route('posts.index'))->with('alert_success', 'Xóa thành công!');
    }

    public function saveImage($img_file){
        if(!empty($img_file)){
            $img_file_extension = $img_file->getClientOriginalExtension();
            $img_file_name = $img_file->getClientOriginalName();
            $img_file_name = date("YmdHis", strtotime(now())) . Str::random(4) . '.' . $img_file_extension;
    
            $img_file->move('uploads/posts', $img_file_name);
            
            return 'uploads/posts/' . $img_file_name;
        }else{
            return '';
        }

    }

    public function search(Request $request)
    {
        $rq = $request->input('q');
        $posts = Post::where('id', 'LIKE', '%' . $rq . '%')
                        ->orWhere('name', 'LIKE', '%' . $rq . '%')
                        ->orWhereHas('categories', function($q) use($rq){
                            $q->where('name', 'LIKE', '%' . $rq . '%');
                        })
                        ->paginate(10);
        
        $title = 'Tìm kiếm với từ khóa ' . $rq;                

        return view('admin.posts.list')->with(compact('posts', 'title'));
    }
}
