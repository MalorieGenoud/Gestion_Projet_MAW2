<?php $__env->startSection('content'); ?>
    <div class="container">
        <!-- Display all projects -->
        <?php foreach($projects as $project): ?>

        <div class="panel panel-default">
            <div class="panel-heading"><h2><a href="<?php echo e(route('project.index')); ?>/<?php echo e($project->id); ?>"><?php echo e($project->name); ?></a></h2></div><!-- Display the project name -->
            <div class="panel-body">
                <h4>Membres : </h4>
                <!-- Display all project members -->
                <?php foreach($project->users as $user): ?>
                    <?php echo $__env->make('user.avatar', ['user' => $user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <a class="button btn btn-default" href="<?php echo e(route('project.create')); ?>">Créer votre projet !</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>