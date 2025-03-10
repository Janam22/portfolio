<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 mt-4 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/business-settings/mail-config*') ? 'active' : '' }}" id="modal_active" href="{{ route('admin.business-settings.mail-config') }}"  aria-disabled="true">{{translate('Mail_Config')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/business-settings/recaptcha*') ? 'active' : '' }}" href="{{route('admin.business-settings.recaptcha_index')}}"  aria-disabled="true">{{translate('Recaptcha')}}</a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
</div>
