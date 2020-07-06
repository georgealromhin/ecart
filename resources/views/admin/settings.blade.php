@extends('admin.layout')
@section('title', 'User Manager')
@section('header')

<style>p{
    margin: auto;
    padding: 10px;
  }</style>
@endsection

@section('content')

    <div class="d-flex" id="wrapper">
        @include('admin.sidebar')

        <div id="page-content-wrapper">
            @include('admin.navbar')
            <div class="container mt-5">

              <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <form action="{{url('change_name')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 h-100">
                                <p class="align-middle"><i class="fas fa-user"></i> Name</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control w-100" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="changeNameBtn" class="btn btn-primary float-right" disabled="disabled">Change</button>
                            </div>
                        </div>
                      </form>
                </div>
              </div>

              <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <form action="{{url('change_username')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 h-100">
                                <p class="align-middle"><i class="fas fa-user"></i> Username</p>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="username" id="username" value="{{ Auth::user()->username }}" class="form-control w-100" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="changeUsernameBtn" class="btn btn-primary float-right" disabled="disabled">Change</button>
                            </div>
                        </div>
                      </form>
                </div>
              </div>

              <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <form action="{{url('change_password')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 h-100">
                                <p class="align-middle"><i class="fas fa-lock"></i> Password</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6"><input type="text" name="current_password" id="current_password" class="form-control w-100" required placeholder="Current Password"></div>
                                    <div class="col-md-6"><input type="text" name="new_password" id="new_password" class="form-control w-100" required placeholder="New Password"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="changeNameBtn" class="btn btn-primary float-right">Change</button>
                            </div>
                        </div>
                      </form>
                </div>
              </div>
              @if($errors->any())
              <p class="text-danger text-center mt-2">
                  Error: {{ implode('', $errors->all(':message')) }}
              </p>
              @endif
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