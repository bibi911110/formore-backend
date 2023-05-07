@extends('layouts.app')
@section('title','Appointments')
@section('content')
<style type="text/css">
  .fc-today-button{
    display: none !important;
  }
</style>
 <div class="block full">
      <div class="block-title">
          <h2><strong>Appointments</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('brands.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
        <!-- <button class="btn btn-primary">Today</button> -->
        <a href="{{url('appointments_new')}}" class="btn btn-primary">New</a>
        <a href="{{url('appointments_view')}}" class="btn btn-primary">Today</a>
        <a href="{{url('appointments_weekly_view')}}" class="btn btn-primary">Weekly</a>
        <a href="{{url('appointments_monthly_view')}}" class="btn btn-primary">Monthly</a>
        <div class="col-md-12">
          <!-- FullCalendar (initialized in js/pages/compCalendar.js), for more info and examples you can check out http://arshaw.com/fullcalendar/ -->
          <div id="calendar_id"></div>
      </div>
        <!--  <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Slot</th>
                      <th class="text-center">Total Booking</th>
                      <th class="text-center">Booked Status</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($book_slot as $key => $slot)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $slot->slot_time}}</td>
                      <td class="text-center">{{ $slot->total_booking}}</td>
                      @if($slot->limit_per_slot == $slot->total_booking)
                        <td class="text-center"><a href="{{'/book_appointment'}}"><?php echo "BOOKED"; ?></a></td>
                      @else
                        <td class="text-center"><a href="{{ url('book_appointment',['id'=> $slot->id]) }}"><?php echo "AVAILABLE"; ?></a></td>
                      @endif
                      
                    </tr>
                  @endforeach
                                
              </tbody>
          </table> -->
      </div>
  </div>
  <!-- END Datatables Content -->
@endsection
@section('scripts')
    <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
    <!-- <script src="{{url('public/new/js/pages/compCalendar.js')}}"></script> -->
        <!-- <script>$(function(){ CompCalendar.init(); });</script> -->
        <script>$(function(){ TablesDatatables.init(); });</script>
<script type="text/javascript">
$(document).ready(function () {

/*$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});*/
var calendar = $('#calendar_id').fullCalendar({
                    editable: true,
                    today:    false,
                    events: APP_URL + "/get_monthly_apointments",
                    type:"GET",
                    displayEventTime: false,
                    editable: true,
                    //defaultView: 'agendaWeek',
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                  select: function (start, end, allDay) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        //alert(start);
                        window.location.href = APP_URL+"/appointment_by_date/"+start;  
                    },
                    eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Event Updated Successfully");
                            }
                        });
                    },
                    eventClick: function (event) {
                      //alert(event.id);
                      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                      window.location.href = APP_URL+"/appointment_by_date/"+start;
                      //alert(start);
                        /*var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                        id: event.id,
                                        type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Event Deleted Successfully");
                                }
                            });
                        }*/
                    }
                }); 

});
</script>
@endsection


