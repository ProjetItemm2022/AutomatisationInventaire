<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Historique;

class HistoriqueController extends Controller
{
public function __invoke()
    {
        return view('historique/historique');
    }

public function Historique(){
    $histo = Historique::join("users","historiques.user_id","=","users.id")->select(['historiques.created_at as date','users.nom as nomUser','users.prenom as prenomUser',"historiques.description as description","historiques.nouvelleQuantité as nouvelleQuantite","historiques.boite_id as idBoite"])->get();

    return datatables()
    ->of($histo)
    // renvoie un objet
    ->make(true);
}


}
