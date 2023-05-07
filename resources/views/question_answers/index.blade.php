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
                    <select class="form-control select-chosen" name="title_id" required>
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
                    <select class="form-control select-chosen" name="code_id" required>
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
                    <select class="form-control select-chosen" name="user_id" required>
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
                      <th class="text-center">Name</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Notes</th>
                      <th class="text-center">Code</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Questions</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i=1; 
                    if(!empty($questions)){ 
                  ?>
                  @foreach ($questions as $key => $question)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $question->userName }}</td>
                      <td class="text-center">{{ $question->title }}</td>
                      <td class="text-center">{{ $question->notes }}</td>
                      <td class="text-center">{{ $question->code }}</td>
                      <td class="text-center">{{ $question->q_date }}</td>
                      <td class="text-center"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$question->id}}">Question Details</button>

                          <div id="myModal_{{$question->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>Question Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                  <?php 
                                    $questionsDetails = \App\Models\QuestionDetails::where('question_id',$question->id)->where('user_id',$question->user_id)->whereNull('deleted_at')->get();
                                  $j =1;
                                  foreach ($questionsDetails as $value) {
                                  ?>

                                  <div class="row">
                                    <div class="col-md-4">
                                         <b>Q - </b>{{$j++}}
                                      </div>
                                    <div class="col-md-4">
                                         <b>Question - </b>{{$value->name}}
                                      </div>
                                      <div class="col-md-4">
                                        <b>Answer Type - </b>{{$value->ans_type}}
                                      </div>
                                  </div>
                                <?php } ?>
                              </div>
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>

                      </td>
                      <td class="text-center">
                       @if($question->status == 1)
                            <a href="{{ route('question_status',['id'=> $question->id,'status'=> $question->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('question_status',['id'=> $question->id,'status'=> $question->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <!-- <a href="{{ route('questions.edit', $question->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> -->
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
 
<script type="text/javascript">
    
$(document).ready(function(){

/*$(".input-datepicker22").datepicker({
    todayBtn:  1,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.input-datepickerStart').datepicker('setStartDate', minDate);
    $('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
});*/
$(".input-datepicker22").datepicker({
    todayBtn:  "linked",
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
<script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
 <script>$(function(){ TablesDatatables.init(); });</script>
@endpush


