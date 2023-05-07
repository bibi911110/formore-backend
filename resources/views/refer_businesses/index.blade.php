@extends('layouts.app')
@section('title','Refer Businesses')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Refer Businesses</strong> </h2>
           <h1 class="pull-right">
                 <!-- <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('referBusinesses.create') }}">Add New</a> -->
                 <?php  $count_data = \App\Models\Refer_business::count();  if($count_data != 1){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('referBusinesses.create') }}">Add New</a>
          <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Icon</th>
                      <th class="text-center">Text</th>
                      <th class="text-center">Icon1</th>
                      <th class="text-center">Text1</th>
                      <th class="text-center">Icon2</th>
                      <th class="text-center">Text2</th>
                      <th class="text-center">Term Details</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $refer_business)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $refer_business->title }}</td>
                      <?php if($refer_business->refer_icon != ''){ ?>
                       <td class="text-center"><img src="<?php echo  url('/').'/'.$refer_business->refer_icon; ?>" style="width: 7%"  ></td>
                     <?php } else { ?>
                      <td class="text-center"> - </td>
                      <?php } ?>
                      <td class="text-center">{{ $refer_business->refer_text }}</td>


                       <?php if($refer_business->refer_icon1 != ''){ ?>
                       <td class="text-center"><img src="<?php echo  url('/').'/'.$refer_business->refer_icon1; ?>" style="width: 7%"  ></td>
                     <?php } else { ?>
                      <td class="text-center"> - </td>
                      <?php } ?>
                      <td class="text-center">{{ $refer_business->refer_text1 }}</td>

                       <?php if($refer_business->refer_icon2 != ''){ ?>
                       <td class="text-center"><img src="<?php echo  url('/').'/'.$refer_business->refer_icon2; ?>" style="width: 7%"  ></td>
                     <?php } else { ?>
                      <td class="text-center"> - </td>
                      <?php } ?>
                      <td class="text-center">{{ $refer_business->refer_text2 }}</td>


                      <td class="text-center">{{ $refer_business->term_details }}</td>
                      <td class="text-center">
                       @if($refer_business->status == 1)
                            <a href="{{ route('refer_business_status',['id'=> $refer_business->id,'status'=> $refer_business->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('refer_business_status',['id'=> $refer_business->id,'status'=> $refer_business->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['referBusinesses.destroy', $refer_business->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('referBusinesses.edit', $refer_business->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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