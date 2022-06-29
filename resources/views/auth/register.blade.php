<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Ajouter un utilisateur' }}</title>
    <link rel="icon" href="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png">

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/user.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('/css/user.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
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
                            document.getElementById('logout-form').submit();">{{ 'Déconnexion' }}</a></li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        </nav>

    </header>
    </nav>
<label class="titre">Connexion</label>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <label for="privilege_id">{{ __('Privilège') }}</label>
                        <div>
                            <select name="privilege" class="form-select">

                                <option value="2">Gestionnaire</option>
                                <option value="3">Consultant</option>
                            </select>

                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="nom">{{ __('Nom') }}</label>
                        <div>
                            <input pattern="[a-zA-Z]{1,}" id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                        </div>
                        <div style="color: red">- Majuscules et minuscules</div>
                    </div>
                    <br>
                    <div>
                        <label for="prenom">{{ __('Prénom') }}</label>

                        <div>
                            <input id="prenom" pattern="[a-zA-Z]{1,}" type="text" class="form-control @error('prenom') is-invalid @enderror"
                                name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                        </div>
                        <div style="color: red">- Majuscules et minuscules</div>
                    </div>
                    <br>
                    <div>
                        <label for="email">{{ __('Adresse email') }}</label>

                        <div>
                            <input  pattern="[a-z0-9].+gmail.com$" id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                        <div style="color: red">- Lettres + @itemm.fr</div>
                    </div>
                    <br>
                    <div>
                        <label for="password">{{ __('Mot de passe') }}</label>

                        <div>
                            <input id="password" type="password"
                             pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                        </div>
                        <div style="color: red">- Majuscules, minuscules, nombres, caractères spéciaux (@$!%*?&)</div>
                    </div>
                    <br>
                    <div>
                        <label for="password-confirm">{{ __('Confirmation de mot de passe') }}</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                    <br>
                    <div>
                        <div style="text-align: center">
                            <button class="bouton" type="submit">
                                Enregistrement

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
