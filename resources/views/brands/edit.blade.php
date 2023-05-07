@extends('layouts.app')
@section('title','Brand')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong> Brand</h2>
            </div>
                   {!! Form::model($brand, ['route' => ['brands.update', $brand->id], 'method' => 'patch','files' => true]) !!}

                        @include('brands.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@push('scripts')
<script type="text/javascript">
$('.category').on('load change',function(){
   var cat_id = $(this).val();
   
    if(cat_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-sub-cat-list')}}?cat_id="+cat_id,
           success:function(res){
            if(res){
                $(".sub-category").empty();
                //$(".sub-category").append('<option value="">Select Category</option>');
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
$(document).ready(function(){

$(".expiration_date").datepicker()
   // .on('changeDate', function (selected) {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
       // var maxDate = new Date(selected.date.valueOf());
        $('.expiration_date').datepicker('setStartDate', today);
  //  });

});
</script>
@endpush