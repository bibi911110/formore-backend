@extends('layouts.app')
@section('title','NFC Masters')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>NFC Masters</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('nfcMasters.create') }}">Add New</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">NFC CODE</th>
                      <th class="text-center">PREDEFINED URL</th>
                      <th class="text-center">LINKED URL</th>
                      <th class="text-center">Business Name</th>
                      <th class="text-center">Note</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $purchaseOption)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $purchaseOption->nfc_code }}</td>
                      <td class="text-center">www.formore.eu/nfc/{{ $purchaseOption->nfc_url }}</td>
                      <td class="text-center">{{ $purchaseOption->linked_url }}</td>
                      <td class="text-center">{{ $purchaseOption->bussName }}</td>
                      <td class="text-center">{{ $purchaseOption->notes }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['nfcMasters.destroy', $purchaseOption->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('nfcMasters.edit', $purchaseOption->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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




