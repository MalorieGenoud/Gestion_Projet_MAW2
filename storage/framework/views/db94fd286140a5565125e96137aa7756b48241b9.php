<?php foreach($task->usersTasks as $usertask): ?>
    <?php if($usertask->user_id == Auth::user()->id): ?>
        <li>
            <a>
                <span class="taskshow" data-id="<?php echo e($task->id); ?>">
                    <p><?php echo e($task->id); ?> - <?php echo e($task->name); ?></p>
                </span>
                <button class="right btn btn-lg
                <?php if($taskactive == null): ?>
                        taskplay" data-usertaskid="<?php echo e($usertask->id); ?>"
                <?php elseif($taskactive == $task->id): ?>
                        taskstop " data-usertaskid="<?php echo e($usertask->id); ?>" data-duration="<?php echo e($duration); ?>"
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
            </a>
    <?php else: ?>
        <li>
            <?php endif; ?>
            <?php endforeach; ?>

            <?php if($task->children->isEmpty()): ?>

            <?php else: ?>
                <ul>
                    <?php foreach($task->children as $task): ?>
                        <?php echo $__env->make('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>


