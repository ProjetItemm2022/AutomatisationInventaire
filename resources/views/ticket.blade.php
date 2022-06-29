<!DOCTYPE html>
<html>

<head>
    <title>{{ 'Ticket' }}</title>
    <link href="{{ asset('css/page.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/ticket.js') }}" defer></script>
    <script src="{{ asset('/js/app.js') }}" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".addBouton").click(function() {
                $("#subcat").empty();

                $("#subcat2").empty();
                $("#Prod").empty();

            });


            // button delete click
        });

        function Confirm() {



        }
        $("#generer").click(function() {
            alert("Aucun objet dans le tableau!!");
            var rowCount = $("#Table_id tr").length;

            if (rowCount === 1) {
                alert("Aucun objet dans le tableau!!");
            }
        });
    </script>
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
                    <li><a class="menu__item" href=" {{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ 'Déconnexion' }}</a></li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </nav>
    </header>
    <div>
    <label class="titre">Demande de matériel ( Ticket )</label>
    </div>
    <br>
        <!-- Dropdown pour le choix des categories et du produit -->
        <div style="margin-left: 2%; margin-right: 2%;">
        <!-- Dropdown categories-->
        <div class="dropdown">
            <label for="categorie">Categorie:</label>
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
            <label for="subcat">Sous categorie:</label>
            <br>
            <select name="subcat" id="subcat" class="btn btn-secondary dropdown-toggle">
            </select>
        </div>
       <!-- Dropdown sous-categories2-->
        <div class="dropdown">
            <label for="subcat2">Sous categorie 2:</label>
            <br>
            <select name="subcat2" id="subcat2" class="btn btn-secondary dropdown-toggle">
            </select>
        </div>
        <!-- Dropdown produits-->
        <div class="dropdown">
            <label for="Prod">Produit:</label>
            <br>
            <select name="Prod" id="Prod" class="btn btn-secondary dropdown-toggle">
                <option value="pro" selected disabled>Selectionner un Produit</option>
                @foreach ($produits as $prod => $produit)
                    <option value="{{ $prod }}"> {{ $produit }}</option>
                @endforeach
            </select>
        </div>

        <br><br>
        <!-- Bouton pour ajouter dans le tableau le produit selectionné-->
        <button class="AjouterBouton">Ajouter le produit</button>
        <button class="bouton" onclick=verifEffacer()>Supprimer</button>




        <br>
        <!--<input type="button" class="addBouton" value="Ajouter une ligne">-->
        <form  class="form-vertical" method="GET" enctype="multipart/form-data" id="convert"
        action="{{ route('downloadTicket') }}">{{ csrf_field() }}
        <table id="Table_id" class="ticket_table">
            <tr>
                <th style="background-color: grey;"> <input type='checkbox' /></th>

                <th style="background-color: grey;">Nom</th>
                <th style="background-color: grey;">Réference</th>
                <th style="background-color: grey;" >Fournisseur</th>
                <th style="background-color: grey;">Quantité</th>
            </tr>

        </table>
        <div class="centre">
            <button class="bouton" data-loading-text="<i class='fa fa-refresh fa-spin></i>' &nbsp;Chargement" type="submit" style="margin: auto auto">Générer</button>
            <br><br>
            <a href="" class="bouton" id="ticketGenere" style="visibility: visible;margin:auto auto; display:block; text-decoration: none ; color:black; " target="_blank">Afficher ticket</a>
        </div>
    </form >

        </div>
        <textarea name="reference" id="reference" style="display:none;"></textarea>



    <div class="modal" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Confirmation de la Suppression
                    </h5>

                </div>
                <div class="modal-body">
                    <p>Etes-vous sûr de vouloir supprimer ce ou ces produits ?</p>
                </div>
                <div class="modal-footer">

                    <button class="bouton close" data-bs-dismiss="modal">Annuler</button>
                    <button class="bouton" data-bs-dismiss="modal" onclick=effacer()>Confirmer</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal2" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Aucun produit dans le tableau
                    </h5>

                </div>
                <div class="modal-body">
                    <p>Veuillez ajouter au moins un produit dans le tableau</p>
                </div>
                <div class="modal-footer">

                    <button class="bouton close" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal3" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Aucun produit selectionné dans le tableau
                    </h5>

                </div>
                <div class="modal-body">
                    <p>Veuillez selectioner au moins un produit dans le tableau</p>
                </div>
                <div class="modal-footer">

                    <button class="bouton close" data-bs-dismiss="modal">OK</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal4" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Aucun produit selectionné
                    </h5>

                </div>

                <div class="modal-body">
                    <p>Veuillez selectioner au moins un produit</p>
                </div>
                <div class="modal-footer">

                    <button class="bouton close" data-bs-dismiss="modal">OK</button>

                </div>
            </div>
        </div>
    </div>
</body>
    <script>
        $(document).ready(function() {
            $("#convert").submit(function(event){
                event.preventDefault();
                var dataTab= [];
                $("#Table_id tr").each(function(index){
                    if (index!=0){
                    var nom=$(this).find("td:nth-child(2)").text();
                    var ref=$(this).find("td:nth-child(3)").text();
                    var four=$(this).find("td:nth-child(4)").find("select").find("option:selected").text();
                    var qte=$(this).find("td:nth-child(5)").find("input").val();
                    var obj={
                        'nom' : nom,
                        'reference' : ref ,
                        'fournisseur' : four,
                        'quantite' : qte
                };
                    dataTab.push(obj);
                }

                });
                /*
                $("#Table_id tr").each(function(){
                    console.log("in each "+$(this).html());
                });*/

                console.log("submit tabeau");
                console.log(dataTab);
                $.ajax({
                    url: "{{ url('downloadTicket')  }}",
                    data:{
                        dataTab//"coucou"//$("#Table_id").html()
                    },
                    type : 'GET',
                    dataType:'json',
                    success:
                    function(donnees)
                    {
                        console.log(donnees);
                        console.log("lien  : "+donnees.lien);
                        $("#ticketGenere").attr("href",donnees.lien);
                        console.log("generation pdf : ");
                    },
                    error :
                    function(){
                        console.log("pb");
                    }

                });


            });

            var num = 0;
            // when categorie dropdown changes

            $('#categorie').change(function() {
                $("#Prod").empty();
                $("#subcat2").empty();


                var catID = $(this).val();
                //console.log(catID);
                var machine = $('#categorie').val();
                if(machine === '1' )
                {
                    if (catID) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getProd') }}?id=" + catID,
                        success: function(res) {

                            if (res) {


                                $.each(res,
                                    function(prod, value) {
                                        $("#Prod").append('<option value="' + prod + '">' +
                                            value +
                                            '</option>');
                                    });

                            } else {

                                $("#Prod").empty();
                            }
                        }
                    });

                } else {

                    $("#subcat").empty();
                    $("#subcat2").empty();
                }
                } else {
                if (catID) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getSub') }}?id=" + catID,
                        success: function(res) {

                            if (res) {

                                $("#subcat").empty();
                                $("#subcat").append(
                                    '<option selected disabled >Selectionner une sous-catégorie</option>');
                                res.forEach(element => {
                                    $("#subcat").append('<option value="' + element.id +
                                        '">' +
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
            }
            });



            // when Sous-categorie dropdown changes
            $('#subcat').change(function() {
                $("#subcat2").empty();
                $("#Prod").empty();

                var subCatID = $(this).val();
                console.log(subCatID);

                if (subCatID) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getSub2') }}?id=" + subCatID,
                        success: function(res) {
                            reference
                            if (res) {

                                $("#subcat2").empty();
                                $("#subcat2").append(
                                    '<option selected disabled >Selectionner une sous-catégorie 2</option>');

                                res.forEach(element => {
                                    $("#subcat2").append('<option value="' + element
                                        .id + '">' +
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

            // when Sous-categorie 2 dropdown changes
            $('#subcat2').change(function() {

                var subCat2ID = $(this).val();
                console.log(subCat2ID);

                if (subCat2ID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('getProd') }}?id=" + subCat2ID,
                        success: function(res) {

                            if (res) {

                                $("#Prod").empty();
                                $("#Prod").append(
                                    '<option selected disabled >Selectionner un Produit</option>');
                                $.each(res,
                                    function(prod, value) {
                                        $("#Prod").append('<option value="' + prod + '">' +
                                            value +
                                            '</option>');
                                    });

                            } else {

                                $("#Prod").empty();
                            }
                        }
                    });
                } else {

                    $("#Prod").empty();
                }
            });
            // when produit dropdown changes
            $('#Prod').change(function() {
                var pro= $('#Prod').val();
                console.log(pro);
                if(pro){
                    $.ajax({
                        type: "GET",
                        url: "{{ url('getReference') }}?id=" + pro,
                        success: function(res) {
                        console.log(res);
                        var ref =res;
                        //console.log($('#reference').text());
                        $('#reference').empty();
                        $('#reference').append(ref);

                        }
                    });

                } else {

                }

            });
    $(".AjouterBouton").click(function() {
    var selection = $('#Prod').val();
    console.log(selection);

   // console.log($("#Table_id")

    if(selection === null)//test si il y a un produit selectionné dans le dropdown des produits
    {
        console.log("vide")
        showModal4();
    }
    else
    {
        num = num +1;
        var test = $('#Prod :selected').val();
        console.log(test);

        var ProdId = $('#Prod :selected').val();

            var nom = $('#Prod :selected').text();
            console.log(nom);

            var reference = $("#reference").text();
            var fournisseur = $("#fournisseur").val();
            var ligne = "<tr id='ligne"+ num +"'><td><input type='checkbox' name='select'></td><td>" + nom +"</td><td>" +
                reference + "</td><td><select id='fournisseur' name='fournisseur' class='btn btn-secondary dropdown-toggle' ><option value=''>Aucun</option>@foreach ($fournisseurs as $four => $fournisseur)<option value='{{ $four }}''> {{ $fournisseur }}</option>@endforeach</select></td><td><input type='number' id='quantite' name='quantite'  value='1' min='1' max='100' required></td></tr>";
            $("table.ticket_table").append(ligne);
    }
});


        });
    </script>
