<table class="table">
    <tr>
        <div class="panel-body">
            <th>Inviteur</th>
            <th>Invité</th>
            <th>Statut</th>
            <th>Date d'envoi</th>
        </div>
    </tr>
    <?php foreach($wait as $invit): ?>
        <tr>
            <div class="panel-body">
                <td><p><?php echo e($invit->host->firstname); ?> <?php echo e($invit->host->lastname); ?></p></td>
                <td><p><?php echo e($invit->guest->firstname); ?> <?php echo e($invit->guest->lastname); ?></p></td>
                <td><p><?php echo e($invit->statut); ?></p></td>
                <td><p><?php echo e($invit->created_at); ?></p></td>
            </div>
        </tr>
    <?php endforeach; ?>
</table>