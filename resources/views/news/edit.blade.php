@extends('layouts.app')
@section('title', 'Create ')
@section('content')
    {{-- start create posts forme --}}
    @if (Auth::user())
        <div class="container  pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-success">
                            Edit News
                        </div>
                        {{-- {{ dd($categories->pivot_category_id) }} --}}
                        <div class="card-body">
                            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="title" class="col-md-2 col-form-label text-md-end">Title </label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $post->title }}">
                                        @error('title')
                                            <div class="alert alert-danger mx-auto p-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="content" class="col-md-2 col-form-label text-md-end">Content</label>

                                    <div class="col-md-9">
                                        <textarea class="form-control" id="content" rows="3" name="content">{{ $post->content }}</textarea>
                                        @error('content')
                                            <div class="alert alert-danger mx-auto p-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-md-2 col-form-label text-md-end">Image</label>

                                    <div class="col-md-9">
                                        <input type="file" name="image" class="form-control" id="image">
                                        @error('image')
                                            <div class="alert alert-danger mx-auto p-1 ">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="category" class="col-md-2 col-form-label text-md-end">Category</label>

                                    <div class="col-md-9">
                                        <select class="form-select" name="category" aria-label="Default select example"
                                            id="createBy">

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="createBy" class="col-md-2 col-form-label text-md-end">Create By</label>

                                    <div class="col-md-9">
                                        <input type="text" id="createBy" class="form-control"
                                            value="{{ $post->user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" value=" Edit News" class="btn btn-success">
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
                            Edit News
                        </div>
                        <div class="card-body py-5 my-5 text-center text-danger">
                            please login to your account
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- end create posts forme --}}
@endsection
