<!DOCTYPE html>
<html>

<head>
    <title>Menu Assignation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        div > .row {
            margin-right: 0;
        }
        body{
            width: 100%;
            box-sizing: border-box;
            margin: 0 auto;

        }

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

        .header {
            justify-content: space-between;
            align-items: center;
            background-color: #EBEBEB;
            margin-bottom: 5em;
        }

        .flex {
            display: flex;
        }

        span {
            font-size: 30px;
            margin-top: none;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;

        }


        .header {
            justify-content: space-between;
            align-items: center;
            background-color: #EBEBEB;

        }




        #body {
            background-color: #AEDFF4;
        }

        .header>img {
            margin-left: 0.5em;
        }

        #buttonLogout {
            font-size: 30px;
        }

        button > a{
            all: unset
        }
    </style>
</head>

<body class="colorfond">
    <header>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


    </header>
    <div>
        <div name="menu" id="form1">
            <br><br><br>
            <br><br><br>
            <br><br><br>
            <div class="row">
                <button type="button" style="margin-left: auto" onclick="location='{{ route('assign.name') }}'">
                    <span>Nommer les batiments</span>
                </button>
                <br><br>
                <span style="margin-right: 75px"></span>
                <button type="button" style="margin-right: auto" onclick="location='{{ route('assign.batiment') }}'">
                    <span>Délimiter les batiments</span>
                </button>
            </div>
            <br><br>
            <div class="row">
                <button style="margin-left: auto" onclick="location='{{ route('assign.salle') }}'">
                    <span>Délimiter les salles</span>
                </button>
                <br><br>
                <span style="margin-right: 150px; margin-left:150px" id="imgItemm">
                    <img width="250" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                    alt="Logo de l'itemm"></span>
                <button style="margin-right: auto" onclick="location='{{ route('assign.zone') }}'">
                    <span>Délimiter les zones</span>
                </button>
            </div>
            <br><br>
            <div class="row">
                <button style="margin-left: auto" onclick="location='{{ route('index') }}'">
                    <span>Revenir à l'accueil</span>
                </button>
                <span style="margin-right: 75px"></span>
                <button style="margin-right: auto" id="buttonLogout"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ 'Deconnexion' }}
                </button>
                <br><br>
            </div>
        </div>
    </div>
</body>

</html>
