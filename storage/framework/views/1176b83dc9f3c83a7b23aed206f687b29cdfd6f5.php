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

    /* Sidenav menu */
.sidenav {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: -250px;
  background-color: #e8e8e8;
  padding-top: 60px;
  transition: left 0.5s ease;
}

/* Sidenav menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #111;
}

.sidenav ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}


#menu__toggle {
  opacity: 0;
}
#menu__toggle:checked + .menu__btn > span {
  transform: rotate(45deg);
}
#menu__toggle:checked + .menu__btn > span::before {
  top: 0;
  transform: rotate(0deg);
}
#menu__toggle:checked + .menu__btn > span::after {
  top: 0;
  transform: rotate(90deg);
}
#menu__toggle:checked ~ .menu__box {
  right: 0 !important;
}
.menu__btn {
  position: fixed;
  top: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  cursor: pointer;
  z-index: 1;
}
.menu__btn > span,
.menu__btn > span::before,
.menu__btn > span::after {
  display: block;
  position: absolute;
  width: 100%;
  height: 2px;
  background-color: #616161;
  transition-duration: .25s;
}
.menu__btn > span::before {
  content: '';
  top: -8px;
}
.menu__btn > span::after {
  content: '';
  top: 8px;
}
.menu__box {
  display: block;
  position: fixed;
  top: 0;
  right: -100%;
  width: 300px;
  height: 100%;
  margin: 0;
  padding: 80px 0;
  list-style: none;
  background-color: #ECEFF1;
  box-shadow: 2px 2px 6px rgba(0, 0, 0, .4);
  transition-duration: .25s;
}
.menu__item {
  display: block;
  padding: 12px 24px;
  color: #333;
  font-family: 'Roboto', sans-serif;
  font-size: 20px;
  font-weight: 600;
  text-decoration: none;
  transition-duration: .25s;
}
.menu__item:hover {
  background-color: #CFD8DC;
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

<div class="hamburger-menu">
    <input id="menu__toggle" type="checkbox" />
    <label class="menu__btn" for="menu__toggle">
      <span></span>
    </label>

    <ul class="menu__box">
      <li><a class="menu__item" href="href=" <?php echo e(route('logout')); ?> onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"><?php echo e('Deconnexion'); ?></a></li>
    </ul>
  </div>



            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </nav>








    </header>
    <div>
        <div name="menu" id="form1 ">
            <?php if($Idprivilege = 'Administateur'): ?>
                <div class="row">
                    <button style="margin-left: auto" onclick="location='<?php echo e(route('gestionStocks')); ?>'">
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
        </div>
    </div>
</body>

</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/menu/admin.blade.php ENDPATH**/ ?>