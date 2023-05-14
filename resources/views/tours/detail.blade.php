@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.alert')
        <!-- Title Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">{{ $tour->name }}</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/tours') }}">Tours</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-primary">{{ $tour->name }}</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
                <!-- Top Buttons Start -->
                <div class="col-12 col-sm-6 d-flex align-items-start justify-content-end">
                    <!-- Start Button Start -->
                    <a href="{{ url('admin/export-users') }}"
                        class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-sm-auto">
                        <i data-acorn-icon="chevron-right"></i>
                        <span>Export</span>
                    </a>
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-sm-auto"
                        data-bs-toggle="modal" data-bs-target="#importUsers">
                        <i data-acorn-icon="chevron-right"></i>
                        <span>Import</span>
                    </button>
                    <button type="button" class="btn btn-outline-success btn-icon btn-icon-start w-100 w-sm-auto"
                        data-bs-toggle="modal" data-bs-target="#createData">
                        <i data-acorn-icon="chevron-right"></i>
                        <span>Create</span>
                    </button>
                    {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#largeRightModalExample">Large</button> --}}
                    <!-- Start Button End -->
                </div>
                <!-- Top Buttons End -->
            </div>
        </div>
        <!-- Title End -->

        <div class="row">
            <div class="col-12">
                <div class="card mb-5">
                    <!-- Content Start -->
                    <div class="card-body p-0">
                        <div class="glide glide-gallery" id="glideBlogDetail">
                            <div class="glide glide-large">
                                <div class="glide__track" data-glide-el="track">
                                    <ul class="glide__slides gallery-glide-custom">
                                        <li class="glide__slide p-0">
                                            <a href="{{ $tour->image ? $tour->image : asset('img/tour/default.jpg') }}">
                                                <img alt="detail"
                                                    src="{{ $tour->image ? $tour->image : asset('img/tour/default.jpg') }}"
                                                    class="responsive border-0 rounded-top-end rounded-top-start img-fluid mb-3 sh-50 w-100" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="glide glide-thumb mb-3">
                                <div class="glide__track" data-glide-el="track">
                                    <ul class="glide__slides">
                                        <li class="glide__slide p-0">
                                            <img alt="thumb"
                                                src="{{ $tour->image ? $tour->image : asset('img/tour/default.jpg') }}"
                                                class="responsive rounded-md img-fluid" />
                                        </li>
                                    </ul>
                                </div>
                                <div class="glide__arrows" data-glide-el="controls">
                                    <button class="btn btn-icon btn-icon-only btn-foreground hover-outline left-arrow"
                                        data-glide-dir="<">
                                        <i data-acorn-icon="chevron-left"></i>
                                    </button>
                                    <button class="btn btn-icon btn-icon-only btn-foreground hover-outline right-arrow"
                                        data-glide-dir=">">
                                        <i data-acorn-icon="chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <h4 class="mb-3">{{ $tour->name }}</h4>
                            <div>
                                <p>
                                    {{ $tour->description }}
                                </p>
                                <h6 class="mb-3 mt-5 text-alternate">Tour Location</h6>
                                <p>
                                    {{ $tour->address }}
                                </p>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="active">
                                            <i class="icon fa-solid fa-earth-asia"></i>
                                            <span class="label">{{ $tour->city_name }}</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="active">
                                            <i class="icon fa-solid fa-city"></i>
                                            <span class="label">{{ $tour->city_name }}</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="active">
                                            <i class="icon fa-solid fa-tree-city"></i>
                                            <span class="label">{{ $tour->district_name }}</span>
                                        </a>
                                    </li>
                                    <li><a href="#" class="active">
                                            <i class="icon fa-solid fa-mountain-city"></i>
                                            <span class="label">{{ $tour->sub_district_name }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Content End -->

                    <div class="card-footer border-0 pt-0">
                        <div class="row align-items-center">
                            <!-- Comments and Likes Start -->
                            <div class="col-6 text-muted">
                                <div class="row g-0">
                                    <div class="col-auto pe-3">
                                        <i data-acorn-icon="eye" class="text-primary me-1" data-acorn-size="15"></i>
                                        <span class="align-middle">421</span>
                                    </div>
                                    <div class="col">
                                        <i data-acorn-icon="message" class="text-primary me-1" data-acorn-size="15"></i>
                                        <span class="align-middle">4</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Comments and Likes End -->

                            <!-- Social Buttons Start -->
                            <div class="col-6">
                                <div class="d-flex align-items-center justify-content-end">
                                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-primary ms-1"
                                        type="button">
                                        <i data-acorn-icon="facebook"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-icon-only btn-outline-primary ms-1"
                                        type="button">
                                        <i data-acorn-icon="twitter"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Social Buttons End -->
                        </div>
                    </div>
                </div>

                <!-- About the Author Start -->
                <h2 class="small-title">Tour Location</h2>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-auto">
                                <div class="sw-5 me-3">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container" id="map" style="width:100%; height:580px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About the Author End -->

                <!-- You May Also Like Start -->
                <h2 class="small-title">Testimonials</h2>
                <div class="row g-4">
                    <div class="col-md-4 sh-45">
                        <div class="card h-100">
                            <img src="{{ asset('img/product/small/product-2.webp') }}" class="card-img-top sh-25" alt="card image" />
                            <div class="card-body pb-0">
                                <a href="Pages.Blog.Detail.html"
                                    class="h5 heading body-link stretched-link sh-8 sh-md-6 d-block">
                                    <div class="mb-0 lh-1-5 clamp-line" data-line="2">Testimonial</div>
                                </a>
                            </div>
                            <div class="card-footer border-0 pt-0">
                                <div class="row g-0">
                                    <div class="col-auto pe-3">
                                        <i data-acorn-icon="like" class="text-primary me-1" data-acorn-size="15"></i>
                                        <span class="align-middle">115</span>
                                    </div>
                                    <div class="col">
                                        <i data-acorn-icon="clock" class="text-primary me-1" data-acorn-size="15"></i>
                                        <span class="align-middle">15 Min</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- You May Also Like End -->
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var data = {!! json_encode($location) !!}
        var map_init = L.map('map', {
            center: [9.0820, 8.6753],
            zoom: 8
        });
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map_init);
        L.Control.geocoder().addTo(map_init);
        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        } else {
            navigator.geolocation.getCurrentPosition(mapRoute);
            navigator.geolocation.getCurrentPosition(getPosition);
        };
        var marker, circle, lat, long, accuracy;

        function getPosition(position) {
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy

            marker = L.marker([lat, long])
            circle = L.circle([lat, long], {
                radius: accuracy
            })

            var featureGroup = L.featureGroup([circle]).addTo(map_init)

            map_init.fitBounds(featureGroup.getBounds())

            mapRoute();
        }
        //Geo
        function mapRoute() {
            navigator.geolocation.getCurrentPosition(cekFunction);

            function cekFunction(position) {
                for (var i = 0; i < data.length; i++) {
                    new L.marker([data[i][1], data[i][2]], {
                        win_url: data[i][3],
                    }).bindPopup(data[i][0]).addTo(map_init);
                }
            }
        }
    </script>
@endpush
