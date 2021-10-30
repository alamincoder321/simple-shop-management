  <!-- ========== Left Sidebar Start ========== -->

  <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
          <div class="user-details">
{{--               <div class="pull-left">
                  <img src="@auth{{asset(Auth::user()->image)}}@endauth" alt="" class="thumb-md img-circle">
              </div> --}}
              <div class="user-info">
                  <div class="dropdown">
                      <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">@auth {{Auth::user()->name}} @endauth <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
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
                  </div>
                  
                  <p class="text-muted m-0">Administrator</p>
              </div>
          </div>
          <!--- Divider -->
          <div id="sidebar-menu">
              <ul>
                  <li>
                      <a href="{{route ('home')}}" class="waves-effect @yield('home')"><i class="md md-home"></i><span> Dashboard </span></a>
                  </li>

                    <li>
                      <a href="{{route ('pos')}}" class="waves-effect @yield('pos')"><i class="md md-home"></i><span class="text-info"> Point of Sale </span></a>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('order')"><i class="md md-palette"></i><span> Order </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route('order.index')}}">Order-details</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('customer')"><i class="ion-person-stalker"></i><span> Customer </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route('customer.create')}}">Add Customer</a></li>
                          <li><a href="{{route('customer.index')}}">Customer list</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('employee')"><i class="ion-person-stalker"></i><span> Employee </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route('employee.create')}}">Add Employee</a></li>
                          <li><a href="{{route('employee.index')}}">Employee list</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('brand')"><i class="md md-palette"></i><span> Brand </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route('brand.create')}}">Add Brand</a></li>
                          <li><a href="{{route('brand.index')}}">Brand list</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('category')"><i class="md md-palette"></i><span> Category </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route('category.create')}}">Add Category</a></li>
                          <li><a href="{{route('category.index')}}">Category list</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('product')"><i class="md md-palette"></i><span> Product </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route('product.create')}}">Add Product</a></li>
                          <li><a href="{{route('product.index')}}">Product list</a></li>
                      </ul>
                  </li>

              </ul>
              <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
      </div>
  </div>
  <!-- Left Sidebar End --> 