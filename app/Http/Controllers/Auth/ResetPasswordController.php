<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur est responsable du traitement des demandes de
    | réinitialisation de mot de passe
    | et utilise un trait simple pour inclure ce comportement.
    |
    */



    use ResetsPasswords;

    /**
     * Où rediriger les utilisateurs après avoir réinitialisé leur mot de passe.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

}
