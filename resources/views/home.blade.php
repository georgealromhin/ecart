@extends('layout')
@section('title', $settings[12]->value)


@section('content')

    <div id="carouselControls" class="carousel slide mt-4 shadow" data-ride="carousel">
        <div class="carousel-inner">

            @foreach($banners as $banner)
                <div class="carousel-item @if($loop->first) active @endif ">
                    <img class="d-block w-100 carousel-img rounded" src="{{ url($banner->image) }}" alt="image">
                </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <products-menu-component currency="{{ config('app.currency') }}"></products-menu-component>

@endsection
