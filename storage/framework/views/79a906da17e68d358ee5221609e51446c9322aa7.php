<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Vos projets</div>

                    <div class="panel-body">
                        Vous êtes loggé ! Voilà vos projets !
                    </div>


                    <?php foreach($projects as $project): ?>
                        <div>
                        <h3><a href="<?php echo e(route('project.index')); ?>/<?php echo e($project->id); ?>"><?php echo e($project->name); ?></a></h3>
                        <?php foreach($project->users as $user): ?>
                           <p>Utilisateurs :  <?php echo e($user->lastname); ?> <?php echo e($user->firstname); ?></p>
                        <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <a class="button" href="<?php echo e(route('project.create')); ?>">Créer votre projet !</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>