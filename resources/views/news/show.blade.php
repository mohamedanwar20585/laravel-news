@extends('layouts.app')
@section('title', $post->slug . ' ')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-primary text-center" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    {{-- start show posts --}}
    <div class="container pt-5">

        <div class=" col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
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
                    @if (Auth::user() && Auth::user()->id == $post->user_id)
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-lg px-4 col-4">
                                Edit</a>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger btn-lg px-4 col-4"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Delete</a>
                        </div>
                    @endif



                </div>
            </div>
        </div>
    </div>

    {{-- end show posts --}}
    <!-- Modal -->
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
@endsection
