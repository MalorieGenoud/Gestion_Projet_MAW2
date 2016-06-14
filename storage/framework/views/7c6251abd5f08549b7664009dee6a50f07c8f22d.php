<table class="table">
    <tr>
        <th>Utilisateur</th>
        <th>Action</th>
    </tr>
    <?php foreach($userstask as $usertask): ?>
        <tr>
            <td><?php echo $__env->make('user.avatar', ['user' => $usertask->user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
            <td style="text-align: center;">
                <!-- If a user doesn't begin a task, he can be deleted -->
                <?php if($usertask->durationsTasks->isEmpty()): ?>
                <button class="btn usertaskdestroy" data-id="<?php echo e($usertask->id); ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <?php else: ?>
                    <p>Suppression impossible</p>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>
<h4>Ajouter des participant à la tâche</h4>

<form class="form-horizontal" role="form" method="POST" action="<?php echo e(Route('tasks.storeUsers',$task->id)); ?>">
    <?php echo csrf_field(); ?>

    <div class="checkbox">
        <?php foreach($project->users as $user): ?>
            <!-- Display all users which aren't in the project -->
            <?php if(!in_array($user->id,$refuse)): ?>
                <label>
                    <input type="checkbox" name="user[<?php echo e($user->id); ?>]">
                    <?php echo $__env->make('user.avatar', ['user' => $user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </label>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>

<br>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-plus"></i>Ajouter un utilisateur
            </button>
        </div>
    </div>
</form>