<?php use App\CentralLogics\Helpers; ?>

<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar__brand-wrapper navbar-brand-wrapper justify-content-between">
                <!-- Logo -->
                @php($restaurant_logo = \App\Models\SystemSetting::where(['key' => 'logo'])->first())
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

                        <!-- Employee-->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.internal_management_handle') }}">{{ translate('messages.Internal_Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/add-timesheet') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.about') }}">
                                <i class="tio-info nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('About') }}</span>
                            </a>
                        </li>
                        
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/my-timesheets') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.skills') }}">
                                <i class="tio-brain nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Skills') }}</span>
                            </a>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/timesheets') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.resume') }}">
                                <i class="tio-file-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Resume') }}</span>
                            </a>
                        </li>
                        
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/timesheets') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.projects') }}">
                                <i class="tio-folder-opened-labeled nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Projects') }}</span>
                            </a>
                        </li>
                                                
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/social') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.social_media') }}">
                                <i class="tio-media-photo nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Social_Media') }}</span>
                            </a>
                        </li>
                        
                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/blog/blogs') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.blog') }}">
                                <i class="tio-edit nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Blogs') }}</span>
                            </a>
                        </li>

                        <!-- External Management -->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.external_management_handle') }}">{{ translate('messages.External_Management') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/add-timesheet') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.users') }}">
                                <i class="tio-send nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Service_Requests') }}</span>
                            </a>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/timesheet/timesheets') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href=""
                                title="{{ translate('messages.testimonials') }}">
                                <i class="tio-quotes nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('Testimonials') }}</span>
                            </a>
                        </li>

                    <!-- Settings -->
                        <li class="nav-item">
                            <small class="nav-subtitle"
                                title="{{ translate('messages.settings') }}">{{ translate('messages.settings') }}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/system-settings/system-setup*') ||
                            Request::is('admin/system-settings/language*')
                                ? 'active'
                                : '' }}">
                            <a class="nav-link " href="{{ route('admin.system-settings.system-setup') }}"
                                title="{{ translate('messages.system_setup') }}">
                                <span class="tio-settings nav-icon"></span>
                                <span class="text-truncate">{{ translate('messages.system_setup') }}</span>
                            </a>
                        </li>

                        <li
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/system-settings/email-setup*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                                title="{{ translate('messages.email_template') }}">
                                <i class="tio-email nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.email_template') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('admin/system-settings/email-setup*') ? 'block' : 'none' }}">


                                <li
                                    class="navbar-vertical-aside-has-menu {{ Request::is('admin/system-settings/email-setup/admin*') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('admin.system-settings.email-setup', ['admin','forgot-password']) }}"
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
                            class="navbar-vertical-aside-has-menu {{ Request::is('admin/system-settings/mail-config') || Request::is('admin/system-settings/recaptcha*') || Request::is('admin/system-settings/storage-connection') ? 'active' : '' }} @yield('3rd_party')">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                                title="{{ translate('3rd_Party_&_Configurations') }}">
                                <span class="tio-plugin nav-icon"></span>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{ translate('messages.3rd_Party_&_Configurations') }}</span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('admin/system-settings/mail-config') || Request::is('admin/system-settings/storage-connection') || Request::is('admin/system-settings/recaptcha*') ? 'block' : 'none' }}  ">

                                <li
                                    class="nav-item {{ Request::is('admin/system-settings/mail-config') || Request::is('admin/system-settings/storage-connection') || Request::is('admin/system-settings/recaptcha*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.system-settings.mail-config') }}"
                                        title="{{ translate('messages.3rd_Party') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{ translate('messages.3rd_Party') }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                <!-- End Settings -->

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
