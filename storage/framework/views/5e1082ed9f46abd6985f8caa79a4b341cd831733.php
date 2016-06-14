<div class="panel panel-default">
    <div class="panel-heading">Informations projet</div>

    <div class="panel-body">
        <!-- Display the information about project -->
        <p>Nom : <?php echo e($project->name); ?></p>
        <p>Date de début : <?php echo e($project->startdate); ?></p>
        <p>Description : <?php echo e($project->description); ?></p>
    </div>

    <div class="panel-heading">Membres du projet</div>

    <div class="panel-body">
        <?php foreach($project->users as $user): ?>
            <p>
                <!-- Display all project members -->
                <?php echo $__env->make('user.avatar', ['user' => $user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <button class="right btn userprojectdestroy" data-id="<?php echo e($user->id); ?>" data-projectid="<?php echo e($project->id); ?>">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </p>
        <?php endforeach; ?>
        <a class="btn btn-warning invitation" data-projectid="<?php echo e($project->id); ?>">Ajouter une personne</a>
        <a class="btn btn-warning invitationwait" data-projectid="<?php echo e($project->id); ?>">Voir les invitations en attente</a>

    </div>

    <div class="panel-heading">Objectifs du projet</div>

    <div class="panel-body">
        <!-- Display all project objectives -->
        <ol class="targets">
        <?php foreach($project->targets as $target): ?>
            <li class="<?php if($target->status == 'Finished'): ?><?php echo e('finished'); ?><?php endif; ?>"><?php echo e($target->description); ?>

                <?php if($target->status == 'Wait'): ?>
                <button class="right btn validetarget" data-targetid="<?php echo e($target->id); ?>">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </button>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ol>
        <br>
        <a class="btn btn-warning target" data-projectid="<?php echo e($project->id); ?>">Ajouter un objectif</a>
    </div>


</div>

