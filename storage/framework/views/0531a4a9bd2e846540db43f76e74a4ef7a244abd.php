<style>
    button {
        background-color: #E88E73;
        border-width: 5px;
        border-color: black;
        width: 300px;
        height: 100px;
    }

    .colorfond {
        background-color: #AEDFF4;
    }

    .colormenu {
        background-color: #E88E73;
    }

    .colorWhite {
        background-color: white;
    }

    .colorGrey {
        color: grey;
    }

    div>.row {
        margin-right: 0%;
    }

    span {
        font-size: 30px;

    }

    .header {
        justify-content: space-between;
        align-items: center;
        background-color: #EBEBEB;
        margin-bottom: 2em;
    }

    .header>img {
        margin-left: 0.5em;
    }

    #buttonLogout {
        font-size: 30px;
    }

    button>a {
        all: unset
    }

     #imgItemm{
         text-align: center;
         margin: center;
     }


</style>



<!DOCTYPE html>
<html>

<head>
    <title>Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
</head>

<body class="colorfond">
    <header>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
    </header>
    <div name="menu" id="form1 ">
        <?php if($Idprivilege = 'Administateur'): ?>
    <br>
    <br>
    <br>
            <div class="row">
                <button style="margin-left: auto" onclick="location='<?php echo e(route('gestionStocks')); ?>'">
                    <span>Gérer les Stocks</span>
                </button>
                <br><br>
                <span style="margin-right: 75px"></span>
                <button onclick="location='<?php echo e(route('user')); ?>'" style="margin-right: auto">
                    <span>Gestion des utilisateurs</span>
                </button>
            </div>
            <br><br>
            <div class="row">

                <button onclick="location='<?php echo e(route('GestionBoites')); ?>'" style="margin-left: auto">
                    <span>Gestion des boites</span>
                </button>
                <br><br>
                <span style="margin-right: 300px"></span>
                <button onclick="location='<?php echo e(route('GenererQrCodeBoite')); ?>'" style="margin-right: auto">
                    <span>Gestion des QrCodes</span>
                </button>
            </div>
            <br><br>
            <div class="row">
                <button style="margin-left: auto" onclick="location='<?php echo e(route('assignation')); ?>'">
                    <span>Definir les lieux </span>
                </button>
                <br><br>
                <span style="margin-right: 150px; margin-left:150px" id="imgItemm">
                    <img width="250" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                    alt="Logo de l'itemm"></span>
                    <button type="button" style="margin-right: auto" onclick="location='<?php echo e(route('consult')); ?>'">
                        <span>Consulter les Stocks</span>
                    </button>

                <br><br>
            </div>
            <br><br>
            <div class="row">
                <button style="margin-left: auto" onclick="location='<?php echo e(route('ticket')); ?>'">

                    <span>Générer un ticket (devis)</span>
                </button>
                <br><br>
                <span style="margin-right: 300px"></span>
                <button style="margin-right: auto">
                    <span>Visualiser les Statistiques</span>
                </button>
                <br><br>
            </div>
            <br><br>
            <div class="row">
                <button onclick="location='<?php echo e(route('historique')); ?>'" style="margin-left: auto">
                    <span>Historique</span>
                </button>
                <br><br>
                <span style="margin-right: 75px"></span>
                <button style="margin-right: auto" id="buttonLogout" href="href=" <?php echo e(route('logout')); ?> onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><?php echo e('Déconnexion'); ?>

                </button>
                <br><br>
            </div>
            <br><br>
        <?php endif; ?>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/AutomatisationInventaire/resources/views/menu/index.blade.php ENDPATH**/ ?>