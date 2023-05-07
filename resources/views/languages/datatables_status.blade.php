@if($status == 1)
    <a href="{{ route('language_status',['id'=> $id,'status'=> $status]) }}"><span class="badge badge-success">Success</span></a>
@else
    <a href="{{ route('language_status',['id'=> $id,'status'=> $status]) }}"><span class="badge badge-danger">Danger</span></a>
@endif