@extends('layouts.app')
@section('title','Voucher Upload Receipts')
@section('content')
<!-- Datatables Content -->
  <div class="block full">
      <div class="block-title">
          <h2><strong>Voucher Upload Receipts</strong> </h2>
           <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ url('export_upload_receipt') }}">Excel Download</a>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">
            <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Business</th>
                      <th class="text-center">User</th>
                      <th class="text-center">voucher Code</th>
                      <th class="text-center">Vat Number</th>
                      <th class="text-center">Date Of Purchase</th>
                      <th class="text-center">Time</th>
                      <th class="text-center">Upload Receipt</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Comment</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i =1;?>
                  @foreach ($data as $key => $receipt)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $receipt->bussName }}</td>
                      <td class="text-center">{{ $receipt->uname }}</td>
                      <td class="text-center">{{ $receipt->voucherCode }}</td>
                      <td class="text-center">{{ $receipt->vat_number }}</td>
                      <td class="text-center">{{date('d-m-Y',strtotime($receipt->date_of_purchase))}}</td>
                      <td class="text-center">{{ $receipt->time }}</td>

                      <?php if($receipt->upload_receipt != ''){ ?>
                       <td class="text-center"><a href="<?php echo  url('/').'/'.$receipt->upload_receipt; ?>" target="_blank">View Receipt</a></td>
                     <?php } else { ?>
                      <td class="text-center"> - </td>
                      <?php } ?>
                      <td class="text-center">{{ $receipt->status }}</td>
                      <td class="text-center">{{ $receipt->comment }}</td>
                      <td class="text-center">
                      <a href="{{ route('voucherUploadReceipts.edit', $receipt->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                          {!! Form::open(['route' => ['voucherUploadReceipts.destroy', $receipt->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>                     
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



