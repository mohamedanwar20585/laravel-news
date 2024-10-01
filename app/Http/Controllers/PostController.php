<?php

namespace App\Http\Controllers;

use App\Models\Post;
// use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Str;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $postsFormDB = Post::orderBy('id', 'DESC')->get();
        $postsFormDB = Post::with('categories')->orderBy('id', 'DESC')->get();
        // $categoryDB = Category::all();
        // $categoryFormDB = Category::get();
        // dd($postFormDB);
        return view('news.index', ['posts' => $postsFormDB/* , 'categories' => $categoryDB */]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categoriesDB = Category::all();
        return view('news.create'/* , ['categories' => $categoriesDB] */);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'image' => 'required | mimes:jpg,png,jped|max:5048', 
        ]);
        $slug = Str::slug($request->title, '-');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        // dd($newImageName);
        $title = request()->title;
        $content = request()->content;
        $categoris = request()->category;
        $id = DB::table('posts')->max('id') + 1;

        Post::create([
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'post_image' => $newImageName,
            'user_id' => auth()->user()->id,
        ]);
        $category = Category::findOrFail($categoris);
        $category->posts()->attach($id);
        return to_route('posts.index')->with('message', 'Will Don Created News');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post/* , Comment $comment */)
    {
        $commentDB = Comment::orderBy('id', 'DESC')->get();
        // $categoryDB = Category::all();
        // $category = Post::with('categories')->get();
        return view('news.show', ['post' => $post, 'comments' => $commentDB/* ,  'categories' => $categoryDB */]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // $category = Category::all();


        return view('news.edit', ['post' => $post/* , 'categories' => $category */]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'image' => ['required ', 'mimes:jpg,png,jped', 'max:5048'],

        ]);
        // dd($request->image->extension());
        $slug = Str::slug($request->title, '-');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $title = request()->title;
        $content = request()->content;
        $updatePost = Post::findOrFail($post->id);
        $categoris = request()->category;
        $category = Post::findOrFail($post->id);
        $category->categories()->sync($categoris);

        $updatePost->update([
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'post_image' => $newImageName,
            'user_id' => auth()->user()->id,
        ]);




        return to_route('posts.show', $post->id)->with('message', 'Update Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->delete();
        return to_route('posts.index');
    }
}
