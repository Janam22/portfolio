<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('service_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Service_Analytics') }}</th>
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
            <tr></tr>
        <tr>
            <th>{{ translate('sl') }}</th>
            <th>{{ translate('name') }}</th>
            <th>{{ translate('description') }}</th>
            <th>{{ translate('priority') }}</th>
            <th>{{ translate('status') }} </th>
            <th>{{ translate('Created_date') }} </th>
        </thead>
        <tbody>
        @foreach($data['services'] as $key => $service)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->description }}</td>
            <td>
                @if($service->priority == '0')
                    Normal
                @elseif($service->priority == '1')
                    Medium
                @else
                    High
                @endif
            </td>
            <td>
                @if($service->status == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>{{ $service->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
