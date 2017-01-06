@include('errors._error_field')

<?php $errorClass = $errors->first('name') ? ['class' => 'validate invalid'] : [] ?>

<div class="row">
    <div class="input-field col s6">
        {!! Form::text('name', null, $errorClass) !!}
        {!! Form::label('name', 'Name: ', ['data-error' => $errors->first('name')]) !!}
    </div>
</div>

<div class="row">
    <div class="input-field file-field col s6">
        <div class="btn">
            Logo
            {!! Form::file('logo') !!}
        </div>
        <div class="file-path-wrapper">
            <input type="text" class="file-path" />
        </div>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        {!! Form::submit('Save', ['class' => 'btn waves-effect']) !!}
    </div>
</div>