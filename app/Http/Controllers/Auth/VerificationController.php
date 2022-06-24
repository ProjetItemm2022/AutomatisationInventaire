<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur est responsable de la gestion de la vérification des
    | e-mails pour tout utilisateur qui s'est récemment inscrit à
    | l'application. Les e-mails peuvent également être renvoyé si
    | l'utilisateur n'a pas reçu l'e-mail d'origine.
    |
    */

    use VerifiesEmails;

    /**
     * Où rediriger les utilisateurs après vérification.
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
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
