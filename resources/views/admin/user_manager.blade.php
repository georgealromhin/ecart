@extends('admin.layout')
@section('title', 'User Manager')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
@endsection

@section('content')

    <div class="d-flex" id="wrapper">
        @include('admin.sidebar')

        <div id="page-content-wrapper">
            @include('admin.navbar')
            <div class="container mt-5">
                
                    @if (Auth::user()->role == 'main')
                    <div class="row">
                        <div class="col-md-6"><h3> <i class="fas fa-user-cog"></i> User Manager</h3></div>
                        <div class="col-md-6"><a href="add_user" class="btn btn-primary btn-sm float-right"> <i class="fas fa-user-plus"></i> Add User</a></div>
                    </div>
                    <table class="table table-striped table-bordered bg-light shadow-sm">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    @if ($user->role != 'main')
                                    <a href="#" class="text-danger" onclick="deleteUser({{$user->id}})"> <i class="fas fa-trash"></i> Delete</a> 

                                    @endif
                                </td>
                              </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                    @else
                        <h3 class="text-center"> <i class="fas fa-exclamation-triangle"></i> Unauthorized </h3>
                    @endif
                
                
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
       function deleteUser(user_id){
           Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                       window.location.href = "delete_user/"+user_id;

                }
            })
       }
    </script>
@endsection