<div class="table-responsive">
    <table class="table" id="userBusinessDetails-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Header Banner</th>
        <th>Business Name</th>
        <th>Map Link</th>
        <th>User Available Points</th>
        <th>E Shop Banner</th>
        <th>Booking Banner</th>
        <th>Logo</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userBusinessDetails as $userBusinessDetails)
            <tr>
                <td>{{ $userBusinessDetails->user_id }}</td>
            <td>{{ $userBusinessDetails->header_banner }}</td>
            <td>{{ $userBusinessDetails->business_name }}</td>
            <td>{{ $userBusinessDetails->map_link }}</td>
            <td>{{ $userBusinessDetails->user_available_points }}</td>
            <td>{{ $userBusinessDetails->e_shop_banner }}</td>
            <td>{{ $userBusinessDetails->booking_banner }}</td>
            <td>{{ $userBusinessDetails->logo }}</td>
                <td>
                    {!! Form::open(['route' => ['userBusinessDetails.destroy', $userBusinessDetails->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userBusinessDetails.show', [$userBusinessDetails->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('userBusinessDetails.edit', [$userBusinessDetails->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
