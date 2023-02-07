<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validations = [
        'slug'      => [
            'required',
            'string',
            'max:100',
        ],
        'title'         => 'required|string|max:100',
        'category_id'   => 'required|integer|exists:categories,id',
        'tags'          => 'array',
        'tags.*'        => 'integer|exists:tags,id',
        'image'         => 'url|max:100',
        'uploaded_img'  => 'nullable|image|max:1024',
        'content'       => 'nullable|string',
        'excerpt'       => 'nullable|string',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        // $posts->dd();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all('id', 'name');
        $tags       = Tag::all();

        return view('admin.posts.create', [
            'categories'    => $categories,
            'tags'          => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validations['slug'][] = 'unique:posts';
        $request->validate($this->validations);

        $data = $request->all();

        $img_path = isset($data['uploaded_img']) ? Storage::put('uploads', $data['uploaded_img']) : null;

        // salvare i dati nel db
        $post = new Post;
        $post->slug             = $data['slug'];
        $post->title            = $data['title'];
        $post->category_id      = $data['category_id'];
        $post->image            = $data['image'];
        $post->uploaded_img     = $img_path;
        $post->content          = $data['content'];
        $post->excerpt          = $data['excerpt'];
        $post->save();

        // associamo il post appena creato ai tag
        $post->tags()->attach($data['tags']);

        // ridirezionare (e non ritornare una view)
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all('id', 'name');
        $tags       = Tag::all();

        return view('admin.posts.edit', [
            'post'          => $post,
            'categories'    => $categories,
            'tags'          => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validation
        $this->validations['slug'][] = Rule::unique('posts')->ignore($post);
        $request->validate($this->validations);

        $data = $request->all();

        if (isset($data['uploaded_img'])) {
            $img_path = Storage::put('uploads', $data['uploaded_img']);
            Storage::delete($post->uploaded_img);
        } else {
            $img_path = $post->uploaded_img;
        }

        // salvare i dati nel db
        $post->slug         = $data['slug'];
        $post->title        = $data['title'];
        $post->image        = $data['image'];
        $post->uploaded_img  = $img_path;
        $post->content  = $data['content'];
        $post->excerpt  = $data['excerpt'];
        $post->update();

        $post->tags()->sync($data['tags']);

        // ridirezionare (e non ritornare una view)
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post->tags()->sync([]);
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success_delete', $post);
    }
}
