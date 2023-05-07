<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
         <link rel="shortcut icon" href="{{url('public/backend/images/favicon.png')}}">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="72x72">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="76x76">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="114x114">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="120x120">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="144x144">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="152x152">
        <link rel="apple-touch-icon" href="{{url('public/backend/images/favicon.png')}}" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{url('public/new/css/bootstrap.min.css')}}">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{url('public/new/css/plugins.css')}}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{url('public/new/css/main.css')}}">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="{{url('public/new/css/themes.css')}}">
        <link rel="stylesheet" href="{{url('public/new/css/validatior/developer.css')}}">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- END Stylesheets -->
        <style>
            a.fa-globe {
              position: relative;
              font-size: 2em;
              color: grey;
              cursor: pointer;
            }
            span.fa-comment {
              position: absolute;
              font-size: 0.6em;
              top: -4px;
              color: red;
              right: -4px;
            }
            span.num {
              position: absolute;
              font-size: 0.3em;
              top: 1px;
              color: #fff;
              right: 2px;
            }
        </style>
        <!-- Modernizr (browser feature detection library) -->
        <script src="{{url('public/new/js/vendor/modernizr.min.js')}}"></script>
        <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    </head>

 <body>
        <!-- Page Wrapper -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
        
        <div id="page-wrapper">
            <!-- Preloader -->
            <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
            <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie10"></div>
                </div>
            </div>
            <!-- END Preloader -->

            <!-- Page Container -->
            <!-- In the PHP version you can set the following options from inc/config file -->
            <!--
                Available #page-container classes:

                '' (None)                                       for a full main and alternative sidebar hidden by default (> 991px)

                'sidebar-visible-lg'                            for a full main sidebar visible by default (> 991px)
                'sidebar-partial'                               for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
                'sidebar-partial sidebar-visible-lg'            for a partial main sidebar which opens on mouse hover, visible by default (> 991px)
                'sidebar-mini sidebar-visible-lg-mini'          for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)
                'sidebar-mini sidebar-visible-lg'               for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)

                'sidebar-alt-visible-lg'                        for a full alternative sidebar visible by default (> 991px)
                'sidebar-alt-partial'                           for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
                'sidebar-alt-partial sidebar-alt-visible-lg'    for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

                'sidebar-partial sidebar-alt-partial'           for both sidebars partial which open on mouse hover, hidden by default (> 991px)

                'sidebar-no-animations'                         add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

                'style-alt'                                     for an alternative main style (without it: the default style)
                'footer-fixed'                                  for a fixed footer (without it: a static footer)

                'disable-menu-autoscroll'                       add this to disable the main menu auto scrolling when opening a submenu

                'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
                'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

                'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links
            -->
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                <!-- Alternative Sidebar -->
                <div id="sidebar-alt">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-alt-scroll">
                        <!-- Sidebar Content -->
                    
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Alternative Sidebar -->

                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Wrapper for scrolling functionality -->
                    @include('layouts.sidebar');
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    <!-- Header -->
                    <!-- In the PHP version you can set the following options from inc/config file -->
                    <!--
                        Available header.navbar classes:

                        'navbar-default'            for the default light header
                        'navbar-inverse'            for an alternative dark header

                        'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                            'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                        'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                            'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
                    -->
                    <header class="navbar navbar-default">
                        <!-- Left Header Navigation -->
                        <ul class="nav navbar-nav-custom">
                            <!-- Main Sidebar Toggle Button -->
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                    <i class="fa fa-bars fa-fw"></i>
                                </a>
                            </li>
                            <!-- END Main Sidebar Toggle Button -->

                            <!-- Template Options -->
                            <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                            <!-- <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="gi gi-settings"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-options">
                                    <li class="dropdown-header text-center">Header Style</li>
                                    <li>
                                        <div class="btn-group btn-group-justified btn-group-sm">
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                                        </div>
                                    </li>
                                    <li class="dropdown-header text-center">Page Style</li>
                                    <li>
                                        <div class="btn-group btn-group-justified btn-group-sm">
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                                            <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                                        </div>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- END Template Options -->
                            <li>
                                <?php if(Auth::user()->role_id == '5') { ?>

                                    <?php $data = \App\Models\Notification_all_child::orderBy('id','DESC')->where('business_user_id',Auth::user()->id)->where('status',0)->get(); ?>
                                    <a href="{{url('/bookedServices')}}" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning"><?php if(!empty($data)) { echo count($data);} else { echo "0"; }?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    <li class="dropdown-header text-center">Notification</li>
                                    <?php if(!empty($data)) {
                                        foreach ($data as  $value) { ?>
                                        <li>
                                            <?php if($value['slug'] == 'appointment') {?>
                                            <a href="{{url('/appointments_view')}}">
                                                <?php echo $value['message']; ?>
                                            </a>
                                            <?php } ?>
                                            <?php if($value['slug'] == 'order') {?>
                                            <a href="{{url('/get_all_order')}}">
                                                <?php echo $value['message']; ?>
                                            </a>
                                            <?php } ?>
                                        </li>
                                    
                                    <?php 
                                            }
                                        } else { ?>
                                        <a href="page_ready_timeline.html">
                                            No Notification available
                                        </a>
                                    <?php } ?>
                                    </ul>

                                <?php } ?>
                                <?php if(Auth::user()->role_id == '3') { ?>

                                    <?php $data = \App\Models\Notification_all_count::orderBy('id','DESC')->where('business_id',Auth::user()->id)->where('status',0)->get(); ?>
                                    <a href="{{url('/bookedServices')}}" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning"><?php if(!empty($data)) { echo count($data);} else { echo "0"; }?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    <li class="dropdown-header text-center">Notification</li>
                                    <?php if(!empty($data)) {
                                        foreach ($data as  $value) { ?>
                                        <li>
                                            <?php if($value['slug'] == 'appointment') {?>
                                            <a href="{{url('/bookedServices')}}">
                                                <?php echo $value['message']; ?>
                                            </a>
                                            <?php } ?>
                                            <?php if($value['slug'] == 'order') {?>
                                            <a href="{{url('/memberOrders')}}">
                                                <?php echo $value['message']; ?>
                                            </a>
                                            <?php } ?>
                                        </li>
                                    
                                    <?php 
                                            }
                                        } else { ?>
                                        <a href="page_ready_timeline.html">
                                            No Notification available
                                        </a>
                                    <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        </ul>
                        <!-- END Left Header Navigation -->

                        <!-- Search Form -->
                        <!-- <form action="page_ready_search_results.html" method="post" class="navbar-form-custom">
                            <div class="form-group">
                                <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
                            </div>
                        </form> -->
                        <!-- END Search Form -->

                        <!-- Right Header Navigation -->
                        <ul class="nav navbar-nav-custom pull-right">
                            <!-- Alternative Sidebar Toggle Button -->
                           
                            <!-- END Alternative Sidebar Toggle Button -->

                            <!-- User Dropdown -->

                            @if(Auth::user()->role_id == 1)
                            
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{url('public/backend/images/favicon.png') }}" alt="avatar"> <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                    <li class="dropdown-header text-center">Account</li>
                                   <
                                    <li class="divider"></li>
                                    <li>
                                        <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel pull-right"></i>Change Password</a>

                                        <a href="{{ url('/logout') }}"data-toggle="tooltip" data-placement="bottom" title="Logout"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="gi gi-exit pull-right"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </li>
                                    @endif
                                    <!-- <li class="divider"></li>
                                    <li>
                                        <a href="page_ready_lock_screen.html"><i class="fa fa-lock fa-fw pull-right"></i> Lock Account</a>
                                        <a href="login.html"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                    </li>
                                    <li class="dropdown-header text-center">Activity</li>
                                    <li>
                                        <div class="alert alert-success alert-alt">
                                            <small>5 min ago</small><br>
                                            <i class="fa fa-thumbs-up fa-fw"></i> You had a new sale ($10)
                                        </div>
                                        <div class="alert alert-info alert-alt">
                                            <small>10 min ago</small><br>
                                            <i class="fa fa-arrow-up fa-fw"></i> Upgraded to Pro plan
                                        </div>
                                        <div class="alert alert-warning alert-alt">
                                            <small>3 hours ago</small><br>
                                            <i class="fa fa-exclamation fa-fw"></i> Running low on space<br><strong>18GB in use</strong> 2GB left
                                        </div>
                                        <div class="alert alert-danger alert-alt">
                                            <small>Yesterday</small><br>
                                            <i class="fa fa-bug fa-fw"></i> <a href="javascript:void(0)" class="alert-link">New bug submitted</a>
                                        </div>
                                    </li> -->
                                </ul>
                            </li>
                            <!-- END User Dropdown -->
                        </ul>
                        <!-- END Right Header Navigation -->
                    </header>
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content">
                        @yield('content')
                    </div>
                    <!-- END Page Content -->

                    <!-- Footer -->
                    <!-- <footer class="clearfix">
                        <div class="pull-right">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                        </div>
                        <div class="pull-left">
                            <span id="year-copy"></span> &copy; <a href="https://1.envato.market/x4R" target="_blank">ProUI 3.8</a>
                        </div>
                    </footer> -->
                     <footer class="clearfix">
                        <div class="pull-right">
                           <!--  Crafted with <i class="fa fa-heart text-danger"></i> by <a href="https://1.envato.market/ydb" target="_blank">pixelcave</a> -->
                        </div>
                        <div class="pull-left">
                            <span id="year-copy"></span> &copy; <a href="#" target="_blank">ForMore</a>
                        </div>
                    </footer>
                    <!-- END Footer -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
        <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Change Password</h2>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body">
                         <?php $id = Auth::user()->id; ?>
                        <form action="{{ url('/administrator/profile/update') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" >
                             @csrf
                             <input type="hidden" name="id" value="<?php echo Auth::user()->id; ?>">
                            <fieldset>
                                <legend>Password Update</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" id="user-settings-password" name="password" class="form-control" placeholder="Please choose a complex one.." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" id="user-settings-repassword" name="confirm_pwd" class="form-control" placeholder="..and confirm it!" required>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group form-actions">
                                <div class="col-xs-12 text-right">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END Modal Body -->
                </div>
            </div>
        </div>
        <!-- END User Settings -->


     <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="{{url('public/new/js/vendor/jquery.min.js')}}"></script>
        <script src="{{url('public/new/js/vendor/bootstrap.min.js')}}"></script>
        <script src="{{url('public/new/js/plugins.js')}}"></script>
        <script src="{{url('public/new/js/app.js')}}"></script>
        <script src="{{url('public/new/js/validator/jquery.validate.min.js')}}"></script>
        <!-- <script src="{{url('public/new/js/validator/additional-methods.js')}}"></script> -->
        <script src="{{url('public/new/js/validator/validator.js')}}"></script>

        <!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
        <!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key="></script>
        <script src="{{url('public/new/js/helpers/gmaps.min.js')}}"></script> -->

        <!-- Load and execute javascript code used only in this page -->
        <!-- <script src="{{url('public/new/js/pages/index.js')}}"></script>
        <script>$(function(){ Index.init(); });</script> -->
        



    
    @stack('scripts')
    @yield('scripts')
</body>
</html>