@extends('layouts.app')
@section('title','Notification')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Notification Masters</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('notificationMasters.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Business</th>
                      <th class="text-center">Message</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $notification)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $notification->title }}</td>
                      <td class="text-center">{{ $notification->details }}</td>
                      <?php if($notification->notification_image != ''){ ?>
                       <td class="text-center"><img src="<?php echo  url('/').'/'.$notification->notification_image; ?>" style="width: 7%"  ></td>
                     <?php } else { ?>
                      <td class="text-center"> - </td>
                      <?php } ?>
                      <td class="text-center">{{date('d-m-Y',strtotime($notification->created_at))}}</td>
                      <td class="text-center">
                       @if($notification->status == 1)
                            <a href="{{ route('notification_status',['id'=> $notification->id,'status'=> $notification->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('notification_status',['id'=> $notification->id,'status'=> $notification->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['notificationMasters.destroy', $notification->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                            @if($notification->send_status == 1)                           
                                <a href="{{ route('notificationMasters.edit', $notification->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default" style="pointer-events: none"><i class="fa fa-pencil"></i></a>
                            @else
                            <a href="{{ route('notificationMasters.edit', $notification->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                            @endif                                
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                                @if($notification->send_status == 1)
                                  <a href="{{ route('sendNotification',['id'=> $notification->id]) }}" data-toggle="tooltip" title="Notification" class="btn btn-xs btn-default" style="pointer-events: none"><i class="fa fa-bell"></i>Send Notification</a>
                                @else
                                <a href="{{ route('sendNotification',['id'=> $notification->id]) }}" data-toggle="tooltip" title="Notification" class="btn btn-xs btn-default"><i class="fa fa-bell"></i>Send Notification</a>
                                @endif
                            </div>
                            {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                                
              </tbody>
          </table>
      </div>
  </div>
  <!-- END Datatables Content -->
@endsection
@section('scripts')
    <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
        <script>$(function(){ RoleTablesDatatables.init(); });</script>
@endsection