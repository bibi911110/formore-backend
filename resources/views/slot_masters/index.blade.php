@extends('layouts.app')
@section('title','Slot Masters')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Slot Masters</strong> </h2>
          <?php  $count_data = \App\Models\Slot_master::where('created_by',Auth::user()->id)->count();  if($count_data != 1){ ?>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('slotMasters.create') }}">Add New</a>
          </h1>
          <?php } ?>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Start Time</th>
                      <th class="text-center">End Time</th>
                      <th class="text-center">Pepole per slot</th>
                      <th class="text-center">Price per slot</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $language)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $language->start_time }}</td>
                      <td class="text-center">{{ $language->end_time }}</td>
                      <td class="text-center">{{ $language->pepole_per_slot }}</td>
                      <td class="text-center">{{ $language->price_per_slot }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['slotMasters.destroy', $language->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('slotMasters.edit', $language->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                            
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


