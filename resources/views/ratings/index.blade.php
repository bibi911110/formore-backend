@extends('layouts.app')
@section('title','Business Ratings')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          @include('flash::message')
          <h2><strong>Business Rating</strong> </h2>
          <?php if(Auth::user()->role_id != 3){ ?>

            <div class="row">
              {!! Form::open(['url' => 'ratings_filter']) !!}
              <div class="col-md-4" style="margin-left: 2%;">
                <div class="form-group">
                  {!! Form::label('buss_id', 'Business :') !!}
                  <select class="form-control" name="buss_id">
                 <?php //echo "<pre>"; print_r($buss); exit; ?>
                  <option value="">Select Business</option>
                   <option value="all">All</option>
                 <?php foreach ($buss as $value) { ?>
                    <option value="{{ $value['id']}}">{{$value['name']}}</option>
                 <?php } ?>
                 </select>
              </div>
            </div>
            <div class="form-group" style="">
              {!! Form::submit('Filter', ['class' => 'btn btn-primary','style' => "margin-top: 2%;"]) !!}
              <a href="{{ route('ratings.index') }}" class="btn btn-default" style="margin-top: 2%;">Cancel</a>
            </div>
            {!! Form::close() !!}
            <div class="col-md-4 pull-right" style="">
               <h1 class="pull-right">
                     <a class="btn btn-primary " style="" href="{{ route('ratings.create') }}">Add New</a>
                     @if(isset($bus_id))
                     <a href="{{ url('ratings_export',['id'=> $bus_id])}}" class="btn btn-primary float-right" style="margin-right: 7px;"> Export Excel</a>
                     @else
                      <a href="{{ url('ratings_export')}}" class="btn btn-primary float-right" style="margin-right: 7px;"> Export Excel</a>
                     @endif
              </h1>
            </div>
          </div>
           <?php } elseif (Auth::user()->role_id == 3) { ?>
                   <div class="row" style="margin-right: 1%;">
                    <h1 class="pull-right">
                       <a class="btn btn-primary " style="margin-top: -69%;" href="{{ url('ratings_export') }}">Export Excel</a>
                    </h1>
                  </div>
         
           <?php } ?>
      </div>
        
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th>User ID</th>
                      <th>User name</th>
                      <th>Business name</th>
                      <th>Business rating</th>
                      <?php if(Auth::user()->role_id != 3){ ?>
                      <th>Comment</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                      <?php } ?>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $rating)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center"><?php if(isset($rating->unique_no)){ echo $rating->unique_no;} else { echo '-';} ?></td>
                      <td class="text-center"><?php if(isset($rating->userName)){ echo $rating->userName;} else { echo '-';} ?></td>
                      <td class="text-center"><?php $business_name = \App\User::where('role_id',3)->where('id',$rating->buss_id)->first();
                        
                       ?><?php if(isset($business_name->name)){ echo $business_name->name;} else { echo '-';} ?></td>
                      <td class="text-center">{{ $rating->rating_no }}</td>
                     <?php if(Auth::user()->role_id != 3){ ?>
                      <td class="text-center">{{ $rating->comment }}</td>
                      <td class="text-center">
                       @if($rating->status == 1)
                            <a href="{{ route('rating_status',['id'=> $rating->id,'status'=> $rating->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('rating_status',['id'=> $rating->id,'status'=> $rating->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <?php } ?>
                      <?php if(Auth::user()->role_id != 3){ ?>
                      <td class="text-center">
                          {!! Form::open(['route' => ['ratings.destroy', $rating->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                               <!--  <a href="{{ route('ratings.edit', $rating->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> -->
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                      </td>
                    <?php } else { ?>
                      <td class="text-center"> - </td>
                    <?php } ?>
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



