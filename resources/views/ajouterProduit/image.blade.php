<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ajout Image</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 45px">
            <div class="col-md-4 col-md-offset-4">
                <h4>Enregistrement fichier</h4>
                <hr>
                <form action="{{ route ('file.upload') }}" method="post" enctype="multipart/form-data"
                onclick="{{ route ('ajout') }}">
                    @csrf
                    <input type="file" name="_file" id="_file" class="form-control" pattern=""/><br>
                    <button type="submit"  class="btn btn-dark btn-block">Ajouter Image</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
