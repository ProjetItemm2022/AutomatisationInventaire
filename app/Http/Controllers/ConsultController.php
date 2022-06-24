<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use App\Models\Boite;
use App\Models\Produit;
use App\Models\Salle;
use App\Models\Zone;
use stdClass;

class ConsultController extends Controller
{
    public function getConsultTableData(){
        return datatables()->of(Produit::get(['nom','ref','quantite','id']))->make(true);
    }

    //prend en parametre l'id d'un produit
    public function getLocalisationTableData($id){
        //initialisation tu tableau de données
        $data = [];
        //obtenir chaque emplacement ainsi que la quantité disponible à celui-ci
        $produits = Boite::where('produit_id','=',$id)->get();

        //pour chaque emplacement

        foreach ($produits as $key => $produit) {
            // obtenir l'id de la zone
            $zoneID = Boite::where('id',$produit->id)->pluck('zone_id');
            // obtenir l'id de la salle et le chemin de l'image de la zone
            $zone = Zone::where('id',$zoneID)->get(['salle_id','cheminLocalisation']);
            // obtenir le nom de la salle et l'id du bâtiment
            $salle = Salle::where('id',$zone[0]->salle_id)->get(['nom','batiment_id']);
            // obtenir le nom du batiment
            $batiment = Batiment::where('id',$salle[0]->batiment_id)->pluck('nom');
            // création de l'objet qui contient les données de la ligne
            $obj = new stdClass();
            //remplissage de l'objet
            $obj->quantite = $produit->quantite;
            $obj->cheminImage = $zone[0]->cheminLocalisation;
            $obj->batiment = $batiment[0];
            $obj->salle = $salle[0]->nom;
            $data[$key] = $obj;
        }
        //retourner le tableau sous format d'objet
        return datatables()->of($data)->make(true);

    }

    public function produitLocalisation($id){
        return view('produitLocation',['productId'=>$id]);
    }

    public function __invoke()
    {
        return view('stock/consultation');
    }


}
