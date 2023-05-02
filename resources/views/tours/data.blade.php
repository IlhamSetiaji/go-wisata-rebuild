@foreach ($tours as $tour)
    <div class="col">
        <div class="card h-100">
            <img src="{{ $tour->image ? $tour->image : 'img/tour/default.jpg' }}" class="card-img-top sh-19"
                alt="card image" />
            <div class="card-body">
                <h5 class="heading mb-3">
                    <a href="#" class="body-link stretched-link">
                        <span class="clamp-line sh-5" data-line="2">{{ $tour->name }}</span>
                    </a>
                </h5>
                <div>
                    <div class="row g-0">
                        <div class="col-auto pe-3">
                            <i class="fa-solid fa-location-dot text-primary me-1"></i>
                            <span
                                class="align-middle">{{ $tour->sub_district_name . ', ' . $tour->district_name . ', ' . $tour->city_name . ', ' . $tour->province_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
