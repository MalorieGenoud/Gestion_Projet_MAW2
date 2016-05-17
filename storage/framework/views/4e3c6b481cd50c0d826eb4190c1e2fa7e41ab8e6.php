<table class="table">
    <tr>
        <th>id</th>
        <th>token</th>
        <th>statut</th>
        <th>guest_id</th>
        <th>host_id</th>
        <th>project_id</th>
        <th>created_at</th>
        <td>action</td>
    </tr>

    <?php foreach($invitations as $invitation): ?>

        <tr>
            <td><?php echo e($invitation->id); ?></td>
            <td><?php echo e($invitation->token); ?></td>
            <td><?php echo e($invitation->statut); ?></td>
            <td><?php echo e($invitation->guest_id); ?></td>
            <td><?php echo e($invitation->host_id); ?></td>
            <td><?php echo e($invitation->project_id); ?></td>
            <td><?php echo e($invitation->created_at); ?></td>
            <?php if($invitation->statut == 'Wait'): ?>
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