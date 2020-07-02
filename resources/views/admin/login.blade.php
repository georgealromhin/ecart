@extends('admin.layout')
@section('title', 'Login')


@section('content')

       
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card rounded mt-50 shadow-sm">
                <div class="card-header h5 text-center">Admin Login</div>
                <div class="card-body">
                    <form action="{{url('login')}}" action="post">
                        <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
                        </div>
                        <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <footer> 
        <p class="text-center">{{config('app.name')}} © {{ date('Y') }} </p>
    </footer>
</div>
@if ($message = Session::get('error'))

<script type="text/javascript">
    Swal.fire('Error', '{{$message}}', 'error');
</script>
@endif
@endsection

