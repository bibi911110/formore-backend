@extends('layouts.app')
@section('title','Order List')
@section('content')

<div class="block full">
      <div class="block-title">
          <h2><strong>Orders List</strong> </h2>
           <!-- <h1 class="pull-right">
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('memberOrders.create') }}">Add New</a>
          </h1> -->
      </div>
        @include('flash::message')
      <div class="table-responsive">
        <div class="form-group col-md-6">
            {!! Form::label('end_date', 'Start Date:') !!}
            {!! Form::text('start_date', null, ['class' => 'form-control input-datepicker22 startDate','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    </div>
    <!-- End Date Field -->
    <div class="form-group col-md-6">
        {!! Form::label('end_date', 'End Date:') !!}
        {!! Form::text('end_date', null, ['class' => 'form-control input-datepickerStart endDate','id'=>'example-datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>'yyyy-mm-dd']) !!}
    </div>
        <button class="btn btn-primary" id="all" value="all">All</button>
        <button class="btn btn-primary" id="delivered" value="delivered">Delivered</button>
        <button class="btn btn-primary" id="canceled" value="Canceled">Canceled</button>
        <input type="hidden" name="status" id="status" value=''>

        <div id="order_data"></div>
      </div>
  </div>
  <!-- END Datatables Content -->
@endsection
@section('scripts')
    <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>
        <script>$(function(){ TablesDatatables.init(); });</script>

<script type="text/javascript">
  $(document).ready(function(){

      $(".input-datepicker22").datepicker({
          todayBtn:  1,
          autoclose: true,
      }).on('changeDate', function (selected) {
          var minDate = new Date(selected.date.valueOf());
          //$('.input-datepickerStart').datepicker('setStartDate', minDate);
          //$('.input-datepickerStart').datepicker('setDate', minDate); // <--THIS IS THE LINE ADDED
      });
      $(".input-datepickerStart").datepicker()
          .on('changeDate', function (selected) {
              //var maxDate = new Date(selected.date.valueOf());
              $('.input-datepicker22').datepicker();
          });
    });
  </script>
  <script type="text/javascript">

        var endDate = $(".endDate").val()
        datatable()
        function datatable(page = 1) {
            //const status_value = $("#status_value").val()
            $.ajax({
                type: "POST",
                url: "{{url('search_orders')}}",
                data: {
                    _token: '{{csrf_token()}}',
                    page: page,
                    status : $("#status").val(),
                    startDate: $(".startDate").val(),
                    endDate: $(".endDate").val(),
                    /*follower: $("#followeRange").val(),
                    price: $("#mileageRange").val(),*/
                    //sort_by: $("#sort_by").val(),
                },
                success: function (data) {
                    $("#order_data").html(data.data)
                }, error: function (error) {

                }
            })
        }

        $(".endDate").on('change', function () {
            datatable();
            //alert("ddd")
        })
         $('#all').on('click' , function(){
              $("#status").val('1');
              datatable();
         });
         $('#delivered').on('click' , function(){
              $("#status").val('2');
              datatable();
         });
         $('#canceled').on('click' , function(){
              $("#status").val('3');
              datatable();
         });
        
        $(document).on("click", '.page-link', function () {
            $(this).attr('href', '#')
            if ($(this).text() === 'Prev') {
                const current_page = $("#current_page").val()
                if (current_page != 1) {
                    const all_page = $("#all_page").val()
                    const page = current_page - 1
                    datatable(page)
                }
            } else if ($(this).text() === 'Next') {
                const current_page = $("#current_page").val()
                const all_page = $("#all_page").val()
                if (current_page != all_page) {
                    const page = parseFloat(current_page) + 1
                    datatable(page)
                }
            } else {
                const page = $(this).text()
                datatable(page)
            }
        })
    </script>
@endsection




