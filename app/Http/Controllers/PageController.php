<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    public function index()
    {

        $CategoryFormDBAll = Category::with('posts')->get();
        $postsFormDBAll = Post::with('categories')->orderBy('id', 'DESC')->get();
        $postsFormDB = Post::orderBy('id', 'DESC')->limit(3)->get();
        $postsFormDBFirst = Post::orderBy('id', 'DESC')->first();
        $postsFormDBSecond = Post::orderBy('id', 'DESC')->skip(1)->take(1)->first();
        $postsFormDBTherd = Post::orderBy('id', 'DESC')->skip(2)->take(1)->first();
        // $postsFormDB = Post::orderBy('id', 'DESC')->first();
        return view('welcome', ['posts' => $postsFormDB, 'postsAll' => $postsFormDBAll, 'postOne' => $postsFormDBFirst, 'postSecond' => $postsFormDBSecond, 'postTherd' => $postsFormDBTherd, 'categories' => $CategoryFormDBAll]);
    }
}
