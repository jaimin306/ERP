<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="{{ Active::checkRoutePattern('admin/dashboard') }}">
                    
                    <a href="{{route('admin.dashboard')}}"  ><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class=""></span></a>
                    
                </li>
                <li class="{{ Request::path() == 'admin/*' ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a>
                    <!-- <ul class="nav nav-second-level collapse"> -->
                        <!-- <li class="{{ Active::checkRoutePattern('admin/country/*') }}" ><a href="{{route('admin.country')}}">Countries</a></li>
                        <li><a href="{{route('admin.state')}}">States</a></li>
                        <li><a href="{{route('admin.department')}}">Departments</a></li>
                        <li><a href="{{route('admin.designation')}}">Designation</a></li> -->
                        
                            <!-- <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a> -->
                            <ul class="nav nav-second-level collapse">
                                <li class="{{ Request::path() == 'admin/country' ? 'active' : '' }}"><a href="{{route('admin.country')}}">Countries</a></li>
                                <li class="{{ Request::path() == 'admin/state' ? 'active' : '' }}"><a href="{{route('admin.state')}}">States</a></li>
                                <li class="{{ Request::path() == 'admin/department' ? 'active' : '' }}"><a href="{{route('admin.department')}}">Departments</a></li>
                                <li class="{{ Request::path() == 'admin/designation' ? 'active' : '' }}"><a href="{{route('admin.designation')}}">Designation</a></li>
                                <li ><a href="{{route('admin.accountType')}}">Account Type</a></li>
                                <li><a href="{{route('admin.accountType')}}">Default Account</a></li>
                            </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-key"></i> <span class="nav-label">Settings</span> <span class=""></span></a>
                </li>
            </ul>

        </div>
    </nav>