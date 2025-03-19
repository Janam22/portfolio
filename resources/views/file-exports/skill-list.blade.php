<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('skill_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Skill_Analytics') }}</th>
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
            <th>{{ translate('rate') }}</th>
            <th>{{ translate('status') }} </th>
            <th>{{ translate('Created_date') }} </th>
        </thead>
        <tbody>
        @foreach($data['skills'] as $key => $skill)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $skill->name }}</td>
            <td>{{ $skill->rate }}</td>
            <td>
                @if($skill->status == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>{{ $skill->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
