<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categoryDB = Category::all();
        return view('categories.index', /* ['categories' => $categoryDB] */);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categoryDB = Category::all();

        return view('categories.create'/* , ['categories' => $categoryDB] */);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        request()->validate([
            'name' => ['required', 'min:3']
        ]);
        $name = request()->name;
        $posts = request()->post->id;
        $slug = Str::slug($request->name, '-');
        $post = Post::findOrFail($posts);
        $post->categories()->attach($posts);

        Category::create([
            'name' => $name,
            'slug' => $slug,
        ]);
        return to_route('categories.index')->with('message', 'will done , category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // $categoryDB = Category::all();

        return view('categories.show', ['category' => $category/* , 'categories' => $categoryDB */]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // $categoryDB = Category::all();
        return view('categories.edit', ['category' => $category/* , 'categories' => $categoryDB */]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        request()->validate([
            'name' => ['required', 'min:3']
        ]);
        $name = request()->name;
        $slug = Str::slug($request->name, '-');
        $updateCategory = Category::findOrFail($category->id);
        $updateCategory->update([
            'name' => $name,
            'slug' => $slug
        ]);


        return to_route('categories.index')->with('message', 'Update Category Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('categories.index')->with('message', 'Delete Category Done');
    }
}
