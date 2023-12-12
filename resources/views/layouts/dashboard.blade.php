<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Indian Mission Vicarate</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet">

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a class="navbar-brand" href="{{ URL::to('/dashboard') }}">IMV - Indian Mission Vicarate - {{ date('Y') }}</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <ul class="nav navbar-nav navbar-right admin-text">
                <li>
                   @if(@Auth::user()->user_type == "priest")
                      <img src="{{ asset('images/priest.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" style="border-radius: 50%;margin-top: 10px;"/>
                    @elseif(@Auth::user()->user_type == "brother")
                      <img src="{{ asset('images/brother.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" style="border-radius: 50%;margin-top: 10px;"/>
                    @elseif(@Auth::user()->user_type == "sister")
                      <img src="{{ asset('images/nun.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" style="border-radius: 50%;margin-top: 10px;"/>
                    @else
                      <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" style="border-radius: 50%;margin-top: 10px;"/>
                    @endif
                </li>
                <li>
                  <div class="info-container" style="color: #fff;padding: 24px 0px 0px 9px;">
                    <div class="name" aria-haspopup="true" aria-expanded="false">{{ ucfirst(@Auth::user()->name) }}
                      @if(@Auth::user()->user_type == "admin")
                        <div class="btn-group user-helper-dropdown" style="float:right;cursor:pointer;margin-left: 5px;">
                          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                          <ul class="dropdown-menu pull-right" style="top: 67px;">
                            @if(date('d-m-Y') == trans('main.res_date'))
                              <li>
                                <a href="{{ route('fdashboard') }}" title="User" class="waves-effect"><i class="material-icons">person</i>Reports</a>
                              </li>
                            @endif
                            <li><a href="{{ route('logout') }}" onclick="window.top.close();event.preventDefault();document.getElementById('logout-form').submit();" title="Logout" class=" waves-effect"><i class="material-icons">input</i>Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                            </form>
                            </li>
                          </ul>
                        </div>
                      @endif
                    </div>
                  </div>
                </li>
              </ul>
            </div>
        </div>
    </nav>
    {{-- @if(@Auth::user()->user_type == "admin") --}}
    <!-- #Top Bar -->
    <?php /*<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    @if(@Auth::user()->user_type == "priest")
                      <img src="{{ asset('images/priest.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" />
                    @elseif(@Auth::user()->user_type == "brother")
                      <img src="{{ asset('images/brother.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" />
                    @elseif(@Auth::user()->user_type == "sister")
                      <img src="{{ asset('images/nun.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" />
                    @else
                      <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="{{ ucfirst(@Auth::user()->name) }}" />
                    @endif
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucfirst(@Auth::user()->name) }}</div>
                    <div class="email">{{ ucfirst(@Auth::user()->email) }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            {{-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li> --}}
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
              <ul class="list">
                {{-- <li class="header">MAIN NAVIGATION</li> --}}
                <li>
                  <a href="{{ URL::to('/home') }}">
                    <i class="material-icons">home</i>
                    <span>{!! trans('main.dashboard') !!}</span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal" title="Copyright &copy; {{ now()->year }} {!! trans('main.ssite_title') !!} All Rights Reserved.">
                <div class="copyright" title="Copyright &copy; {{ now()->year }} {!! trans('main.site_title') !!} All Rights Reserved.">
                    Copyright &copy; {{ now()->year }} <a href="javascript:void(0);" title="Copyright &copy; {{ now()->year }} {!! trans('main.site_title') !!} All Rights Reserved.">{!! trans('main.site_title') !!}</a> All Rights Reserved.
                </div>
                {{-- <div class="version">
                    <b>Version: </b> 1.0.0
                </div> --}}
            </div>
            <!-- #Footer -->
        </aside>
    </section> */?>
    {{-- @endif --}}

    <section class="content-fluid" style="margin-top:120px !important">
        @yield('content')
    </section>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
</body>
<script>
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  @if(Session::has('success'))
    toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
    toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
    toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
    toastr.warning("{{ session('warning') }}");
  @endif

  $(document).ready(function(){
    $(".form-line").removeClass("focused");
  });
</script>
</html>
