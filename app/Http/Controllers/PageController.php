<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    public function index()
    {
        $postsFormDB = Post::orderBy('id', 'DESC')->limit(3)->get();
        // $postsFormDB = Post::orderBy('id', 'DESC')->first();
        return view('welcome', ['posts' => $postsFormDB]);
    }
}
