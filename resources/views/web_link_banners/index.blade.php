@extends('layouts.app')
@section('title','Web Link Banners')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Web Link Banners</strong> </h2><span style="color: gray;"> (Maximum 2 can be added) </span>
           <h1 class="pull-right">
                 <?php  $count_data = \App\Models\Web_link_banners::where('user_id',Auth::user()->id)->count();  if($count_data != 2){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('webLinkBanners.create') }}">Add New</a>
            <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Name</th>
                     <!--  <th class="text-center">Link</th> -->
                      <th class="text-center">Banner Image</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $web_link)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center">{{ $web_link->title }}</td>
                     <!--  <td class="text-center">{{ $web_link->link }}</td> -->
                      <td class="text-center" style="width:50% !important;"><img src="<?php echo  url('/').'/'.$web_link->web_image; ?>" style="width: 6%"  ></td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['webLinkBanners.destroy', $web_link->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('webLinkBanners.edit', $web_link->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                {!! Form::button('<i class="fa fa-times"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
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
        <script>$(function(){ TablesDatatables.init(); });</script>
@endsection



