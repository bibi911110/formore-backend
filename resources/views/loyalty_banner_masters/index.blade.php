@extends('layouts.app')
@section('title','Loyalty Banner')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Loyalty Banner</strong> </h2> (Maximum 1 can be added) 
          <?php  $count_data = \App\Models\Loyalty_banner_master::where('user_id',Auth::user()->id)->count();  if($count_data != 1){ ?>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('loyaltyBannerMasters.create') }}">Add New</a>
          </h1>
      <?php } ?>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th>Terms of loyalty</th>
                      <th>schema</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $purchaseOption)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $purchaseOption->terms_of_loyalty }}</td>
                      <td class="text-center">{{ $purchaseOption->schema }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['loyaltyBannerMasters.destroy', $purchaseOption->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('loyaltyBannerMasters.edit', $purchaseOption->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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





