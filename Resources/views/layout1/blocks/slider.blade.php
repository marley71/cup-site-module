@if (count($items) > 0)
    <div class="card shadow-md shadow-lg-hover transition-all-ease-250 transition-hover-top h-100 border-primary bl-0 br-0 bb-0 bw--2">
        <div class="card-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="4000">
                @foreach($items as $item)
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                @endforeach

                <div class="carousel-inner">
                    @foreach($items as $item)
                        <div class="carousel-item active">
                            <img src="../demo.files/images/unsplash/studio-republic-fotKKqWNMQ4-unsplash.jpg" class="d-block w-100" alt="...">
                        </div>
                    @endforeach
    {{--                <div class="carousel-item">--}}
    {{--                    <img src="../demo.files/images/unsplash/studio-republic-qeij_dhDhGg-unsplash.jpg" class="d-block w-100" alt="...">--}}
    {{--                </div>--}}

                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
    {{--        <h5 class="card-title">Slider</h5>--}}
    {{--        <p class="card-text">--}}
    {{--            @foreach($items as $item)--}}
    {{--                <div>--}}
    {{--                    Some quick example text to build on the card title and make up the bulk of the card's content.--}}
    {{--                </div>--}}

    {{--            @endforeach--}}
    {{--        </p>--}}
    {{--        <a href="#" class="btn btn-sm btn-primary btn-soft">Go somewhere</a>--}}
        </div>
    </div>
@endif
