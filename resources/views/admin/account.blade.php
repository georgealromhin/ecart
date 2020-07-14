@extends('admin.layout')
@section('title', 'User Manager')
@section('header')

<style>p{margin: auto;padding: 10px;}</style>

@endsection

@section('content')

    <div class="d-flex" id="wrapper">
        @include('admin.sidebar')

        <div id="page-content-wrapper">
            @include('admin.navbar')
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6"><h3> <i class="fas fa-user-cog"></i> Account Settings</h3></div>
                </div>
              <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <form action="{{url('name/update')}}" method="POST">
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
                    <form action="{{url('username/update')}}" method="POST">
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
                    <form action="{{url('password/update')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 h-100">
                                <p class="align-middle"><i class="fas fa-lock"></i> Password</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6"><input type="password" name="current_password" id="current_password" class="form-control w-100" required placeholder="Current Password"></div>
                                    <div class="col-md-6"><input type="password" name="new_password" id="new_password" class="form-control w-100" required placeholder="New Password"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="changePasswordBtn" class="btn btn-primary float-right">Change</button>
                            </div>
                        </div>
                      </form>
                </div>
              </div>
              <div class="text-center">
                   <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger text-center mt-5" data-toggle="modal" data-target="#deleteModalCenter">
            Delete Account 
        </button>
              </div>
       
        
        <!-- Modal -->
        <div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle"> <i class="fas fa-exclamation-triangle text-warning"></i> Are you sure ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <form action="{{url('account/delete')}}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <p> <i class="fas fa-info-circle text-info"></i> You won't be able to revert this! </p>
                        <input type="password" name="password" id="password" class="form-control w-100" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                </form>
                
            </div>
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
<script type="text/javascript" src="{{asset('js/easy_notify.js')}}"></script>   
<script type="text/javascript" src="{{asset('js/notification.js')}}"></script>   

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