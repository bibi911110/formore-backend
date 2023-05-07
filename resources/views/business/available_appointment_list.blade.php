@extends('layouts.app')
@section('title','Appointments')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Appointments</strong> </h2>
          
      </div>
        @include('flash::message')
      <div class="table-responsive">
        
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Slot</th>
                      <th class="text-center">Add</th>
                      <th class="text-center">Edit</th>
                     
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($book_slot as $key => $slot)
                    <?php $appointmentCount = \App\Models\Booking_add_cart_time_order::where('slot_id',$slot->id)->whereDate('date', \Carbon\Carbon::today())->count();  ?>
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $slot->slot_time}}</td>
                      <td class="text-center"><a class="btn btn-primary" href="{{ url('book_appointment',['id'=> $slot->slot_id]) }}">Add New</a></td>
                      <?php $user_id = \App\Models\Booked_services::where('id',$slot->booking_id)->select('member_id')->first(); ?>
                      <td class="text-center"><a href="{{url('/booked_appointment').'/'.$slot->booking_id.'/'.@$user_id->member_id.'/'.$slot->slot_id}}">Edit</a></td>
                            
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


