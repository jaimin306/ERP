<div class="ibox-content mailbox-content" style="background: #fff;padding: 0">
    <div class="file-manager">
        <ul class="nav nav-pills nav-stacked navbar-custom-nav nav-setting" style="padding: 0">
            <li class="{{ Request::path() == 'admin/settings/companySetting' ? 'active' : '' }}"><a href="{{route('admin.settings.create')}}"> <i class="fa fa-certificate "></i> Company Settings </a></li>
            <li class="{{ Request::path() == 'admin/settings/systemSetting' ? 'active' : '' }}""><a href="{{route('admin.settings.systemSetting')}}"> <i class="fa fa-certificate"></i> System Settings</a></li>
            <li class="{{ Request::path() == 'admin/settings/emailSetting' ? 'active' : '' }}"><a href="{{route('admin.settings.emailSetting')}}"> <i class="fa fa-certificate"></i> Email Settings</a></li>
            <li class=""><a href="javascript:;"> <i class="fa fa-certificate"></i> Invoice Settings</a></li>
            <li class=""><a href="javascript:;"> <i class="fa fa-certificate"></i> Change Password</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>