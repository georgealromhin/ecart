@extends('admin.layout')
@section('title', 'Categories')

@section('header')

@endsection

@section('content')

    <div class="d-flex" id="wrapper">
        @include('admin.sidebar')

        <div id="page-content-wrapper">
            @include('admin.navbar')
            <div class="container mt-5 mb-5">
                <categories-component></categories-component>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script>
    $('#name').on('keyup', function(){
        $('#changeNameBtn').prop("disabled", false);;
    });
    $('#username').on('keyup', function(){
        $('#changeUsernameBtn').prop("disabled", false);;
    });

</script>
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