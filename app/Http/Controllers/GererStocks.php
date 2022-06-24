<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Resources\View\ajouterProduit\index;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\DataTables\ProduitsDataTable;
use App\DataTables\FournisseursDataTable;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;

class GererStocks extends Controller
{
    public function gestionStocks(){
        $produits = Produit::get("id","nom","ref","quantite","seuilAlerte","numBon","description","categorie_id");

        $categories = DB::table("categories")->where("niveau", "=", 1)->pluck("nom", "id");

        //------ Faire une jointure entre categorie_id, produit et categorie, pour le filtre.

        return View('gestionStocks.index',compact('categories','produits'));
    }

    public function ajout(){

        $fournisseurs = DB::table("fournisseurs")->select("id","nom")->get();

        $categories = DB::table("categories")->where("niveau", "=", 1)->pluck("nom", "id");

        return View('ajouterProduit.index',compact('fournisseurs','categories'));
    }

    public function edit($id){
        $produits = Produit::find($id);

        $fournisseurNom = Fournisseur::find($id);

       // $categorie = Categorie::get("id","nom");

        $fournisseurs = DB::table("fournisseurs")->select("id","nom")->get();

        $categories = DB::table("categories")->where("niveau", "=", 1)->pluck("nom", "id");

        //------- Faire jointure entre categorie et produit pour le filtre
        //------- Faire jointure entre Fournisseur et produit

        return View('modifierProduit.index',compact('fournisseurs','categories','produits','fournisseurNom'));
    }

    public function update(Request $request, $id){
        $produits = Produit::find($id);
        $produits->nom = $request->input('nom');
        $produits->ref = $request->input('ref');
        $produits->quantite = $request->input('quantite');
        $produits->seuilAlerte = $request->input('seuilAlerte');
        $produits->numBon = $request->input('numBon');
        $produits->description = $request->input('description');
        $produits->cheminImage = $request->input('cheminImage');
        $produits->update();

        /*$categorie = Categorie::find($id);
        $categorie->nom = $request->input('nom');
        $categorie->update();*/

        /*$fournisseurNom = Fournisseur::find($id);
        $fournisseurNom->nom = $request->input('fournisseur');
        $fournisseurNom->update();*/

        return redirect()->back()->with('status','Student Updated Successfully');
    }

    // Filtre

    public function getSub(Request $request)
    {
        $sousCategories1 = Categorie::where("niveau", "=", 2)->where("parent", "=",$request->id)->get(["nom", "id"]);
        return response()->json($sousCategories1);
    }

    public function getSub2(Request $request)
    {
        $sousCategories2 = Categorie::where("niveau", "=", 3)->where("parent", "=",$request->id)->get(["nom", "id"]);
        return response()->json($sousCategories2);
    }
    public function getSub5(Request $request)
    {
        $produits = Produit::where("categorie_id", "=",$request->id)->pluck(["nom", "id","ref","quantite",'deleted_at']);
        return response()->json($produits);
    }

    // Ajout de categories

    public function getSub3(Request $request)
    {
        $addCategories = Categorie::where("niveau", "=", 1)->get(["nom", "id"]);
        return response()->json($addCategories);
    }
    public function getSub4(Request $request)
    {
        $addSousCategories1 = Categorie::where("niveau", "=", 2)->where("parent", "=",$request->id)->get(["nom", "id"]);
        return response()->json($addSousCategories1);
    }

    public function create(Request $request)
        {

            // Form validation
             $this->validate($request, [
                'nom' => 'required',
                'quantite' => 'required',
                'seuilAlerte' => 'required',
                'cheminImage' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

             ]);
             // Pour Image
             if ($request->cheminImage != ""){
                $path = 'images/produits';
                $newname = Helper::renameFile($path, $request->file('cheminImage')->getClientOriginalName());
                $upload = $request->cheminImage->move(public_path($path), $newname);
             }

      // Pour Produit
      //  Store data in database

      'App\Models\Produit'::create($request->all());
      //------------------------------------------------------------------ La meme chose
          /*  Produit::create([
            'nom' => $request->nom,
            'quantite' => $request->quantite,
            'seuilMin' => $request->naseuilMinme,
            'seuilAlerte' => $request->seuilAlerte,
            'ref' => $request->ref,
            'description' => $request->description,
            'cheminImage' => $request->cheminImage,
            'numBon' => $request->numBon,
            'categorie_id' => $request->categorie_id,
        ]);*/

      return back()->with('success', 'Les données ont été enregistrées avec succès.');
        }

    public function get(){
        return datatables()->of(Produit::query())->make(true);
    }

    public function getFournisseur(){
        $fournisseurs = Fournisseur::get([ 'id','nom']);

        return datatables()
        ->of($fournisseurs)
        ->make(true);
    }


        public function getTableData()
    {
        $produit = Produit::withTrashed()->get([ 'id','nom','ref','quantite','deleted_at']);

        return datatables()
        ->of($produit)
        ->make(true);
    }

    public function index()
    {
        return view('ajouterProduit.image');
    }


}
