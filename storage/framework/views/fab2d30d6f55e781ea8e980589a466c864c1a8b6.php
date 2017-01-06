

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">

            <h5>Editar Banco <?php echo e($bank->name); ?></h5>

            <?php echo Form::model($bank, [
                    'route' => ['admin.banks.update', 'bank' => $bank->id],
                    'method' => 'PUT',
                    'files' => true
                ]); ?>


                <?php echo $__env->make('admin.banks._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>