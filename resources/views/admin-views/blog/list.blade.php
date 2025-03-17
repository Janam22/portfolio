@extends('layouts.admin.app')

@section('title', translate('Blog_list'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm">
                    <h1 class="page-header-title">
                        <span class="page-header-icon"><i class="tio-group-equal"></i></span>
                        {{ translate('messages.Blog_lists') }}
                    </h1>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('Blog Date') }}</label>
                            <div class="position-relative">
                                <span class="tio-calendar icon-absolute-on-right"></span>
                                <input type="text" readonly name="blog_date"
                                    value="{{ request()->get('blog_date') ?? null }}"
                                    class="date-range-picker form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('Show Limit') }}</label>
                            <input type="number" min="1" name="show_limit" class="form-control"
                                value="{{ request()->get('show_limit') }}" placeholder="{{ translate('Ex : 100') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="d-md-block">&nbsp;</label>
                            <div class="btn--container justify-content-end">
                                <button type="submit" class="btn btn--primary">{{ translate('Filter') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Card -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header gap-2 flex-wrap pt-3 border-0">
                <h3 class="m-0">
                    {{ translate('messages.Blog_Lists') }} <span class="badge badge-soft-dark ml-2"
                        id="count">{{ $blog_lists->total() }}</span>
                </h3>
                <div class="search--button-wrapper justify-content-end">
                    <form>
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                value="{{ request()?->search ?? null }}"
                                placeholder="{{ translate('Ex:_Search_by_title') }}" aria-label="Search" required>
                            <button type="submit" class="btn btn--secondary">
                                <i class="tio-search"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>
                    <div class="d-flex flex-wrap justify-content-sm-end align-items-sm-center ml-0 mr-0">


                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-download-to mr-1"></i> {{ translate('messages.export') }}
                            </a>

                            <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header">{{ translate('messages.download_options') }}</span>
                                <a id="export-excel" class="dropdown-item"
                                    href="{{ route('admin.blog.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ dynamicAsset('public/assets/admin') }}/svg/components/excel.svg"
                                        alt="Image Description">
                                    {{ translate('messages.excel') }}
                                </a>
                                <a id="export-csv" class="dropdown-item"
                                    href="{{ route('admin.blog.export', ['type' => 'csv', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ dynamicAsset('public/assets/admin') }}/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                    .{{ translate('messages.csv') }}
                                </a>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                    data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "paging":false
                   }'>
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0">
                                {{ translate('sl') }}
                            </th>
                            <th class="table-column-pl-0 border-0">{{ translate('messages.author_name') }}</th>
                            <th class="border-0">{{ translate('messages.title') }}</th>
                            <th class="border-0">{{ translate('messages.image') }}</th>
                            <th class="border-0">{{ translate('messages.status') }}</th>
                            <th class="border-0">{{ translate('messages.created_date') }}</th>
                            <th class="border-0">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>
                    @php
                        $count = 0;
                    @endphp
                    <tbody id="set-rows">
                        @foreach ($blog_lists as $key => $blog_list)
                            <tr class="">
                                <td class="">
                                    {{ (request()->get('show_limit') ? $count++ : $key) + $blog_lists->firstItem() }}
                                </td>
                                <td class="table-column-pl-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-body text-hover-primary">
                                            {{  $blog_list->author_name?  $blog_list->author_name : translate('Author_not_found') }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    {{ $blog_list->blog_title }}
                                </td>
                                <td>
                                    <div class="">
                                        <img class="avatar border"

                                        src="{{ $blog_list['image_full_url'] }}"


                                    alt="{{Str::limit($blog_list['blog_title'], 20,'...')}}">
                                    </div>
                                </td>                            
                                <td>
                                    <label class="toggle-switch toggle-switch-sm ml-2" for="stocksCheckbox{{$blog_list->id}}">
                                    <input type="checkbox" data-url="{{route('admin.blog.status',[$blog_list['id'],$blog_list->status?0:1])}}" class="toggle-switch-input redirect-url" id="stocksCheckbox{{$blog_list->id}}" {{$blog_list->status?'checked':''}}>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </td>

                                <td>
                                    <label class="badge">
                                    {{ \App\CentralLogics\Helpers::date_format($blog_list->created_at) }}
                                    </label>
                                </td>  
                                <td>
                                    <div class="btn--container">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                            href="{{route('admin.blog.edit',[$blog_list['id']])}}" title="{{translate('messages.edit_blog')}}"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                        data-id="category-{{$blog_list['id']}}" data-message="{{ translate('Want_to_delete_this_blog_?') }}" title="{{translate('messages.delete_blog')}}"><i class="tio-delete-outlined"></i>
                                        </a>
                                    </div>

                                    <form action="{{route('admin.blog.delete',[$blog_list['id']])}}" method="post" id="service-{{$blog_list['id']}}">
                                        @csrf @method('delete')
                                    </form>
                                </td>
   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($blog_lists->total() === 0)
                <div class="empty--data">
                    <img src="{{ dynamicAsset('/public/assets/admin/img/empty.png') }}" alt="public">
                    <h5>
                        {{ translate('no_data_found') }}
                    </h5>
                </div>
            @endif
            <!-- End Table -->
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                    <div>
                        {!! $blog_lists->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
            <!-- End Footer -->

        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";
        $(document).on('ready', function() {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function() {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none',
                        customize: function(doc) {
                            doc.content[1].table.body.forEach(row => {
                                row.splice(4, 3);
                            });
                        }
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3 w-7rem" src="{{ dynamicAsset('public/assets/admin') }}/svg/illustrations/sorry.svg" alt="Image Description">' +
                        '<p class="mb-0">{{ translate('No_data_to_show') }}</p>' +
                        '</div>'
                }
            });


            $('#datatableSearch').on('mouseup', function(e) {
                let $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function() {
                    let newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });

            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function() {
                let tagify = $.HSCore.components.HSTagify.init($(this));
            });
        });
    </script>
@endpush