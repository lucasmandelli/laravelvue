

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col s12 z-depth-2 panel">
                <h5>Listagem de Bancos</h5>

                <a href="<?php echo e(route('admin.banks.create')); ?>" class="btn waves-effect">Criar</a>

                <search :search="search"></search>

                <table class="bordered striped highlight centered responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><?php echo e($bank->id); ?></td>
                            <td>
                                <img src="<?php echo e(asset("storage/banks/images/{$bank->logo}")); ?>" class="bank-logo" />
                            </td>
                            <td><?php echo e($bank->name); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.banks.edit', ['bank' => $bank->id])); ?>" title="Edit">
                                    <i class="material-icons">mode_edit</i>
                                </a>
                                <delete-action action="<?php echo e(route('admin.banks.destroy', ['bank' => $bank->id])); ?>" action-element="link-delete-<?php echo e($bank->id); ?>" csrf-token="<?php echo e(csrf_token()); ?>">
                                    <a id="link-modal-<?php echo e($bank->id); ?>" href="#modal-delete-<?php echo e($bank->id); ?>" title="Delete">
                                        <i class="material-icons">delete</i>
                                    </a>
                                    <modal :modal="<?php echo e(json_encode(['id' => "modal-delete-$bank->id"])); ?>" style="display: none;">
                                        <div slot="content">
                                            <h5>Comfirm...</h5>
                                            <div class="divider"></div>
                                            <p>Do you want to delete the <?php echo e($bank->name); ?> bank?</p>
                                        </div>
                                        <div slot="footer">
                                            <button id="link-delete-<?php echo e($bank->id); ?>" class="btn btn-flat red waves-effect modal-close">Delete</button>
                                            <button class="btn btn-flat waves-effect modal-close">Cancel</button>
                                        </div>
                                    </modal>
                                </delete-action>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                <?php echo $banks->links(); ?>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        export default {
            data() {
                return {
                    modal: {
                        id: 'modal-delete'
                    },
                    bank: null,
                    search: ""
                };
            },
            methods: {
                openModalDelete(id) {
                    this.bank = id;
                    $('#bank').val(id);
                    $('#'+this.modal.id).openModal();
                }
            },
            events: {
                'filter::submited'(search) {
                    this.search = search;
                    alert('aaa');
                }
            }
        };
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>