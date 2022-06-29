<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldPushContent('title'); ?></title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js" defer
        integrity="sha512-nPzvcIhv7AtvjpNcnbr86eT6zGtiudLiLyVssCWLmvQHgR95VvkLX8mMpqNKWs1TG3Hnf+tvHpnGmpPS3yJIgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <?php echo $__env->yieldPushContent('head'); ?>

    <!-- Fonts -->
    <!--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/assignation.css')); ?>" rel="stylesheet">
</head>

<body>
    <div id="app" class="">
        <nav class="flex header" style="margin-bottom: 2.5em">
            <img width="260" class=""
                src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png" alt="Logo de l'itemm">
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
        </nav>
        <div class="container">
            <?php echo $__env->yieldPushContent('Explanation'); ?>;
            <?php if(!Route::is("assign.batiment")): ?>
            <h1><?php echo e($nomBatiment[$id]); ?></h1>
            <?php endif; ?>
            <?php if($id  != 0 && $id != '' ): ?>
                    <button id="arrowPrevious" class="arrow left col"></button>
                <?php endif; ?>
            <?php if($id < 7 && !Route::is("assign.batiment")): ?>
                    <button id="arrowNext"  class="arrow right col"></button>
                <?php endif; ?>

            <div class="row align-items-center justify-content-center">

                <canvas class="col" height="<?php echo e($size[1]); ?>" width="<?php echo e($size[0]); ?>" id="canvasDessin"></canvas>
                <div class="control  col">



                            <button id="draw" class="btn btn-primary toggle-label">Dessiner un batiment</button>
                            <button id="remove" class="btn btn-danger toggle-label">Effacer le dessin d'un batiment</button>


                    <?php if($id > 6 || Route::is("assign.batiment")): ?>;
                        <button class="enregistrer toggle-label">Enregistrer</button>
                    <?php endif; ?>
                </div>



            </div>
            <canvas id="hiddenCanvas" style="visibility: collapse"></canvas>
            <!-- modal choix batiment -->
            <div class="modal" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?php echo $__env->yieldPushContent('modal-tittle'); ?></h5>
                    </div>
                    <div class="modal-body">
                        <?php echo $__env->yieldPushContent('modal-body'); ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="modalBtn">Validez</button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</body>
    <?php echo $__env->yieldContent('content'); ?>
</html>
<?php /**PATH /var/www/html/AutomatisationInventaire/resources/views/assignation/layouts.blade.php ENDPATH**/ ?>