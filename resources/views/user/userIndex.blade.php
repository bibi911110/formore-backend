@extends('layouts.app')

@section('title','User')

@section('content')

   <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Users</strong> </h2>
          <?php if(Auth::user()->role_id == '3') { ?>
           <h1 class="pull-right">

                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('users.create') }}">Add New</a>

          </h1>
        <?php } ?>

      </div>

        @include('flash::message')


      <div class="table-responsive">

         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">

              <thead>

                  <tr>

                      <th class="text-center">No</th>

                     <th class="text-center">Name</th>

                      <th class="text-center">Email</th>

                     <!--  <th>Roles</th> -->
                      <th class="text-center">Status</th>
                      
                      <th class="text-center">View</th>
              

                      <th class="text-center">Actions</th>

                  </tr>

              </thead>

              <tbody>


                  <?php $i=1; ?>
                  @foreach ($data as $key => $user)

                    <tr>

                      <td class="text-center">{{$i++ }}</td>

                      <td class="text-center">{{ $user->name }}</td>

                      <td class="text-center">{{ $user->email }}</td>

                      <!-- <td class="text-center">

                        @if(!empty($user->getRoleNames()))

                          @foreach($user->getRoleNames() as $v)

                              <label class="label label-success">{{ $v }}</label>
                         
                          @endforeach

                        @endif

                      </td> -->
                      <td class="text-center">
                        @if($user->status == 1)
                            <a href="{{ route('user_status',['id'=> $user->id,'status'=> $user->status]) }}"><span class="label label-success">Active</span></a>
                        @else
                            <a href="{{ route('user_status',['id'=> $user->id,'status'=> $user->status]) }}"><span class="label label-danger">Deactive</span></a>
                        @endif
                      </td>

                     <!--  <td class="text-center">

                          @if($user->id != 1)

                            <a data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil"></i></a>



                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

                                <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>



                            {!! Form::close() !!}

                          @endif

                      </td> -->
                    
        
                      <td class="text-center">
                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{$i}}">User Details</button>

                          <!-- Modal -->
                          <div id="myModal_{{$i}}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: black;color: white;">
                                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                  <h4 class="modal-title"><b>User Details</b></h4>
                                </div>
                                 <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <h4>Personal Data</h4>
                                          <div> <b>User ID - </b>{{$user->unique_no}}</div><hr>
                                          <div> <b>Name/Surname - </b>{{$user->name}}</div><hr>
                                          <div> <b>Date Of Birth - </b>{{date('d-m-Y',strtotime($user->birth_date))}}</div><hr>
                                          <div> <b>Residence Country - </b><?php $country = \App\Models\Country::where('id',$user->residence_country_id)->select('country_name','country_code')->first(); 
                                                if(!empty($country))
                                                {
                                                  echo $country['country_code'] .' '. $country['country_name']; 
                                                }
                                                else
                                                {
                                                  echo "NA";
                                                }

                                                ?></div><hr>
                                        <div> <b>City - </b>{{$user->city}}</div><hr>
                                        <div> <b>Mobile Number - </b>{{$user->mobile_no}}</div><hr>
                                        <div> <b>Email - </b>{{$user->email}}</div><hr>
                                        <div> <b>Sex - </b><?php if($user->sex == '1'){ echo "Male";}elseif($user->sex == '2'){ echo "Female";} else{
                                          echo "Other";
                                        }  ?>
                                        </div><hr>
                                        <div>
                                           <b>Marital Status - </b><?php if($user->marital_status == '1'){ echo "Married ";}else{ echo "Unmarried ";}  ?>
                                        </div><hr>
                                        <div>
                                           <b>Kids - </b><?php if($user->no_kids != ''){ 
                                                echo $user->no_kids;}else{
                                                echo "No Data";
                                        }  ?>
                                        </div><hr>
                                      </div>
                                    
                                     <div class="col-md-4">
                                        <h4>Interests</h4>
                                        <div><b>Entartainment - </b><?php if($user->entartainment == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Sports - </b><?php if($user->sports == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Technolocgy - </b><?php if($user->technolocgy == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Music - </b><?php if($user->music == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Travelings - </b><?php if($user->travelings == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Electronic Games - </b><?php if($user->electronic_games == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Food - </b><?php if($user->food == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>
                                        <div><b>Night Life - </b><?php if($user->nightlife == '1'){ echo "Yes";}else{ echo "No";}  ?></div><hr>

                                      </div>
                                      <div class="col-md-4">
                                        <h4>Other</h4>
                                         <div> <b>Date Of Registration - </b>{{date('d-m-Y',strtotime($user->created_at))}}</div><hr>
                                      </div>

                              </div>
                                  <div class="row">
                                    <div class="col-md-6">  
                                      <b>Bar Code - </b> <a download ="{{$user->bar_code}}" href="<?php echo $user->bar_code; ?>"><img src="<?php echo  url('/').'/'.$user->bar_code; ?>" style="width: 50%; height:50%;"  ></a>
                                    </div>
                                    <div class="col-md-6">
                                      <b>QR Code - <a download="{{$user->qr_code}}" href="<?php echo $user->qr_code; ?>"><img src="<?php echo  url('/').'/'.$user->qr_code; ?>" style="width: 30%"  ></a></b>
                                    </div>
                                  </div>
                                  <hr>
                            </div>
                                  
                                
                                    
                                <div class="modal-footer" style="background-color: black;">
                                  <button type="button"  class="btn btn-default pull-left" style="background-color:white;"><a href="{{ url('user_export',['id' => $user->id]) }}">Export</a></button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:white;">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                      </td>
                    
                      <td class="text-center">
                          {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <!-- <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> -->
                                @if($user->id != 1)
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                            @endif
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

        <script>$(function(){ TablesDatatables.init(); });</script>

@endsection

