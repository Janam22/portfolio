<div class="d-flex flex-wrap justify-content-between statistics--title-area">
    <div class="statistics--title pr-sm-3">
        <h4 class="m-0 mr-1">
            {{translate('System_statistics')}}
        </h4>
    </div>
</div>

<div class="row g-2">
    <div class="col-xl-3 col-sm-6">
        <div class="resturant-card dashboard--card bg--2 cursor-pointer redirect-url" data-url="{{ route('admin.inquiry.list') }}">
            <h4 class="title">{{ $total_inquiries }}</h4>
            <span class="subtitle">{{translate('messages.inquiries')}}</span>
            <img class="resturant-icon" src="{{dynamicAsset('/public/assets/admin/img/dashboard/1.png')}}" alt="dashboard">
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="resturant-card dashboard--card bg--3 cursor-pointer redirect-url" data-url="{{ route('admin.service.add') }}">
            <h4 class="title">{{ $total_services }}</h4>
            <span class="subtitle">{{translate('messages.services')}}</span>
            <img class="resturant-icon" src="{{dynamicAsset('/public/assets/admin/img/dashboard/2.png')}}" alt="dashboard">
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="resturant-card dashboard--card bg--5 cursor-pointer redirect-url" data-url="{{ route('admin.project.add') }}">
            <h4 class="title">{{ $total_projects }}</h4>
            <span class="subtitle">{{translate('messages.projects')}}</span>
            <img class="resturant-icon" src="{{dynamicAsset('/public/assets/admin/img/dashboard/3.png')}}" alt="dashboard">
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="resturant-card dashboard--card bg--14 cursor-pointer redirect-url" data-url="{{ route('admin.blog.list') }}">
            <h4 class="title">{{ $total_blogs }}</h4>
            <span class="subtitle">{{translate('messages.blogs')}}</span>
            <img class="resturant-icon" src="{{dynamicAsset('/public/assets/admin/img/dashboard/4.png')}}" alt="dashboard">
        </div>
    </div>
</div>


