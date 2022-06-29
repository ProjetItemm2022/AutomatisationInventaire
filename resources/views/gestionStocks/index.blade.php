<style>
    .color {
        background-color: #AEDFF4;
    }

    td {
        background-color: white;
        border-collapse: collapse;
        border: 1px solid black;
    }

    th {
        background-color: #E88E73;
        border: 1px solid black;
    }

    .colorGrey {
        color: grey;
    }

    .gestionStocks {
        width: 100%;
        height: 80px;
        background-color: white;
        font-size: xx-large;
        font-weight: bold;
        text-align: center;


    }

    .buttonAction {
        margin-top: 10px;
        margin-right: 10px;
        float: right;
    }

    .header {
        justify-content: space-between;
        align-items: center;
        background-color: #EBEBEB;

    }

    .flex {
        display: flex;
    }

    .bouton {
        background-color: #E88E73;
        width: 150px;
        margin-top: 10px;
        margin-bottom: 10px;
        border-color: black;
        font-weight: bold;
    }

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
    <title>Gestion des Stocks</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/produit.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        $(function() {
            $('#dataTable').dataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('getTableData') }}',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<input type=\"checkbox\" name=\"checkbox\" value=\"${data}\">`
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<a class="bouton" style="margin:auto auto; text-align: center; display:block;  text-decoration: none ; color:black;" href="{{ url('edit/${data}') }}">Modifier</a>`
                        }
                    },
                    {
                        data: 'nom',
                        name: 'nom'
                    },
                    {
                        data: 'ref',
                        name: 'ref'
                    },
                    {
                        data: 'quantite',
                        name: 'quantite'
                    },
                    {
                        data: 'deleted_at',
                        name: 'actif',
                        render: function(data) {
                            console.log(data);
                            if (data === null) {
                                return '✔️';
                            } else return '❌'
                        }
                    },

                ],
                order: [
                    [1, "asc"]
                ],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, ],
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
        <div>
            <label class="gestionStocks">Gestion des Stocks</label>
            <div>
                <br><br>
                <input type="button" onclick="location='{{ route('ajout') }}'" class="bouton" value="Ajouter"
                    style="margin-left: 10px">
                <input type="button" onclick=showModal() class="bouton" value="Supprimer">
                <input type="button" onclick=showModal2() class="bouton" value="Restaurer">

            </div>
        </div>
        <br>
        <div class="container">
            <div>

                <table cellspacing="5" cellpadding="5" class="table table-bordered display" id="dataTable"
                    name="produits">



                    <thead>
                        <tr>
                            <th style="background-color: grey;" id="checkbox"><input id="checkAll" type="checkbox" />
                            </th>
                            <th style="background-color: grey;">Modifier</th>
                            <th style="background-color: grey;">Désignation</th>
                            <th style="background-color: grey;">Référence</th>
                            <th style="background-color: grey;">Quantité</th>
                            <th style="background-color: grey;">Actif</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="modal" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Confirmation de la suppression
                            </h5>

                        </div>
                        <div class="modal-body">
                            <p>Etes-vous sûr de vouloir supprimer ce ou ces produits ?</p>
                        </div>
                        <div class="modal-footer">

                            <button class="bouton" data-bs-dismiss="modal">Annuler</button>
                            <button class="bouton" onclick=supprimerProduits()>Confirmer</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal2" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Confirmation de la Restauration
                            </h5>

                        </div>
                        <div class="modal-body">
                            <p>Etes-vous sûr de vouloir restaurer ce ou ces produits ?</p>
                        </div>
                        <div class="modal-footer">

                            <button class="bouton" data-bs-dismiss="modal">Annuler</button>
                            <button class="bouton" onclick=restore()>Confirmer</button>

                        </div>
                    </div>
                </div>
            </div>




        </div>


        <script>
            //--------------------------------------------------------------------------------- Filtrage des Produits
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
                                $("#subcat").append('<option>Selectionner la sous categorie </option>')
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
         /*// when Sous-categorie 1 dropdown changes
          $('#subcat2').change(function() {
            $("#dataTable").empty();

              var subCatID2 = $(this).val();
              console.log(subCatID2);

              if (subCatID2) {

                  $.ajax({
                      type: "GET",
                      url: "{{ url('getSub5') }}?id=" + subCatID2,
                      success: function(res) {

                          if (res) {

                              $("#dataTable").empty();
                              res.forEach(element => {
                                  $("#dataTable").append('<option value="' + element.id + '">' +
                                      element.nom +
                                      '</option>');
                              });

                          } else {

                              $("#dataTable").empty();
                          }
                      }
                  });
              } else {
                  $("#dataTable").empty();
              }
          });*/
        </script>

</body>

</html>
