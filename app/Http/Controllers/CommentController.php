<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('posts.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Comment::where('post_id', $id)
                        ->with('user')->paginate(10);

        $title = 'Bài viết "' . Post::find($id)->name . '"';
        
        return view('admin.comment.comment')->with(compact('data', 'title', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Comment::destroy($id);

        return redirect()->back()->with('alert_success', 'Xóa thành công!');
    }

    public function search(Request $request, $id)
    {
        $rq = $request->input('q');
        $data = Comment::where('comment', 'LIKE', '%' . $rq . '%')
                        ->orWhereHas('user', function($q) use($rq){
                            $q->where('name', 'LIKE', '%' . $rq . '%');
                        })
                        ->whereHas('post', function($q) use($id){
                            $q->where('id', $id);
                        })
                        ->paginate(10);
        
        $title = 'Tìm kiếm với từ khóa ' . $rq;                

        return view('admin.comment.comment')->with(compact('data', 'title', 'id'));
    }
}
