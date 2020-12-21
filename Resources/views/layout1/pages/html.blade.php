@extends('cup_site.layouts.layout1')


@section('content')
<!-- -->
<section>
    <div class="container">
        {!!   $page['content_it'] !!}
{{--        <div class="row">--}}

{{--            <div class="col-12 col-lg-4 mb-5">--}}
{{--                --}}
{{--                <h2 class="m-0 fs-25">--}}
{{--                    Boxed water is better--}}
{{--                </h2>--}}
{{--                <h6 class="font-weight-normal mb-4">--}}
{{--                    June 29, 2019 &ndash; Present--}}
{{--                </h6>--}}

{{--                <p>--}}
{{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.--}}
{{--                </p>--}}

{{--                <div class="border-left border-primary bw--3 py-1 px-3 my-5">--}}
{{--                    <h2 class="mb-0 h5">Beyond the future</h2>--}}
{{--                    <p class="mb-0 text-gray-500">Healthy! 100% Natural!</p>--}}
{{--                </div>--}}

{{--                <p>--}}
{{--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.--}}
{{--                </p>--}}

{{--                <div class="mt-5">--}}
{{--                    <a href="https://unsplash.com/@boxedwater" target="unsplash" rel="noopener" class="btn btn-lg btn-outline-dark shadow-none btn-block">--}}
{{--                        Visit Website--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--            </div>--}}


{{--            <!----}}
{{--                In order for lazyload to work, a height is required, else all images are in viewport.--}}
{{--                By default, an empty png is set with 400px height:--}}
{{--                http://png-pixel.com/--}}
{{--            -->--}}
{{--            <div class="col-12 col-lg-8">--}}

{{--                <div class="bg-white shadow-primary-xs mb-5">--}}
{{--                    <img height="500" class="img-fluid lazy rounded" data-src="demo.files/images/unsplash/portfolio/boxed-water-is-better-CYEgCGYm2JY-unsplash-min.jpg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAGQCAQAAADFUcJQAAAAFElEQVR42mNkYGAcRaNoFI2ioYAAsLUBkdmEbfIAAAAASUVORK5CYII=" alt="...">--}}
{{--                </div>--}}


{{--                <div class="bg-white shadow-primary-xs mb-5">--}}
{{--                    <img height="500" class="img-fluid lazy rounded" data-src="demo.files/images/unsplash/portfolio/boxed-water-is-better-D1KrCHVipIw-unsplash-min.jpg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAGQCAQAAADFUcJQAAAAFElEQVR42mNkYGAcRaNoFI2ioYAAsLUBkdmEbfIAAAAASUVORK5CYII=" alt="...">--}}
{{--                </div>--}}


{{--                <div class="bg-white shadow-primary-xs mb-5">--}}
{{--                    <img height="500" class="img-fluid lazy rounded" data-src="demo.files/images/unsplash/portfolio/boxed-water-is-better-GoYNk3CrgxQ-unsplash-min.jpg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAGQCAQAAADFUcJQAAAAFElEQVR42mNkYGAcRaNoFI2ioYAAsLUBkdmEbfIAAAAASUVORK5CYII=" alt="...">--}}
{{--                </div>--}}


{{--                <div class="bg-white shadow-primary-xs mb-5">--}}
{{--                    <img height="500" class="img-fluid lazy rounded" data-src="demo.files/images/unsplash/portfolio/boxed-water-is-better-JeduO5K_tRg-unsplash-min.jpg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAGQCAQAAADFUcJQAAAAFElEQVR42mNkYGAcRaNoFI2ioYAAsLUBkdmEbfIAAAAASUVORK5CYII=" alt="...">--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
    </div>
</section>
<!-- / -->






<!-- -->
<section class="bg-theme-color-light">
    <div class="container">


        <div class="text-center">
						<span class="badge badge-pill badge-primary badge-soft font-weight-light pl-2 pr-2 pt--6 pb--6 mb-2">
							GOODIES
						</span>
            <h2 class="font-weight-normal">
                More from our

                <!-- typed -->
                <span class="typed text-primary"
                      data-typed-string="team|professionals|seniors"
                      data-typed-speed-forward="80"
                      data-typed-speed-back="30"
                      data-typed-back-delay="700"
                      data-typed-loop-times="infinite"
                      data-typed-smart-backspace="true"
                      data-typed-shuffle="false"
                      data-typed-cursor="|"></span>

            </h2>
        </div>




        <div class="swiper-container swiper-secondary" data-aos="fade-in" data-aos-delay="0" data-aos-offset="0" data-swiper='{
							"slidesPerView": 4,
							"spaceBetween": 15,
							"slidesPerGroup": 1,
							"loop": true,
							"autoplay": { "delay" : 5500, "disableOnInteraction": false },
							"breakpoints": {
								"1024": { "slidesPerView": "4" },
								"920": 	{ "slidesPerView": "4" },
								"768": 	{ "slidesPerView": "2" },
								"460": 	{ "slidesPerView": "1" }
							}
						}'>

{{--            <div class="hide swiper-wrapper pt-5 pb-5">--}}

{{--                <a href="portfolio-single-3.html" class="swiper-slide transition-hover-top transition-all-ease-150 p-2 shadow-md rounded text-center text-decoration-none">--}}
{{--                    <img class="img-fluid rounded" src="demo.files/images/unsplash/portfolio/boxed-water-is-better-HwTkJ5AvEjE-unsplash-min.jpg" alt="...">--}}
{{--                    <h3 class="h6 mt-3 mb-3">--}}
{{--                        <span class="text-dark">Project 1</span>--}}
{{--                    </h3>--}}
{{--                </a>--}}

{{--                <a href="portfolio-single-3.html" class="swiper-slide transition-hover-top transition-all-ease-150 p-2 shadow-md rounded text-center text-decoration-none">--}}
{{--                    <img class="img-fluid rounded" src="demo.files/images/unsplash/portfolio/boxed-water-is-better-9fl-u7IcgOY-unsplash-min.jpg" alt="...">--}}
{{--                    <h3 class="h6 mt-3 mb-3">--}}
{{--                        <span class="text-dark">Project 2</span>--}}
{{--                    </h3>--}}
{{--                </a>--}}

{{--                <a href="portfolio-single-3.html" class="swiper-slide transition-hover-top transition-all-ease-150 p-2 shadow-md rounded text-center text-decoration-none">--}}
{{--                    <img class="img-fluid rounded" src="demo.files/images/unsplash/portfolio/boxed-water-is-better-hhXhUjF6erk-unsplash-min.jpg" alt="...">--}}
{{--                    <h3 class="h6 mt-3 mb-3">--}}
{{--                        <span class="text-dark">Project 3</span>--}}
{{--                    </h3>--}}
{{--                </a>--}}

{{--                <a href="portfolio-single-3.html" class="swiper-slide transition-hover-top transition-all-ease-150 p-2 shadow-md rounded text-center text-decoration-none">--}}
{{--                    <img class="img-fluid rounded" src="demo.files/images/unsplash/portfolio/boxed-water-is-better-fbbxMwwKqZk-unsplash-min.jpg" alt="...">--}}
{{--                    <h3 class="h6 mt-3 mb-3">--}}
{{--                        <span class="text-dark">Project 4</span>--}}
{{--                    </h3>--}}
{{--                </a>--}}

{{--                <a href="portfolio-single-3.html" class="swiper-slide transition-hover-top transition-all-ease-150 p-2 shadow-md rounded text-center text-decoration-none">--}}
{{--                    <img class="img-fluid rounded" src="demo.files/images/unsplash/portfolio/boxed-water-is-better-6RTh34xCS1M-unsplash-min.jpg" alt="...">--}}
{{--                    <h3 class="h6 mt-3 mb-3">--}}
{{--                        <span class="text-dark">Project 5</span>--}}
{{--                    </h3>--}}
{{--                </a>--}}

{{--            </div>--}}

        </div>



    </div>
</section>
<!-- / -->






@endsection
