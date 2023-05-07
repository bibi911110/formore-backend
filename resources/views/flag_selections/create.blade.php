@extends('layouts.app')
@section('title',' Flag Selection')
@section('content')
<div class="content">
<div class="box box-primary">
<div class="content">
    @include('adminlte-templates::common.errors')
     <div class="block">
            <!-- Normal Form Title -->
            <div class="block-title">
               <h2><strong>Create New </strong>  Flag Selection</h2>
            </div>
                    {!! Form::open(['route' => 'flagSelections.store']) !!}

                        @include('flag_selections.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    
$('.segment_id').on('load change',function(){
    var buss_id = $(this).val();
    if(buss_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-segment-list')}}?buss_id="+buss_id,
           success:function(res){
            if(res){
                $("#segment_data").empty();
                //$("#segment_data").append('<option value="">Select Category</option>');
                $.each(res,function(key,value){
                    $("#segment_data").append('<option value="'+key+'">'+value+'</option>');
                });
                //$('select').niceSelect('update');
            }else{
               $("#segment_data").empty();
            }
           }
        });
    }else{
        $("#segment_data").empty();
    }
});
</script>
@endpush
