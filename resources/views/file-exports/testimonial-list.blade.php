<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('testimonial_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Testimonial_Analytics') }}</th>
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
            <th>{{ translate('designation') }}</th>
            <th>{{ translate('message') }}</th>
            <th>{{ translate('status') }} </th>
            <th>{{ translate('Created_date') }} </th>
        </thead>
        <tbody>
        @foreach($data['testimonials'] as $key => $testimonial)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $testimonial->name }}</td>
            <td>{{ $testimonial->designation }}</td>
            <td>{{ $testimonial->message }}</td>
            <td>
                @if($testimonial->status == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>{{ $testimonial->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
