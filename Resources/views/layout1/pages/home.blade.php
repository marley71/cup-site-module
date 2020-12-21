@extends('cup_site.layouts.layout1')


@section('content')
    <!-- -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{\App\Http\Controllers\CupSiteController::block('slider')}}
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card shadow-md shadow-lg-hover transition-all-ease-250 transition-hover-top h-100 border-primary bl-0 br-0 bb-0 bw--2">
                        <div class="card-body">
                            {{$page['content_it']}}
                        </div>

                    </div>

                </div>
                <div class="col-lg-6 col-sm-12">
                    {{\App\Http\Controllers\CupSiteController::block('eventi')}}
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    {{\App\Http\Controllers\CupSiteController::block('news')}}
                </div>
                <div class="col-6">
                    {{\App\Http\Controllers\CupSiteController::block('news')}}
                </div>
            </div>
        </div>
    </section>
@endsection
