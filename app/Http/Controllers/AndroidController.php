<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Boite;
use Illuminate\Support\Facades\DB;
class AndroidController extends Controller
{
/**
 * Display a listing of the ressource
 *
 * @return \Illuminate\Http\Response
 *
 */
    public function index()
    {

    return response()->json(['index'=> 'dans index']);

        }


    public function show($id)
    {
        return response()->json(['show'=> $id]);

        }
    public function store(Request $request)
    {

        if($request->command == "affichageInfos"){
            //Requete BD recuperer nom, description, quantité du produit de l'id reçu
            $affichage=Boite::join("produits","boites.produit_id", "=", "produits.id")
            ->join("zones","boites.zone_id", "=", "zones.id")
            ->select("produits.nom", "produits.description", "boites.quantite", "produits.cheminImage", "zones.cheminLocalisation")
            ->where("boites.id", "=", $request->boiteId)
            ->first();
            if($affichage == null){
                return response()->json(['error'=> "idInvalide"]);
            }else{
                return response()->json(['command'=> $request->command, 'boiteId' => $request->boiteId, 'nom'=>$affichage->nom, 'description'=>$affichage->description, 'quantite'=>$affichage->quantite, 'cheminImage'=>$affichage->cheminImage, 'cheminLocalisation'=>$affichage->cheminLocalisation]);
            }


        }
        if($request->command == "MAJQuantite"){
            //Requete Mise a jour
            //if($infos->quantite < $request->nouvelleQuantite){//non fonctionnelle
            $majQuantite = DB::table('boites')->where('id', $request->boiteId)->update(['quantite' => $request->nouvelleQuantite]);

            //Requete Historique
            DB::table('historiques')->insert(['nouvelleQuantité'=>$request->nouvelleQuantite, 'description'=>'Mise a jour quantite du produit','boite_id'=>$request->boiteId, 'user_id'=>$request->idUser],);
            return response()->json(['command'=>"MAJQuantite",'succes'=>"true"]);

            //return response()->json(['command'=>"MAJQuantite",'succes'=>"false"]);
        }
    }
}
