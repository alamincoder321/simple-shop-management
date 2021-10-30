<!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="index.html" class="logo"><i class="md md-terrain"></i> <span>{{ config('app.name') }} </span></a>
        </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">

                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="{{asset('backend')}}/images/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                            <li>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                  <i class="md md-settings-power"></i>{{ __('Logout') }}
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                              </form> 
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->