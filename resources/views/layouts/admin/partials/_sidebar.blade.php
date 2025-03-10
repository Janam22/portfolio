<?php use App\CentralLogics\Helpers; ?>

<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar__brand-wrapper navbar-brand-wrapper justify-content-between">
                <!-- Logo -->
                @php($restaurant_logo = \App\Models\BusinessSetting::where(['key' => 'logo'])->first())
                <a class="navbar-brand d-block p-0" href="{{ route('admin.dashboard') }}" aria-label="Front">
                    <img class="navbar-brand-logo sidebar--logo-design"
                        src="{{ Helpers::get_full_url('business', $restaurant_logo?->value, $restaurant_logo?->storage[0]?->value ?? 'public', 'favicon') }}"
                        alt="image">
                    <img class="navbar-brand-logo-mini sidebar--logo-design-2"
                        src="{{ Helpers::get_full_url('business', $restaurant_logo?->value, $restaurant_logo?->storage[0]?->value ?? 'public', 'favicon') }}"
                        alt="image">
                </a>
                <!-- End Logo -->

                <!-- Navbar Vertical Toggle -->
                <button type="button"
                    class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                    <i class="tio-clear tio-lg"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->

                <div class="navbar-nav-wrap-content-left d-none d-xl-block">
                    <!-- Navbar Vertical Toggle -->
                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                            data-placement="right" title="Collapse"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                            data-template='<div class="tooltip d-none" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                            data-toggle="tooltip" data-placement="right" title="Expand"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

            </div>

            <!-- Content -->
            <div class="navbar-vertical-content bg--title" id="navbar-vertical-content">
                <!-- Search Form -->
                <form class="sidebar--search-form" autocomplete="off">
                    <input autocomplete="false" name="hidden" type="text" class="d-none">
                    <div class="search--form-group">
                        <button type="button" class="btn"><i class="tio-search"></i></button>
                        <input type="text" id="search" class="form-control form--control"
                            placeholder="{{ translate('messages.Search_Menu...') }}">
                    </div>
                </form>
                <!-- Search Form -->
                <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <!-- Dashboards -->
                    <li class="navbar-vertical-aside-has-menu {{ Request::is('admin') ? 'active' : '' }}">
                        <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{ route('admin.dashboard') }}"
                            title="{{ translate('messages.dashboard') }}">
                            <i class="tio-dashboard-vs nav-icon"></i>
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                {{ translate('messages.dashboard') }}
                            </span>
                        </a>
                    </li>

                    <!-- End Dashboards -->
                    @if (Helpers::module_permission_check('staff_attendance'))
                        <!-- Employee-->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.attendance_handle') }}">{{ translate('messages.Staff_Attendance') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('staff_attendance'))
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/staff-attendance*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.staff-attendance.list') }}"
                                title="{{ translate('messages.staff_attendance') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('staff_attendance') }}</span>
                            </a>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('timesheet'))
                        <!-- Employee-->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.timesheet_handle') }}">{{ translate('messages.Timesheet_Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('timesheet'))
                    
                        @if(auth('admin')->user()->role_id !== 1)
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/add-timesheet') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.timesheet.new') }}"
                                title="{{ translate('messages.timesheet') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('add_new_timesheet') }}</span>
                            </a>
                        </li>
                        
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/my-timesheets') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.timesheet.my-timesheets') }}"
                                title="{{ translate('messages.timesheet') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('my_timesheets') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(auth('admin')->user()->role_id == 1)
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/timesheets') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.timesheet.list') }}"
                                title="{{ translate('messages.timesheet') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('timesheet_lists') }}</span>
                            </a>
                        </li>
                        @endif
                    @endif

                    @if (Helpers::module_permission_check('leave'))
                        <!-- Employee-->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.leave_handle') }}">{{ translate('messages.Leave_Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('leave'))
                    
                        @if(auth('admin')->user()->role_id !== 1)
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/leave/leave-request-new') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.leave-request.request') }}"
                                title="{{ translate('messages.leave') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('add_new_leave_request') }}</span>
                            </a>
                        </li>
                        
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/leave/my-leave-requests') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.leave-request.my-requests') }}"
                                title="{{ translate('messages.leave') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('my_leave_requests') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(auth('admin')->user()->role_id == 1)
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/leave/leave-requests') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.leave-request.list') }}"
                                title="{{ translate('messages.leave') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('leave_request_lists') }}</span>
                            </a>
                        </li>
                        @endif
                    @endif

                    @if (Helpers::module_permission_check('travelorder'))
                        <!-- Employee-->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.travel_handle') }}">{{ translate('messages.Travel_Order') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('travelorder'))
                    
                        @if(auth('admin')->user()->role_id !== 1)
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/travel-order/travel-order-request-new') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.travel-order-request.request') }}"
                                title="{{ translate('messages.travel_order') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('add_new_travel_request') }}</span>
                            </a>
                        </li>
                        
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/travel-order/my-travel-order-requests') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.travel-order-request.my-requests') }}"
                                title="{{ translate('messages.travel_order') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('my_travel_requests') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(auth('admin')->user()->role_id == 1)
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/travel-order/travel-order-requests') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.travel-order-request.list') }}"
                                title="{{ translate('messages.travel_order') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('travel_request_lists') }}</span>
                            </a>
                        </li>
                        @endif
                    @endif

                    @if (Helpers::module_permission_check('custom_role') || Helpers::module_permission_check('employee'))
                        <!-- Employee-->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.employee_handle') }}">{{ translate('messages.Employee_Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('custom_role'))
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/custom-role*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{ route('admin.custom-role.create') }}"
                                title="{{ translate('messages.employee_Role') }}">
                                <i class="tio-incognito nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.employee_Role') }}</span>
                            </a>
                        </li>
                    @endif

                    @if (Helpers::module_permission_check('employee'))
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/employee*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                                title="{{ translate('Employees') }}">
                                <i class="tio-user nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.employees') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('admin/employee*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('admin/employee/add-new') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.employee.add-new') }}"
                                        title="{{ translate('messages.add_new_Employee') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span
                                            class="text-truncate">{{ translate('messages.Add_New_Employee') }}</span>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Request::is('admin/employee/list') || Request::is('admin/employee/update/*') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.employee.list') }}"
                                        title="{{ translate('messages.Employee_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.Employee_List') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif
                    <!-- End Employee -->

                    <!-- Business Settings -->
                    @if (Helpers::module_permission_check('settings'))
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.business_settings') }}">{{ translate('messages.business_settings') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/business-settings/business-setup*') ||
                            Request::is('admin/business-settings/refund/settings*') ||
                            Request::is('admin/business-settings/language*')
                                ? 'active'
                                : '' }}">
                            <a class="nav-link " href="{{ route('admin.business-settings.business-setup') }}"
                                title="{{ translate('messages.business_setup') }}">
                                <span class="tio-settings nav-icon"></span>
                                <span class="text-truncate">{{ translate('messages.business_setup') }}</span>
                            </a>
                        </li>

                <li
                    class="navbar-vertical-aside-has-menu {{ Request::is('admin/business-settings/email-setup*') ? 'active' : '' }}">
                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                        title="{{ translate('messages.email_template') }}">
                        <i class="tio-email nav-icon"></i>
                        <span
                            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.email_template') }}
                        </span>
                    </a>
                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                        style="display: {{ Request::is('admin/business-settings/email-setup*') ? 'block' : 'none' }}">


                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/business-settings/email-setup/admin*') ? 'active' : '' }}">
                            <a class="nav-link " href="{{ route('admin.business-settings.email-setup', ['admin','forgot-password']) }}"
                                title="{{ translate('messages.Social_Media') }}">
                                <span class="tio-circle nav-indicator-icon"></span>
                                <span class="text-truncate">{{ translate('messages.Admin_Mail_Templates') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/login-url/login-page-setup') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.login_url.login_url_page') }}"
                        title="{{ translate('messages.login_setup') }}">
                        <span class="tio-devices-apple nav-icon"></span>
                        <span class="text-truncate text-capitalize">{{ translate('messages.login_setup') }}</span>
                    </a>
                </li>

                <li
                    class="navbar-vertical-aside-has-menu {{ Request::is('admin/business-settings/mail-config') || Request::is('admin/business-settings/recaptcha*') || Request::is('admin/business-settings/storage-connection') ? 'active' : '' }} @yield('3rd_party')">
                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                        title="{{ translate('3rd_Party_&_Configurations') }}">
                        <span class="tio-plugin nav-icon"></span>
                        <span
                            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.3rd_Party_&_Configurations') }}</span>
                    </a>
                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                        style="display: {{ Request::is('admin/business-settings/mail-config') || Request::is('admin/business-settings/storage-connection') || Request::is('admin/business-settings/recaptcha*') ? 'block' : 'none' }}  ">

                        <li
                            class="nav-item {{ Request::is('admin/business-settings/mail-config') || Request::is('admin/business-settings/storage-connection') || Request::is('admin/business-settings/recaptcha*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.business-settings.mail-config') }}"
                                title="{{ translate('messages.3rd_Party') }}">
                                <span class="tio-circle nav-indicator-icon"></span>
                                <span class="text-truncate">{{ translate('messages.3rd_Party') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                @endif
                <!-- End Business Settings -->

                <li class="nav-item pt-100px">

                </li>
                </ul>
            </div>
            <!-- End Content -->
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>

@push('script_2')
    <script>
        "use strict";
        $(window).on('load', function() {
            if ($(".navbar-vertical-content li.active").length) {
                $('.navbar-vertical-content').animate({
                    scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
                }, 300);
            }
        });

        var $navItems = $('#navbar-vertical-content > ul > li');
        $('#search').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            $navItems.show().filter(function() {
                var $listItem = $(this);
                var text = $listItem.text().replace(/\s+/g, ' ').toLowerCase();
                var $list = $listItem.closest('li');

                return !~text.indexOf(val) && !$list.text().toLowerCase().includes(val);
            }).hide();
        });
    </script>
@endpush
