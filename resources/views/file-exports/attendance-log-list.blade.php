<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('attendance_log_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Attendance_log_Analytics') }}</th>
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
                    {{ translate('Attendance_Date_Range')  }}: {{ $data['attendance_date'] ??translate('N/A') }}
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        <tr>
            <th>{{ translate('sl') }}</th>
            <th>{{ translate('staff_name') }}</th>
            <th>{{ translate('checkin_time') }}</th>
            <th>{{ translate('checkin_latitude') }}</th>
            <th>{{ translate('checkin_longitude') }}</th>
            <th>{{ translate('checkout_time') }}</th>
            <th>{{ translate('checkout_latitude') }} </th>
            <th>{{ translate('checkout_longitude') }} </th>
        </thead>
        <tbody>
        @foreach($data['attendance_logs'] as $key => $attendance_log)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $attendance_log->employee->f_name . ' ' . $attendance_log->employee->l_name }}</td>
            <td>{{ $attendance_log->checkin_time }}</td>
            <td>{{ $attendance_log->ci_lat }}</td>
            <td>{{ $attendance_log->ci_lon }}</td>
            <td>{{ $attendance_log->checkout_time }}</td>
            <td>{{ $attendance_log->co_lat }}</td>
            <td>{{ $attendance_log->co_lon }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
