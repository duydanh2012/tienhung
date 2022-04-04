<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->paginate(10);

        $title = 'Danh mục';  

        return view('admin.categories.list')->with(compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.categories.form')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        if($request->input('menu')){
            $data['menu'] = 1;
        }else{
            $data['menu'] = 0;
        }

        $categories = Category::create($data);

        $slug = Str::slug($request->input('name'));
        
        createSlug($slug, $categories);
       
        return redirect(route('categories.index'))->with('alert_success', 'Thêm danh mục thành công');
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
        $categories = Category::pluck('name', 'id')->all();
        $data = Category::find($id);

        return view('admin.categories.form')->with(compact('categories', 'data'));
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
        $datas = $request->input();

        if($request->input('menu')){
            $datas['menu'] = 1;
        }else{
            $datas['menu'] = 0;
        }

        $data = Category::find($id);
        $slug = Str::slug($request->input('name'));
        updateSlug($slug, $data);

        $data->fill($datas);

        $data->save();
        return redirect(route('categories.index'))->with('alert_success', 'Sửa danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::destroy($id);

        deleteSlug($data);
        
        return redirect(route('categories.index'))->with('alert_success', 'Xóa thành công!');
    }

    public function search(Request $request)
    {
        $rq = $request->input('q');
        $categories = Category::where('id', 'LIKE', '%' . $rq . '%')
                        ->orWhere('name', 'LIKE', '%' . $rq . '%')
                        ->paginate(10);
        
        $title = 'Tìm kiếm với từ khóa ' . $rq;                

        return view('admin.categories.list')->with(compact('categories', 'title'));
    }
}
