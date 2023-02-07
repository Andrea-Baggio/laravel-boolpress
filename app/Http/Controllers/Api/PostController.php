<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        // return view('posts.index', compact('posts'));

        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }


    public function show(Post $post)
    {
        // return view('posts.index', compact('post'));

        return response()->json([
            'success' => true,
            'results' => $post,
        ]);
    }

    // public function everything() {
    //     $posts = Post::all();
    //     $categories = Category::all();

    //     return response()->json([
    //         'posts' => $posts,
    //         'categories'=> $categories,
    //     ]);
    // }
}
