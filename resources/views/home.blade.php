@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<style type="text/css">
.highcharts-exporting-group
{
    display: none !important;
}

.highcharts-credits{

    display: none !important;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


</style>

<!-- Dashboard Header -->
<!-- For an image header add the class 'content-header-media' and an image as in the following example -->
<!-- <div class="content-header content-header-media">
    <div class="header-section">
        <div class="row">
            Main Title (hidden on small devices for the statistics to fit)
            <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                <h1>Welcome <strong>Admin</strong><br><small>You Look Awesome!</small></h1>
            </div> -->
            <!-- END Main Title -->

            <!-- Top Stats -->
           <!--  <div class="col-md-8 col-lg-6">
                <div class="row text-center">
                    <div class="col-xs-4 col-sm-3">
                        <h2 class="animation-hatch">
                            $<strong>93.7k</strong><br>
                            <small><i class="fa fa-thumbs-o-up"></i> Great</small>
                        </h2>
                    </div>
                    <div class="col-xs-4 col-sm-3">
                        <h2 class="animation-hatch">
                            <strong>167k</strong><br>
                            <small><i class="fa fa-heart-o"></i> Likes</small>
                        </h2>
                    </div>
                    <div class="col-xs-4 col-sm-3">
                        <h2 class="animation-hatch">
                            <strong>101</strong><br>
                            <small><i class="fa fa-calendar-o"></i> Events</small>
                        </h2>
                    </div>-->
                    <!-- We hide the last stat to fit the other 3 on small devices -->
                   <!-- <div class="col-sm-3 hidden-xs">
                        <h2 class="animation-hatch">
                            <strong>27&deg; C</strong><br>
                            <small><i class="fa fa-map-marker"></i> Sydney</small>
                        </h2>
                    </div>
                </div>
            </div> -->
            <!-- END Top Stats -->
        <!-- </div>
    </div> -->


    <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
  <!--   <img src="{{url('public/new/img/placeholders/headers/dashboard_header.jpg') }}" alt="header image" class="animation-pulseSlow"> -->
<!-- </div> -->

                        @if(Auth::user()->role_id == 1)
                        <h3>Users Dashboard Data</h3>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <!-- Widget -->
                                <a href="{{ url('show_data') }}" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Total <strong>Members</strong><br>
                                            <small>{{ $member_count}}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <!-- Widget -->
                                <a href="{{ url('show_data') }}" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Last Week <strong>Members</strong><br>
                                            <small>{{ $lastWeekUsersCount }}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <!-- Widget -->
                                <a href="{{ url('show_data') }}" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Current Month <strong>Members</strong>
                                            <small>{{ $lastMonthUsersCount  }}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                        </div>
                    </div>

                <div class="row">
                    <div class="col-lg-12" style="">
                                <!-- Latest Orders Block -->
                                <div class="block">
                                    <!-- Latest Orders Title -->
                                    <div class="block-title">
                                       <!--  <div class="block-options pull-right">
                                            <a href="page_ecom_orders.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Settings"><i class="fa fa-cog"></i></a>
                                        </div> -->
                                        <h2><strong>Members per country</strong></h2>
                                    </div>
                                    <!-- END Latest Orders Title -->

                                    <!-- Latest Orders Content -->
                                    <table class="table table-borderless table-striped table-vcenter table-bordered">
                                        <tbody>
                                            <thead>
                                              <tr>
                                                  <th class="">Country</th>
                                                  <th class="" style="width: 16%;">Total Members</th>
                                                  <th class="" style="width: 16%;">Today Members</th>
                                                  <th class="" style="width: 16%;">Current Month</th>
                                              </tr>
                                          </thead>
                                            <?php foreach ($countryFinal as $value) { ?>
                                            <tr>
                                                <td class="hidden-xs"><img src="<?php echo  url('/').'/'.$value['country_icon']; ?>" style="width: 6%"> {{$value['country_name']}}</td>
                                                <td class="hidden-xs">
                                                   <?php echo $value['member_count']; ?>                                               

                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $value['today']; ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php echo $value['currentMonth']; ?>
                                                </td>
                                                
                                            </tr>
                                            
                                          <?php  } ?>
                                        </tbody>
                                    </table>
                                    <!-- END Latest Orders Content -->
                                </div>
                                <!-- END Latest Orders Block -->
                            </div>
                            </div>
                 <div class="row">
                            <div class="col-md-6">
                             
                               
                                <figure class="highcharts-figure">
                                <div id="container"></div>
                                <!-- <p class="highcharts-description">
                                    This chart shows how data labels can be added to the data series. This
                                    can increase readability and comprehension for small datasets.
                                </p> -->
                            </figure>
                            </div>
                <div class="col-md-6">
                   
                        <figure class="highcharts-figure">
                            <div id="container1"></div>
                            <!-- <p class="highcharts-description">
                                Chart showing browser market shares. Clicking on individual columns
                                brings up more detailed data. This chart makes use of the drilldown
                                feature in Highcharts to easily switch between datasets.
                            </p> -->
                        </figure>
                    </div>
                </div>
                 <h3>Businesses & Brands Dashboard</h3>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <!-- Widget -->
                                <a href="{{ url('brands') }}" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Total <strong>Business</strong><br>
                                            <small>{{ $business_count}}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <!-- Widget -->
                                <a href="{{ url('brands') }}" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            Total <strong>Brand</strong><br>
                                            <small>{{ $brand_count }}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <!-- Widget -->
                                <a href="{{ url('brands') }}" class="widget widget-hover-effect1">
                                    <div class="widget-simple">
                                        <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h3 class="widget-content text-right animation-pullDown">
                                            <strong>Total</strong>
                                            <small>{{ $total_count  }}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                                <!-- Latest Orders Block -->
                                <div class="block">
                                    <!-- Latest Orders Title -->
                                    <div class="block-title">
                                       <!--  <div class="block-options pull-right">
                                            <a href="page_ecom_orders.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Settings"><i class="fa fa-cog"></i></a>
                                        </div> -->
                                        <h2><strong>Country</strong> Businesses</h2>
                                    </div>
                                    <!-- END Latest Orders Title -->

                                    <!-- Latest Orders Content -->
                                    <table class="table table-borderless table-striped table-vcenter table-bordered">
                                        <tbody>
                                            <thead>
                                              <tr>
                                                  <th style="width: 16%;">Country</th>
                                                  <th style="width: 16%;">Total Businesses</th>
                                                  <!-- <th style="width: 16%;">Total members</th> -->
                                                  <th style="width: 16%;">Today Businesses</th>
                                                  <!-- <th style="width: 16%;">Brand per country</th> -->
                                                 <!--  <th style="width: 16%;">Total Brands per country</th> -->
                                                  <!-- <th style="width: 16%;">Total members</th>
                                                  <th style="width: 16%;">Today members</th> -->

                                                  <th style="width: 16%;">Current Month</th>
                                                  <!-- <th style="width: 16%;">Total members</th> -->
                                                  <!-- <th style="width: 16%;">Today members</th> -->
                                              </tr>
                                          </thead>
                                            <?php 
                                            $business_total = 0;
                                            $today_total = 0;
                                            $month_total = 0;
                                            foreach ($country as $value) {

                                                $business_all = \App\Models\Brand::where('type','1')->where('country_id',$value->id)->count();
                                                if($business_all != 0){
                                             ?>
                                            <tr>
                                                <td class="hidden-xs"><img src="<?php echo  url('/').'/'.$value->country_icon; ?>" style="width: 6%"> {{$value->country_name}}</td>
                                                <td><?php $business_all = \App\Models\Brand::where('type','1')->where('country_id',$value->id)->count();
                                                        echo $business_all;

                                                        $business_total += $business_all;
                                                     ?> 
                                                </td>
                                                <!-- <td class="hidden-xs">
                                                    <?php $all = \App\User::where('residence_country_id',$value->id)->count();
                                                        echo $all;
                                                     ?>
                                                </td> -->

                                                <td class="hidden-xs">
                                                    <?php $today = \App\User::where('residence_country_id',$value->id)->whereDate('created_at', '>=', \Carbon\Carbon::now())->count();
                                                        echo $today;
                                                        $today_total += $today;
                                                     ?>                                                 
                                                </td>
                                                <!-- <td class="hidden-xs"><img src="<?php echo  url('/').'/'.$value->country_icon; ?>" style="width: 6%"> {{$value->country_name}}</td> -->
                                                <!-- <td class="hidden-xs">
                                                    <?php $all = \App\User::where('residence_country_id',$value->id)->count();
                                                        echo $all;
                                                     ?>                                                 

                                                </td> -->
                                                <td class="hidden-xs">
                                                    <?php //$today = \App\Models\Brand::where('type','2')->where('country_id',$value->id)->whereDate('created_at', '>=', \Carbon\Carbon::now())->count();
                                                       /* $today = \App\Models\Brand::where('type','2')->where('country_id',$value->id)->count();
                                                        echo $today;*/

                                                        $currentMonth = \App\Models\Brand::where('type',2)->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
                                                        echo $currentMonth;
                                                        $month_total += $currentMonth;
                                                     ?>                                                 

                                                </td>
                                                <!-- <td class="hidden-xs">
                                                    <?php //$today = \App\Models\Brand::where('type','2')->where('country_id',$value->id)->whereDate('created_at', '>=', \Carbon\Carbon::now())->count();
                                                        $totalBranBuss = \App\Models\Brand::where('country_id',$value->id)->count();
                                                        echo $totalBranBuss;

                                                     ?>                                                 

                                                </td> -->
                                                <!-- <td class="hidden-xs"><img src="<?php echo  url('/').'/'.$value->country_icon; ?>" style="width: 6%"> {{$value->country_name}}</td> -->
                                                <!-- <td class="hidden-xs">
                                                    <?php $all = \App\Models\Brand::where('country_id',$value->id)->count();
                                                        echo $all;
                                                     ?>                                                 

                                                </td> -->
                                                <!-- <td class="hidden-xs">
                                                    <?php $today = \App\Models\Brand::where('country_id',$value->id)->whereDate('created_at', '>=', \Carbon\Carbon::now())->count();
                                                        echo $today;

                                                     ?>                                                 

                                                </td> -->
                                            </tr>
                                            
                                          <?php  } } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                          <td><b>Total</b></td>
                                          <td>{{$business_total}}</td>
                                          <td>{{$today}}</td>
                                          <td>{{$month_total}}</td>
                                          
                                        </tr>
                                    </tfoot>
                                    </table>
                                    <!-- END Latest Orders Content -->
                                </div>
                                <!-- END Latest Orders Block -->
                            </div>
                </div>
               
<!-- END Dashboard Header -->
@endif
<!-- Busss login-->
@if(Auth::user()->role_id == 3 || Auth::user()->role_id == 5)
                        <h3>Business Dashboard Data</h3>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="#" class="widget widget-hover-effect1" style="background-color: #ff751a !important;">
                                    <div class="widget-simple">
                                        <!-- <div  class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div> -->
                                        <h3 style="font-size:12px !important; color: white !important;" class="widget-content text-right animation-pullDown">
                                            Total <strong>Members</strong><br>
                                            <small style="color: white !important;">{{$buss_user}}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="#" class="widget widget-hover-effect1" style="background-color: #27ae60 !important;">
                                    <div class="widget-simple">
                                        <!-- <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div> -->
                                        <h3 style="font-size:12px !important; color: white !important;" class="widget-content text-right animation-pullDown">
                                           Total <strong>No. Of Users</strong><br>
                                            <small style="color: white !important;">{{$number_user}} (Rewards)</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="#" class="widget widget-hover-effect1" style="background-color: #cc66ff !important;">
                                    <div class="widget-simple">
                                        <!-- <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div> -->
                                        <h3 style="font-size:12px !important; color: white !important;" class="widget-content text-right animation-pullDown">
                                            Total <strong>Orders</strong>
                                            <small style="color: white !important;">{{$total_order}}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                        </div>
                         <div class="col-sm-6 col-lg-3">
                                <!-- Widget -->
                                <a href="#" class="widget widget-hover-effect1" style="background-color: #e74c3c !important;">
                                    <div class="widget-simple">
                                        <!-- <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                            <i class="fa fa-users"></i>
                                        </div>
 -->                                        <h3 style="font-size:12px !important; color: white !important;" class="widget-content text-right animation-pullDown">
                                            Total <strong>Appointments </strong>
                                            <small style="color: white !important;">{{$total_app}}</small>
                                        </h3>
                                    </div>
                                </a>
                                <!-- END Widget -->
                        </div>
                    </div>
@endif
@endsection
@section('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">

      // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
$(document).ready(function() {
$.ajax({
type:"GET",
url:"{{url('get_days_count_list')}}",
success:function(res){
    //alert(res)

Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Members daily chart'
    },
   /* subtitle: {
        text: 'Source: ' +
            '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
            'target="_blank">Wikipedia.com</a>'
    },*/
    xAxis: {
        categories: ['Mon', 'Tue', 'Wed', 'Th', 'Fri', 'Sat','Sun']
    },
    yAxis: {
        title: {
            text: 'Total'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [/*{
        name: 'Reggane',
        data: [16.0, 18.2, 23.1, 27.9, 32.2, 36.4, 39.8, 38.4, 35.5, 29.2,
            22.0, 17.8]
    },*/ {
        name: 'Days',
        data: res
    }]
});


}
});

});

</script>

<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar
$(document).ready(function() {
$.ajax({
type:"GET",
url:"{{url('get_month_count_list')}}",
success:function(res){
    //alert(res)
var myArray = [];
$.each(res,function(key,value){
    myArray.push({name: value.name,y: value.y});
   });
//alert(myArray)
// Create the chart
Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Members Monthly chart'
    },
    /*subtitle: {
        align: 'left',
        text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },*/
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                // format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [
        {
            name: "Month",
            colorByPoint: true,
            data: myArray


           /* data: [
                {
                    name: "Jan",
                    y: 63.06,
                    //drilldown: "Jan"
                },
                {
                    name: "Feb",
                    y: 19.84,
                    drilldown: "Feb"
                },
                {
                    name: "Mar",
                    y: 4.18,
                    drilldown: "Mar"
                },
                {
                    name: "Apr",
                    y: 4.12,
                    drilldown: "Apr"
                },
                {
                    name: "May",
                    y: 2.33,
                    drilldown: "May"
                },
                {
                    name: "Jun",
                    y: 0.45,
                    drilldown: "Jun"
                },
                {
                    name: "Jul",
                    y: 1.582,
                    drilldown: "Jul"
                },
                {
                    name: "Aug",
                    y: 1.582,
                    drilldown: "Aug"
                },
                {
                    name: "Sep",
                    y: 1.582,
                    drilldown: "Sep"
                },
                {
                    name: "Oct",
                    y: 1.582,
                    drilldown: "Oct"
                },
                {
                    name: "Nov",
                    y: 1.582,
                    drilldown: "Nov"
                },
                {
                    name: "Dec",
                    y: 1.582,
                    drilldown: "Dec"
                }
            ]*/
        }
    ]
});

}
});

});
</script>
@endsection
