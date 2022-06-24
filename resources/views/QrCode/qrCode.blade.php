<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Générer les QrCodes des boites</title>
    <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>

    <link href="{{ asset('/css/qrcode.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
        body,
        html {
            font-family: "Free Sans";
        }

        .carte {
            border: 5px solid black;
            width: 180px;
            height: 90px;
            text-align: start;
            margin-bottom: 20px;

        }

        b {
            font-size: 42px;
        }

        h2 {
            font-weight: 1000;
        }

        * {

            margin: 2;
            padding: 2;

        }

        .wrapper {
            display: inline-grid;
            grid-template-columns: repeat(3, 105px);

        }

    </style>
</head>

<body>
    <table>

    @php $cpt=0; @endphp
    @foreach ($boitesProduits as $boiteProduit)
    @if ($cpt==0)
        <tr>
    @endif
            <td>
  <!--  <div class="wrapper">-->

            <div class="carte">
                <table>
                    <tr>

                        <td> <img src="{{ url('') . $boiteProduit[0]->cheminQrCode }}" alt="img" /></td>
                        <td>
                            <div>
                                <span
                                    style="  font-size:8px; float:right; margin-top:0px">{{ $boiteProduit[0]->nom }}</span>
                            </div>
                            <div>
                                <span
                                    style="  font-size:8px;">{{ $boiteProduit[0]->nomZone }}</span>
                            </div>
                        </td>

                    </tr>

                </table>
            </div>

   <!-- </div>-->
</td>
    @if ($cpt==3)
</tr>
@endif
@php
$cpt=$cpt+1;
if ($cpt==3) $cpt=0;
@endphp
@endforeach
</table>

</body>

</html>
