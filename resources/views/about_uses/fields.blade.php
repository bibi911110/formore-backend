<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<!-- <div class="form-group ">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>
 -->
 @if(isset($aboutUs->content))
<div class="form-group ">
    {!! Form::label('content', 'Content:') !!}
    <textarea id="textarea-ckeditor" name="content" class="ckeditor">{{$aboutUs->content}}</textarea>
    <!-- {!! Form::text('content', null, ['class' => 'form-control ckeditor',"id" =>"textarea-ckeditor"]) !!} -->
</div>
@else
<div class="form-group ">
    {!! Form::label('content', 'Content:') !!}
    <textarea id="textarea-ckeditor" name="content" class="ckeditor"></textarea>
    <!-- {!! Form::text('content', null, ['class' => 'form-control ckeditor',"id" =>"textarea-ckeditor"]) !!} -->
</div>
@endif
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('aboutUses.index') }}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
<script src="{{url('public/new/js/helpers/ckeditor/ckeditor.js')}}"></script>
@endpush