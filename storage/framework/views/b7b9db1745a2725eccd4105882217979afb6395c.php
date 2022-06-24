<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Nommage Batiment</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js" defer
        integrity="sha512-nPzvcIhv7AtvjpNcnbr86eT6zGtiudLiLyVssCWLmvQHgR95VvkLX8mMpqNKWs1TG3Hnf+tvHpnGmpPS3yJIgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>



    <!-- Fonts -->
    <!--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/assignation.css')); ?>" rel="stylesheet">
</head>
<style>
    body{
        background-color: #AEDFF4
    }
    input{
        width: 280px;
    }
</style>
<header>
    <nav class="flex header">
        <img width="260" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
            alt="Logo de l'itemm">
            <h2>Nommage des batiments</h2>
            <div class="hamburger-menu">
                <input id="menu__toggle" type="checkbox" />
                <label class="menu__btn" for="menu__toggle">
                  <span></span>
                </label>

                <ul class="menu__box">
                    <li><a class="menu__item" href="#" onclick="location='<?php echo e(route('index')); ?>'">Menu</a></li>
                  <li><a class="menu__item" href="href=" <?php echo e(route('logout')); ?> onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><?php echo e('Deconnexion'); ?></a></li>

                </ul>
            </div>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                     <?php echo csrf_field(); ?>
                </form>

    </nav>
    <div class=" text-center ">
        <form method="post" action="<?php echo e(url("/assignation/updatenomsbatiments")); ?>">
            <?php echo csrf_field(); ?>
            <table class="mx-auto">
                <th>Ancien</th>
                <th>Nouveau</th>

                <?php $__currentLoopData = $batiments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batiment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                    <td>
                        <input type="text" value="<?php echo e($batiment->nom); ?>" readonly disabled>

                    </td>
                    <td>
                        <input name="nom[]" type="text" placeholder="Laissez vide pour garder le meme nom" value="<?php echo e($batiment->nom); ?>">
                        <input name="id[]" type="hidden" value="<?php echo e($batiment->id); ?>">
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




            </table>
            <input type="submit" value="Enregistrer" class=" text-center "><br/>
            <input type="button" value="Retour au menu" class=" text-center " onclick="location.replace('<?php echo e(route('assignation')); ?>');">
        <div>


    </div>

</header>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/assignation/nommage.blade.php ENDPATH**/ ?>