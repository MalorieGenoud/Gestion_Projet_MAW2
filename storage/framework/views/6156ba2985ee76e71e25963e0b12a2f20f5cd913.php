<table class="table">
    <tr>
        <th>Statut</th>
        <th>Invité</th>
        <th>Hôte</th>
        <th>Projet</th>
        <th>Créer le</th>
        <th>Action</th>
    </tr>

    <?php foreach($invitations as $invitation): ?>

        <tr>
            <td><?php echo e($invitation->status); ?></td>
            <td><?php echo e($invitation->guest->fullName); ?></td>
            <td><?php echo e($invitation->host->fullname); ?></td>
            <td><?php echo e($invitation->project->name); ?></td>
            <td><?php echo e($invitation->created_at); ?></td>

            <!-- If the invation has a status "Wait", display the buttons to accept or refuse the invation -->
            <?php if($invitation->status == 'Wait'): ?>
                <td>
                    <button style="float: left;padding: 3px 6px;" class="left btn invitationaccept" data-invitation="<?php echo e($invitation->id); ?>"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> </button>
                    <button style="float: left;padding: 3px 6px;" class="left btn invitationrefuse" data-invitation="<?php echo e($invitation->id); ?>"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                </td>
            <?php else: ?>

                <td></td>

            <?php endif; ?>

        </tr>

    <?php endforeach; ?>

</table>