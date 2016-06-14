<!-- Display all tasks about user connected -->
<?php foreach($task->usersTasks as $usertask): ?>
    <li>
        <?php if($usertask->user_id == Auth::user()->id): ?>

            <a>
                <span class="taskshow" data-id="<?php echo e($task->id); ?>">
                    <p><?php echo e($task->name); ?></p>
                </span>

                <button class="right btn btn-lg
                <?php if($taskactive == null): ?>
                        taskplay" data-usertaskid="<?php echo e($usertask->id); ?>"
                        <?php elseif($taskactive == $task->id): ?>
                        taskstop
                " data-usertaskid="<?php echo e($usertask->id); ?>" data-duration="<?php echo e($duration); ?>"
                <?php else: ?>
                    taskplay" data-usertaskid="<?php echo e($usertask->id); ?>"
                <?php endif; ?>
                >
                <span class="glyphicon
                <?php if($taskactive == null): ?>
                        glyphicon-play-circle
                <?php elseif($taskactive == $task->id): ?>
                        glyphicon-stop
                <?php else: ?>
                        glyphicon-play-circle
                <?php endif; ?>
                        " aria-hidden="true"></span>
                </button>
                <button class="right btn btn-lg validate" data-task="<?php echo e($usertask->task_id); ?>">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </button>
            </a>
            <div class="progression"
                 style="background: linear-gradient(90deg, #20DE13 <?php echo e((($task->getElapsedDuration()*100/60/60)/$task->duration)); ?>%, #efefef 0%);">
                <p style="text-align: left;"><?php echo e(gmdate("H:i:s",$task->getElapsedDuration())); ?></p>
                <p> | <?php echo e(round(($task->getElapsedDuration()*100/60/60)/$task->duration,1)); ?>%</p>
                <p style="text-align: right;margin-left: auto;"><?php echo e($task->getDurationTask()); ?>h</p>
            </div>

        <?php endif; ?>

        <?php if($task->children->isEmpty()): ?>
    </li>
    <?php else: ?>
        <ul>
            <?php foreach($task->children as $task): ?>
                <?php echo $__env->make('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    </li>

<?php endforeach; ?>