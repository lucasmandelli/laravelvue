<?php echo $__env->make('errors._error_field', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $errorClass = $errors->first('name') ? ['class' => 'validate invalid'] : [] ?>

<div class="row">
    <div class="input-field col s6">
        <?php echo Form::text('name', null, $errorClass); ?>

        <?php echo Form::label('name', 'Name: ', ['data-error' => $errors->first('name')]); ?>

    </div>
</div>

<div class="row">
    <div class="input-field file-field col s6">
        <div class="btn">
            Logo
            <?php echo Form::file('logo'); ?>

        </div>
        <div class="file-path-wrapper">
            <input type="text" class="file-path" />
        </div>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <?php echo Form::submit('Save', ['class' => 'btn waves-effect']); ?>

    </div>
</div>