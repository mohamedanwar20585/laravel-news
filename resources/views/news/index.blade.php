@extends('layouts.app')

@section('title', 'Home ')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-primary text-center" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    {{-- start all posts --}}
    <div class="container text-center pt-5">
        <h1 class="fw-bold">All News</h1>
    </div>
    <div class="container">
        @foreach ($posts as $post)
            <div class=" col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6 mx-auto">
                        <img src="{{ url('images') }}/{{ $post->post_image }}" class="d-block mx-lg-auto img-fluid"
                            alt="Bootstrap Themes" width="400" height="300" loading="lazy">
                    </div>
                    <div class="col-lg-6 ">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">Category</strong>
                        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">{{ $post->title }}</h1>
                        <div class="mb-1 text-body-secondary">{{ $post->user ? $post->user->name : 'not found user' }}
                        </div>
                        <div class="mb-1 text-body-secondary">
                            {{ $post->created_at ? $post->created_at->format('Y-m-d') : 'not found date' }}</div>
                        <p class="lead overflow-hidden">{{ $post->content }}</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="btn btn-secondary btn-lg px-4 col-6">Continue reading</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="featurette-divider">
        @endforeach

    </div>



    {{-- end all posts --}}
@endsection
{{-- {{ dd($posts) }} --}}
