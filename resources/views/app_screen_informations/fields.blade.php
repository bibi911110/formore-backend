<!-- Screen Name Field -->
<!-- <div class="form-group">
    {!! Form::label('screen_name', 'Screen Name:') !!}
    {!! Form::text('screen_name', null, ['class' => 'form-control']) !!}
</div> -->
<div class="form-group">
    <label for="grade">Screen Name</label>
    {!! Form::select('screen_name', $screen_name= array("" => "Select screen name","Registration 2"=>"Registration 2","View ID" => "View ID","Deals"=>"Deals","Super code info" => "Super code info","Choose Brand" => "Choose Brand","Campaigns" => "Campaigns","Upload receipt" => "Upload receipt","Menu info" => "Menu info","Find member" => "Find member","Option info" => "Option info","Stamp info" => "Stamp info","Point info" => "Point info","Voucher info" => "Voucher info","Voucher detail info" => "Voucher detail info","Cashback info" => "Cashback info","Cashback details info" => "Cashback details info","Invite info" => "Invite info","Offer info" => "Offer info","Offer details info" => "Offer detail info","Give Vouche Info" => "Give Vouche Info","Give Vouche Detail Info" => "Give Vouche Detail Info","My Rewards" =>"My Rewards" , "Scan Tag" => "Scan Tag","Search By Category" => "Search By Category","By Distance" => "By Distance","Marketplace" => "Marketplace","Online orders" => "Online orders","Other Programs" =>"Other Programs"), null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<!-- <div class="form-group">
    {!! Form::label('language_id', 'Language Id:') !!}
    {!! Form::text('language_id', null, ['class' => 'form-control']) !!}
</div> -->

<div class="form-group">
<label for="mobile_no">Language</label>
@if(isset($appScreenInformation->language_id))
{!! Form::select('language_id', [''=>'Select language'] + $language->toArray(), $appScreenInformation->language_id, ['class' => 'form-control', 'id' =>'stateId']) !!}
@else
{!! Form::select('language_id', [''=>'Select language'] + $language->toArray(), null, ['class' => 'form-control', 'id' =>'stateId']) !!}
@endif
</div>

<!-- Content Field -->
<!-- <div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div> -->
@if(isset($appScreenInformation->content))
<div class="form-group ">
    {!! Form::label('content', 'Content:') !!}
    <textarea id="textarea-ckeditor" name="content" class="ckeditor">{{$appScreenInformation->content}}</textarea>
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
    <a href="{{ route('appScreenInformations.index') }}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
<script src="{{url('public/new/js/helpers/ckeditor/ckeditor.js')}}"></script>
@endpush