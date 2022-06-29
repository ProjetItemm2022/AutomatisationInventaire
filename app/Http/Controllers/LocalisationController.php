<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Resources\View\ajouterProduit\index;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\DataTables\ProduitsDataTable;
use App\DataTables\FournisseursDataTable;
use App\Helper\Helper as HelperHelper;
use App\Models\Batiment;
use App\Models\Salle;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use App\Models\Boite;

class LocalisationController extends Controller
{
    public $batiments;
    public $salles;
    public $zones;
    public $produits;
    public $quantite;
    public $categories1;
    public $categories2;
    public $categories3;
    public $boite;
    public $nouvelleQauntite;
    public $img;

    public function index()
    {

        $produits =DB::table("produits")
        ->pluck("nom", "id","quantite");

        $batiments = DB::table('batiments')
        ->pluck("nom","id");
        $salles = DB::table('salles')
        ->pluck("nom","id");
        $zones = DB::table('zones')
        ->pluck("nom","id");

        return View('GestionBoites', compact('produits','batiments','salles','zones'));
    }
    public function localisation()
    {
        $produits =DB::table("produits")
        ->pluck("nom", "id","quantite");

        $categories1 = DB::table("categories")->where("niveau", "=", 1)->pluck("nom", "id");

        //$batiments = DB::table('batiments')->pluck("nom","id","cheminImage");
        $batiments=Batiment::select('id','nom','cheminImage')->get();
        //$salles = DB::table('salles')->pluck("nom","id");
        //$zones = DB::table('zones')->pluck("nom","id");

    return View('ajoutBoites', compact('categories1','produits','batiments'/*,'salles','zones'*/));
    }




    public function getBatiment(request $request)
    {
        $batiments = DB::table('batiments')->pluck("nom","id","cheminImage");
        return response()->json($batiments);

    }

    public function getSalle(request $request)
    {

        $salles = Salle::select("nom","id","cheminImage")->where("batiment_id", "=", $request->id)->get();
        return response()->json($salles);
    }

    public function getZone(request $request)
    {

        $zones = Zone::select("nom","id","cheminLocalisation")->where("salle_id", "=",$request->id)->get();

        return response()->json($zones);

    }
    public function getImgBat(request $request){

    $img = DB::table('batiments')->where("id","=",$request->id)->pluck("cheminImage");
    return response($img);
    }



    //public function salle(request $request)
    //{
    //    $salles = DB::table("salles")
    //    ->where("batiment_id", "=", $request->id)
     //   ->get("nom","id","coordPoint");

      //  return response()->json($salles);
       // return view('GestionBoites', compact('salles'));
    //}


    public function getSub(Request $request)
    {
        $categories2 = DB::table("categories")
        ->where("niveau", "=", 2)
        ->where("parent", "=",$request->id)
        ->pluck("nom", "id");

        return response()->json($categories2);
    }
    public function getSub2(Request $request)
    {
        $categories3 = DB::table("categories")->select("nom", "id")
        ->where("niveau", "=", 3)->where("parent", "=",$request->id);
        return response()->json($categories3);
    }
    public function getProd(Request $request)
    {
        $produits = DB::table("produits")->select(["nom","id","quantite"])->where("categorie_id", "=", $request->id);

        return view("ajoutBoites", compact('produits'));
    }
    public function getQuantite(Request $request)
    {
        $quantite = DB::table("produits")->where("id", "=" , $request->id )->pluck("quantite");
        return response()->json($quantite);
    }
    public function creerBoite(Request $request)
    {
       // $idprod = DB::table("produits")->select('id')->where("nom","=",$request->produit_id)->first();


        Boite::insert(["produit_id"=>$request->produit, "zone_id"=>$request->zone, "quantite"=>$request->quantite]);
        //$produits = Produit::find($request->produit);
        //$produits->quantite = $request->Nouvellequantite;

        Db::table("produits")->where("id", "=" , $request->produit)->update(['quantite' => $request->Nouvellequantite]);
        return view('GestionBoites');
    }

    public function boiteData()
    {

        // Prend les champs de la base de données pour chaque utilisateur enregistrer et retourne dans un tableau

        $boite = Boite::join("produits","boites.produit_id","=","produits.id")
        ->join("zones","boites.zone_id","=","zones.id")
        ->select(['boites.id','zones.nom as nomZone','produits.nom as nomProduit',"boites.quantite"])->get();

        return datatables()
        ->of($boite)
        // renvoie un objet
        ->make(true);


    }
    public function editBoite($id){
        $boite = Boite::find($id);
        $categories1 = DB::table("categories")->where("niveau", "=", 1)->pluck("nom", "id");
        $produits =DB::table("produits")->pluck("nom", "id");
        $batiments=Batiment::select('id','nom','cheminImage')->get();

        return View('modifBoites',compact('boite','categories1','produits','batiments'));

    }

    public function updateBoite(Request $request, $id){
        $boite = Boite::find($id);
        $boite->produit_id = $request->produit;
        $boite->zone_id = $request->zone;
        $boite->quantite = $request->quantite ;
        $boite->update();

        return redirect()->back()->with('status','Student Updated Successfully');
    }


}
