@extends('layouts.admin.app')

@section('title', translate('Travel_Order_Request_list'))

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
                        {{ translate('messages.Travel_Order_Request_logs') }}
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
                            <label class="form-label">{{ translate('Travel_Order_Request_Date') }}</label>
                            <div class="position-relative">
                                <span class="tio-calendar icon-absolute-on-right"></span>
                                <input type="text" readonly name="travel_order_request_date"
                                    value="{{ request()->get('travel_order_request_date') ?? null }}"
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
                    {{ translate('messages.Travel_Order_Request_logs') }} <span class="badge badge-soft-dark ml-2"
                        id="count">{{ $travel_order_request_logs->total() }}</span>
                </h3>
                <div class="search--button-wrapper justify-content-end">
                    <form>
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                value="{{ request()?->search ?? null }}"
                                placeholder="{{ translate('Ex:_Search_by_name') }}" aria-label="Search" required>
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
                                    href="{{ route('admin.travel-order-request.export', ['type' => 'excel', request()->getQueryString()]) }}">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{ dynamicAsset('public/assets/admin') }}/svg/components/excel.svg"
                                        alt="Image Description">
                                    {{ translate('messages.excel') }}
                                </a>
                                <a id="export-csv" class="dropdown-item"
                                    href="{{ route('admin.travel-order-request.export', ['type' => 'csv', request()->getQueryString()]) }}">
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
                            <th class="table-column-pl-0 border-0">{{ translate('messages.staff_name') }}</th>
                            <th class="border-0">{{ translate('messages.start_date') }}</th>
                            <th class="border-0">{{ translate('messages.end_date') }}</th>
                            <th class="border-0">{{ translate('messages.travel_place') }}</th>
                            <th class="border-0">{{ translate('messages.travel_mode') }}</th>
                            <th class="border-0">{{ translate('messages.status') }}</th>
                            <th class="border-0">{{ translate('messages.action') }}</th>
                        </tr>
                    </thead>
                    @php
                        $count = 0;
                    @endphp
                    <tbody id="set-rows">
                        @foreach ($travel_order_request_logs as $key => $travel_order_request_log)
                            <tr class="">
                                <td class="">
                                    {{ (request()->get('show_limit') ? $count++ : $key) + $travel_order_request_logs->firstItem() }}
                                </td>
                                <td class="table-column-pl-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-body text-hover-primary">
                                            {{  $travel_order_request_log->employee->f_name?  $travel_order_request_log->employee->f_name . ' ' . $travel_order_request_log->employee->l_name : translate('Staff_not_found') }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <label class="badge">
                                        {{ \App\CentralLogics\Helpers::date_format($travel_order_request_log->from_date) }}
                                    </label>
                                </td>
                                <td>
                                    <label class="badge">
                                    {{ \App\CentralLogics\Helpers::date_format($travel_order_request_log->to_date) }}
                                    </label>
                                </td>                
                                <td>
                                    {{ $travel_order_request_log->travel_place }}
                                </td>            
                                <td style="white-space: normal; word-wrap: break-word; max-width: 200px;">
                                    {{ $travel_order_request_log->travel_mode }}
                                </td>     
                                <td class="
                                    @if($travel_order_request_log->travel_order_status == 'pending') text-secondary
                                    @elseif($travel_order_request_log->travel_order_status == 'approved') text-success
                                    @elseif($travel_order_request_log->travel_order_status == 'rejected') text-danger
                                    @endif
                                ">
                                    {{ ucfirst($travel_order_request_log->travel_order_status) }}
                                </td>
                                <td>
                                @if(($travel_order_request_log->travel_order_status == 'pending') || ($travel_order_request_log->travel_order_status == 'rejected'))
                                    <!-- Approve Button -->
                                    <form action="{{ route('admin.travel-order-request.status', ['id' => $travel_order_request_log->id, 'travel_order_status' => 'approved']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success">
                                            Approve
                                        </button>
                                    </form>
                                @endif
                                @if(($travel_order_request_log->travel_order_status == 'pending') || ($travel_order_request_log->travel_order_status == 'approved'))
                                    <!-- Reject Button -->
                                    <form action="{{ route('admin.travel-order-request.status', ['id' => $travel_order_request_log->id, 'travel_order_status' => 'rejected']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($travel_order_request_logs->total() === 0)
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
                        {!! $travel_order_request_logs->withQueryString()->links() !!}
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