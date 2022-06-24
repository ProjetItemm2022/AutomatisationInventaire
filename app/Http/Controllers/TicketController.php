<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\User;
use App\Models\Produit;
use App\Models\Fournisseur;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Logger\ConsoleLogger;

class TicketController extends Controller
{
    /**
     * @param NA
     * @return view
     */

    /**
     * @param request
     * @return response
     */
    public $produits;
    public $categories1;
    public $categories2;
    public $categories3;
    public $fournisseurs;
    public $reference;

    public function __construct()
    {
        //$this->produits = Produit::getAllProduits();
      //  $this->categories = Categorie::getAllCategorie();
        //$produits = Produit::getAllProduit();
   }
   public function __invoke(){
    return view('ticket');
   }


    public function index()
    {
        $produits =DB::table("produits")
        ->pluck("nom", "id","ref");

        $fournisseurs =DB::table("fournisseurs")
        ->pluck("nom", "id");

        $categories1 = DB::table("categories")
        ->where("niveau", "=", 1)
        ->pluck("nom", "id");

        return view('ticket', compact('categories1','produits','fournisseurs'));
    }

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
        $categories3 = DB::table("categories")
        ->where("niveau", "=", 3)
        ->where("parent", "=",$request->id)
        ->pluck("nom", "id");

        return response()->json($categories3);
    }
    public function getProd(Request $request)
    {
        $produits = DB::table("produits")
        ->where("categorie_id", "=", $request->id)
        ->pluck("nom", "id");

        return response()->json($produits);
        return view('ticket', compact('produits'));
    }
    public function getfournisseur(Request $request)
    {
        $fournisseurs = DB::table("fournisseurs")->where("id", "=" , $request->id )->pluck("nom", "id");
        return response()->json($fournisseurs);
        return view('ticket', compact('fournisseurs'));
    }
    public function getReference(Request $request)
    {
        $reference = DB::table("produits")->where("id", "=" , $request->id )->pluck("ref");
        return response()->json($reference);
    }













}
