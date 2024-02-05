@extends('layouts.app')

@section('content')
    {{-- start Carousel --}}
    <div class="container py-5">
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class=""
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"
                    class=""></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img src="{{ url('images') }}/{{ $postOne->post_image }}" class="d-block w-100" alt="...">
                    <div class="container">
                        <div class="carousel-caption ">
                            <h1>{{ $postOne->title }}</h1>
                            <p class="opacity-75">{{ $postOne->content }}
                            </p>
                            <p><a class="btn btn-lg btn-primary" href="{{ route('posts.show', $postOne->id) }}">Read
                                    More</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item active">
                    <img src="{{ url('images') }}/{{ $postSecond->post_image }}" class="d-block w-100" alt="...">
                    <div class="container">
                        <div class="carousel-caption">
                            {{-- {{ dd($postSecond) }} --}}
                            <h1>{{ $postSecond->title }}</h1>
                            <p>{{ $postSecond->content }}</p>
                            <p><a class="btn btn-lg btn-primary" href="{{ route('posts.show', $postSecond->id) }}">Read
                                    More</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ url('images') }}/{{ $postTherd->post_image }}" class="d-block w-100" alt="...">
                    <div class="container">
                        <div class="carousel-caption ">

                            <h1>{{ $postTherd->title }}</h1>
                            <p>{{ $postTherd->content }}</p>
                            <p><a class="btn btn-lg btn-primary" href="{{ route('posts.show', $postTherd->id) }}">Read
                                    More</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    {{-- end Carousel --}}

    {{-- start category --}}
    {{-- {{$categories}} --}}
    <div class="container">
        @foreach ($categories as $category)
            <h4>{{ $category->name }} </h4>
            <div class="album py-3 bg-body-tertiary ">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3  ">
                    @foreach ($category->posts->take(3) as $post)
                        <div class="col d-flex align-items-stretch">
                            <div class="card shadow-sm ">
                                <img src="{{ url('images') }}/{{ $post->post_image }}"
                                    class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes"width="100%" height="225"
                                    loading="lazy">
                                <div class="card-body">
                                    <h4>{{ $post->title }}</h4>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a type="button" href="{{ route('posts.show', $post->id) }}"
                                                class="btn btn-sm btn-outline-secondary">View</a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-body-secondary">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="border border-secondary-subtle my-5"></div>
            {{-- @endif --}}
        @endforeach
    </div>
    {{-- end category --}}
    {{-- start subscribe --}}
    <div class="container">
        <div class="col-md-7 offset-md-1 mb-3">
            <form>
                <h5>Subscribe to our newsletter</h5>
                <p>Monthly digest of what's new and exciting from us.</p>
                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                    <label for="newsletter1" class="visually-hidden">Email address</label>
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                    <button class="btn btn-primary col-4" type="button">Subscribe</button>
                </div>
            </form>
        </div>
    </div>

    {{-- end subscribe --}}
@endsection
