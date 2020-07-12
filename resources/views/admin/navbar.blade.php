<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow bg-primary ">

    <a href="#" id="menu-toggle" class="navbar-brand"><i class="fas fa-bars" aria-hidden="true"></i> </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav mr-auto">



          <li class="nav-item">

              

              <a class="nav-link text-light brand-baity"> {{config('app.name')}}</a>

          </li>

          </ul>

              <ul class="navbar-nav ml-auto">

                  <li class="nav-item dropdown">

                      <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  aria-expanded="false">
                      <i class="far fa-bell"></i> 
                      @if (Auth::user()->notifications->count() > 0)
                        <span class="badge badge-warning">{{Auth::user()->notifications->count()}}</span>
                      @endif
                      </a>

                  <div class="dropdown-menu bg-light shadow dropdown-menu-right" aria-labelledby="navbarDropdown2">
                        @foreach (Auth::user()->notifications as $notification)
                        <a class="dropdown-item" href="{{url('orders')}}"> {{$notification->data['data']}}</a>
                        @endforeach
                  </div>

                  </li>
                  <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                      <i class="fas fa-user-circle"></i>  
                      
                      @if (isset(Auth::user()->username))

                          {{Auth::user()->name}}

                      @endif
                      @if (Auth::user()->role == 'main')

                      <i class="fas fa-star text-warning"></i>

                  @endif
                    </a>

                <div class="dropdown-menu bg-light shadow dropdown-menu-right" aria-labelledby="navbarDropdown">


                    <a class="dropdown-item" href="{{url('user_manager')}}"> <i class="fas fa-users-cog"></i>  User Manager</a>

                    <a class="dropdown-item" href="{{url('account')}}"> <i class="fas fa-user-cog"></i>  Your Account</a>

                    <div class="dropdown-divider"></div> 

                    <a class="dropdown-item"  href="{{url('user/logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>

                </div>

                </li>
              </ul>

          </div>

      </div>

    </nav>