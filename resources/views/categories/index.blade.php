@extends('layouts.app')
@section('title', 'Category - ')
@section('content')
    @if (Auth::check())
        @if (session()->has('message'))
            <div class="alert alert-primary text-center" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        {{-- start all category --}}
        <div class="container text-center pt-5">
            <h1 class="fw-bold">Categories</h1>
            <a class="btn btn-success " href="{{ route('categories.create') }}">Create Category</a>
        </div>
        <div class="container text-center p-3">

            <div class="container row justify-content-md-center">
                <div class=" col-md-7">
                    <table class="table  ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($categories as $category)
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a class="btn btn-info "
                                            href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                        {{-- <a class="btn btn-info " href="{{ route('categories.show', $category->id) }}">show</a> --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure delete category ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Category</button>
                        </form>

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
                            Category
                        </div>
                        <div class="card-body py-5 my-5 text-center text-danger">
                            please login to your account
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- end all category --}}
@endsection
