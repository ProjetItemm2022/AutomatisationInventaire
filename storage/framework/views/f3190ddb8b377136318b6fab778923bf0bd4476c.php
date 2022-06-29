<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title><?php echo e('Ticket'); ?></title>
    <link href="<?php echo e(asset('css/page.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('/js/ticket.js')); ?>" defer></script>
    <script src="<?php echo e(asset('/js/app.js')); ?>" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <script src="https://www.google.com/jsapi"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
    <h1 class="titre">Ticket demande de matériel</h1>
    <table id="Table_id">
        <tr>
            <th>Nom</th>
            <th>Réference</th>
            <th>Fournisseur</th>
            <th>Quantité</th>

        </tr>
        <?php $__currentLoopData = $donnees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
<td><?php echo e($data["nom"]); ?></td>
<td><?php echo e($data["reference"]); ?></td>
<td><?php echo e($data["fournisseur"]); ?></td>

<td><?php echo e($data["quantite"]); ?></td>



        </tr>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </table>



</body>
<?php /**PATH /var/www/html/AutomatisationInventaire/resources/views/ticketPDF.blade.php ENDPATH**/ ?>