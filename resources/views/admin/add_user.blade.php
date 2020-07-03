@extends('admin.layout')
@section('title', 'Add New User')


@section('content')

<div class="d-flex" id="wrapper">
    @include('admin.sidebar')

    <div id="page-content-wrapper">
        @include('admin.navbar')
        <div class="container mt-5">
            <div id="app">
                @if (Auth::user()->role == 'main')
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-header">Add new user</div>
                                <div class="card-body">
                                    <form action="add_new_user" method="POST">
                                        @csrf
                                        <div class="form-group">
                                          <label for="name">Name</label>
                                          <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                          </div>
                                          <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                          </div>
                                          <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control" name="role" id="role" required>
                                              <option value="main" selected>Main</option>
                                              <option value="subsidiary">Subsidiary</option>
                                            </select>
                                          </div>
                                          <button type="submit" class="btn btn-primary w-100">Add</button>
                                    </form>
                                    @if($errors->any())
                                    <p class="text-danger text-center mt-2">
                                        Error: {{ implode('', $errors->all(':message')) }}
                                    </p>
    
@endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                @else
                    <h3 class="text-center"> <i class="fas fa-exclamation-triangle"></i> Unauthorized </h3>
                @endif
            </div>
            
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