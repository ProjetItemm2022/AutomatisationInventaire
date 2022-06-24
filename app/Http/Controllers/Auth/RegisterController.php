<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'enregistrement des nouveaux utilisateurs ainsi que
    | leur validation et création. Par défaut, ce contrôleur utilise un trait
    | pour fournir cette fonctionnalité sans nécessiter de code supplémentaire.
    |
    */

    use RegistersUsers;

    /**
     * Où rediriger les utilisateurs après l'inscription.
     *
     * @var string
     */
    protected $redirectTo = '/menu/user';

    /**
     * Créez une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Obtenez un validateur pour une demande d'inscription entrante.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'privilege_id'=>['int','min:0','max:2'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Créez une nouvelle instance d'utilisateur après un enregistrement
     * valide.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'privilege_id' => $data['privilege'],
            'password' => Hash::make($data['password']),
        ]);
    }


}
