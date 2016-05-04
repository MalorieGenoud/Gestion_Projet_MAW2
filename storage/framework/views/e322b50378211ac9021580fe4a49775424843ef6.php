<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Création de projet</div>

                    <div class="panel-body">

                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/project')); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label">Nom de votre projet</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="<?php echo e(old('description')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Date de début</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date" value="<?php echo e(old('date')); ?>">
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
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>