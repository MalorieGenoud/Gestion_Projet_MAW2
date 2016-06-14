<form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/tasks/'.$task->id.'/children')); ?>">
    <?php echo csrf_field(); ?>


    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <label class="col-md-4 control-label">Nom de la tâche</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Durée de la tâche</label>

        <div class="col-md-6">
            <input type="time" class="form-control" name="duration" value="<?php echo e(old('duration')); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Date de début</label>

        <div class="col-md-6">
            <input type="date" class="form-control" name="date_jalon" value="<?php echo e(old('date_jalon')); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <input type="hidden" class="form-control" name="project_id" value="<?php echo e($task->project_id); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <input type="hidden" class="form-control" name="parent_id" value="<?php echo e($task->id); ?>" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Créer
            </button>

        </div>
    </div>
</form>