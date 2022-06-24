<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e('Réinitialisation du mt de passe'); ?></title>
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
            <button>
                <img width="50" class="m-e-1"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1024px-Hamburger_icon.svg.png">
                <span class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <?php echo e(__('Deconnexion')); ?>

                </span>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </button>

        </nav>

    </header>
    </nav>

    <main class="py-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <div class="container">
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <?php echo e($error); ?>

            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
         </div>
        <?php endif; ?>
        <?php if(session()->get('message')): ?>
        <div class="alert alert-success" role="alert">
          <strong>Success: </strong><?php echo e(session()->get('message')); ?>

        </div>
        <?php endif; ?>
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header"><?php echo e(Auth::user()->nom); ?>'s Profile</div>

                      <div class="card-body">
                          <?php if(session('status')): ?>
                              <div class="alert alert-success" role="alert">
                                  <?php echo e(session('status')); ?>

                              </div>
                          <?php endif; ?>
                          <?php if($message = Session::get('success')): ?>
                            <div class="alert alert-success">
                         <p><?php echo e($message); ?></p>
                            </div>
                         <?php endif; ?>
                          <form action="<?php echo e(route('home')); ?>" method="POST">
                          <?php echo csrf_field(); ?>
                             <div class="form-group">
                                 <label for="name"><strong>Name:</strong></label>
                                 <input type="text" class="form-control" id ="name" name="name" value="<?php echo e(Auth::user()->name); ?>">
                             </div>
                              <div class="form-group">
                                 <label for="email"><strong>Email:</strong></label>
                                 <input type="text" class="form-control" id ="email" value="<?php echo e(Auth::user()->email); ?>" name="email">
                             </div>
                              <button class="btn btn-primary" type="submit">Update Profile</button>
                         </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</body>

</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>