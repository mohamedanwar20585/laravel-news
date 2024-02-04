@extends('layouts.app')
@section('title', 'Create category - ')
@section('content')
    {{-- start create posts forme --}}

    @if (Auth::user())
        <div class="container  pt-5 mb-5"height="200px">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-success">
                            Create Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf

                                <div class="row my-5 ">
                                    <label for="name" class="col-md-2 col-form-label text-md-end">Name </label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="alert alert-danger mx-auto p-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-5">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" value=" Create Category" class="btn btn-success">
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
                            Create Category
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
