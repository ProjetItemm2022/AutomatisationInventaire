<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e('Ajouter un utilisateur'); ?></title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">

    <!-- Scripts -->
    <script src="<?php echo e(asset('/js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('/js/user.js')); ?>" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="<?php echo e(asset('/css/user.css')); ?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
</head>

<body id="body">
    <header>
        <nav class="flex header">
            <img width="260" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                alt="Logo de l'itemm">

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
                <form method="POST" action="<?php echo e(route('register')); ?>">
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
                            <input pattern="[a-zA-Z]{1,}" id="nom" type="text" class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="nom" value="<?php echo e(old('nom')); ?>" required autocomplete="nom" autofocus>
                        </div>
                        <div style="color: red">- Majuscules et minuscules </div>
                    </div>
                    <br>
                    <div>
                        <label for="prenom"><?php echo e(__('Prénom')); ?></label>

                        <div>
                            <input id="prenom" pattern="[a-zA-Z]{1,}" type="text" class="form-control <?php $__errorArgs = ['prenom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="prenom" value="<?php echo e(old('prenom')); ?>" required autocomplete="prenom" autofocus>
                        </div>
                        <div style="color: red">- Majuscules et minuscules</div>
                    </div>
                    <br>
                    <div>
                        <label for="email"><?php echo e(__('Adresse email')); ?></label>

                        <div>
                            <input  pattern="[a-z0-9].+itemm.fr$" id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                        </div>
                        <div style="color: red">- Lettres + @itemm.fr</div>
                    </div>
                    <br>
                    <div>
                        <label for="password"><?php echo e(__('Mot de passe')); ?></label>

                        <div>
                            <input id="password" type="password"
                             pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                autocomplete="new-password">
                        </div>
                        <div style="color: red">- Majuscules, minuscules, nombres, caractères spéciaux (@$!%*?&)</div>
                    </div>
                    <br>
                    <div>
                        <label for="password-confirm"><?php echo e(__('Confirmation de mot de passe')); ?></label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                    <br>
                    <div>
                        <div style="text-align: center">
                            <button class="bouton" type="submit">
                                Enregistrement

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/auth/register.blade.php ENDPATH**/ ?>