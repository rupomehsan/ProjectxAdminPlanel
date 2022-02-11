<?php
$currentControllerName = Request::segment(2);
//dd($currentControllerName);
?>


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <div class="logo d-flex my-4">
        <span class="iconify mx-3" data-icon="eos-icons:admin" style="color: #da0f0f;" data-width="30"
              data-height="30"></span>
        <h4 class="text-uppercase ">admin</h4>
    </div>

    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Sidebar Dashboard -->
        <li class="nav-item">
            <a class="nav-link  {{ $currentControllerName == 'dashboard' ? 'active' : '' }}" href="{{url('admin/dashboard')}}">
                <div class="sidebar-icon-bg">
                    <span class="iconify mx-3 sidebar-icon" data-icon="ic:sharp-space-dashboard" style="color: #00000;"
                          data-width="20" data-height="20"></span>
                </div>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <!-- End Sidebar Dashboard -->


        <li class="nav-heading">Manage</li>

        <!-- Sidebar User -->
        <li class="nav-item ">
            <a class="nav-link {{ $currentControllerName == 'users' ? 'active' : '' }}" href="{{url('admin/users')}}">
                <span class="iconify mx-3" data-icon="ic:sharp-space-dashboard" style="color: #00000;" data-width="20"
                      data-height="20"></span>
                <span class="title">Users</span>
            </a>
        </li>
        <!-- End Sidebar User -->

        <!-- Sidebar Subscriptions -->
        <li class="nav-item ">
            <a class="nav-link {{ $currentControllerName == 'subscription' ? 'active' : '' }}" href="{{url('admin/subscription')}}">
                <span class="iconify mx-3" data-icon="eos-icons:subscriptions-created-outlined" style="color: #00000;"
                      data-width="20"
                      data-height="20"></span>
                <span class="title">Subscriptions</span>
            </a>
        </li>
        <!-- End Sidebar Subscriptions -->

        <!-- Sidebar API -->
        <li class="nav-item ">
            <a class="nav-link {{ $currentControllerName == 'weather-api' ? 'active' : '' }}" href="{{url('admin/weather-api')}}">
                <span class="iconify mx-3" data-icon="eos-icons:api" style="color: #00000;" data-width="20"
                      data-height="20"></span>
                <span class="title">Weather API</span>
            </a>
        </li>
        <!-- End Sidebar API -->

        <!-- Sidebar Blog -->
        <li class="nav-item ">
            <a class="nav-link {{ $currentControllerName == 'blog' ? 'active' : '' }}" href="{{url('admin/blog')}}">
                <span class="iconify mx-3" data-icon="jam:blogger-square" style="color: #00000;" data-width="20"
                      data-height="20"></span>
                <span class="title">Blog</span>
            </a>
        </li>
        <!-- End Sidebar Blog -->

        <li class="nav-heading">Administration</li>
        <!-- Sidebar Manage Admin -->
        <li class="nav-item">
            <a class="nav-link {{ $currentControllerName == 'manage-admin' ? 'active' : '' }}" href="{{url('admin/manage-admin')}}">
                <span class="iconify mx-3" data-icon="ri:user-settings-fill" style="color: #00000;" data-width="20"
                      data-height="20"></span>
                <span class="title">Manage Admin</span>
            </a>
        </li>
        <!-- End Sidebar Manage Admin -->

{{--        <li class="nav-heading">User</li>--}}
{{--        <!-- Sidebar Manage User -->--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="../view/pages/manage-user.php">--}}
{{--                <span class="iconify mx-3" data-icon="ri:user-settings-fill" style="color: #00000;" data-width="20"--}}
{{--                      data-height="20"></span>--}}
{{--                <span class="title">Manage User</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <!-- End Sidebar Manage user -->

        <li class="nav-heading">Settings</li>
        <!-- Sidebar Advertisement -->
        <li class="nav-item">
            <a class="nav-link {{ $currentControllerName == 'advertisement' ? 'active' : '' }}" href="{{url('admin/advertisement')}}">
                <span class="iconify mx-3" data-icon="ri:advertisement-fill" style="color: #00000;" data-width="20"
                      data-height="20"></span>
                <span class="title">Advertisement</span>
            </a>
        </li>
        <!-- End Sidebar Advertisement -->


        <!-- Sidebar Notification -->
        <li class="nav-item">
            <a class="nav-link {{ $currentControllerName == 'notification' ? 'active' : '' }}" href="{{url('admin/notification')}}">
                <span class="iconify mx-3" data-icon="ic:baseline-notification-add" style="color: #00000;"
                      data-width="20"
                      data-height="20"></span>
                <span class="title">Notification</span>
            </a>
        </li>
        <!-- End Sidebar Notification -->

        <!-- Sidebar Setting -->
        <li class="nav-item">
            <a class="nav-link {{ $currentControllerName == 'setting' ? 'active' : '' }}" href="{{url('admin/setting')}}">
                <span class="iconify mx-3" data-icon="ant-design:setting-filled"  data-width="20"
                      data-height="20"></span>
                <span class="title">Basic Setting</span>
            </a>
        </li>
        <!-- End Sidebar Setting -->

        <!-- Sidebar SMTP -->
        <li class="nav-item">
            <a class="nav-link {{ $currentControllerName == 'smtp' ? 'active' : '' }}" href="{{url('admin/smtp')}}">
                <span class="iconify mx-3" data-icon="fluent:mail-settings-16-filled" style="color: #00000;"
                      data-width="20"
                      data-height="20"></span>
                <span class="title">SMTP</span>
            </a>
        </li>
        <!-- End Sidebar SMTP -->
    </ul>
</aside>
<!-- ======= End Sidebar ======= -->
