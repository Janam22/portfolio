<div class="row">
    <div class="col-lg-12 text-center "><h1 >{{ translate('blog_list') }}</h1></div>
    <div class="col-lg-12">
    <table>
        <thead>
            <tr>
                <th>{{ translate('Blog_Analytics') }}</th>
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
            <th>{{ translate('author_name') }}</th>
            <th>{{ translate('blog_title') }}</th>
            <th>{{ translate('blog_details') }}</th>
            <th>{{ translate('slug') }} </th>
            <th>{{ translate('status') }} </th>
            <th>{{ translate('Created_date') }} </th>
        </thead>
        <tbody>
        @foreach($data['blogs'] as $key => $blog)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{ $blog->author_name }}</td>
            <td>{{ $blog->blog_title }}</td>
            <td>{{ $blog->blog_details }}</td>
            <td>{{ $blog->slug }}</td>
            <td>
                @if($blog->status == '1')
                    Active
                @else
                    Inactive
                @endif
            </td>
            <td>{{ $blog->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
