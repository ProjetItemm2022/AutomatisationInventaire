<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Délimitation des zones</title>
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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/assignation.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="">
        <nav class="flex header" style="margin-bottom: 2.5em">
            <img width="260" class=""
                src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png" alt="Logo de l'itemm">
                <h2>Délimitation des zones des salles d'un batiment</h2>
                <div class="hamburger-menu">
                    <input id="menu__toggle" type="checkbox" />
                    <label class="menu__btn" for="menu__toggle">
                      <span></span>
                    </label>

                    <ul class="menu__box">
                        <li><a class="menu__item" href="#" onclick="location='{{ route('index') }}'">Menu</a></li>
                      <li><a class="menu__item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ 'Déconnexion' }}</a></li>

                    </ul>
                </div>
        </nav>
        <div class="container">
            <h3>Cliquez sur le batiment pour lequel vous souhaitez définir des zones</h3>
        <!--    <div class="control  row">
                <button id="draw" class="btn btn-primary toggle-label">Dessiner une salle</button>
                <button id="supprimer" class="btn btn-danger toggle-label">Effacer le dessin d'une salle</button>

            <button id="grise" class="btn btn-primary toggle-label">Grise</button>-->
            <button class="enregistrer toggle-label" onclick="location.replace('{{ route('assignation') }}');">Retour</button>

    </div>

            <br/><br/>
            <br/><br/>

                <canvas height="{{ $size[1] }}" width="{{ $size[0] }}" id="canvas-tools"></canvas>
<!--
                <img src="./plan/0PlanGeneral.png" class="map" alt="plan" height="{{ $size[1] }}" width="{{ $size[0] }}" usemap="#mapplan"/>
                <map name="mapplan" id="mapplan">
                   <area shape="poly" coords="137,102,395,225,377,242,399,254,333,327,305,312,289,333,28,213,46,195,39,161,71,125,125,121,135,105,135,105,137,102" title="1" href="1.html">
                    <area shape="poly" coords="559,231,580,233,594,237,619,247,627,257,636,270,639,278,638,294,632,297,619,306,612,311,568,315,557,315,535,308,520,302,512,281,510,254,516,241,544,232,557,230,557,230,557,230,557,230,559,231" title="3" href="3.html">
                    <area shape="poly" coords="449,334,448,432,592,432,591,331,591,331,449,334" title="7" href="7.html">

                </map>-->


        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/assignationZone.js') }}" defer type="module"></script>


</body>

</html>
