  <!-- Main Sidebar -->
               
<!-- Wrapper for scrolling functionality -->
<div id="sidebar-scroll">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Brand -->
        <a href="{{ url('/admin') }}" class="sidebar-brand">
            <!-- <i class="gi gi-flash"></i><span class="sidebar-nav-mini-hide"><strong>For</strong>More</span> -->
            <center><img src="{{url('public/backend/images/Formore-white.png')}}" style="width: 40%;"></center>
        </a>
        <!-- END Brand -->

        <!-- User Info -->
        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
            @if(Auth::user()->role_id == 1)
            <div class="sidebar-user-avatar">
                <a href="#">
                    <img src="{{url('public/backend/images/favicon.png') }}" alt="avatar">
                </a>
            </div>
            @endif
            <div class="sidebar-user-name">{{ Auth()->user()->name}}</div>
            <div class="sidebar-user-links">
                
                <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                <a href="{{ url('/logout') }}"data-toggle="tooltip" data-placement="bottom" title="Logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="gi gi-exit"></i>
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
               
            </div>
        </div>
        <!-- END User Info -->

        

        <!-- Sidebar Navigation -->
        @include('layouts.menu')
        <!-- END Sidebar Navigation -->

    </div>
    <!-- END Sidebar Content -->
</div>
<!-- END Wrapper for scrolling functionality -->
