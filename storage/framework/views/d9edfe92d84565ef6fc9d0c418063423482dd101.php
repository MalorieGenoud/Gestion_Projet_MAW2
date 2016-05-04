<li><?php echo e($task->id); ?> || <?php echo e($task->name); ?></li>
<ul>
    <?php echo $__env->renderEach('project.task', $task->children, 'task'); ?>
</ul>

