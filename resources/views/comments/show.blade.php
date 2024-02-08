@extends('layouts.app')
@section('title', $comment->slug . ' ')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-primary text-center" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    {{-- start show posts --}}
    @if (Auth::user() && Auth::user()->id == $comment->user_id)
        <div class="container  pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-success">
                            Show News
                        </div>
                        <div class="card-body">
                            <form action="{{ route('posts.update', $comment) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-9 mx-auto">
                                    <textarea class="form-control" id="content" rows="3" name="content">{{ $comment->comment }}</textarea>
                                    @error('content')
                                        <div class="alert alert-danger mx-auto p-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row my-3">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" value=" Edit" class="btn btn-success btn-sm ">
                                        <a href="{{-- {{ route('posts.show', $post->id) }} --}}" class="btn btn-danger btn-sm  "
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Delete</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container  pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-success">
                            Show comment
                        </div>
                        <div class="card-body py-5 my-5 text-center text-danger">
                            please login to your account
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- end show posts --}}



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
                    <form action="{{-- {{ route('posts.destroy', $post->id) }} --}}" method="post">
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
