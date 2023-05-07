@extends('layouts.app')

@section('title','Business User')

@section('content')

   <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Business Users</strong> </h2>
               <h1 class="pull-right">

                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('users.create') }}">Add New</a>

          </h1>
      

      </div>

        @include('flash::message')


      <div class="table-responsive">

         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">

              <thead>

                  <tr>

                      <th class="text-center">No</th>
                      <th class="text-center">Business Name</th>

                     <th class="text-center">Name</th>

                      <th class="text-center">Email</th>
                      <th class="text-center">Password</th>

                     <!--  <th>Roles</th> -->
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>

                  </tr>

              </thead>

              <tbody>


                  <?php $i=1; ?>
                  @foreach ($data as $key => $user)

                    <tr>

                      <td class="text-center">{{$i++ }}</td>
                      <td class="text-center">{{$user->brand_name}}</td>

                      <td class="text-center">{{ $user->name }}</td>

                      <td class="text-center">{{ $user->email }}</td>
                      <td class="text-center">{{ $user->show_password }}</td>

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
                          {!! Form::open(['url' => ['users_buss_delete', $user->id], 'method' => 'delete']) !!}
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

