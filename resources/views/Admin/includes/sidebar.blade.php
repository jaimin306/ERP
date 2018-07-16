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
                <li class="{{ active_class(if_route('admin.dashboard')) }}">
                    <a href="{{route('admin.dashboard')}}"  ><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class=""></span></a>
                </li>
<!-- $active->checkRoutePattern([]) 
    {{ active_class(if_route('admin.dashboard')) }}
-->
                <li class="{{ active_class(if_route(['admin.country', 'admin.country.create', 'admin.state', 'admin.state.create', 'admin.department', 'admin.department.create', 'admin.designation', 'admin.designation.create', 'admin.accountType', 'admin.accountType.create', 'admin.user', 'admin.user.create' ]) ) }}">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a>
                    <!-- <ul class="nav nav-second-level collapse"> -->
                        <!-- <li class="{{ Active::checkRoutePattern('admin/country/*') }}" ><a href="{{route('admin.country')}}">Countries</a></li>
                        <li><a href="{{route('admin.state')}}">States</a></li>
                        <li><a href="{{route('admin.department')}}">Departments</a></li>
                        <li><a href="{{route('admin.designation')}}">Designation</a></li> -->
                        
                            <!-- <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a> -->
                            <ul class="nav nav-second-level collapse">
                                <li class="{{ active_class(if_route(['admin.country', 'admin.country.create'])) }}">
                                   <a href="{{route('admin.country')}}">Countries</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.state', 'admin.state.create'])) }}">
                                    <a href="{{route('admin.state')}}">States</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.department', 'admin.department.create'])) }}">
                                    <a href="{{route('admin.department')}}">Departments</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.designation', 'admin.designation.create'])) }}">
                                    <a href="{{route('admin.designation')}}">Designation</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.accountType', 'admin.accountType.create'])) }}">
                                    <a href="{{route('admin.accountType')}}">Account Type</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.accountType', 'admin.accountType.create'])) }}">
                                    <a href="{{route('admin.accountType')}}">Default Account</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.user', 'admin.user.create'])) }}"><a href="{{route('admin.user')}}">User</a></li>
                            </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-key"></i> <span class="nav-label">Settings</span> <span class=""></span></a>
                </li>
            </ul>

        </div>
    </nav>