@extends('layouts.app')
@section('title','Faqs Business')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Edit </strong> Faqs Business</h2>
                </div>
                   {!! Form::model($faqsBusiness, ['route' => ['faqsBusinesses.update', $faqsBusiness->id], 'method' => 'patch']) !!}

                        @include('faqs_businesses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection