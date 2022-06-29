<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e('Modifier un utilisateur'); ?></title>
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
            <div class="hamburger-menu">
                <input id="menu__toggle" type="checkbox" style="position: fixed" />
                <label class="menu__btn" for="menu__toggle">
                    <span></span>
                </label>
                <ul class="menu__box">
                    <li><a class="menu__item" href="#" onclick="location='<?php echo e(route('index')); ?>'">Menu</a></li>
                    <li><a class="menu__item" href="href=" <?php echo e(route('logout')); ?>

                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><?php echo e('Deconnexion'); ?></a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </nav>

    </header>
    </nav>

    <main class="py-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="<?php echo e(url('updateUser/' . $users->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="privilege_id"><?php echo e(__('Privilège')); ?></label>
                        <div>
                            <select name="privilege" class="form-select">

                                <option value="2">Gestionnaire</option>
                                <option value="3">Consultant</option>
                            </select>

                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="nom"><?php echo e(__('Nom')); ?></label>
                        <div>
                            <input pattern="[a-zA-Z]{1,}" id="nom" type="text"
                                class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="nom"
                                value="<?php echo e($users->nom); ?>" required autocomplete="nom" autofocus>
                        </div>

                        <div style="color: red">- Majuscules et minuscules</div>
                    </div>

                    <br>
                    <div>
                        <label for="prenom"><?php echo e(__('Prénom')); ?></label>

                        <div>
                            <input id="prenom" pattern="[a-zA-Z]{1,}" type="text"
                                class="form-control <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="prenom"
                                value="<?php echo e($users->prenom); ?>" required autocomplete="prenom" autofocus>
                        </div>
                        <div style="color: red">- Majuscules et minuscules</div>
                    </div>
                    <br>
                    <div>
                        <label for="email"><?php echo e(__('Adresse email')); ?></label>

                        <div>
                            <input pattern="[a-z0-9].+itemm.fr$" id="email" type="email"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                value="<?php echo e($users->email); ?>" required autocomplete="email">
                        </div>
                        <div style="color: red">- Lettres +@itemm.fr</div>
                    </div>
                    <br>
                    <div>
                        <div style="text-align: center">
                            <button class="bouton" type="submit" name="send">Modifier</button>
                        </div>
                        <div style="text-align: center">
                            <a href="<?php echo e(route('user')); ?>" style=" margin-left:198px; display:block; text-decoration: none ; color:black " class="bouton">Retour</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/AutomatisationInventaire/resources/views/ModifierUtilisateur.blade.php ENDPATH**/ ?>