<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Connexion' }}</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
</head>

<body id="body">
    <header> <!-- Cette partie correspond à l'en-tête de la page -->
        <nav class="flex header">
            <!--  -->
            <img width="260" src="https://itemm.fr/itemm/wp-content/uploads/2021/05/logo-itemm-2016.png"
                alt="Logo de l'itemm">

        </nav>

    </header>
    </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email">{{ __('Adresse email') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                <div style="color: red">- Lettres + @itemm.fr</div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="password">{{ __('Mot de passe') }}</label>

                        <div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                        </div>
                        <div style="color: red">- Majuscules, minuscules, nombres, caractères spéciaux (@$!%*?&)</div>
                    </div>
                    <br>
                    <div style="text-align: center">
                        <div>
                            <button type="submit" class="bouton">
                                {{ __('Connexion') }}
                            </button>
                            @if (Route::has('forget.password.get'))
                            <a class="btn btn-link" href="{{ route('forget.password.get') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

