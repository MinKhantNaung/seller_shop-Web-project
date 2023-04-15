@extends('home.layouts.app')

@section('title', 'Seller Shop Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <section id="header">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('home.index') }}">Home</a>
                        <form action="{{ route('logout') }}" method="POST" class="float-end">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">Logout</button>
                        </form>
                        <img src="{{ asset('default_images/back.jpg') }}" alt="image"
                            class="w-100 img-fluid object-fit-cover">
                        <div class="col-md-6 offset-md-3" id="searchBar">
                            <form action="{{ route('home.search') }}" method="GET">

                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </span>
                                    <input type="text" name="searchKey" class="form-control py-2" placeholder="Search">
                                    <select name="category_id">
                                        <option value="">Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-primary ms-3">Search</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Section -->
            <section id="main">
                <div class="container">
                    <div class="row">
                        <div class="col-12 my-4">
                            <!-- Category Section -->
                            <section id="category">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <h5>
                                            All Categories
                                        </h5>
                                        <div class="row my-sm-5">
                                            @foreach($categories as $category)
                                            <div class="col-lg-2 col-sm-3 col-4 mt-2">
                                                <a href="{{ route('home.category', $category->id) }}">
                                                    <div class="p-2 position-relative"
                                                        style="height:120px; background: rgb(220, 231, 231);">
                                                        <div class="position-absolute top-50 start-50 translate-middle">
                                                            <div style="width:40px;height:40px">
                                                                <img src="{{ asset('storage/category_images/' . $category->image) }}"
                                                                    alt="image"
                                                                    class="w-100 img-fluid object-fit-cover rounded-circle ms-2"
                                                                    style="height:100%">
                                                            </div>
                                                            <div class="text-muted text-center fs-6 text-capitalize">
                                                                {{ $category->name }}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
