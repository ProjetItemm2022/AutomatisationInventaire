<!DOCTYPE html>
<html>

<head>
    <title>{{ 'Gestion des boites' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/page.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/GestionBoites.js') }}" defer></script>

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
    <h1 class="titre">Gestion des boites</h1>
    <form name=" inscription" id="form1 ">
        <div>

            <div style="margin-left: 2%; margin-right: 2%;">
                <input type="button" class="bouton" onclick="location='{{ route('ajoutBoites') }}'" value="Ajouter">
                <br>

                <table class="table table-bordered display" id="dataTableBoites">



                    <thead>
                        <tr>
                            <th style="background-color: grey;" id="checkbox"><input
                                    id="checkAll" type="checkbox" />
                            </th>
                            <th style="background-color: grey;">zone</th>
                            <th style="background-color: grey;">Produit</th>
                            <th style="background-color: grey;">Quantite</th>
                            <th style="background-color: grey;">Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        </div>


    </form>
    <script>
        $(function() {
            $('#dataTableBoites').dataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('boiteData') }}',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<input type=\"checkbox\" name=\"checkbox\" value=\"${data}\">`
                        }

                    },

                    {
                        data: 'nomZone',
                        name: 'nomZone'
                    },
                    {
                        data: 'nomProduit',
                        name: 'produit'
                    },
                    {
                        data: 'quantite',
                        name: 'quantite'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<a href="{{ url('editBoite/${data}') }}">Modifier</a>`
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
