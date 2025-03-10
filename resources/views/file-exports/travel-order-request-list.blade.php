<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('travel_order_request_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Travel_Order_Request_Analytics') }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
            <tr>
                <th>{{ translate('Search_Criteria') }}</th>
                <th></th>
                <th></th>
                <th>
                    {{ translate('Search_Bar_Content')  }}: {{ $data['search'] ??translate('N/A') }}
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>{{ translate('Filter_Criteria') }}</th>
                <th></th>
                <th></th>
                <th>
                    {{ translate('Show_Limit')  }}: {{ $data['show_limit'] ??translate('N/A') }}
                    <br>
                    {{ translate('Travel_Order_Request_Date_Range')  }}: {{ $data['travel_order_request_date'] ??translate('N/A') }}
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        <tr>
            <th>{{ translate('sl') }}</th>
            <th>{{ translate('staff_name') }}</th>
            <th>{{ translate('start_date') }}</th>
            <th>{{ translate('end_date') }}</th>
            <th>{{ translate('travel_place') }}</th>
            <th>{{ translate('travel_mode') }}</th>
            <th>{{ translate('status') }} </th>
        </thead>
        <tbody>
        @foreach($data['travel_order_requests'] as $key => $travel_order_request)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $travel_order_request->employee->f_name . ' ' . $travel_order_request->employee->l_name }}</td>
            <td>{{ $travel_order_request->from_date }}</td>
            <td>{{ $travel_order_request->to_date }}</td>
            <td>{{ $travel_order_request->travel_place }}</td>
            <td>{{ $travel_order_request->travel_mode }}</td>
            <td>{{ ucfirst($travel_order_request->travel_order_status) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
