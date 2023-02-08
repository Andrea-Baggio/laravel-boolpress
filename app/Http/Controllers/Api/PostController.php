<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();

        // return view('posts.index', compact('posts'));

        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }


    public function show($post)
    {
        $post = Post::where('slug', $post)->with(['category', 'tags'])->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'results' => $post,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }


    public function random()
    {
        $posts = Post::inRandomOrder()->limit(9)->get();

        return response()->json([
            'success' => true,
            'results' => $posts,
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
