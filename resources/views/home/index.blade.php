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
                        <form action="{{ route('logout') }}" method="POST" class="float-end">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning position-fixed end-0">Logout</button>
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
                                        <h5>What are you looking for ?
                                            <a href="{{ route('home.allCategories') }}" class="text-decoration-none float-sm-end fs-6">View More
                                                ></a>
                                        </h5>
                                        <div class="row my-sm-5">
                                            @foreach($categories->take(6) as $category)
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

                            <!-- Items Section -->
                            <seciton id="items">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1 mt-sm-0 mt-3">
                                        <h5>Recent items
                                            <a href="{{ route('home.allItems') }}" class="text-decoration-none float-end fs-6">View More ></a>
                                        </h5>
                                        <div class="row mt-sm-4">
                                            @if($items->count() < 1) <h1 class="text-center text-warning my-5">No items
                                                found!</h1>
                                                @else
                                            @foreach($items as $item)
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                <a href="{{ route('item.details', $item->id) }}" class="text-decoration-none">
                                                    <div class="card mt-3">
                                                        <img src="{{ asset('storage/item_images/' . $item->image) }}" style="height:150px"
                                                            class="card-img-top img-fluid object-fit-cover" alt="image">
                                                        <div class="card-body" style="background: rgb(220, 231, 231);">
                                                            <h6 class="card-title text-capitalize">{{ $item->name }} <span
                                                                    class="text-info fw-bold fs-6">
                                                                    @if($item->condition == 0)
                                                                        New
                                                                    @elseif($item->condition == 1)
                                                                        Used
                                                                    @elseif($item->condition == 2)
                                                                        Good Second Hand
                                                                    @endif
                                                                </span>
                                                            </h6>
                                                            <p class="card-text text-primary fs-6">$ {{ $item->price }}</p>
                                                            <div>
                                                                <img src="{{ asset('default_images/profile.png') }}" alt="profile image"
                                                                    style="width:30px; height:30px;"
                                                                    class="rounded-circle">
                                                                <span class="fs-6 d-sm-inline d-block">{{ $item->owner_name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </seciton>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
