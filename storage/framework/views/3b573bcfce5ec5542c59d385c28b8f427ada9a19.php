<!DOCTYPE html>
<html style="overflow:hidden;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e('Réinitialisation du mot de passe'); ?></title>
        <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">

        <!-- Scripts -->
        <script src="<?php echo e(asset('/js/app.js')); ?>" defer></script>
        <script src="<?php echo e(asset('/js/user.js')); ?>" defer></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="<?php echo e(asset('/css/user.css')); ?>" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />

    </head>
    <body id="body">
        <header>
            <nav class="flex header">
                <img width="260" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                    alt="Logo de l'itemm">
                <div class="hamburger-menu" >
                    <input id="menu__toggle" type="checkbox" style="position: fixed" />
                    <label class="menu__btn" for="menu__toggle" >
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

        </header>
    </body>
<?php echo $__env->yieldContent('content'); ?>

</body>
</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/layout.blade.php ENDPATH**/ ?>