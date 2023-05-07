@extends('layouts.app')
@section('title','List Questions')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Questions</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('questions.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
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
                  <?php $i=1; ?>
                  @foreach ($data as $key => $question)
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



