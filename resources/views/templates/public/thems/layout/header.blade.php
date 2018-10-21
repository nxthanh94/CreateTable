<div class="navbar-header col-lg-2">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('index')}}"><img class="logo-img" src="{{$url_public}}/img/logo_index.png"/></a>
</div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right col-lg-10">
                @if(Auth::check())
                
                @endif
                <li class="dropdown bnt-login">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        @if(Auth::check())
                            <li><a href="{{route('profile',Auth::user()->id)}}"><i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} </a>
                            </li>
                            @if ($id_phanquyen = Auth::user()->id_phanquyen == 1 || $id_phanquyen = Auth::user()->id_phanquyen == 2)
                                <li><a href="{{route('admin.index.index')}}"><i class="fa fa-cog" aria-hidden="true"></i> Quản trị hệ thống</a>
                            @endif
                            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li> 
                        @else
                            <li><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                            </li>
                        @endif
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->