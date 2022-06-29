<?php $__env->startSection('content'); ?>
<main class="login-form">
  <div style="margin-top:20px ">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Réinitialisation du mot de passe</div>
                  <div class="card-body">

                    <?php if(Session::has('message')): ?>
                         <div class="alert alert-success" role="alert">
                            <?php echo e(Session::get('message')); ?>

                        </div>
                    <?php endif; ?>

                      <form action="<?php echo e(route('forget.password.post')); ?>" method="POST">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Adresse email</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  <?php if($errors->has('email')): ?>
                                      <span class="text-danger">L'e-mail est invalide </span>
                                  <?php endif; ?>
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="bouton">
                                  Envoie du lien de réinitialisation
                              </button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/AutomatisationInventaire/resources/views/auth/forgetPassword.blade.php ENDPATH**/ ?>