<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'authentification des utilisateurs pour l'application
    | et les rediriger vers votre écran d'accueil. Le contrôleur utilise un
    | trait pour fournir facilement ses fonctionnalités à vos applications.
    |
    */


    use AuthenticatesUsers;





    /**
     * Où rediriger les utilisateurs après la connexion.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Créez une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    /**
     * Redirection à la page de connexion après déconnexion.
     *
     */
    public function deconnexion()
    {
        auth()->logout();

        return redirect('/login');
    }
}

