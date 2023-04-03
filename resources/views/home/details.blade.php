@extends('home.layouts.app')

@section('title', 'Seller Shop Home')
@section('style')
<!-- Map Picker leaflet.css -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<!-- Map Picker from dist -->
<link rel="stylesheet" href="{{ asset('dist/leaflet-locationpicker.src.css') }}" />
@endsection
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
                            <li class="breadcrumb-item"><a href="{{ route('home.category', $item->category->id) }}"
                                    class="text-decoration-none text-black">{{ $item->category->name }}</a>
                            </li>
                            <li class="breadcrumb-item text-primary" aria-current="page">{{ $item->name }}</li>
                        </ol>
                    </nav>
                </div>

                <!-- item image section -->
                <div class="col-md-10 offset-md-1 text-center my-3 bg-light">
                    <img src="{{ asset('storage/item_images/' . $item->image) }}" alt="image"
                        class="img-fluid object-fit-cover">
                </div>
                <!-- item image section end -->

                <!-- Main Section -->
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <!-- information Section start -->
                        <div class="col-md-6">
                            <h5 class="text-capatilize fw-bold mt-3">{{ $item->name }}</h5>
                            <h6 class="fw-bold text-primary">${{ $item->price }}</h6>
                            <table class="col-9 my-4">
                                <tr style="font-size: 15px">
                                    <th class="col-4">Type</th>
                                    <th class="col-4 text-center">Condition</th>
                                    <th class="col-4 text-center">Status</th>
                                </tr>
                                <tr style="font-size: 13px">
                                    <td class="text-danger">
                                        @if($item->type == 0)
                                        For Sell
                                        @elseif($item->type == 1)
                                        For Buy
                                        @else
                                        For Exchange
                                        @endif
                                    </td>
                                    <td class="text-primary text-center">
                                        @if($item->condition == 0)
                                        New
                                        @elseif($item->condition == 1)
                                        Used
                                        @else
                                        Good Second Hand
                                        @endif
                                    </td>
                                    <td class="text-success text-center">
                                        @if($item->is_publish == 1)
                                        Available
                                        @else
                                        Unavailable
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <h6 style="font-size: 15px">Highlighted Information</h6>
                            <small style="font-size: 13px">Try a quick search to explore hundreds of affordable
                                options.</small>
                            <div class="my-4">
                                <h6 style="font-size: 15px">Product Description</h6>
                                <small style="font-size: 14px">
                                    {{ $item->description }}
                                </small>
                            </div>
                            <h6 style="font-size: 15px" class="fw-bold">Owner Information</h6>
                            <div class="my-4 rounded shadow-sm p-3" style="font-size: 14px">
                                <p>
                                    <i class="fa-solid fa-phone me-2"></i>
                                    Contact Number
                                </p>
                                <p>+95 {{ $item->phone }}</p>
                            </div>
                            <div class="mb-3 p-3 rounded d-flex justify-content-start"
                                style="background: rgb(198, 233, 233)">
                                <div class="me-2">
                                    <img src="{{ asset('default_images/profile.png') }}" alt="image"
                                        class="img-fluid object-fit-cover rounded-circle"
                                        style="width:40px;height:40px">
                                </div>
                                <div style="font-size:13px">{{ $item->owner_name }} <br> {{ $item->address }}</div>
                            </div>
                        </div>
                        <!-- information section end -->

                        <!-- filter Section -->
                        <div class="col-md-6">
                            <h6 class="text-capatilize mt-3">
                                <i class="fa-solid fa-location-dot me-2"></i>Location
                            </h6>
                            <!-- <h6 id="locationName"></h6> -->
                            <!-- Map Picker Start -->
                            <input class="example" name="coordinates" type="text" value="{{ $item->coordinates }}" />
                            <div id="mapContainer" class="w-100" style="height: 500px"></div>
                            <!-- Map Picker End -->
                        </div>
                        <!-- filter Seciton end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Jquery Js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- Map Picker leaflet.js -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<!-- Map Picker from dist -->
<script src="{{ asset('dist/leaflet-locationpicker.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.example').leafletLocationPicker({
            alwaysOpen: true,
            mapContainer: "#mapContainer",
            position: 'bottomleft',
            height: 500,
        });
    });

</script>
@endsection
