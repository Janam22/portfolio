<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('project_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Projects_Analytics') }}</th>
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
            <th>{{ translate('link') }}</th>
            <th>{{ translate('priority') }}</th>
            <th>{{ translate('status') }} </th>
            <th>{{ translate('Created_date') }} </th>
        </thead>
        <tbody>
        @foreach($data['projects'] as $key => $project)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->link }}</td>
            <td>
                @if($project->priority == '0')
                    Normal
                @elseif($project->priority == '1')
                    Medium
                @else
                    High
                @endif
            </td>
            <td>
                @if($project->status == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>{{ $project->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
