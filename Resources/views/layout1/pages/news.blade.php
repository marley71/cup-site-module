@extends('cup_site.layouts.layout1')
@section('content')
    <!-- -->
    <section>
        <div class="container">
            <div class="row">
                @foreach($news as $item)
                    <div class="col-6 mb-5">

                        <div class="bg-white p-2 shadow-primary-xs transition-hover-top transition-all-ease-250">
                            <a href="/{{$route_prefix}}/news/{{$item['menu_it']}}" class="d-block overflow-hidden overlay-dark-hover overlay-opacity-2 text-decoration-none text-dark">
                                @if ( count(Arr::get($item,'fotos',[])) > 0 )
                                    <img class="img-fluid lazy rounded" src="{{$item['fotos'][0]['resource']['url']}}" alt="...">
                                @endif
                            </a>

                            <div class="p-3">

                                <h5 class="m-0">
                                    {{$item['titolo_it']}}
                                </h5>

                                <ul class="list-inline fs--13 m-0">
                                    <li class="list-inline-item">
                                        <a href="#!" class="text-gray-500">{{$page['type']}}</a>
                                    </li>

{{--                                    <li class="list-inline-item">--}}
{{--                                        <a href="#!" class="text-gray-500">Design</a>--}}
{{--                                    </li>--}}
                                </ul>
                                <div>{{$item['descrizione_it']}}</div>
                                <div>
                                    <a href="/{{$route_prefix}}/news/{{$item['menu_it']}}">Continua a leggere</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <!-- pagination -->
            <nav aria-label="pagination" class="mt-5">
                <ul class="pagination pagination-pill justify-content-end justify-content-center justify-content-md-end">

                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>

                </ul>
            </nav>




        </div>
    </section>
@endsection
