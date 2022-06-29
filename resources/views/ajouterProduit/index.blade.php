<style>
    button {
        background-color: #E88E73;
        margin-top: 10px;
        margin-bottom: 10px;
        border-color: black;
        font-weight: bold;
    }

    .color {
        background-color: #AEDFF4;
    }

    td {
        background-color: white;
        border-collapse: collapse;
        border: 1px solid black;
    }

    h1 {
        color: black;
    }

    .colorGrey {
        color: grey;
    }

    .header {
        justify-content: space-between;
        align-items: center;
        background-color: #EBEBEB;

    }

    .flex {
        display: flex;
    }

    #container ul li:hover {
        background-color: #85C1E9;
    }

    #container ul ul {
        display: none;
    }

    #container ul li:hover>ul {
        display: block;
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

    #menu__toggle:checked+.menu__btn>span {
        transform: rotate(45deg);
    }

    #menu__toggle:checked+.menu__btn>span::before {
        top: 0;
        transform: rotate(0deg);
    }

    #menu__toggle:checked+.menu__btn>span::after {
        top: 0;
        transform: rotate(90deg);
    }

    #menu__toggle:checked~.menu__box {
        right: 0 !important;
    }

    .menu__btn {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        cursor: pointer;
        z-index: 2;
    }

    .menu__btn>span,
    .menu__btn>span::before,
    .menu__btn>span::after {
        display: block;
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #616161;
        transition-duration: .25s;
    }

    .menu__btn>span::before {
        content: '';
        top: -8px;
    }

    .menu__btn>span::after {
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
        z-index: 1;
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
    <title>Ajout de Produit</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/produit.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('images/produits') }}" defer></script>

</head>

<body class="color">
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
                            document.getElementById('logout-form').submit();">{{ 'Déconnexion' }}</a></li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </header>
    <div>
        <br>
        <div class="row mx-2">
            <div class="col-sm-4" style="margin: auto">
                <form action="{{ route('categorie.ajout') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button name="addCategorie" onclick=showModal() class="form-label">Ajouter une
                        Categorie</button>
                    <div class="modal" id="modal" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Ajout d'une nouvelle categorie
                                    </h5>
                                </div>
                                <div>
                                    <label for="">Selectionner le type de categories à ajouter : </label>
                                    <div>
                                        <select id="niveau" name="niveau" class="form-label mx-4" required>
                                            <option value="" selected disabled>Niveau de la Categorie</option>
                                            <option value="1">Categorie</option>
                                            <option value="2">Sous Categorie 1</option>
                                            <option value="3">Sous Categorie 2</option>
                                        </select>
                                        <select id="addCategorie" name="parent" class="form-label mx-4">
                                            <option value="" selected disabled>Selectionner la Categorie</option>
                                        </select>
                                        <select id="subcat4" name="parent" class="form-label mx-4">
                                            <option value="" selected disabled>Selectionner la Sous-Categorie</option>
                                        </select>

                                    </div>
                                </div>
                                <div>
                                    <label>Entrer le nom : </label>
                                    <input id="nom" type="text" class="form-control" name="nom" required
                                        autocomplete="newCategorie" autofocus>
                                </div>

                                <div class="modal-footer">
                                    <button class="bouton" data-bs-dismiss="modal">Annuler</button>
                                    <button class="bouton" type="submit">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <form action="{{ route('fournisseur.ajout') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button name="addFournisseur" onclick=showModal2() class="form-label">Ajouter un Fournisseur</button>
                    <div class="modal" id="modal2" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Ajout d'un nouveau fournisseur
                                    </h5>
                                </div>
                                <div>
                                    <label>Entrer le nom du nouveau fournisseur : </label>
                                    <input id="nom" type="text" class="form-control" name="nom" required
                                        autocomplete="newFournisseur" autofocus>
                                </div>
                                <div class="modal-footer">
                                    <button class="bouton" data-bs-dismiss="modal">Annuler</button>
                                    <button class="bouton" type="submit">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <form method="post" action="{{ action('App\Http\Controllers\GererStocks@ajout') }}"
            enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row mx-2">
                <select id="categorie" name="categorie_id" class="form-label mx-4" style="position: relative;
                       display: inline-block;
                       left: 25%;
                       transform: translateX(-50%);
                       -webkit-transform: translateX(-50%);" required>
                    <option value="" selected disabled>Selectionner une categorie</option>
                    @foreach ($categories as $cat1 => $categorie)
                        <option value="{{ $cat1 }}"> {{ $categorie }}</option>
                    @endforeach
                </select>
                <select name="categorie_id" id="subcat" class="form-label mx-4" style="position: relative;
                       display: inline-block;
                       left: 25%;
                       transform: translateX(-50%);
                       -webkit-transform: translateX(-50%);">
                    <option value="" selected disabled>Selectionner la sous-categorie 1</option>
                </select>
                <select name="categorie_id" id="subcat2" class="form-label mx-4" style="position: relative;
                       display: inline-block;
                       left: 25%;
                       transform: translateX(-50%);
                       -webkit-transform: translateX(-50%);">
                    <option value="" selected disabled>Selectionner la sous-categorie 2</option>
                </select>
            </div>

            <br><br>

            <div class="row mx-2">
                <table style="border-collapse: collapse; border: 1px solid black; margin: 0px auto">
                    <tbody>
                        <div>
                            <tr>
                                <td>
                                    <h3>Nom</h3>
                                </td>
                                <td style="width: 700px">
                                    <input id="nom" type="text" class="form-control" name="nom" required
                                        autocomplete="nom" autofocus placeholder="*Obligatoire">
                                    <!-- Error -->
                                    @if ($errors->has('nom'))
                                        <div class="error">
                                            {{ $errors->first('nom') }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        </div>
                        <div>
                            <tr>
                                <td>
                                    <h3>Reference</h3>
                                </td>
                                <td>
                                    <input id="ref" type="text" class="form-control" name="ref">
                                    <!-- Error -->
                                    @if ($errors->has('ref'))
                                        <div class="error">
                                            {{ $errors->first('ref') }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        </div>

                        <div class="dropdown">
                            <tr>
                                <td>
                                    <h3>Fournisseur</h3>
                                </td>
                                <td>
                                    <select class="form-control" name="produit_id" id="produit_id" required>
                                        <option selected disabled>Choisir le fournisseur</option>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}
                                            </option>
                                        @endforeach
                                    </select>

                                </td>

                            </tr>
                        </div>

                        <div>
                            <tr>
                                <td>
                                    <h3>Quantité</h3>
                                </td>
                                <td>
                                    <input id="quantite" type="text" class="form-control" name="quantite" required
                                        autocomplete="quantite" autofocus placeholder="*Obligatoire"
                                        pattern="[0-9]{1,}">
                                    <!-- Error -->
                                    @if ($errors->has('quantite'))
                                        <div class="error">
                                            {{ $errors->first('quantite') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </div>
                        <div>
                            <tr>
                                <td>
                                    <h3>Quantité d'alerte</h3>
                                </td>
                                <td>
                                    <input id="seuilAlerte" type="text" class="form-control" name="seuilAlerte"
                                        required autocomplete="seuilAlerte" autofocus placeholder="*Obligatoire"
                                        pattern="[0-9]{1,}">
                                    <!-- Error -->
                                    @if ($errors->has('seuilAlerte'))
                                        <div class="error">
                                            {{ $errors->first('seuilAlerte') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </div>
                        <div>
                            <tr>
                                <td>
                                    <h3>N° d'immobilisation</h3>
                                    <h3>N° de bon</h3>
                                    <h3>N° d'inventaire</h3>
                                </td>
                                <td>
                                    <input id="numBon" type="text" class="form-control" name="numBon">
                                    <!-- Error -->
                                    @if ($errors->has('numBon'))
                                        <div class="error">
                                            {{ $errors->first('numBon') }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        </div>
                        <div>
                            <tr>
                                <td>
                                    <br>
                                    <h3>Description</h3>
                                    <br>
                                </td>
                                <td>
                                    <input id="description" type="text" class="form-control" name="numBon">
                                    <!-- Error -->
                                    @if ($errors->has('description'))
                                        <div class="error">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        </div>
                        <div>
                            <tr>
                                <td>
                                    <br>
                                    <h3>Image</h3>
                                    <br>
                                </td>
                                <td>
                                    <input type="file" name="cheminImage" id="cheminImage" class="form-control" />
                                    <!-- Error -->
                                    @if ($errors->has('cheminImage'))
                                        <div class="error">
                                            {{ $errors->first('cheminImage') }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        </div>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row">
                <button type="submit" name="send" style="margin: auto auto">Ajouter le Produit</button>
            </div>
        </form>

    </div>

    <br><br><br>

    <script>
        // ----------------- Selection de Fournisseur
        $(document).ready(function() {
            $('.dropdown-fournisseurs li a').on('click', function() {
                console.log("TEST");
                var categories = $("#fournisseurs").val();
            });
        })
    </script>

    <script>
        // ----------------- Selection de categorie
        $(document).ready(function() {
            $('.dropdown-categories li a').on('click', function() {
                console.log("TEST");
                var categories = $("#categories").val();
            });
        })
    </script>


    <script>
        //--------------------------------------------------------------------------------- Pour l'ajout d'un Produit
        // when categorie dropdown changes
        $('#categorie').change(function() {
            $("#subcat").empty();
            $("#subcat2").empty();


            var catID = $(this).val();
            //console.log(catID);

            if (catID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getSub') }}?id=" + catID,
                    success: function(res) {

                        if (res) {

                            $("#subcat").empty();
                            res.forEach(element => {
                                $("#subcat").append('<option value="' + element.id + '">' +
                                    element.nom +
                                    '</option>');
                            });

                        } else {

                            $("#subcat").empty();
                        }
                    }
                });
            } else {

                $("#subcat").empty();
                $("#subcat2").empty();

            }
        });

        // when Sous-categorie dropdown changes
        $('#subcat').change(function() {
            $("#subcat2").empty();

            var subCatID = $(this).val();
            console.log(subCatID);

            if (subCatID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getSub2') }}?id=" + subCatID,
                    success: function(res) {

                        if (res) {

                            $("#subcat2").empty();
                            res.forEach(element => {
                                $("#subcat2").append('<option value="' + element.id + '">' +
                                    element.nom +
                                    '</option>');
                            });

                        } else {

                            $("#subcat2").empty();
                        }
                    }
                });
            } else {
                $("#subcat2").empty();
            }
        });


        //--------------------------------------------------------------------------------- Ajout d'une Categorie
        //------------------------- Categorie selon le niveau
        $('#niveau').change(function() {
            $("#addCategorie").empty();
            $("#subcat4").empty();

            var niveau = $(this).val();
            console.log(niveau);

            // selon le niveau choise la categorie

            if (niveau == 1) {
                $("#addCategorie").empty();
                $("#subcat4").empty();
            }
            if (niveau == 2) { // ----------------------- Si niveau = 2, afficher seulement la categorie
                $.ajax({
                    type: "GET",
                    url: "{{ url('getSub3') }}?niveau=" + niveau,
                    success: function(res) {

                        if (res) {

                            $("#addCategorie").empty();
                            res.forEach(element => {
                                $("#addCategorie").append('<option value="' + element.id +
                                    '">' +
                                    element.nom +
                                    '</option>');
                            });

                        } else {

                            $("#addCategorie").empty();
                        }
                    }
                });
            }
            if (niveau ==
                3) { // --------------------- sinon (niveau = 3), afficher la categorie  et la sous categorie

                $.ajax({
                    type: "GET",
                    url: "{{ url('getSub3') }}?niveau=" + niveau,
                    success: function(res) {

                        if (res) {

                            $("#addCategorie").empty();
                            res.forEach(element => {
                                $("#addCategorie").append('<option value="' + element.id +
                                    '">' +
                                    element.nom +
                                    '</option>');
                            });

                        } else {

                            $("#addCategorie").empty();
                        }
                    }
                });

                $('#addCategorie').change(function() {
                    $("#subcat4").empty();

                    var addCatID = $(this).val();
                    console.log(addCatID);

                    if (addCatID) {

                        $.ajax({
                            type: "GET",
                            url: "{{ url('getSub4') }}?id=" + addCatID,
                            success: function(res) {

                                if (res) {

                                    $("#subcat4").empty();
                                    res.forEach(element => {
                                        $("#subcat4").append('<option value="' + element
                                            .id + '">' +
                                            element.nom +
                                            '</option>');
                                    });

                                } else {

                                    $("#subcat4").empty();
                                }
                            }
                        });
                    } else {

                        $("#subcat4").empty();

                    }
                })
            }
        });
    </script>

</body>

</html>
