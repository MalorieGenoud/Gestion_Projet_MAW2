<div class="col-md-10">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e($task->name); ?> - <?php echo e($task->id); ?></div>

        <div class="panel-body">
            <p>Durée initial : <?php echo e($task->duration); ?></p>
            <p>Date du jalon : <?php echo e($task->date_jalon); ?></p>
        </div>

        <div class="panel-heading">Rush</div>

        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Créer le</th>
                    <th>Fin le</th>
                    <th>Nom de l'utilisateur</th>
                    <th>Durée</th>
                </tr>
                <!-- Display user rush about a task -->
                <?php foreach($task->usersTasks as  $usertask): ?>
                    <?php foreach($usertask->durationsTasks as $duration): ?>
                        <?php if($duration->ended_at): ?>
                            <tr>
                                <td><?php echo e($duration->created_at); ?></td>
                                <td><?php echo e($duration->ended_at); ?></td>
                                <td><?php echo e($usertask->user->fullName); ?></td>
                                <td><?php echo e(round(abs(strtotime($duration->ended_at) - strtotime($duration->created_at))). " secondes"); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="panel-heading">Commentaires</div>

        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Commentaire</th>
                    <th>Crée le</th>
                    <th>Nom de l'utilisateur</th>
                </tr>
                <!-- Display the comment for a task -->
                <?php foreach($task->comments as  $comment): ?>
                    <tr>
                        <td><?php echo e($comment->comment); ?></td>
                        <td><?php echo e($comment->created_at); ?></td>
                        <td><?php echo e($comment->user->fullName); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('comment.store', $task->id)); ?>">
                <?php echo csrf_field(); ?>

                <textarea name="comment" rows="8" cols="45" placeholder="Tapez votre commentaire ici"></textarea>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Envoyer
                </button>
            </form>

        </div>


    </div>
</div>