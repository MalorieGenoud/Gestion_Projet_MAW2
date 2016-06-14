<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Votre projet</div>
            <div class="panel-body">
                <!-- Include the plugin for the planning -->
                <?php echo $__env->make('planning.show', ['taskparent' => $project->tasksParent], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <h1>Vos tâches</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display the tasks connected user -->
                        <?php foreach($project->tasksParent as $task): ?>
                            <?php echo $__env->make('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <h1>Les tâches du projet</h1>
                <div class="tree-menu" id="tree-menu">
                    <ul>
                        <!-- Display all project tasks -->
                        <?php echo $__env->renderEach('project.task', $project->tasksParent, 'task'); ?>
                    </ul>
                </div>
                <a class="btn btn-warning taskroot" data-id="<?php echo e($project->id); ?>">Créer une tâche racine</a>
            </div>
            <div class="col-md-6"><h1>Détail de la tâche</h1>
                <div id="taskdetail"></div>
            </div>
        </div>

        <h1>Informations du projet</h1>
        <!-- Display all project informations like the members, a description and so on -->
        <?php echo $__env->make('project.info', ['project' => $project], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
        <h1>Evénements majeur</h1>
        <div class="panel panel-default" id="events"></div>
        <a class="btn btn-warning events" data-id="<?php echo e($project->id); ?>">Créer un événement</a>

        <h1>Fichiers</h1>
        <div class="panel panel-default" id="files">
            <div class="container">
                <form enctype="multipart/form-data" action="<?php echo e(route('files.store', $project->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>


                    Ajouter des fichiers<br>

                    <label class="col-md-4 control-label">Description du fichier</label>

                    <div class="col-md-6">
                        <input type="texte" class="form-control" name="description" value="" required>
                    </div>

                    <label class="col-md-4 control-label">Le fichier</label>

                    <div class="col-md-6">
                        <input type="file" name="file">
                    </div>

                    <div class="col-md-6">
                        <input type="submit" value="Envoyer">
                    </div>

                </form>
            </div>
        </div>

        <div class="panel panel-default" id="files">
            <div class="container">
                <p>Fichiers du projet</p>
                <?php foreach($project->files as $file): ?>
                    <div class="file">
                        <a href="<?php echo e(asset('files/'.$project->id.'/'.$file->url)); ?>" download="<?php echo e($file->name); ?>">
                            <img class="" src="<?php echo e(asset('images/icon/'.$file->mime.'.png')); ?>">
                            <p><?php echo e($file->name); ?></p>
                            <p><?php echo e($file->description); ?></p>
                            <p><?php echo e(round($file->size / (1024*1024), 2)); ?> MB</p>
                        </a>
                        <button class="right btn filedestroy"  data-id="<?php echo e($file->id); ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    callEvents(<?php echo e($project->id); ?>);


<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>