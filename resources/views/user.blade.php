<!Doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Liste des utilisateurs' }}</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/user.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('/css/user.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('UserData') }}',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<input type=\"checkbox\" name=\"checkbox\" value=\"${data}\">`
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<a href="{{ url('editUser/${data}') }}">Modifier</a>`
                        }
                    },
                    {
                        data: 'nom',
                        name: 'nom'
                    },
                    {
                        data: 'prenom',
                        name: 'prenom'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nomPrivilege',
                        name: 'nomPrivilege'
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

<body id="body">
    <header>
        <nav class="flex header">
            <img width="260" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                alt="Logo de l'itemm">
            <div class="hamburger-menu" >
                <input id="menu__toggle" type="checkbox" style="position: fixed" />
                <label class="menu__btn" for="menu__toggle" >
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
    <main class="py-4">
        <div class="justify-content-center ">
            <div class="blanc" style="margin-left: 2%; margin-right: 2%;">
                <input type="button" onclick="location='{{ route('register') }}'" class="bouton"
                    style="margin-right: 10px" value="Ajouter">
                <input type="button" onclick=showModal() class="bouton" style="margin-right: 10px"
                    value="Supprimer">
                <input type="button" onclick=showModal2() class="bouton"
                    value="Restaurer">

                <table class="table table-bordered display" id="dataTable">
                    <thead>
                        <tr>
                            <th id="checkbox" style="background-color: white;"><input id="checkAll" type="checkbox" />
                            </th>
                            <th style="background-color: white;">Modifier</th>
                            <th style="background-color: white;">Nom</th>
                            <th style="background-color: white;">Prénom</th>
                            <th style="background-color: white;">Email</th>
                            <th style="background-color: white;">Privilege</th>
                            <th style="background-color: white;">Actif</th>

                        </tr>
                    </thead>
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
                            <p>Etes-vous sûr de vouloir supprimer ce ou ces utilisateurs ?</p>
                        </div>
                        <div class="modal-footer">

                            <button class="bouton" data-bs-dismiss="modal">Annuler</button>
                            <button class="bouton" onclick=supprimerUtilisateur()>Confirmer</button>

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
                            <p>Etes-vous sûr de vouloir restaurer ce ou ces utilisateurs ?</p>
                        </div>
                        <div class="modal-footer">

                            <button class="bouton" data-bs-dismiss="modal">Annuler</button>
                            <button class="bouton" onclick=restore()>Confirmer</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
