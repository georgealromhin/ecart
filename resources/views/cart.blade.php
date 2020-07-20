@extends('layout')
@section('title', 'Cart')


@section('content')

    <cart-component currency="{{ config('app.currency') }}"></cart-component>

@endsection
