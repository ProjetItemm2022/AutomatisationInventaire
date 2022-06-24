<!DOCTYPE html>
<html>

<head>
    <title>{{ 'Modification-Boites' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/page.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/GestionBoites.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js" defer
        integrity="sha512-nPzvcIhv7AtvjpNcnbr86eT6zGtiudLiLyVssCWLmvQHgR95VvkLX8mMpqNKWs1TG3Hnf+tvHpnGmpPS3yJIgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="{{ asset('/css/boites.css') }}" rel="stylesheet">

</head>

<body id="body">
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
                    <li><a class="menu__item" href="#" onclick="location='{{ route('index') }}'">Menu</a></li>
                    <li><a class="menu__item" href="href=" {{ route('logout') }} onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ 'Deconnexion' }}</a></li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </nav>
    </header>
    <form method="post" action="{{ url('updateBoite/' . $boite->id) }}">
        @csrf
        @method('PUT')
        @csrf
        <h1 class="titre">Modifier la boite</h1>
        <div style="margin-left: 2%; margin-right: 2%;">
            <div class="dropdown">
                <label for="cat">Categorie:</label>
                <br>
                <select id="categorie" name="categorie" class="btn btn-secondary dropdown-toggle">
                    <option value="" selected disabled>Selectionner une categorie</option>
                    @foreach ($categories1 as $cat1 => $categorie)
                        <option value="{{ $cat1 }}"> {{ $categorie }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Dropdown sous-categories-->
            <div class="dropdown">
                <label for="cat2">Sous categorie:</label>
                <br>
                <select name="subcat" id="subcat" class="btn btn-secondary dropdown-toggle">
                </select>
            </div>
            <!-- Dropdown sous-categories2-->
            <div class="dropdown">
                <label for="cat3">Sous categorie 2:</label>
                <br>
                <select name="subcat2" id="subcat2" class="btn btn-secondary dropdown-toggle">
                </select>
            </div>
            <br>
            <!-- Dropdown produits-->
            <div class="dropdown">
                <b><label for="produit">Produit:</label></b>
                <br>
                <select name="produit" id="produit_id" class="btn btn-secondary dropdown-toggle">
                    <option value="" selected disabled>Selectionner un Produit</option>
                    @foreach ($produits as $prod => $produit)
                        <option value="{{ $prod }}"> {{ $produit }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <!--Dropdown Batiment-->
            <div class="dropdown">
                <label for="bat">Batiment :</label>
                <br>
                <select name="batiment" id="batiment_id" class="btn btn-secondary dropdown-toggle">
                    <option value="" selected disabled>Selectionner un batiment</option>
                    @foreach ($batiments as $bat => $batiment)
                        <option value="{{ $bat }}"> {{ $batiment }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown salle-->
            <div class="dropdown">
                <label for="salle">Salle :</label>
                <br>
                <select name="salle" id="salle_id" class="btn btn-secondary dropdown-toggle"></select>
            </div>
            <!-- Dropdown zone-->
            <div class="dropdown">
                <label for="zone">Zone :</label>
                <br>
                <select name="zone" id="zone_id" class="btn btn-secondary dropdown-toggle"></select>
            </div>
            <br><br>
            <div class="centre">
                <label for="ObjectSelected">Action : </label>
                <br>
                <textarea name="ObjectSelected" id="ObjectSelected" cols="30" rows="3" readonly class="bolder"></textarea>
            </div>
            <div class="centre">
                <label for="Quantité">Quantité : </label>
                <br>
                <input type='number' id='quantite' name='quantite' value='1' min='1' max='100' required>

            </div>
            <br>
            <div class="centre">
                <button type="submit" class="bouton" name="send" style="margin: auto auto">Creer boite</button>
            </div>

        </div>
    </form>

    <script>
        $(document).ready(function() {

            $('#categorie').change(function() {
                $("#produit_id").empty();  // vide le dropdown des produit
                $("#subcat2").empty();   // vide le dropdown des sous-categories2


                var catID = $(this).val();
                console.log(catID);
                var machine = $('#categorie').val();

                // Fonction qui permet de charger les produits qui appartiennent a la categorie machine
                if (machine === '1') {
                    if (catID) {

                        $.ajax({
                            type: "GET",
                            url: "{{ url('getProd') }}?id=" + catID,
                            success: function(res) {

                                //Ajout des produits qui correspondent à la selection

                                if (res) {
                                    console.log(res);
                                    $("#produit_id").append(
                                    '<option selected disabled >Selectionner un Produit</option>');
                                    $.each(res,
                                        function(prod, value) {
                                            $("#produit_id").append('<option value="' +
                                                prod +
                                                '">' +
                                                value +
                                                '</option>');
                                        });

                                } else {
                                    $("#produit_id").empty();  // vide le dropdown des produit
                                }
                            }
                        });

                    } else {

                        $("#subcat").empty();  // vide le dropdown des sous-categories
                        $("#subcat2").empty();  // vide le dropdown des sous-categories2
                        $("#produit_id").empty();  // vide le dropdown des produit
                    }
                } else {
                    // Fonction qui permet de charger les Sous-categories qui appartiennent a la categorie choisie
                    if (catID) {

                        $.ajax({
                            type: "GET",
                            url: "{{ url('getSub') }}?id=" + catID,
                            success: function(res) {

                                if (res) {

                                    $("#subcat").empty();  // vide le dropdown des sous-categories
                                    //Ajout des sous-categories qui correspondent à la selection
                                    $("#subcat").append(
                                        '<option selected disabled >Selectionner une sous-catégorie</option>');
                                    res.forEach(element => {
                                        $("#subcat").append('<option value="' + element
                                            .id +
                                            '">' +
                                            element.nom +
                                            '</option>');
                                    });

                                } else {

                                    $("#subcat").empty();  // vide le dropdown des sous-categories
                                }
                            }
                        });

                    } else {

                        $("#subcat").empty();  // vide le dropdown des sous-categories
                        $("#subcat2").empty();  // vide le dropdown des sous-categories2
                    }
                }
            });



            // when Sous-categorie dropdown changes
            $('#subcat').change(function() {
                $("#subcat2").empty();
                $("#produit_id").empty();  // vide le dropdown des produit

                var subCatID = $(this).val();
                console.log(subCatID);
                // Fonction qui permet de charger les Sous-categories2 qui appartiennent a la sous-categorie choisie
                if (subCatID) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getSub2') }}?id=" + subCatID,
                        success: function(res) {

                            if (res) {
                                console.log(res);

                                $("#subcat2").empty();  // vide le dropdown des sous-categories2
                                //Ajout des sous-categories2 qui correspondent à la selection
                                $("#subcat2").append(
                                    '<option selected disabled >Selectionner une sous-catégorie 2</option>');
                                res.forEach(element => {
                                    $("#subcat2").append('<option value="' + element
                                        .id + '">' +
                                        element.nom +
                                        '</option>');

                                });


                            } else {

                                $("#subcat2").empty(); // vide le dropdown des sous-categories2
                            }
                        }
                    });

                } else {

                    $("#subcat2").empty();  // vide le dropdown des sous-categories2
                }
            });


            $('#subcat2').change(function() {

                var subCat2ID = $(this).val();
                console.log(subCat2ID);

                // Fonction qui permet de charger les produits qui appartiennent a la sous-categorie choisie
                if (subCat2ID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('getProd') }}?id=" + subCat2ID,
                        success: function(res) {

                            if (res) {

                                $("#produit_id").empty();  // vide le dropdown des produits
                                //Ajout des produits qui correspondent à la selection
                                $("#produit_id").append(
                                    '<option selected disabled >Selectionner un Produit</option>');
                                $.each(res,
                                    function(prod, value) {
                                        $("#produit_id").append('<option value="' + prod +
                                            '">' +
                                            value +
                                            '</option>');
                                    });

                            } else {

                                $("#produit_id").empty();  // vide le dropdown des produits
                            }
                        }
                    });
                } else {

                    $("#produit_id").empty();  // vide le dropdown des produits
                }
            });


            //affiche sur la console la valeur de la selection du dropdown des produits
            $('#produit_id').change(function() {
                var idProd = $(this).val();
                console.log(idProd);




            });



            $('#batiment_id').change(function() {
                $("#salle_id").empty(); // vide le dropdown des salles
                $("#zone_id").empty();  // vide le dropdown des zones
                var batID = $(this).val();
                console.log(batID);

                // Fonction qui permet de charger les salles qui appartiennent au batiment choisi
                if (batID) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getSalle') }}?id=" + batID,
                        success: function(res) {

                            if (res) {
                                $("#salle_id").empty();  // vide le dropdown des salles
                                //Ajout des salles qui correspondent à la selection
                                $("#salle_id").append(
                                    '<option>Selectionner une salle</option>');
                                $.each(res,
                                    function(bat, value) {
                                        $("#salle_id").append('<option value="' + bat +
                                            '">' + value + '</option>');
                                    });

                            } else {

                                $("#salle_id").empty();  // vide le dropdown des salles
                            }
                        }
                    });

                } else {
                    $("#salle_id").empty();  // vide le dropdown des salles
                    $("#zone_id").empty();  // vide le dropdown des zones
                }

            });



            $('#salle_id').change(function() {
                $("#zone_id").empty();  // vide le dropdown des zones

                var salleID = $(this).val();
                console.log(salleID);

                // Fonction qui permet de charger les zones qui appartiennent à la salle choisie
                if (salleID) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getZone') }}?id=" + salleID,
                        success: function(res) {

                            if (res) {

                                $("#zone_id").empty();  // vide le dropdown des zones
                                //Ajout des zones qui correspondent à la selection
                                $("#zone_id").append(
                                    '<option>Selectionner une zone</option>');

                                res.forEach(element => {
                                    $("#zone_id").append('<option value="' + element
                                        .id + '">' + element.nom + '</option>');
                                });
                            } else {

                                $("#zone_id").empty(); // vide le dropdown des zones
                            }
                        }
                    });

                } else {

                    $("#zone_id").empty();  // vide le dropdown des zones
                }
            });

            $('#zone_id').change(function() {
                var idzone = $(this).val();
                console.log(idzone);
            });
        });
    </script>
</body>

