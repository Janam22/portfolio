<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 mt-4 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('admin/system-settings/system-setup') ?'active':'' }}" href="{{ route('admin.system-settings.system-setup') }}"   aria-disabled="true">{{translate('messages.system_settings')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/system-settings/language*') ? 'active' : '' }}"
                href="{{ route('admin.language.index') }}">{{translate('messages.Language')}}</a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
</div>
