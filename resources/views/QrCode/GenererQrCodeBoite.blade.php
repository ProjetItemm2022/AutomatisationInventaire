<!DOCTYPE html>
<html>

<head>
    <title>Générer les QrCodes des boites</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('js/qrCode.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('/css/qrcode.css') }}" rel="stylesheet">
</head>


<script>
    $(document).ready(function() {
        $(document).on('click', "#genererQR", function() {

            var options = {
                'backdrop': 'static'
            };
            var tabProd = [];
            $(".checkProd:checked").each(function() {
                tabProd.push($(this).val());
            });
            $('#modalpdf').modal(options);
            var RecupId = $('#RecupIdProduit').empty();
            var i = 0;
            $.each(tabProd, function(i, valId) {
                $('<input/>', {
                    value: valId,
                    name: "produit[" + i + "]",
                    type: 'hidden'
                }).appendTo($("#RecupIdProduit"));
                //i++;
                console.log("id prod : " + valId + "index prod : " + i);
            })
            console.log("generation completed");
        })
    })

    $(function() {
        $('#dataTableQrCode').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ url('ProduitData') }}',
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return '<input type=\"checkbox\" class=\"checkProd\" name=\"checkbox\" value=\"' +
                            data +
                            '\">'
                    }
                },
                {
                    data: 'id',
                    name: 'id'
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

<body id="body">
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
                    <li><a class="menu__item" href="href=" {{ route('logout') }}
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ 'Deconnexion' }}</a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </header>

    <form name=" inscription" id="form1 ">
        <div>
            <label class="gestionQrCode">Générer QrCode</label>


            <div style="margin-left: 2%; margin-right: 2%;">
                <div>
                    <br><br>
                    <input id="genererQR" type="button" onclick="showModal3();" class="bouton" value="Générer QR Code">
                </div>
                <br>

                <table class="table table-bordered display" id="dataTableQrCode">



                    <thead>
                        <tr>
                            <th style="background-color: #E88E73;" id="checkbox" class="checkProd"><input
                                    id="checkAll" type="checkbox" />
                            </th>
                            <th style="background-color: #E88E73;">Boite</th>
                            <th style="background-color: #E88E73;">Zone</th>
                            <th style="background-color: #E88E73;">Produit</th>
                            <th style="background-color: #E88E73;">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>


    </form>
    <div class="modal" id="modalpdf" data-modal-type="genererPDF" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Confirmation de la creation du ou des QrCode(s)
                    </h5>

                </div>
                <div class="modal-body">
                    <p>Etes-vous sûr de vouloir faire des QrCode pour ce ou ces produit(s) ?</p>
                    <form class="form-vertical" method="POST" enctype="multipart/form-data"
                        action="{{ route('downloadQrCode') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <div id="RecupIdProduit">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">





                            <button class="bouton" type="submit"
                                data-loading-text="<i class='fa fa-refresh fa-spin></i>' &nbsp;Chargement">Confirmer</button>
                            <button id="annuler" data-bs-dismiss="modal" style="display: inline;" class="bouton"
                                type="button">Annuler</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
