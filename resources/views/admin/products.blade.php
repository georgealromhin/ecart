@extends('admin.layout')
@section('title', 'Products')

@section('header')

@endsection

@section('content')

    <div class="d-flex" id="wrapper">
        @include('admin.sidebar')

        <div id="page-content-wrapper">
            @include('admin.navbar')
            <div class="container mt-5 mb-5">
                <products-component></products-component>
            </div>
        </div>
    </div>
    
@endsection

@section('script')

    @if ($message = Session::get('error'))
        <script type="text/javascript">
            Swal.fire('Error', '{{$message}}', 'error');
        </script>
    @endif

    @if ($message = Session::get('success'))
        <script type="text/javascript">
            Swal.fire('Success', '{{$message}}', 'success');
        </script>
    @endif
@endsection