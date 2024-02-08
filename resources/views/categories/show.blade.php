@extends('layouts.app')

@section('title', $category->name . ' ')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-primary text-center" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    {{-- {{dd($posts->user ? $posts->user->name : 'not found user')}} --}}
    {{-- start all posts --}}
    <div class="container text-center pt-5">
        <h1 class="fw-bold">{{ $category->name }}</h1>
    </div>
    <div class="container">
        @foreach ($category->posts as $post)
            <div class=" col-xxl-8 px-4 py-2">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                        <img src="{{ url('images') }}/{{ $post->post_image }}" class="d-block mx-lg-auto img-fluid"
                            alt="Bootstrap Themes" width="400" height="300" loading="lazy">
                    </div>
                    <div class="col-lg-6 ">
                        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">{{ $post->title }}</h1>
                        <div class="mb-1 text-body-secondary">{{ $post->user ? $post->user->name : 'not found user' }}
                        </div>
                        <div class="mb-1 text-body-secondary">
                            {{ $post->created_at ? $post->created_at->format('Y-m-d') : 'not found date' }}</div>
                        <p class="lead overflow-hidden">{{ $post->content }}</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="btn btn-secondary btn-sm px-2 col-4 col-md-3">Continue reading</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider">
        @endforeach
    </div>
    {{-- end all posts --}}
@endsection
