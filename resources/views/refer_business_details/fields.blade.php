
@if(isset($referBusinessDetails->id))
<div class="form-group" id="campaign_cat" >
    {!! Form::label('status', 'Select Status:') !!}
    {!! Form::select('status', [''=>'Select Status','New' => 'New',"Reward" => 'Reward',"Existing" => 'Existing',"Cancel" => 'Cancel',"Not accepted" => 'Not accepted'], null, ['class' => 'form-control','id' => 'campaign_type']) !!}
</div>
@else

<!-- Name Of Business Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_of_business', 'Name Of Business:') !!}
    {!! Form::text('name_of_business', null, ['class' => 'form-control']) !!}
</div>

<!-- Owner Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner_email', 'Owner Email:') !!}
    {!! Form::text('owner_email', null, ['class' => 'form-control']) !!}
</div>

<!-- Your Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('your_name', 'Your Name:') !!}
    {!! Form::text('your_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Your Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('your_email', 'Your Email:') !!}
    {!! Form::text('your_email', null, ['class' => 'form-control']) !!}
</div>

<!-- Term Check Field -->
<div class="form-group col-sm-6">
    {!! Form::label('term_check', 'Term Check:') !!}
    {!! Form::text('term_check', null, ['class' => 'form-control']) !!}
</div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('referBusinessDetails.index') }}" class="btn btn-default">Cancel</a>
</div>
