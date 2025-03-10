<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('timesheet_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Timesheet_Analytics') }}</th>
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
                    {{ translate('Timesheet_Date_Range')  }}: {{ $data['timesheet_date'] ??translate('N/A') }}
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        <tr>
            <th>{{ translate('sl') }}</th>
            <th>{{ translate('staff_name') }}</th>
            <th>{{ translate('timesheet_details') }}</th>
            <th>{{ translate('created_date') }}</th>
        </thead>
        <tbody>
        @foreach($data['timesheets'] as $key => $timesheet)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $timesheet->employee->f_name . ' ' . $timesheet->employee->l_name }}</td>
            <td>{{ $timesheet->details }}</td>
            <td>{{ \App\CentralLogics\Helpers::time_date_format($timesheet->created_at) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
