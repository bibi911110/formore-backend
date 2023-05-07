@extends('layouts.app')
@section('title','About Us')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>About Us</strong> </h2>
           <h1 class="pull-right">
          <?php  
            $count_data = \App\Models\About_us::where('user_id',Auth::user()->id)->count();
                      if($count_data != 1){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('aboutUses.create') }}">Add New</a>
  <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Content</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $about)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $about->title }}</td>
                     <td class="text-center">{{ strip_tags(html_entity_decode($about->content)) }}</td>  
                      <td class="text-center">
                          {!! Form::open(['route' => ['aboutUses.destroy', $about->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('aboutUses.edit', $about->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                               <!--  {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!} -->
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
        <script>$(function(){ AbooutUsTablesDatatables.init(); });</script>
@endsection

