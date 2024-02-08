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
        <div class="container  p-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-success">
                            Show News
                        </div>
                        <div class="card-body my-3">
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-9 mx-auto">
                                    <textarea class="form-control" id="content" rows="3" name="content">{{ $comment->comment }}</textarea>
                                    @error('content')
                                        <div class="alert alert-danger mx-auto p-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row my-2 py-2 ">
                                    <div class="col-md-6 offset-md-4 ">
                                        <input type="submit" value=" Edit" class="btn btn-success btn-sm ">
                                        <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-danger btn-sm  "
                                            data-bs-toggle="modal" data-bs-target="#exampleModa2">
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
                            update & Delete Comment
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



    <!-- Modal delete comment -->
    <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabe2">Delete Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You sure Delete Comment ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete Comment" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end Modal delete comment -->

@endsection
