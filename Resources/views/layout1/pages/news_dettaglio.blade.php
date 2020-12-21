@extends('cup_site.layouts.layout1')
@section('content')
    <!-- -->
    <section>
        <div class="container">
            <h3>{{$news['titolo_it']}}</h3>
            <!-- tabs -->
            <div class="row">
                <div class="order-2 order-lg-1 col-12 col-lg-8 mb-5">
                    <div class="tab-content">
                        <!-- content tab 1 -->
                        @foreach($news['fotos'] as $key => $item)
                            <div class="tab-pane fade show {{$key==0?'active':''}}"
                                 id="tab-v-{{$key}}"
                                 aria-labelledby="tab-btn-v-{{$key}}"
                                 role="tabpanel">

                                <div class="mx-4 position-relative bg-primary-soft rounded">
                                    <img width="100%" class="img-fluid rounded block-over-end-bottom" src="{{$item['resource']['url']}}/large" alt="...">

                                    <div class="position-absolute block-over-end-bottom rounded-bottom overflow-hidden bottom-0 w-100 overlay-dark overlay-opacity-6">
                                        <p class="m-0 p-3 position-relative z-index-1 text-white fs--16 font-weight-light">
                                            {{$item['nome_it']}}
                                        </p>
                                    </div>
                                </div>
                                @if ($item['descrizione_it'])

                                    <p class="lead">
                                        <br>
                                        {{$item['nome_it']}}
                                    </p>

                                    <p>
                                        {{$item['descrizione_it']}}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>


                <div class="order-1 order-lg-2 col-12 col-lg-4 mb-5">

                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        @foreach($news['fotos'] as $key => $item)
                            <!-- tab 1 -->
                            <a class="nav-link mb-4 px-4 rounded border border-light text-gray-800 shadow-xs bg-white bg-primary-active {{$key==0?'active':''}}"
                               id="tab-btn-v-{{$key}}"
                               href="#tab-v-{{$key}}"
                               aria-controls="tab-v-{{$key}}"

                               data-toggle="pill"
                               role="tab"
                               aria-selected="true">

                                <h3 class="h4 h5-xs d-block font-weight-light py-3">
                                    {{$item['nome_it']}}
                                </h3>

{{--                                <span class="d-block font-weight-light pb-3 fs--16">--}}
{{--                                            {{$item['descrizione_it']}}--}}
{{--                                        </span>--}}
                            </a>
                        @endforeach

                    </div>

                </div>

            </div>
            <!-- /tabs -->



{{--            @if (count($news['fotos']) > 0)--}}
{{--                @if (count($news['fotos']) == 1)--}}
{{--                    <div class="mx-4 position-relative bg-primary-soft rounded">--}}
{{--                        <img class="img-fluid rounded block-over-end-bottom" src="{{$news['fotos'][0]['resource']['url']}}/large" alt="...">--}}

{{--                        <div class="position-absolute block-over-end-bottom rounded-bottom overflow-hidden bottom-0 w-100 overlay-dark overlay-opacity-6">--}}
{{--                            <p class="m-0 p-3 position-relative z-index-1 text-white fs--16 font-weight-light">--}}
{{--                                {{$news['fotos'][0]['nome_it']}}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="card shadow-md shadow-lg-hover transition-all-ease-250 transition-hover-top h-100 border-primary bl-0 br-0 bb-0 bw--2">--}}
{{--                        <div class="card-body">--}}
{{--                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="4000">--}}
{{--                                    <ol class="carousel-indicators">--}}
{{--                                        @foreach($news['fotos'] as $key => $item)--}}
{{--                                            <li data-target="#carouselExampleIndicators" data-slide-to="$key" class="{{$key==0?'active':''}}"></li>--}}
{{--                                        @endforeach--}}
{{--                                    </ol>--}}


{{--                                <div class="carousel-inner">--}}
{{--                                    @foreach($news['fotos'] as $key => $item)--}}
{{--                                        <div class="carousel-item {{$key==0?'active':''}}">--}}
{{--                                            <img src="{{$item['resource']['url']}}" class="d-block w-100" alt="...">--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                    --}}{{--                <div class="carousel-item">--}}
{{--                                    --}}{{--                    <img src="../demo.files/images/unsplash/studio-republic-qeij_dhDhGg-unsplash.jpg" class="d-block w-100" alt="...">--}}
{{--                                    --}}{{--                </div>--}}

{{--                                </div>--}}

{{--                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
{{--                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                                    <span class="sr-only">Previous</span>--}}
{{--                                </a>--}}

{{--                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
{{--                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                                    <span class="sr-only">Next</span>--}}
{{--                                </a>--}}

{{--                            </div>--}}
{{--                            --}}{{--        <h5 class="card-title">Slider</h5>--}}
{{--                            --}}{{--        <p class="card-text">--}}
{{--                            --}}{{--            @foreach($items as $item)--}}
{{--                            --}}{{--                <div>--}}
{{--                            --}}{{--                    Some quick example text to build on the card title and make up the bulk of the card's content.--}}
{{--                            --}}{{--                </div>--}}

{{--                            --}}{{--            @endforeach--}}
{{--                            --}}{{--        </p>--}}
{{--                            --}}{{--        <a href="#" class="btn btn-sm btn-primary btn-soft">Go somewhere</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--            @endif--}}

{{--                <a href="/{{$route_prefix}}/page/{{$item->id}}">dettaglio</a>--}}
            <div class="card-body m-10">
                <p>{{$news['descrizione_it']}}</p>
            </div>
            @if(count($news['videos']) > 0)
                <h3>Video</h3>
                <div class="row">
                    @foreach($news['videos'] as $video)
                        <div class="col-6">
                            <h6>{{$video['nome_it']}}&nbsp;</h6>
                            <div class="youtube-player w-100" data-id="{{$video['video_id']}}"></div>
                            <div>
                                {{$video['descrizione_it']}}&nbsp;
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <script>
            (function() {
                var v = document.getElementsByClassName("youtube-player");
                for (var n = 0; n < v.length; n++) {
                    var p = document.createElement("div");
                    p.innerHTML = labnolThumb(v[n].dataset.id);
                    p.onclick = labnolIframe;
                    v[n].appendChild(p);
                }
            })();

            function labnolThumb(id) {
                return '<img class="youtube-thumb" src="//i.ytimg.com/vi/' + id + '/hqdefault.jpg" height="400"><div class="play-button" ></div>';
            }

            function labnolIframe() {
                var iframe = document.createElement("iframe");
                iframe.setAttribute("src", "//www.youtube.com/embed/" + this.parentNode.dataset.id + "?autoplay=1&autohide=2&border=0&wmode=opaque&enablejsapi=1&controls=1&showinfo=1");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("id", "youtube-iframe");
                iframe.setAttribute('width','100%')
                iframe.setAttribute('height','400px')
                this.parentNode.replaceChild(iframe, this);
            }
        </script>
    </section>
@endsection
