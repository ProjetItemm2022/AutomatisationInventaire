<!DOCTYPE html>
<html>

<head>
    <title>{{ 'Localisation' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/page.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/localisation.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js" defer
        integrity="sha512-nPzvcIhv7AtvjpNcnbr86eT6zGtiudLiLyVssCWLmvQHgR95VvkLX8mMpqNKWs1TG3Hnf+tvHpnGmpPS3yJIgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
                    document.getElementById('logout-form').submit();">{{ 'Déconnexion' }}</a></li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </nav>
    </header>
    <h1>Selectionner un batiment</h1>
    <div>
        <button class="bouton" id="suivant" disabled onclick="location='{{ route('getSalle') }}'">Suivant</button>
        <canvas id="c" height=499 width=696>

    </div>
    <div><textarea name="batimentSelected" id="batimentSelected" cols="30" rows="10">Bâtiment sélectionné : </textarea></div>



    <div class="modal" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Aucun Batiment selectionné
                    </h5>

                </div>
                <div class="modal-body">
                    <p>Veulliez selectionner un batiment</p>
                </div>
                <div class="modal-footer">

                    <button class="bouton close" data-bs-dismiss="modal">oK</button>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        let idz;
        suivant.disabled = true;

        const getData = async (url) => {
            let request = await fetch(url).catch((err) => console.log(err));
            if (request.status === 200) {
                return request.json();
            } else return null;
        };
        fabric.Object.prototype.set({
            transparentCorners: false,
            cornerColor: 'rgba(102,153,255,0.5)',
            cornerSize: 12,
            padding: 5
        });

        // initialize fabric canvas and assign to global windows object for debug
        const Canvas = (await getData("./get/canvasglobal")) ?? [];
        console.log(Canvas);
        let canvas = new fabric.Canvas('c');
        canvas.selection = false;

        canvas.loadFromJSON(Canvas, canvas.renderAll.bind(canvas),(o, obj) => {
            console.log(o);
            obj.lockMovementX = true;
            obj.lockMovementY = true;
            obj.lockRotation = true;
            obj.lockScalingx = true;
            obj.lockScalingY = true;
            obj.lockSkewingX = true;
            obj.lockSkewingY = true;
            obj.lockScalingFlip = true;

        });


        canvas.on("before:transform", function(obj) {
            suivant.disabled = false;
            canvas.getActiveObjects().forEach((obj) => {

                console.log(obj)

                idz = obj.id;
                console.log("id = " + idz);
                console.log('truc');
                //salle(idz);
                //document.getElementById("suivant").onclick = salles();

                if (idz) {

                    $.ajax({
                        type: "GET",
                        url: "{{ url('getBatiment') }}?id=" +idz,
                        success: function(res) {

                            if (res) {

                                console.log(res);

                                document.getElementById("batimentSelected").value = "Bâtiment sélectionné :"+ res;


                            } else {

                                console.log("vide");
                            }
                        }
                    });

                } else {


                }

            });

        });

    </script>
</body>
