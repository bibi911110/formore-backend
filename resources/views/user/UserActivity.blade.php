@extends('layouts.app')
@section('title','Login Activity')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Login Activity</h1>
    </section>
    <div class="content" style="margin-top: 20px !important;">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>IP Address</th>
                        <th>Last Login Date</th>
                        <th>Last Login Time</th>
                        <th width="250px">Action</th>
                    </thead>
                  
                    <tbody>
                        @foreach($user_session_data as $data)
                            <?php 
                                $user_data = \Location::get($data->ip_address);
                            ?>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->ip_address }}</td>
                                <td>
                                    <?php echo date('Y-m-d',$data->last_activity) ?>
                                </td>
                                <td>
                                    <?php echo date('h:i:s',$data->last_activity) ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$data->id}}">
                                        More Info.
                                    </button>
                                    <a href="{{ route('delete_one_data',$data->id) }}" class="btn btn-warning">Delete Session</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="myModal{{$data->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">More Information</h4>
                                            <button type="button"  style="margin-top: -24px;" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="modal-body">
                                            <span class="pull-left"><b>Country Code </b></span>
                                            <span class="pull-right"><?php echo $user_data->countryCode; ?></span>
                                            <br />
                                            
                                            <span class="pull-left"><b>Country Name </b></span>
                                            <span class="pull-right"><?php echo $user_data->countryName; ?></span>
                                            <br />
                                            
                                            <span class="pull-left"><b>State Name </b></span>
                                            <span class="pull-right"><?php echo $user_data->regionName; ?></span>
                                            <br />
                                            
                                            <span class="pull-left"><b>City Name </b></span>
                                            <span class="pull-right"><?php echo $user_data->cityName; ?></span>
                                            <br />
                                            
                                            <span class="pull-left"><b>Zip Code </b></span>
                                            <span class="pull-right"><?php echo $user_data->zipCode; ?></span>
                                            <br />
                                            
                                            <span class="pull-left"><b>Latitude </b></span>
                                            <span class="pull-right"><?php echo $user_data->latitude; ?></span>
                                            <br />
                                            
                                            <span class="pull-left"><b>Longitude </b></span>
                                            <span class="pull-right"><?php echo $user_data->longitude; ?></span>
                                            <br />
                                        </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>
                
                    <tfoot>
                        <th>No</th>
                        <th>IP Address</th>
                        <th>Last Login Date</th>
                        <th>Last Login Time</th>
                        <th width="250px">Action</th>
                    </tfoot>
              </table>
        
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('delete_all_data',Auth::user()->id) }}" class="btn btn-success">Delete All Sesssion</a>
        </div>
    </div>
    
@endsection