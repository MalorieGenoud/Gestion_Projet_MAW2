
<form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('project/'.$project.'/invitations')); ?>">
    <?php echo csrf_field(); ?>


    <div class="form-group">
        <label class="col-md-4 control-label">l'id de l'utilisateur à inviter</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="guest_id" value="" required>
        </div>
    </div>

    <div class="form-group">

        <div class="col-md-6">
            <input type="hidden" class="form-control" name="project_id" value="<?php echo e($project); ?>" required>
        </div>
    </div>

    <div class="form-group">

        <div class="col-md-6">
            <input type="hidden" class="form-control" name="host_id" value="<?php echo e($hostid); ?>" required>
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