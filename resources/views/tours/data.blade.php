@foreach ($tours as $tour)
    <div class="col">
        <div class="card h-100">
            <img src="img/tour/default.jpg" class="card-img-top sh-19" alt="card image" />
            <div class="card-body">
                <h5 class="heading mb-3">
                    <a href="#" class="body-link stretched-link">
                        <span class="clamp-line sh-5" data-line="2">{{ $tour->name }}</span>
                    </a>
                </h5>
                <div>
                    <div class="row g-0">
                        <div class="col-auto pe-3">
                            <i data-acorn-icon="like" class="text-primary me-1" data-acorn-size="15"></i>
                            <span class="align-middle">34</span>
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
@endforeach
