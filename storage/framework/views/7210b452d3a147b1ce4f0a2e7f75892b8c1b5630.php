<!DOCTYPE html>
<html>

<head>
    <title><?php echo e('Ticket'); ?></title>
    <link href="<?php echo e(asset('css/page.css')); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        // Mettez le code javascript ici.
        $(document).ready(function() {
            $(".addBouton").click(function() {
                var nom = $("#nom").val();
                var reference = $("#reference").text();
                var fournisseur = $("#fournisseur").val();
                var quantite = $("#quantite").val();
                var ligne = "<tr><td><input type='checkbox' name='select'></td><td>" + nom + "</td><td>" +
                    reference + "</td><td>" + fournisseur + "</td><td>" + quantite + "</td></tr>";
                $("table.ticket_table").append(ligne);
            });
            $(".delete").click(function() {
                var rowCount = $("#Table_id tr").length;
                //alert(rowCount);

                if (rowCount === 1) {
                    alert("Aucun objet dans le tableau!!");
                } else {
                    var result = confirm("Etes vous sur de vouloir supprimer");
                    if (result) {
                        $("table.ticket_table").find('input[name="select"]').each(function() {
                            if ($(this).is(":checked")) {
                                $(this).parents("table.ticket_table tr").remove();
                            }
                        });
                        alert("Supprimé!!");
                    } else {

                        alert("Annulé!!");
                    }
                }
            });
            $(".generer").click(function() {
                var rowCount = $("#Table_id tr").length;
                //alert(rowCount);

                if (rowCount === 1) {
                    alert("Aucun objet dans le tableau!!");
                } else {}
            });


        });

        function Confirm() {



        }
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
    <div class="dropdown">
        <label for="cat">Categorie:</label>
        <select id="categorie" name="categorie" class="form-control">
            <option value="" selected disabled>Selectionner une categorie</option>
            <?php $__currentLoopData = $categories4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat1 => $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat1); ?>"> <?php echo e($categorie); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="dropdown">
        <label for="cat2">Sous categorie:</label>
        <select name="subcat" id="subcat" class="form-control"></select>
    </div>
    <div class="dropdown">
        <label for="cat3">Sous categorie 2:</label>
        <select name="subcat2" id="subcat2" class="form-control"></select>
    </div>
    <div class="dropdown">
        <label for="Prod">Produit:</label>
        <select name="Prod" id="Prod" class="form-control">
            <?php $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod => $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <option value="<?php echo e($prod); ?>"> <?php echo e($produit); ?></option>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

    </div>

    <script>
        // when categorie dropdown changes
        $('#categorie').change(function() {

            var catID = $(this).val();
            //console.log(catID);

            if (catID) {

                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('getSub')); ?>?id=" + catID,
                    success: function(res) {

                        if (res) {

                            $("#subcat").empty();
                            $("#subcat").append('<option>Selectionner une sous-catégorie</option>');
                            $.each(res,
                                function(cat1, value) {
                                    $("#subcat").append('<option value="' + cat1 + '">' + value +
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




        $('#subcat').change(function() {

            var subCatID = $(this).val();
            console.log(subCatID);

            if (subCatID) {

                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('getSub2')); ?>?id=" + subCatID,
                    success: function(res) {

                        if (res) {

                            $("#subcat2").empty();
                            $("#subcat2").append('<option>Selectionner une sous-catégorie 2</option>');
                            $.each(res,
                                function(cat1, value) {
                                    $("#subcat2").append('<option value="' + cat1 + '">' + value +
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


        $('#subcat2').change(function() {

            var subCat2ID = $(this).val();
            console.log(subCatID2);

            if (subCatID2) {

                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('getProd')); ?>?id=" + subCatID2,
                    success: function(res) {

                        if (res) {

                            $("#Prod").empty();
                            $("#Prod").append('<option>Selectionner une sous-catégorie 2</option>');
                            $.each(res,
                                function(prod, value) {
                                    $("#Prod").append('<option value="' + prod + '">' + value +
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
    </script>


    <script>
            $('#Prod').change(function() {
                var txt = ($(this).text());
                var nom = $(this).text();
                var reference = $("#reference").text();
                var fournisseur = $("#fournisseur").val();
                var quantite = $("#quantite").val();
                var ligne = "<tr><td><input type='checkbox' name='select'></td><td>" + nom + "</td><td>" +
                    reference + "</td><td>" + fournisseur + "</td><td>" + quantite + "</td></tr>";
                $("table.ticket_table").append(ligne);

            });
        })
    </script>

    <br>
    <!--<input type="button" class="addBouton" value="Ajouter une ligne">-->
    <table id="Table_id" class="ticket_table">
        <tr>
            <th input type='checkbox'></th>
            <th>Nom</th>
            <th>reference</th>
            <th>fournisseur</th>
            <th>quantité</th>
        </tr>

    </table>

    <button type="button" class="delete"><img width="50"
            src="https://static.vecteezy.com/ti/vecteur-libre/t2/630479-poubelle-icone-symbole-illustration-gratuit-vectoriel.jpg"></button>
    <div id="download" class="text-center">
        <input type="button" class="generer" value="Generer PDF">
        <script>
            //$(document).ready(function(){}
        </script>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/Ticket.blade.php ENDPATH**/ ?>