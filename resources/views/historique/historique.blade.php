<!DOCTYPE html>
<html>

<head>
    <title>Historique</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
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
  z-index: 3;
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
  height:26px;
  cursor: pointer;
  z-index: 3;
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
  z-index: 2;
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

.titreHistorique {
    width: 100%;
    height: 80px;
    background-color: white;
    font-size: xx-large;
    font-weight: bold;
    text-align: center;
}
    </style>

<script>
    $(function() {
        $('#dataTableHistorique').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url('Historique') }}',
            columns: [
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'nomUser',
                    name: 'nomUser'
                },
                {
                    data: 'prenomUser',
                    name: 'prenomUser'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'nouvelleQuantite',
                    name: 'nouvelleQuantite'
                },
                {
                    data: 'idBoite',
                    name: 'idBoite'
                },

            ],
            order: [
                [0, "desc"]
            ],
            retrieve: true,
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
            }
        });
    });
</script>

<body id="body" class="colorfond" >

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
                    <li><a class="menu__item" href="#" onclick="location='{{ route('index') }}'">Menu</a></li>
                    <li><a class="menu__item" href="href=" {{ route('logout') }} onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ 'Deconnexion' }}</a></li>
                </ul>
            </div>
            <label class="titreHistorique">Historique</label>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </header>
    <div>

    <div style="margin-left: 2%; margin-right: 2%;">
    <table class="table table-bordered display" id="dataTableHistorique" >
        <thead>
            <tr>
                <th style="background-color: white;">Date</th>
                <th style="background-color: white;">Nom</th>
                <th style="background-color: white;">Prenom</th>
                <th style="background-color: white;">Description</th>
                <th style="background-color: white;">Nouvelle quantité saisie</th>
                <th style="background-color: white;">Numéro de la boite</th>
            </tr>
        </thead>
        <tbody>
        </tbody>

    </table>
</div>
</div>
</body>

</html>
