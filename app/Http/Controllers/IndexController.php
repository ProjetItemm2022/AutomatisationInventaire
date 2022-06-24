<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privilege;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $id = Auth::id();
        //Recuperer l'id du privilige
        $idPrivilege = User::where('id',$id)->value('privilege_id');
        //Recuperer la valeur du privilege
        $privilege  = Privilege::where('id',$idPrivilege)->value('nom');
        $id = Auth::id();
        //Recuperer l'id du privilige
        $idPrivilege = User::where('id',$id)->value('privilege_id');
        //Recuperer la valeur du privilege
        switch ($privilege){
            case 'Consultant':
                return redirect('consultstock');
                break;
            case 'Gestionnaire':
                return redirect('consultstock');
                break;

            case 'Administrateur':
                return view('menu/index');
                break;
            }

    }
}
