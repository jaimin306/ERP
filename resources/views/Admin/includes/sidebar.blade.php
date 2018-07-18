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
                    <a href="{{route('admin.dashboard')}}"  ><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> <span class=""></span></a>
                </li>

                <li class="{{ active_class(if_route(['admin.country', 'admin.country.create', 'admin.state', 'admin.state.create', 'admin.department', 'admin.department.create', 'admin.designation', 'admin.designation.create', 'admin.accountType', 'admin.accountType.create', 'admin.user', 'admin.user.create', 'admin.bankAccount', 'admin.bankAccount.create', 'admin.vendorType', 'admin.vendorType.create', 'admin.vendor', 'admin.vendor.create' , 'admin.itemType', 'admin.itemType.create' , 'admin.itemCategory', 'admin.itemCategory.create' , 'admin.item', 'admin.item.create' ]) ) }}">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a>
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
                                <li class="{{ active_class(if_route(['admin.bankAccount', 'admin.bankAccount.create'])) }}">
                                    <a href="{{route('admin.bankAccount')}}">Bank Accounts</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.user', 'admin.user.create'])) }}">
                                    <a href="{{route('admin.user')}}">User</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.vendorType', 'admin.vendorType.create'])) }}">
                                    <a href="{{route('admin.vendorType')}}">Vendor Type</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.vendor', 'admin.vendor.create'])) }}">
                                    <a href="{{route('admin.vendor')}}">Vendor</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.itemCategory', 'admin.itemCategory.create'])) }}">
                                    <a href="{{route('admin.itemCategory')}}">Item Category</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.itemType', 'admin.itemType.create'])) }}">
                                    <a href="{{route('admin.itemType')}}">Item Type</a>
                                </li>
                                <li class="{{ active_class(if_route(['admin.item', 'admin.item.create'])) }}">
                                    <a href="{{route('admin.item')}}">Item</a>
                                </li>
                                
                            </ul>
                </li>
                <li class="{{ active_class(if_route(['admin.settings', 'admin.settings.create', 'admin.settings.emailSetting', 'admin.settings.systemSetting', 'admin.settings.getStateByCountry', 'admin.settings.updateCompanySetting', 'admin.settings.updateEmailSetting', 'admin.settings.updateSystemSetting'])) }}" >
                    <a href="{{route('admin.settings')}}"><i class="fa fa-key"></i> <span class="nav-label">Settings</span> <span class=""></span></a>
                </li>
            </ul>

        </div>
    </nav>