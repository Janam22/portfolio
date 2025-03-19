<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('inquiry_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Inquiry_Analytics') }}</th>
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
            <th>{{ translate('subject') }}</th>
            <th>{{ translate('email') }}</th>
            <th>{{ translate('contact') }} </th>
            <th>{{ translate('message') }} </th>
            <th>{{ translate('Inquiry_date') }} </th>
        </thead>
        <tbody>
        @foreach($data['inquiries'] as $key => $inquiry)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $inquiry->name }}</td>
            <td>{{ $inquiry->subject }}</td>
            <td>{{ $inquiry->email }}</td>
            <td>{{ $inquiry->contact }}</td>
            <td>{{ $inquiry->message }}</td>
            <td>{{ $inquiry->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
