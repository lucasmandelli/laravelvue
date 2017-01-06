<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="disabled">
                <a href="#!"><i class="material-icons">chevron_left</i></a>
            </li>
        <?php else: ?>
            <li class="waves-effect">
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="disabled">
                    <a href="#!"><?php echo e($element); ?></a>
                </li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active">
                            <a href="#!"><?php echo e($page); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="waves-effect">
                            <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="waves-effect">
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        <?php else: ?>
            <li class="disabled">
                <a href="#!"><i class="material-icons">chevron_right</i></a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
