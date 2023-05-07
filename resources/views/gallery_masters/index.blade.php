@extends('layouts.app')
@section('title','Gallery')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Gallery</strong> </h2><span style="color: gray;"> (Maximum 10 can be added) </span>
           <h1 class="pull-right">
                 <?php  $count_data = \App\Models\Gallery_master::where('user_id',Auth::user()->id)->count();  if($count_data != 10){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('galleryMasters.create') }}">Add New</a>
            <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $gallery)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center"><img src="<?php echo  url('/').'/'.$gallery->gallery_img; ?>" style="width: 6%"  ></td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['galleryMasters.destroy', $gallery->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('galleryMasters.edit', $gallery->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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





