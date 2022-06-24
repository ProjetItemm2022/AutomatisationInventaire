<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Consultation de Stock</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">

    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts --><!--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->

    <link href="<?php echo e(asset('css/consultation.css')); ?>" rel="stylesheet">
</head>
<style>
    body{
        background-color: #AEDFF4
    }
</style>
<body>
    <div id="app" class="">
        <nav class="flex header">
            <img width="260" class=""src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png" alt="Logo de l'itemm">
            <form action="../menu/">
                <button type="submit" style="margin-right: 10px">
                    <img width="50" class="m-e-1" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1024px-Hamburger_icon.svg.png">
                </button>
            </form>
        </nav>
        <div>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="background-color: white;">Batiment</th>
                        <th style="background-color: white;">Salle</th>
                        <th style="background-color: white;">Zone</th>
                        <th style="background-color: white;">Quantité</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
</html>
<script>
    let index = parseInt(window.location.href.split("/").pop(), 10)
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: `./../getLocalisationTable/${index}`,
            columns: [{
                    data: 'batiment',
                    name: 'Batiment'
                },
                {
                    data: 'salle',
                    name: 'Salle'
                },
                {

                    name: 'zone',
                    data: 'cheminImage',
                    render: function(data,type,row,meta){
                        return `<img src="../${data}">`
                    }
                },
                {
                    data: 'quantite',
                    name :'Quantité'
                }

            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
            }

        });
    });
</script>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/produitLocation.blade.php ENDPATH**/ ?>