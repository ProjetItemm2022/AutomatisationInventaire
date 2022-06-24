@extends('layouts.app')

@section('content')
<title>{{ 'Consultation des stocks' }}</title>
    <body>
        <div id="app" class="">
            <div  class="container blanc">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th  style="background-color: white;">Désignation</th>
                            <th  style="background-color: white;">Référence</th>
                            <th  style="background-color: white;">quantité</th>
                            <th  style="background-color: white;">Localisation</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                pagingType: "input",
                processing: true,
                serverSide: true,
                ajax: '{{ url('getConsultTable') }}',
                columns: [{
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
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `<button onclick="location.href='produitlocation/${data}'">Voir les emplacements</button>`
                        }
                    }

                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
                }

            });
        });
    </script>
@endsection
