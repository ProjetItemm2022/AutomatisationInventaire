<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use mikehaertl\wkhtmlto\Pdf;
use App\Models\Boite;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;





class PDFController extends Controller

{

    /**

     * Write code on Construct

     *

     * @return \Illuminate\Http\Response

     */
    public $zones;
    public $produits;
    public $categories1;
    public $categories2;
    public $categories3;
    public $fournisseurs;

    public function __invoke()
    {

        return view('QrCode/GenererQrCodeBoite');
    }


    public function Ticket()

    {
        return view('ticket');
    }
    public function ProduitData()
    {

        // Prend les champs de la base de données pour chaque utilisateur enregistrer et retourne dans un tableau

        $boite = Boite::join("produits", "boites.produit_id", "=", "produits.id")
        ->join("zones","boites.zone_id","=","zones.id")
        ->select(['zones.nom as nomZone','boites.id', 'produits.nom as nomProduit', "boites.quantite"])->get();

        return datatables()
            ->of($boite)
            // renvoie un objet
            ->make(true);
    }
    /**

     * Write code on Construct->

     *

     * @return \Illuminate\Http\Response

     */
    public function index()
    {

        $produits = DB::table("produits")
            ->pluck("nom", "id");

        $boites = DB::table('boites')
            ->pluck("id", "produit_id");

        return view("QrCode", compact("produits','boites"));
    }
    public function downloadQrCode(Request $request)

    {
        $boitesProduits = array();



        for ($i = 0; $i < count($request->input('produit')) ; $i++) {


            $boitesProduits[$i] = DB::table("boites")
                ->join('produits', 'boites.produit_id', '=', 'produits.id')
                ->join("zones","boites.zone_id","=","zones.id")
                ->select("zones.nom as nomZone","boites.id as id", "produits.id as produit_id", "produits.nom as nom","boites.cheminQrCode as cheminQrCode")
                ->where("boites.id", "=", $request->input('produit')[$i])
                ->get();
            QrCode::format('svg')->size(80)->generate(strval($boitesProduits[$i][0]->id),public_path("images/image".strval($boitesProduits[$i][0]->id).".svg"));


            $boitesProduits[$i][0]->cheminQrCode="/images/image".strval($boitesProduits[$i][0]->id).".svg";


        }


        //return view('QrCode/qrCode', ['boitesProduits' => $boitesProduits]);
        $render=view('QrCode/qrCode', ['boitesProduits' => $boitesProduits])->render();

        $pdf = new Pdf($render);


        if (!$pdf->saveAs(public_path('qrCode.pdf')))
        {
            $error=$pdf->getError();
            echo "<pre>$error</pre>";
            die();

        }


        return response()->download('qrCode.pdf');
        //return $render;


    }
    public function downloadTicket(Request $request)

    {


       // return view('ticketPDF',['donnees' => $request->dataTab]);


       //$render = view('ticketPDF')->render();

       $render = view('ticketPDF',['donnees' => $request->dataTab])->render();



        $pdf = new Pdf;

        $pdf->addPage($render);


        $pdf->saveAs(public_path('ticket.pdf'));


        return response()->json(['lien'=> url('').'/ticket.pdf']);
        //return response()->download(public_path('ticket.pdf'));
        //return view("<a href="+public_path('ticket.pdf')+">tiket</a>");

    }
}
