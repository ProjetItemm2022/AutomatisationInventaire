<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e('Liste des utilisateurs'); ?></title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">

    <!-- Scripts -->
    <script src="<?php echo e(asset('/js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('/js/user.js')); ?>" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="<?php echo e(asset('/css/user.css')); ?>" rel="stylesheet">
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
                ajax: '<?php echo e(url('getTableData')); ?>',
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<input type=\"checkbox\" name=\"checkbox\" value=\"${data}\">`
                        }
                    },

                    {
                        data: 'id',
                        name: 'id'
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
                        data: 'privilege_id',
                        name: 'privilege'
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
            <button>
                <img width="50" class="m-e-1"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1024px-Hamburger_icon.svg.png">
                <span class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <?php echo e(__('Deconnexion')); ?>

                </span>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </button>
        </nav>

    </header>
    <main class="py-4">
        <div class="justify-content-center ">
            <div class="blanc" style="margin-left: 2%; margin-right: 2%;">
                <input type="button" onclick="location='<?php echo e(route('register')); ?>'" class="bouton"
                    style="margin-right: 10px" value="Ajouter">
                <input type="button" onclick=showModal() class="bouton" style="margin-right: 10px"
                    value="Supprimer">

                <input type="button" id="modifiezUtilisateur" class="bouton" style="margin-left: -4px"
                    value="Modifier">
                <table class="table table-bordered display" id="dataTable">
                    <thead>
                        <tr>
                            <th id="checkbox" style="background-color: white;"><input id="checkAll" type="checkbox" />
                            </th>
                            <th style="background-color: white;">Id</th>
                            <th style="background-color: white;">Nom</th>
                            <th style="background-color: white;">Prénom</th>
                            <th style="background-color: white;">Email</th>
                            <th style="background-color: white;">Privilege</th>

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
                            <p>Etes-vous sûr de vouloir supprimer ce ou ces articles ?</p>
                        </div>
                        <div class="modal-footer">

                            <button class="bouton" onclick="location='<?php echo e(route('user')); ?>'">Annulez</button>
                            <button class="bouton" onclick=supprimerUtilisateur()>Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views////user.blade.php ENDPATH**/ ?>