@extends('layouts.app')
@section('title', $post->slug . ' ')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-primary text-center" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    {{-- start show posts --}}
    <div class="container pt-3">
        @if (Auth::user() && Auth::user()->id == $post->user_id)
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm px-4 col-1">
                    Edit</a>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger btn-sm px-4 col-1" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Delete</a>
            </div>
        @endif
        <div class=" col-xxl-8 px-4 py-1">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-1">
                <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                    <img src="{{ url('images') }}/{{ $post->post_image }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6 overflow-hidden" height="50px">
                    @foreach ($post->categories as $category)
                        <div>
                            <strong
                                class="d-inline-block mb-2 text-secondary-emphasis">{{ $category ? $category->name : 'no category' }}</strong>
                        </div>
                    @endforeach
                    <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">{{ $post->title }}</h1>
                    <div class="mb-1 text-body-secondary">{{ $post->user ? $post->user->name : 'not found user' }} </div>
                    <div class="mb-1 text-body-secondary">
                        {{ $post->created_at ? $post->created_at->format('Y-m-d') : 'not found date' }}</div>
                    <p class="overflow-hidden ">{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- end show posts --}}


    <!-- Contenedor Principal -->
    <div class="container">

        @foreach ($comments as $comment)
            @if ($post->id === $comment->post_id)
                <div class="feed__view-comments-wrapper py-3">
                    <div class="comment-cmn__user-pic">
                        <i class="fas fa-user-circle fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="card card-body">
                        <div class="feed__view-comments--user-name">
                            {{ $comment->user->name }}
                        </div>
                        {{ $comment->comment }}
                        @if (Auth::user() && Auth::user()->id == $comment->user_id)
                            <div class="">
                                <a href="{{ route('comments.edit', $comment) }}" class="btn btn-secondary btn-sm px-4 ">
                                    Edit &
                                    Delete</a>
                            </div>
                        @endif
                    </div>

                </div>
            @endif
        @endforeach
        <a class="btn btn-secondary" data-toggle="collapse" href="#collapsibleComment" role="button" aria-expanded="false"
            aria-controls="collapsibleComment">
            <i class="far fa-comment"></i> <span class="">Comment</span>
        </a>

        <!-----comment-Modal-START------>
        @if (Auth::user())
            <div class="collapse pt-2" id="collapsibleComment">
                <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
                    @csrf
                    <div class="feed__add-comment-wrapper">
                        <div class="comment-cmn__user-pic">
                            <i class="fas fa-user-circle fa-2x" aria-hidden="true"></i>
                        </div>
                        <input type="hidden" name="postid" value="{{ $post->id }}">
                        <div class="card card-body">
                            <textarea class="p-3" name="comment">{{ old('comment') }}</textarea>
                        </div>
                        @error('image')
                            <div class="alert alert-danger mx-auto p-1 ">{{ $message }}
                            </div>
                        @enderror

                        <button type="submit" class="add-comment-cmn__submit-icon btn btn-secondary"><i
                                class="fas fa-paper-plane "></i></button>

                    </div>
                </form>

            </div>
        @else
            <div class="collapse pt-2 " id="collapsibleComment">
                <div class="alert alert-danger mx-auto p-1 d-inline-flex"> Please log in to your account
                </div>
            </div>
        @endif



        <!-- Modal delete post -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete News</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are You sure Delete news ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete News" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal delete post -->

    @endsection
