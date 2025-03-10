<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('leave_request_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Leave_request_Analytics') }}</th>
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
                    {{ translate('Leave_Request_Date_Range')  }}: {{ $data['leave_request_date'] ??translate('N/A') }}
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        <tr>
            <th>{{ translate('sl') }}</th>
            <th>{{ translate('staff_name') }}</th>
            <th>{{ translate('leave_type') }}</th>
            <th>{{ translate('start_date') }}</th>
            <th>{{ translate('end_date') }}</th>
            <th>{{ translate('subject') }}</th>
            <th>{{ translate('request_reason') }}</th>
            <th>{{ translate('status') }} </th>
        </thead>
        <tbody>
        @foreach($data['leave_requests'] as $key => $leave_request)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $leave_request->employee->f_name . ' ' . $leave_request->employee->l_name }}</td>
            <td>
                @if($leave_request->leave_type == 'el')
                    Emergency Leave
                @elseif($leave_request->leave_type == 'sl')
                    Sick Leave
                @else
                    {{ $leave_request->leave_type }}
                @endif
            </td>
            <td>{{ $leave_request->from_date }}</td>
            <td>{{ $leave_request->to_date }}</td>
            <td>{{ $leave_request->subject }}</td>
            <td>{{ $leave_request->reason_description }}</td>
            <td>{{ ucfirst($leave_request->leave_status) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
