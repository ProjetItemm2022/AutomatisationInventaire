<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur est responsable de la gestion des confirmations de
    | mot de passe et utilise un trait simple pour inclure le comportement.
    |
    */

    use ConfirmsPasswords;

    /**
     * Où rediriger les utilisateurs lorsque l'URL prévue échoue.
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
        $this->middleware('auth');
    }
}
