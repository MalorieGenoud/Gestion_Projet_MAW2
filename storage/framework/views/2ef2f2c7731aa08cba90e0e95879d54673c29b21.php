<?php $__env->startSection('content'); ?>


    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3><?php echo e($user->id); ?> - <?php echo e($user->fullname); ?></h3></div>

            <div class="panel-body">
                <img style="width: 80px; border-radius : 50%;" src="../avatar/<?php echo e($user->avatar); ?>" \>
                <form enctype="multipart/form-data" action="<?php echo e(route('user.avatar',Auth::user()->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>


                    Votre Avatar<br>
                    <input type="file" name="avatar">

                    <input type="submit" value="Envoyer">

                </form>
            </div>

        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h3>Informations</h3></div>
            <div class="panel-body">
                <p>Email : <?php echo e($user->mail); ?></p>
                <p>Votre rôle : <?php if($user->role_id == 1): ?> Eleve <?php else: ?> Prof <?php endif; ?></p>


            </div>


        </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>