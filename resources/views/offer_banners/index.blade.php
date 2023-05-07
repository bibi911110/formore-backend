@extends('layouts.app')
@section('title','Offer Banners')
@section('content')
 <div class="block full">
      <div class="block-title">
          <h2><strong>Offer Banners</strong> </h2><span style="color: gray;"> (Maximum 12 can be added) </span>
           <h1 class="pull-right">
    <?php  $count_data = \App\Models\Offer_banner::where('user_id',Auth::user()->id)->count();  if($count_data != 12){ ?>
                 <a class="btn btn-primary pull-right" style="margin-top: -8px;margin-bottom: 5px" href="{{ route('offerBanners.create') }}">Add New</a>
  <?php } ?>
          </h1>
      </div>
        @include('flash::message')
      <div class="table-responsive">
         <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Image</th>
                    <!--   <th class="text-center">Deals banner photo</th> -->
                      <th class="text-center">Deal Title</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                  @foreach ($data as $key => $offer_link)
                    <tr>
                      <td class="text-center">{{ $i++ }}</td>
                      <td class="text-center" style="width:30% !important;" ><img src="<?php echo  url('/').'/'.$offer_link->offer_image; ?>" style="width: 3% !important"  ></td>
                      <!-- <td class="text-center"><img src="<?php echo  url('/').'/'.$offer_link->deals_banner_image; ?>" style="width: 6%"  ></td> -->
                      <td class="text-center">{{ $offer_link->title_for_deals }}</td>
                      <td class="text-center">{{ $offer_link->catName }}</td>
                      <td class="text-center">
                          {!! Form::open(['route' => ['offerBanners.destroy', $offer_link->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                                           
                                <a href="{{ route('offerBanners.edit', $offer_link->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
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
        <script>$(function(){ OfferTablesDatatables.init(); });</script>
@endsection





