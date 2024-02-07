<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commentDB = Comment::orderBy('id', 'DESC')->get();
        // dd($commentDB);
        return to_route('news.show', ['comments' => $commentDB]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        request()->validate([
            'comment' => ['required', 'min:3', 'max:1000'],

        ]);
        $comment = request()->comment;
        $postId = request()->postid;
        // dd($comment, $postId);
        Comment::create([
            'comment' => $comment,
            'post_id' => $postId,
            'user_id' => auth()->user()->id,
        ]);
        return to_route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
