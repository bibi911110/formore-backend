@extends('layouts.app')
@section('title','Transaction Types')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Transaction Types</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('giftVocherTypes.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th>Transaction type</th>
                      <th>Status</th>
                     <!--  <th class="text-center">Actions</th> -->
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $buss_faq)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $buss_faq->name }}</td>
                      <td class="text-center">
                       @if($buss_faq->status == 1)
                            <a href="{{ route('gift_vocher_status',['id'=> $buss_faq->id,'status'=> $buss_faq->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('gift_vocher_status',['id'=> $buss_faq->id,'status'=> $buss_faq->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>
                      <!-- <td class="text-center">
                          {!! Form::open(['route' => ['giftVocherTypes.destroy', $buss_faq->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('giftVocherTypes.edit', $buss_faq->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                      </td> -->
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

