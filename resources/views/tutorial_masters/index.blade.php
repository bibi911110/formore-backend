@extends('layouts.app')
@section('title','Tutorial Masters')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Tutorial Masters</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('tutorialMasters.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Language</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Details</th>
                      <th class="text-center">Youtube Link</th>
                      <th class="text-center">Video</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $tutorial)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $tutorial->langName }}</td>
                      <td class="text-center">{{ $tutorial->title }}</td>
                      <td class="text-center">{{ $tutorial->details }}</td>
                      <td class="text-center">{{ $tutorial->youtube_url }}</td>
                      <td class="text-center"><a href="<?php echo  url('/').'/'.$tutorial->tutorial_video; ?>" target="_blank">Play Video</td>
                      
                      <td class="text-center">
                       @if($tutorial->status == 1)
                            <a href="{{ route('tutorial_status',['id'=> $tutorial->id,'status'=> $tutorial->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('tutorial_status',['id'=> $tutorial->id,'status'=> $tutorial->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['tutorialMasters.destroy', $tutorial->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('tutorialMasters.edit', $tutorial->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
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

