<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Privilege;
use function PHPSTORM_META\map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserData()
    {

        // Prend les champs de la base de données pour chaque utilisateur enregistrer et retourne dans un tableau

           $users = DB::table("privileges")->join('users', 'privileges.id','=','users.privilege_id')->select("users.id","users.nom","users.prenom","users.email","privileges.nom as nomPrivilege","users.deleted_at")->get();

        return datatables()
        ->of($users)
        // renvoie un objet
        ->make(true);


    }

    public function __invoke()
    {
        return view('/user');
    }

    public function editUser($id){
        $users = User::find($id);
        $privilege = Privilege::find($id);

        return View('ModifierUtilisateur',compact('users'));

    }

    public function updateUser(Request $request, $id){
        $users = User::find($id);
        $users->prenom = $request->input('prenom');
        $users->nom = $request->input('nom');
        $users->email = $request->input('email');
        $users->update();

        return redirect()->back()->with('status','Student Updated Successfully');
    }
}

