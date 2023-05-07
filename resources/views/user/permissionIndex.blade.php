@extends('layouts.app')
@section('title','Permission')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Permissions</h1>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('permissions.create') }}">Add New</a>
        </h1> -->
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Gurd Name</th>
                        <th width="280px">Action</th>
                    </thead>
                  
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>
                                <a class="btn btn-info text-center" href="{{ route('permissions.show',$permission->id) }}"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                
                    <tfoot>
                        <th>No</th>
                        <th>Name</th>
                        <th>Gurd Name</th>
                        <th width="280px">Action</th>
                    </tfoot>
              </table>
        
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection