<div class="form-group">
    {!! Form::label('eng_language_id', 'English Language:') !!}
    {!! Form::select('eng_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Term Link Field -->
<div class="form-group">
    {!! Form::label('term_link', 'English Term & Condition Link:') !!}
    {!! Form::text('term_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Privacy Link Field -->
<div class="form-group">
    {!! Form::label('privacy_link', 'English Privacy Policy Link:') !!}
    {!! Form::text('privacy_link', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('albanian_language_id', 'Albanian Language:') !!}
    {!! Form::select('albanian_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Term Link Field -->
<div class="form-group">
    {!! Form::label('albanian_term_link', 'Albanian Term & Condition Link:') !!}
    {!! Form::text('albanian_term_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Privacy Link Field -->
<div class="form-group">
    {!! Form::label('albanian_privacy_link', 'Albanian Privacy Policy Link:') !!}
    {!! Form::text('albanian_privacy_link', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('greek_language_id', 'Greek Language:') !!}
    {!! Form::select('greek_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Term Link Field -->
<div class="form-group">
    {!! Form::label('greek_term_link', 'Greek Term & Condition Link:') !!}
    {!! Form::text('greek_term_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Privacy Link Field -->
<div class="form-group">
    {!! Form::label('greek_privacy_link', 'Greek Privacy Policy Link:') !!}
    {!! Form::text('greek_privacy_link', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('italian_language_id', 'Italian Language:') !!}
    {!! Form::select('italian_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Term Link Field -->
<div class="form-group">
    {!! Form::label('italian_term_link', 'Italian Term & Condition Link:') !!}
    {!! Form::text('italian_term_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Privacy Link Field -->
<div class="form-group">
    {!! Form::label('italian_privacy_link', 'Italian Privacy Policy Link:') !!}
    {!! Form::text('italian_privacy_link', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('linkMasters.index') }}" class="btn btn-default">Cancel</a>
</div>
