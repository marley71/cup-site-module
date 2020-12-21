<section class="bg-theme-color-light p-0">
    <div class="container py-5">

        <h1 class="h3">
            @if ($mainPage)
                {{$mainPage['titolo_it']}} - {{$page['titolo_it']}}
            @else
                {{$page['titolo_it']}}
            @endif
        </h1>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs--14">
{{--                <li class="breadcrumb-item"><a href="#!">{{$page['menu_it']}}</a></li>--}}
                @foreach($page['children'] as $children)
                    @if($page['id'] == $children['id'])
                        <li class="breadcrumb-item">{{$page['menu_it']}}</li>
                    @else
                        <li class="breadcrumb-item"><a href="/{{$route_prefix}}/{{$children['menu_it']}}">{{$children['menu_it']}}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>

    </div>
</section>
