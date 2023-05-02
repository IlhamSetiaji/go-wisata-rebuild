@extends('layouts.app')
@section('content')
    <div class="container">
        <!-- Title Start -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Blog Grid</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="Pages.html">Pages</a></li>
                            <li class="breadcrumb-item"><a href="Pages.Blog.html">Blog</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Title End -->

        <div class="row">
            <div class="col-12 col-xl-8 col-xxl-9 mb-5">
                <!-- Grid Start -->
                <div id="data-wrapper" class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-2 mb-5">
                    @include('tours.data')
                </div>
                <!-- Grid End -->

                <div class="row">
                    {{-- <div class="col-12 text-center">
                        <button class="btn btn-xl btn-outline-primary sw-30">Load More</button>
                    </div> --}}
                    <!-- Data Loader -->
                    <div class="auto-load col-12 text-center" style="display: none;">
                        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60"
                            viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <path fill="#000"
                                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                    dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Side Start -->
            <div class="col-12 col-xl-4 col-xxl-3">
                <div class="row">
                    <!-- Mailing List Start -->
                    <div class="col-12">
                        <div class="card mb-5">
                            <div class="card-body row g-0">
                                <div class="col-12">
                                    <div class="cta-3">Ready to make bread?</div>
                                    <div class="mb-3 cta-3 text-primary">Join our email list!</div>
                                    <div class="text-muted mb-3">Cheesecake chocolate carrot cake pie lollipop lemon drops.
                                    </div>
                                    <div class="d-flex flex-column justify-content-start">
                                        <div class="text-muted mb-2">
                                            <input type="email" class="form-control" placeholder="E-mail" />
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-icon btn-icon-start btn-primary">
                                        <i data-acorn-icon="chevron-right"></i>
                                        <span>Join</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mailing List End -->

                    <!-- Must Read Start -->
                    <div class="col-12">
                        <h2 class="small-title">Must Read</h2>
                        <div class="mb-5">
                            <div class="row mb-n2">
                                <div class="col-12 col-md-6 col-xl-12 mb-2">
                                    <div class="card sh-11 sh-sm-14">
                                        <div class="row g-0 h-100">
                                            <div class="col-auto">
                                                <img src="img/product/small/product-1.webp" alt="alternate text"
                                                    class="card-img card-img-horizontal sw-10 sw-sm-14" />
                                            </div>
                                            <div class="col position-static">
                                                <div
                                                    class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                                                    <div class="d-flex flex-column">
                                                        <a href="Pages.Blog.Detail.html" class="stretched-link body-link">
                                                            <div class="clamp-line" data-line="2">A Complete Guide to Mix
                                                                Dough for the Molds</div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12 mb-2">
                                    <div class="card sh-11 sh-sm-14">
                                        <div class="row g-0 h-100">
                                            <div class="col-auto">
                                                <img src="img/product/small/product-2.webp" alt="alternate text"
                                                    class="card-img card-img-horizontal sw-10 sw-sm-14" />
                                            </div>
                                            <div class="col position-static">
                                                <div
                                                    class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                                                    <div class="d-flex flex-column">
                                                        <a href="Pages.Blog.Detail.html" class="stretched-link body-link">
                                                            <div class="clamp-line" data-line="2">Apple Cake Recipe for
                                                                Starters</div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12 mb-2">
                                    <div class="card sh-11 sh-sm-14">
                                        <div class="row g-0 h-100">
                                            <div class="col-auto">
                                                <img src="img/product/small/product-3.webp" alt="alternate text"
                                                    class="card-img card-img-horizontal sw-10 sw-sm-14" />
                                            </div>
                                            <div class="col position-static">
                                                <div
                                                    class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                                                    <div class="d-flex flex-column">
                                                        <a href="Pages.Blog.Detail.html" class="stretched-link body-link">
                                                            <div class="clamp-line" data-line="2">Basic Introduction to
                                                                Bread Making</div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12 mb-2">
                                    <div class="card sh-11 sh-sm-14">
                                        <div class="row g-0 h-100">
                                            <div class="col-auto">
                                                <img src="img/product/small/product-4.webp" alt="alternate text"
                                                    class="card-img card-img-horizontal sw-10 sw-sm-14" />
                                            </div>
                                            <div class="col position-static">
                                                <div
                                                    class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                                                    <div class="d-flex flex-column">
                                                        <a href="Pages.Blog.Detail.html" class="stretched-link body-link">
                                                            <div class="clamp-line" data-line="2">Easy and Efficient
                                                                Tricks for Baking Crispy Breads</div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Must Read End -->

                    <!-- Categories Start -->
                    <div class="col-12 col-sm-6 col-xl-12">
                        <h2 class="small-title">Categories</h2>
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="row g-0">
                                    <div class="col-12 col-sm-6 mb-n2">
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Anpan</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Arboud</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Arepa</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Baba</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Bagel</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Chapati</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Bammy</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Kalach</a>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-n2">
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Kulcha</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Matzo</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Mohnflesserl</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Pan Dulce</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Pane Ticinese</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Pita</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Rieska</a>
                                        <a href="Pages.Blog.List.html" class="body-link d-block mb-2">Zopf</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Categories End -->

                    <!-- Tags Start -->
                    <div class="col-12 col-sm-6 col-xl-12">
                        <h2 class="small-title">Tags</h2>
                        <div class="card mb-5">
                            <div class="card-body">
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Food (12)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Baking (3)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Sweet (1)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Molding (3)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Pastry (5)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Healthy (7)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Rye (3)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Simple (3)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Cake (2)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Recipe (6)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Bread (8)</span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-icon-end btn-outline-primary mb-1 me-1"
                                    href="Pages.Blog.List.html">
                                    <span>Wheat (2)</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Tags End -->
                </div>
            </div>
            <!-- Right Side End -->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const ENDPOINT = "{{ route('tours.index') }}";
        let page = 1;

        /*------------------------------------------
        --------------------------------------------
        Call on Scroll
        --------------------------------------------
        --------------------------------------------*/
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        });

        /*------------------------------------------
        --------------------------------------------
        call infinteLoadMore()
        --------------------------------------------
        --------------------------------------------*/
        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    if (response.html == '') {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }

                    $('.auto-load').hide();
                    $("#data-wrapper").append(response.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
@endpush
