<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 mt-4 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/system-settings/email-setup/admin/forgot-password') ? 'active' : '' }}"
                href="{{ route('admin.system-settings.email-setup', ['admin','forgot-password']) }}">
                    {{translate('Forgot_Password')}}
                </a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
</div>
