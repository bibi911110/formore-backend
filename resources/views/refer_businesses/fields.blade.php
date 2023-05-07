

<!-- Refer Icon Field -->
<div class="form-group">
    {!! Form::label('refer_icon', 'Refer Icon:') !!}
    {!! Form::file('refer_icon') !!}
</div>
<?php if (isset($referBusiness->refer_icon)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$referBusiness->refer_icon; ?>" style="width: 9%"  >
     <input type="hidden" name="refer_icon" value="{{$referBusiness->refer_icon}}">
</div> 
<?php }?>

<!-- Refer Icon Field -->
<div class="form-group">
    {!! Form::label('refer_icon1', 'Refer Icon1:') !!}
    {!! Form::file('refer_icon1') !!}
</div>
<?php if (isset($referBusiness->refer_icon1)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$referBusiness->refer_icon1; ?>" style="width: 9%"  >
     <input type="hidden" name="refer_icon1" value="{{$referBusiness->refer_icon1}}">
</div> 
<?php }?>

<!-- Refer Icon Field -->
<div class="form-group">
    {!! Form::label('refer_icon2', 'Refer Icon2:') !!}
    {!! Form::file('refer_icon2') !!}
</div>
<?php if (isset($referBusiness->refer_icon2)) {?>
    <div class="form-group">
     <img src="<?php echo  url('/').'/'.$referBusiness->refer_icon2; ?>" style="width: 9%"  >
     <input type="hidden" name="refer_icon2" value="{{$referBusiness->refer_icon2}}">
</div> 
<?php }?>

<div class="form-group">
    {!! Form::label('eng_language_id', 'English Language:') !!}
    {!! Form::select('eng_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'English Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('refer_text', 'English Refer Text:') !!}
    {!! Form::textarea('refer_text', null, ['class' => 'form-control','rows' => '4']) !!}
</div>

<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('refer_text1', 'English Refer Text1:') !!}
    {!! Form::textarea('refer_text1', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('refer_text2', 'English Refer Text2:') !!}
    {!! Form::textarea('refer_text2', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Term Details Field -->
<div class="form-group">
    {!! Form::label('term_details', 'English Term Details:') !!}
    {!! Form::textarea('term_details', null, ['class' => 'form-control','rows' => '4']) !!}
</div>


<div class="form-group">
    {!! Form::label('albanian_language_id', 'Albanian Language:') !!}
    {!! Form::select('albanian_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('albanian_title', 'Albanian Title:') !!}
    {!! Form::text('albanian_title', null, ['class' => 'form-control']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('albanian_refer_text', 'Albanian Refer Text:') !!}
    {!! Form::textarea('albanian_refer_text', null, ['class' => 'form-control','rows' => '4']) !!}
</div>

<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('albanian_refer_text1', 'Albanian Refer Text1:') !!}
    {!! Form::textarea('albanian_refer_text1', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('albanian_refer_text2', 'Albanian Refer Text2:') !!}
    {!! Form::textarea('albanian_refer_text2', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Term Details Field -->
<div class="form-group">
    {!! Form::label('albanian_term_details', 'Albanian Term Details:') !!}
    {!! Form::textarea('albanian_term_details', null, ['class' => 'form-control','rows' => '4']) !!}
</div>



<div class="form-group">
    {!! Form::label('greek_language_id', 'Greek Language:') !!}
    {!! Form::select('greek_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('greek_title', 'Greek Title:') !!}
    {!! Form::text('greek_title', null, ['class' => 'form-control']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('greek_refer_text', 'Greek Refer Text:') !!}
    {!! Form::textarea('greek_refer_text', null, ['class' => 'form-control','rows' => '4']) !!}
</div>

<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('greek_refer_text1', 'Greek Refer Text1:') !!}
    {!! Form::textarea('greek_refer_text1', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('greek_refer_text2', 'Greek Refer Text2:') !!}
    {!! Form::textarea('greek_refer_text2', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Term Details Field -->
<div class="form-group">
    {!! Form::label('greek_term_details', 'Greek Term Details:') !!}
    {!! Form::textarea('greek_term_details', null, ['class' => 'form-control','rows' => '4']) !!}
</div>


<div class="form-group">
    {!! Form::label('italian_language_id', 'Italian Language:') !!}
    {!! Form::select('italian_language_id', [''=>'Select Language'] + $language->toArray(), null, ['class' => 'form-control buss_id_country','id' => 'buss_id']) !!}
</div>


<!-- Title Field -->
<div class="form-group">
    {!! Form::label('italian_title', 'Italian Title:') !!}
    {!! Form::text('italian_title', null, ['class' => 'form-control']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('italian_refer_text', 'Italian Refer Text:') !!}
    {!! Form::textarea('italian_refer_text', null, ['class' => 'form-control','rows' => '4']) !!}
</div>

<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('italian_refer_text1', 'Italian Refer Text1:') !!}
    {!! Form::textarea('italian_refer_text1', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Refer Text Field -->
<div class="form-group">
    {!! Form::label('italian_refer_text2', 'Italian Refer Text2:') !!}
    {!! Form::textarea('italian_refer_text2', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Term Details Field -->
<div class="form-group">
    {!! Form::label('italian_term_details', 'Italian Term Details:') !!}
    {!! Form::textarea('italian_term_details', null, ['class' => 'form-control','rows' => '4']) !!}
</div>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('referBusinesses.index') }}" class="btn btn-default">Cancel</a>
</div>
