
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
       
    </ul>
    <h5><strong>Project Performance Monitoring System</strong></h5>
    
    @if (auth()->user()->user_group_id==2 && auth()->user()->project_id==null)
    <div class="mx-auto col-md-3">
        {{-- <marquee>This is basic example of marquee</marquee> --}}
    <marquee class="text-danger text-center text-bold"> Project Not Assigned to this {{auth()->user()->name}} </marquee>    
    </div>
    @endif


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <span class="dropdown-item dropdown-header">
                     @if(Auth::user()->user_image!=null)
                        <img src="{{asset('/storage/uploads/users/images/profilePic/'.Auth::user()->user_image)}}" class="img-circle elevation-2" alt="User Image" style="width: 100px;height: 90px;margin-left:70px;">
                    @else
                        <img src="{{url('/uploads/images/dummyUser.gif')}}" class="dropdown-item dropdown-header text-center" alt="User Image" style="width: 100px;height: 90px;margin-left:70px;">
                    @endif
                         <a href="{{url('dashboard')}}" class="d-block">{{Auth::user()->name}}</a>
                    Settings
                </span>
                <div class="dropdown-divider"></div>
                <a href="{{url('profile')}}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> View Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{url('/profile')}}" class="dropdown-item">
                    <i class="fas fa-cogs mr-2"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>

                <div class="dropdown-divider"></div>
            </div>
        </li>

        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
                {{--<i class="fas fa-th-large"></i>--}}
            {{--</a>--}}
        {{--</li>--}}
    </ul>
</nav>
<!-- /.navbar -->
