@extends('home.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-10 offset-md-1 my-sm-4">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb fw-bold fs-6">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}"
                                    class="text-decoration-none text-black">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Filter
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- Main Section -->
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <!-- items Section start -->
                        <div class="col-md-8 order-md-2">
                            <div class="row">
                                @if($items->count() < 1) <h1 class="text-center text-warning my-5">No items
                                    found!</h1>
                                    @else
                                    @foreach($items as $item)
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <a href="{{ route('item.details', $item->id) }}" class="text-decoration-none">
                                            <div class="card mt-3">
                                                <img src="{{ asset('storage/item_images/' . $item->image) }}"
                                                    style="height:150px" class="card-img-top img-fluid object-fit-cover"
                                                    alt="image">
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
                                                        <img src="{{ asset('default_images/profile.png') }}"
                                                            alt="profile image" style="width:30px; height:30px;"
                                                            class="rounded-circle">
                                                        <span class="fs-6 d-sm-inline d-block">{{ $item->owner_name
                                                            }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                    @endif
                            </div>
                            <div class="mt-2">
                                {{ $items->links() }}
                            </div>
                        </div>
                        <!-- items section end -->

                        <!-- filter Section -->
                        <div class="col-md-4 order-md-1">
                            <form action="{{ route('home.filter') }}" method="GET">
                                @csrf
                                <h6>Filter By
                                    <a href="{{ route('home.clear') }}"
                                        class="text-danger text-decoration-none float-end">Clear Filter</a>
                                </h6>
                                <div class="my-4">
                                    <h6 class="text-muted">Sorting</h6>
                                    <input type="radio" id="latest" name="latestPopular" value="latest" {{
                                        request()->query('latest') ? 'checked' : '' }}>
                                    <label for="latest" class="user-select-none me-4">Latest</label>
                                    <input type="radio" id="popular" name="latestPopular" value="popular" {{
                                        request()->query('popular') ? 'checked' : '' }}>
                                    <label for="popular" class="user-select-none">Popular</label>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Item Name</label>
                                    <input type="text" name="name" id="name" class="form-control bg-light mt-2"
                                        placeholder="Input Name">
                                </div>
                                <div class="mb-3 row">
                                    <label>Price Range</label>
                                    <div class="col-6">
                                        <input type="number" name="min" class="form-control bg-light" placeholder="min">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max" class="form-control bg-light" placeholder="max">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-select bg-light mt-2">
                                        <option value="">Choose one</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="condition">Item Condition</label>
                                    <select name="condition" id="condition" class="form-select bg-light mt-2">
                                        <option value="">Choose one</option>
                                        <option value="0">New</option>
                                        <option value="1">Used</option>
                                        <option value="2">Good Second Hand</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-select bg-light mt-2">
                                        <option value="">Choose one</option>
                                        <option value="0">For Sell</option>
                                        <option value="1">For Buy</option>
                                        <option value="2">For Exchange</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary text-center py-3 w-100">Apply
                                        Filter</button>
                                </div>
                            </form>
                        </div>
                        <!-- filter Seciton end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
