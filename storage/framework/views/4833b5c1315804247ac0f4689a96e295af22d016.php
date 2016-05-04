<?php echo $__env->make('project.planning', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('project.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('project.file', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Votre projet</div>

                    <div class="panel-body">
                        Apercevez votre projet ici
                    </div>
                </div>
            </div>


            <div class="col-md-10 col-md-offset-1">
                <h1>Planning</h1>
                <?php echo $__env->yieldContent('planning.as'); ?>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <h1>Les taches</h1>
                <ul>
                <?php echo $__env->renderEach('project.task', $project->tasksParent, 'task'); ?>
                </ul>
            </div>

            <div class="col-md-6 col-md-offset-1">
                <?php echo $__env->yieldContent('project.info'); ?>
            </div>

            <div class="col-md-6 col-md-offset-1">
                <?php echo $__env->yieldContent('project.file'); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>