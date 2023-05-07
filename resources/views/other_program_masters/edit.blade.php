@extends('layouts.app')
@section('title','Other Program Master')
@section('content')
 <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
           <!-- Normal Form Block -->
            <div class="block">
                <!-- Normal Form Title -->
                <div class="block-title">
                    <h2><strong>Edit </strong>Other Program Master</h2>
                </div>

                   {!! Form::model($otherProgramMaster, ['route' => ['otherProgramMasters.update', $otherProgramMaster->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('other_program_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection