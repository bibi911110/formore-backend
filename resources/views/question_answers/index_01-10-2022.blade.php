@extends('layouts.app')
@section('title','Export Answer')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">

               <h2><strong>Create New </strong> Export Answer</h2>
            </div>
                    {!! Form::open(['url' => 'exporQuestion']) !!}

                    <!-- Name Field -->
                    <!-- Start Date Field -->
                        <div class="form-group">
                            {!! Form::label('start_date', 'Select Date:') !!}
                            {!! Form::text('start_date', null, ['class' => 'form-control input-datepicker22','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
                           
                        </div>
    
                    <!-- User Id Field -->

                    <div class="form-group">
                     {!! Form::label('title_id', 'Title:') !!}
                    <select class="form-control" name="title_id">
                    <option value="">Select Title</option>
                   <?php $title = \App\Models\Question::select('title','id')->get();;
                          foreach ($title as $value) { ?>
                            <option value="{{$value->id}}"> {{ $value->title }}</option>                     
    
                          <?php }
                     ?>
                    </select>
                    </div>

                    <div class="form-group">
                     {!! Form::label('code_id', 'Code:') !!}
                    <select class="form-control" name="code_id">
                    <option value="">Select code</option>
                   <?php $code = \App\Models\Question::select('code','code')->get();
                          foreach ($code as $value) { ?>
                            <option value="{{$value->code}}"> {{ $value->code }}</option>                     
    
                          <?php }
                     ?>
                    </select>
                    </div>

                 <div class="form-group">
                     {!! Form::label('user_id', 'Users:') !!}
                    <select class="form-control" name="user_id">
                    <option value="">Select User</option>
                    <?php $users = \App\User::where('role_id','4')->select('name','id')->get();
                          foreach ($users as $value) { ?>
                            <option value="{{$value->id}}"> {{ $value->name }}</option>                     
    
                          <?php }
                     ?>
                    </select>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <!-- <a href="#" class="btn btn-primary">Export Excel</a> -->
                        <a href="{{ route('questions.index') }}" class="btn btn-default">Cancel</a>
                    </div>


                    {!! Form::close() !!}
                

        <div class="table-responsive">
            @if(!empty($questions))
            <a class="btn btn-primary" download ="{{$basename}}" href="{{$exce_download_url}}">Download</a>
            @endif
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Notes</th>
                      <th class="text-center">Code</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Questions</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>

                  </tr>
              </thead>
              <tbody>
                  <?php $i=1; if(!empty($questions)){ 
                    //echo $file_path_full; exit;
                  ?>
                  @foreach ($questions as $key => $question)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $question->title }}</td>
                     <!--  <td class="text-center">{{ $question->notes }}</td> -->
                      <td class="text-center"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$question->user_id}}">Notes</button>

                          <div id="myModal_{{$question->user_id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Notes</b></h4>
                                </div>
                                 <div class="modal-body">
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                         {{ $question->notes }}
                                      </div>
                                  </div>
                               
                              </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>

                      </td>
                      <td class="text-center">{{ $question->code }}</td>
                      <td class="text-center">{{ $question->q_date }}</td>
                    
                    </tr>
                  @endforeach
                  <?php } ?>              
                    </tbody>
                  </table>
              </div>
              </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
 <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
 <script>$(function(){ TablesDatatables.init(); });</script>
<script type="text/javascript">
    
$(document).ready(function(){

$(".input-datepicker22").datepicker({
    // todayBtn:  1,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerStart').datepicker('setStartDate', minDate);
    $('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});

$(".input-datepickerStart").datepicker()
    .on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('.input-datepicker22').datepicker('setEndDate', maxDate);
    });

});
</script>
@endpush


