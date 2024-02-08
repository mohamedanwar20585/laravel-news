<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $CategoryFormDBAll = Category::with('posts')->get();
        $postsFormDBAll = Post::orderBy('id', 'DESC')->get();
        $postsFormDB = Post::orderBy('id', 'DESC')->limit(3)->get();
        $postsFormDBFirst = Post::orderBy('id', 'DESC')->first();
        $postsFormDBSecond = Post::orderBy('id', 'DESC')->skip(1)->take(1)->first();
        $postsFormDBTherd = Post::orderBy('id', 'DESC')->skip(2)->take(1)->first();
        $categoryDB = Category::all();
        return view('welcome', [
            'posts' => $postsFormDB,
            'postsAll' => $postsFormDBAll,
            'postOne' => $postsFormDBFirst,
            'postSecond' => $postsFormDBSecond,
            'postTherd' => $postsFormDBTherd,
            'categories' => $CategoryFormDBAll,
            'categories' => $categoryDB
        ]);
    }
}
