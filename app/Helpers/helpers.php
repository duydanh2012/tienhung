<?php
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

function getUser($model){
    $name = User::where('id', $model->author_id)->first()->name; 
                      
    return  $name;          
}

if (!function_exists('getCategoryHeader')) {
    function getCategoryHeader(int $limit = 3)
    {
        $data = Category::where('menu', 1)
                        ->limit($limit)
                        ->get();
        
        return $data;                
    }
}

if (!function_exists('featuredPost')) {
    function featuredPost(int $limit = 3)
    {
        $data = Post::where('is_featured' , 1)
                    ->with('categories')
                    ->limit($limit)
                    ->get();
        
        return $data;                
    }
}


if (!function_exists('lastPost')) {
    function lastPost(int $limit = 3)
    {
        $data = Post::with('categories')
                    ->limit($limit)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return $data;                
    }
}

if (!function_exists('getPostWithCategory')) {
    function getPostWithCategory($categoryId, $paginate = 0, $limit = 12)
    {
        if(!is_array($categoryId)){
            $categoryId = [$categoryId];
        }

        $data = Post::join('post_categories', 'post_categories.post_id', '=', 'posts.id')
                    ->join('categories', 'categories.id', '=', 'post_categories.category_id')
                    ->whereIn('post_categories.category_id', $categoryId)
                    ->select('posts.*')
                    ->distinct()
                    ->orderBy('posts.created_at', 'desc');

        if($paginate != 0){
            return $data->paginate($paginate);
        }
        
        return $data->limit($limit)->get();                
    }
}

if (!function_exists('getAllPosts')) {
    function getAllPosts($perPage = 4, array $with = ['categories'])
    {
        $data = Post::with($with)
                    ->orderBy('created_at', 'desc')->paginate($perPage);
        
        return $data;                
    }
}

if (!function_exists('countComment')) {
    function countComment($postId)
    {
        $data = Comment::where('post_id', $postId)->count();
        
        return $data;                
    }
}

if (!function_exists('countPostWithCategory')) {
    function countPostWithCategory()
    {
        $data = Category::join('post_categories', 'post_categories.category_id', '=', 'categories.id')
                    ->select('categories.id', 'categories.name as name', DB::raw("count(post_categories.post_id) as count"))
                    ->groupBy('categories.name', 'categories.id')->get();
        return $data;            
    }
}

if (!function_exists('getCommentWithPost')) {
    function getCommentWithPost($postId)
    {
        return Comment::where('post_id', $postId)->with('user')->get();         
    }
}