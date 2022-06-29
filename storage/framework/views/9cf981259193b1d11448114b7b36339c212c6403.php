<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>delimitation des salles</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.4.0/fabric.min.js" type="text/javascript"></script>
<!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js" defer
        integrity="sha512-nPzvcIhv7AtvjpNcnbr86eT6zGtiudLiLyVssCWLmvQHgR95VvkLX8mMpqNKWs1TG3Hnf+tvHpnGmpPS3yJIgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
-->


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
                <h2>Délimitation des salles pour le batiment <?php echo e($nomBatiment); ?></h2>
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
            <h3>Cliquez  définir des salles</h3>
            <div class="control  row">
                <button id="draw" class="btn btn-primary toggle-label">Dessiner une salle</button>
                <button id="supprimer" class="btn btn-danger toggle-label">Effacer le dessin d'une salle</button>
                <button class="enregistrer toggle-label" onclick="location.replace('<?php echo e(route('assign.salle')); ?>');">Retour</button>
<!--                <button id="tst" class="btn btn-danger toggle-label">afficher salles</button>-->
            <!--<button id="grise" class="btn btn-primary toggle-label">Grise</button>-->
            </div>

            <br/><br/>
            <br/><br/>
                <canvas height="<?php echo e($size[1]); ?>" width="<?php echo e($size[0]); ?>" id="canvas-tools"></canvas>
        </div>
    </div>
    <input type="hidden" id="idBat" value="<?php echo e($id); ?>" />
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
<script>
    var roof = null;
var roofSave = null;
var roofPoints = [];

var lines = [];
var lineCounter = 0;
var drawingObject = {};
drawingObject.type = "";
drawingObject.background = "";
drawingObject.border = "";
var remove = false;
var idsBatDrawn = [];
// canvas Drawing
var canvas = new fabric.Canvas('canvas-tools',
    {
        backgroundImage: "<?php echo e($image); ?>",
        //backgroundImage: "../../images/plan/1rdc.png",
    }
);
var x = 0;
var y = 0;
</script>
    <script src="<?php echo e(asset('js/assignationSalleZoom.js')); ?>" defer type="module"></script>
</body>

</html>
<?php /**PATH /var/www/html/AutomatisationInventaire/resources/views/assignation/sallezoom.blade.php ENDPATH**/ ?>