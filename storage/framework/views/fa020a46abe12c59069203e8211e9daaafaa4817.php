<li>
    <a href="#" ><span class="taskshow" data-id="<?php echo e($task->id); ?>"><p> <?php echo e($task->name); ?></p></span>
        <button class="right btn taskuser" data-id="<?php echo e($task->id); ?>"> <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span> </button>
        <button class="right btn taskdestroy"  data-id="<?php echo e($task->id); ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
        <button class="right btn taskedit" data-id="<?php echo e($task->id); ?>"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </button>
        <button class="right btn taskplus" data-id="<?php echo e($task->id); ?>"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
    </a>
    <div class="progression" style="background: linear-gradient(90deg, #20DE13 <?php echo e((($task->getElapsedDuration()*100/60/60)/$task->duration)); ?>%, #efefef 0%);">
        <p style="text-align: left;"><?php echo e(gmdate("H:i:s",$task->getElapsedDuration())); ?></p>
        <p> | <?php echo e(round(($task->getElapsedDuration()*100/60/60)/$task->duration,1)); ?>%</p><!-- Display the task pourcent -->
        <p style="text-align: right;margin-left: auto;"><?php echo e($task->getDurationTask()); ?>h</p>
    </div>

    <?php if($task->children->isEmpty()): ?>

    <?php else: ?>
        <ul>
            <?php echo $__env->renderEach('project.task', $task->children, 'task'); ?><!-- Display task children -->
        </ul>
    <?php endif; ?>

</li>



