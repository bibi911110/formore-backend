<!-- Media Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('media_name', 'Media Name:') !!}
    {!! Form::text('media_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Media Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('media_category', 'Media Category:') !!}
    {!! Form::text('media_category', null, ['class' => 'form-control']) !!}
</div>

<!-- Media Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('media_icon', 'Media Icon:') !!}
    {!! Form::file('media_icon') !!}
</div>
<div class="clearfix"></div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('socialMediaMgts.index') }}" class="btn btn-default">Cancel</a>
</div>
