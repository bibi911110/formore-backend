@extends('layouts.app')
@section('title','Social Link')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Social Link</strong> </h2> <span style="color: gray;"> (Maximum 8 can be added) </span>
           <h1 class="pull-right">
          <?php  $count_data = \App\Models\Social_icon::where('user_id',Auth::user()->id)->count();  if($count_data != 8){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('socialIcons.create') }}">Add New</a>
          <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Link</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $s_icon)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $s_icon->name }}</td>
                      <td class="text-center"><img src="<?php echo  url('/').'/'.$s_icon->social_icon; ?>" style="width: 6%"  ></td>
                      <td class="text-center">{{ $s_icon->link }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['socialIcons.destroy', $s_icon->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('socialIcons.edit', $s_icon->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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
        <script>$(function(){ TablesDatatables.init(); });</script>
@endsection

