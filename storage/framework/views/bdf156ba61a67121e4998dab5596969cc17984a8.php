<?php $__env->startPush('title'); ?>
    Délimitation des zones
<?php $__env->stopPush(); ?>

<?php $__env->startPush('head'); ?>
    <script src="<?php echo e(asset('js/assignationZone.js')); ?>" defer type="module"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('modal-title'); ?>
    Selection de la salle qui contient la zone
<?php $__env->stopPush(); ?>

<?php $__env->startPush('modal-body'); ?>
    <label for="name-select"> <h2>Veuillez choisir la salle qui contient la zone</h2></label>
    <select id="select-salle" class="form-select">
    </select>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('assignation/layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/assignation/zone.blade.php ENDPATH**/ ?>