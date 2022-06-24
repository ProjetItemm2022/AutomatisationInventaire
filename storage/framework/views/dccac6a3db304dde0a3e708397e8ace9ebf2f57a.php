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
        margin-bottom: 5em;
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
        <nav class="flex header">
            <img width="260" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                alt="Logo de l'itemm">

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>

    </header>
    <div>
        <div name="menu" id="form1 ">
            <?php if($Idprivilege = 'Administateur'): ?>
                <div class="row">
                    <button type="button" type="submit" style="margin-left: auto">
                        <span>Gérer les Stocks</span>
                    </button>
                    <br><br>

                    <button type="button" style="margin-right: auto" onclick="location='<?php echo e(route('ticket')); ?>'">
                        <span>Générer un ticket (devis)</span>
                    </button>
                </div>
                <br><br>
                <div class="row">
                    <button style="margin-left: auto">
                        <span>Consulter les Stocks</span>
                    </button>
                    <br><br>
                    <button style="margin-right: auto">
                        <span>Visualiser les Statistiques</span>
                    </button>
                </div>
                <br><br>
                <div class="row">
                    <button style="margin-left: auto" onclick="location='<?php echo e(route('assignation')); ?>'">
                        <span>Definir les lieux </span>
                    </button>
                    <br><br>
                    <button onclick="location='<?php echo e(route('user')); ?>'" style="margin-right: auto">
                        <span>Gestion des utilisateurs</span>
                    </button>
                    <br><br>
                </div>
                <br><br>
                <div class="row">
                    <button style="margin: auto auto" id="buttonLogout" href="href=" <?php echo e(route('logout')); ?> onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><?php echo e('Deconnexion'); ?>

                    </button>


                </div>
                <br><br>
            <?php endif; ?>

            <?php if($privilege = 'Gestionnaire' || ($privilege = 'Consultant')): ?>
                <div class="row">
                    <button style="margin: auto auto">
                        <span>Consulter les Stocks</span>
                    </button>
                </div>
                <br><br>
                <div class="row">
                    <button style="margin: auto auto" id="buttonLogout" href="href=" <?php echo e(route('logout')); ?> onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><?php echo e('Deconnexion'); ?>

                    </button>
                </div>
                <br><br>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/menu/menu.blade.php ENDPATH**/ ?>