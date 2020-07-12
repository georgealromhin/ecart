@extends('layout')
@section('title', 'Contact Us')


@section('content')

    <h3> Contact Us </h3>
    
    <div class="row mt-5 text-center">
        <div class="col-md-4 mt-2">
            <h5><i class="fas fa-map-marker-alt text-danger"></i> Address</h5>
            <p>{{$settings[1]->value}}</p>
        </div>
        <div class="col-md-4 mt-2">
            <h5><i class="fas fa-envelope text-success"></i> E-Mail</h5>
            <a href="mailto:{{$settings[2]->value}}">{{$settings[2]->value}}</a>
        </div>
        <div class="col-md-4 mt-2">
            <h5><i class="fas fa-phone-alt text-primary"></i> Phone Number</h5>
            <a href="tel:{{$settings[3]->value}}">{{$settings[3]->value}}</a>
        </div>
        <div class="col-md-4 mt-2">
            <h5><i class="far fa-clock"></i> Opening hours</h5>
            <p class="pre-line-text">{{$settings[11]->value}}</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-2"></div>
        
        <div class="col-md-2"></div>
    </div>
@endsection
