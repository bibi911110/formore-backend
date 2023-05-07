@extends('layouts.app')
@section('title','Other Program Masters')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Other Program Masters</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('otherProgramMasters.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th>Name</th>
                      <th>Sur Name</th>
                      <th>Business name</th>
                      <th>Type Code</th>
                      <th>Upload Photo</th>
                      <th>Upload Photo1</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $other)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $other->name }}</td>
                      <td class="text-center">{{ $other->surname }}</td>
                      <td class="text-center">{{ $other->bussName }}</td>
                      <td class="text-center">{{ $other->type_code }}</td>
                      
                      <td class="text-center"><img data-enlargable src="<?php echo  url('/').'/'.$other->upload_photo; ?>" style="width: 6%"  ></td> 
                      <td class="text-center"><img data-enlargable src="<?php echo  url('/').'/'.$other->upload_photo_1; ?>" style="width: 8%"  ></td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['otherProgramMasters.destroy', $other->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('otherProgramMasters.edit', $other->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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
        <script type="text/javascript">
      $('img[data-enlargable]').addClass('img-enlargable').click(function(){
    var src = $(this).attr('src');
    $('<div>').css({
        background: 'RGBA(0,0,0,.5) url('+src+') no-repeat center',
        backgroundSize: 'contain',
        width:'100%', height:'100%',
        position:'fixed',
        zIndex:'10000',
        top:'0', left:'0',
        cursor: 'zoom-out'
    }).click(function(){
        $(this).remove();
    }).appendTo('body');
});
  </script>
@endsection





