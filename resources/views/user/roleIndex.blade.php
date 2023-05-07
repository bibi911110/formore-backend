@extends('layouts.app')

@section('title','Role')

@section('content')

      <!-- Datatables Content -->

  <div class="block full">

      <div class="block-title">

          <h2><strong>Roles</strong> </h2>

           <h1 class="pull-right">

                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('roles.create') }}">Add New</a>

          </h1>

      </div>

        @include('flash::message')

      <div class="table-responsive">

          <table id="role-datatable" class="table table-vcenter table-condensed table-bordered">

              <thead>

                  <tr>

                      <th class="text-center">No</th>

                     <!--  <th class="text-center"><i class="gi gi-user"></i></th> -->

                      <th>Name</th>

                      <th class="text-center">Actions</th>

                  </tr>

              </thead>

              <tbody>

                  @foreach ($roles as $key => $role)

                    <tr>

                      <td class="text-center">{{ ++$i }}</td>

                      <td class="text-center">{{ $role->name }}</td>

                     <!--  <td class="text-center">

                          @if($role->id != 1)

                            <a data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pencil"></i></a>



                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}

                                <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>

                            {!! Form::close() !!}

                          @endif

                      </td> -->
                      <td class="text-center">
                          {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('roles.edit', $role->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                  <!-- {!! Form::button('<i class="fa fa-times"></i>', [
                                      'type' => 'submit',
                                      'class' => 'btn btn-danger btn-xs',
                                      'onclick' => "return confirm('Are you sure?')"
                                  ]) !!} -->
                            </div>
                            {!! Form::close() !!}
                      </td>

                    </tr>

                  @endforeach

                 <!--  <tr>

                      <td class="text-center">1</td>

                      <td class="text-center"><img src="img/placeholders/avatars/avatar15.jpg" alt="avatar" class="img-circle"></td>

                      <td><a href="javascript:void(0)">client1</a></td>

                      <td>client1@company.com</td>

                      <td><span class="label label-info">Business</span></td>

                      <td class="text-center">

                          <div class="btn-group">

                              <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>

                              <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>

                          </div>

                      </td>

                  </tr> -->

                  

              </tbody>

          </table>

      </div>

  </div>

  <!-- END Datatables Content -->

@endsection

@section('scripts')

   <script src="{{url('public/new/js/pages/tablesDatatables.js') }}"></script>

    <script>$(function(){ RoleTablesDatatables.init(); });</script>

    </script>

@endsection

