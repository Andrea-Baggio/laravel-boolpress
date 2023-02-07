<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare
        $request->validate([
            'name'          => 'required|string|max:100',
            'slug'          => 'required|string|max:100|unique:categories',
            'description'   => 'nullable|string',
        ]);

        $data = $request->all();

        // salvare nel database
        $category = new Category;
        $category->name =           $data['name'];
        $category->slug =           $data['slug'];
        $category->description =    $data['description'];
        $category->save();

        // ridirezionare
        return redirect()->route('admin.categories.show', ['category' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(6);

        return view('admin.categories.show', [
            'category'  => $category,
            'posts'     => $posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // validare
        $request->validate([
            'name'          => 'required|string|max:100',
            'slug'          => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories')->ignore($category),
            ],
            'description'   => 'nullable|string',
        ]);

        $data = $request->all();

        // aggiornare la riga nel database
        $category->name =           $data['name'];
        $category->slug =           $data['slug'];
        $category->description =    $data['description'];
        $category->update();

        // ridirezionare
        return redirect()->route('admin.categories.show', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // elimimare dal database la riga
        $defaultCategory = Category::where('slug', 'uncategorized')->first();

        foreach ($category->posts as $post) {
            $post->category_id = $defaultCategory->id;
            $post->update();
        }
        $category->delete();

        // ridirezionare
        return redirect()->route('admin.categories.index')->with('success_delete', $category);
    }

    public function slug(Request $request) {
        // localhost:8000/admin/categories/slug?title=ciao a tutti

        $title = $request->query('title');

        // risponde con il primo slug disponibile restituito in formato JSON per essere usato da JS
        $slug = Category::getSlug($title);

        return response()->json([
            'slug'  => $slug,
        ]);
    }
}
