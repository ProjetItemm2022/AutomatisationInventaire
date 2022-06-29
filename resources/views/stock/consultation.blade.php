@extends('layouts.app')

@section('content')
<title>{{ 'Consultation des stocks' }}</title>
    <body>
        <div id="app">
            <div  class=" blanc" style="margin: 20px 20px">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th  style="background-color: grey;">Désignation</th>
                            <th  style="background-color: grey;">Référence</th>
                            <th  style="background-color: grey;">Quantité</th>
                            <th  style="background-color: grey;">Localisation</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
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
                            return `<button class="bouton2" style="visibility: visible;margin:auto auto; display:block; text-decoration: none ; color:black;" onclick="location.href='produitlocation/${data}'">Voir les emplacements</button>`
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
