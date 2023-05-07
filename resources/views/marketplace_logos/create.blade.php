@extends('layouts.app')
@section('title','Marketplace Priorities')
@section('content')
<div class="content">
    <div class="box box-primary">
    <div class="content">
        @include('adminlte-templates::common.errors')
         <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                   <h2><strong>Create New </strong> Marketplace Priorities</h2>
                </div>
                    {!! Form::open(['route' => 'marketplaceLogos.store','files' => true]) !!}

                        @include('marketplace_logos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">

$('.country').on('load change',function(){
   var country_id = $(this).val();
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get_country_buss_list')}}?country_id="+country_id,
           success:function(res){
            if(res){
                $(".business").empty();
                $(".business").append('<option value="">Select Business</option>');
                $.each(res,function(key,value){
                    $(".business").append('<option value="'+key+'">'+value+'</option>');
                });
                //$('select').niceSelect('update');
            }else{
               $(".business").empty();
            }
           }
        });
    }else{
        $(".business").empty();
    }
});
    
$('.category').on('load change',function(){
   var cat_id = $(this).val();
    if(cat_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-sub-cat-list')}}?cat_id="+cat_id,
           success:function(res){
            if(res){
                $(".sub-category").empty();
                $(".sub-category").append('<option value="">Select Category</option>');
                $.each(res,function(key,value){
                    $(".sub-category").append('<option value="'+key+'">'+value+'</option>');
                });
                //$('select').niceSelect('update');
            }else{
               $(".sub-category").empty();
            }
           }
        });
    }else{
        $(".sub-category").empty();
    }
});
</script>
@endpush

