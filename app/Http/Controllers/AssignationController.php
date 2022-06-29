<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use App\Models\Salle;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;



class AssignationController extends Controller
{

    public function __invoke()
    {
        return view('assignation/menu');
    }
    public function nommage(){
        $arrNom = Batiment::all();//pluck('id','nom');
         //dump($arrNom);die();
        return view('assignation/nommage', ['batiments'=>$arrNom]);
    }


    public function changeBatimentName(Request $request){
        /*dump($request->nom);
        die();*/
        $noms=$request->nom;
        $ids=$request->id;
        //$input = $request->all();
        for ($i=0;$i<count($noms);$i++)
        {
            $bat=Batiment::find($ids[$i]);
            $bat->nom=$noms[$i];
            $bat->save();
        }
        /*
        for ($i =1; $i < 9;$i++){
            if ($input[$i]!= null){
                $batiment = Batiment::find($i);
                $batiment->nom = $input[$i];
                $batiment ->save();
            }
        }*/
        //return redirect('/menu');
        return redirect('/assignation');
    }

    public function getBatimentName(){
        return response()->json(Batiment::get(['nom','id','coordPoint','offset']));
    }

    public function getSalleNameOfBatiment($idbatiment){
        return response()->json(Salle::where('batiment_id','=',$idbatiment)->get(['nom','id','coordPoint','offset']));
    }
    public function getZoneNameOfBatiment($idbatiment){
        $res=Zone::join("salles","zones.salle_id","=", "salles.id")
        ->select("zones.nom as nom", "zones.id as id", "zones.coordPoint as coordPoint", "zones.offset as offset")
        ->where("salles.batiment_id", "=", $idbatiment)->get();
        return response()->json($res);
    }

    public function assignationBatiment(){
        $image = getimagesize(asset("/images/plan/0PlanGeneral.png"));
            $size = [
                $image[0],
                $image[1],
            ];
        $id = null;
        return view('assignation/batiment', ["size"=>$size, 'id'=> $id]);
    }
    public function assignationSalle(){
        $image = getimagesize(asset("/images/plan/0PlanGeneral.png"));
        $size = [
            $image[0],
            $image[1],
        ];
    $id = null;
    return view('assignation/salle', ['id'=> $id,"size"=>$size]);
    }
    public function assignationZone(){
        $image = getimagesize(asset("/images/plan/0PlanGeneral.png"));
        $size = [
            $image[0],
            $image[1],
        ];
    $id = null;
    return view('assignation/zone', ['id'=> $id,"size"=>$size]);
    }

    public function assignationSalleZoom($id){


        $batiment = Batiment::find($id);
        //if (Batiment::find($id)->count()==1){
        if ($batiment->count()==8){ //8 est le nombre de champs retourné pour 1 id trouve
            $imagePath = $batiment->cheminDetail;
            $image = getimagesize(asset("/$imagePath"));
            $size = [
                $image[0],
                $image[1],
            ];
            return view('assignation/sallezoom', ['id'=> $id,"size"=>$size, 'nomBatiment'=>$batiment->nom,'image'=>url('')."/".$batiment->cheminDetail]);
        }
        else return abort(404);
    }

    public function assignationZoneZoom($id){


        $batiment = Batiment::find($id);
        if ($batiment->count()==8){ //8 est le nombre de champs retourné pour 1 id trouve
            $imagePath = $batiment->cheminDetail;
            $image = getimagesize(asset("/$imagePath"));
            $size = [
                $image[0],
                $image[1],
            ];
            return view('assignation/zonezoom', ['id'=> $id,"size"=>$size, 'nomBatiment'=>$batiment->nom,'image'=>url('')."/".$batiment->cheminDetail]);
        }
        else return abort(404);
    }
/*
    public function assignationZone($id){

        if ($id > 0 && $id < 9){
            $batiment = Batiment::pluck('nom');
            $id = $id-1;
            $path = [
                "1rdc.png",
                "2Brahms.png",
                "3Debussy.png",
                "4Gershwin.png",
                "5Haendel.png",
                "6Pape.png",
                "7Sax.png",
                "8Torres.png",
            ];
            $imagePath = $path[$id];
            $image = getimagesize(asset("/images/plan/$imagePath"));
            $size = [
                $image[0],
                $image[1],
            ];

            return view('assignation/zone', ['id'=> $id,"size"=>$size, 'nomBatiment'=>$batiment]);
        }
        else return abort(404);
    }
    */

    public function storeCoordBatiment(Request $request)
    {

        $query = $request->getContent();
        $monImageBase64=null;
        $id=null;
        $nom=null;
        $coordonnees=null;
        $offset=null;

        foreach (explode('&', $query) as $chunk) {
            $param = explode("=", $chunk);

            if ($param) {
                if (urldecode($param[0])=="id")
                {
                    $id=urldecode($param[1]);

                }
                if (urldecode($param[0])=="coordonnees")
                {
                    $coordonnees=urldecode($param[1]);
                }
                if (urldecode($param[0])=="nom")
                {
                    $nom=urldecode($param[1]);
                }
                if (urldecode($param[0])=="offset")
                {
                    $offset=urldecode($param[1]);
                }
                if (urldecode($param[0])=="monImageBase64")
                {
                    $monImageBase64=urldecode($param[1]);
                }

            }
        }



            $path=public_path().'/images/batiment/';
            $img=$monImageBase64;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_en_base64 = base64_decode($image_parts[1]);
            $nomImg=$nom. uniqid(). '.'.$image_type;
            $file = $path .$nomImg;


    //echo "fichier : $file";
    // die();
            file_put_contents($file, $image_en_base64);
            $bat=Batiment::find($id);
            $bat->cheminImage='/images/batiment/'.$nomImg;
            $bat->coordPoint=$coordonnees;
            $bat->offset=$offset;
            $bat->save();
            return response()->json(['upload'=> 'upload']);


    }
    public function removeSalle(Request $request)
    {
        $query = $request->getContent();
        $id=null;
        foreach (explode('&', $query) as $chunk) {
            $param = explode("=", $chunk);


            if ($param) {

                if (urldecode($param[0])=="id")
                {
                    $id=urldecode($param[1]);

                }
            }
        }


        if ($id!=null)
        {
            Salle::find($id)->delete();
        }
        return response()->json("supp ok");


    }
    public function removeZone(Request $request)
    {
        $query = $request->getContent();
        $id=null;
        foreach (explode('&', $query) as $chunk) {
            $param = explode("=", $chunk);


            if ($param) {

                if (urldecode($param[0])=="id")
                {
                    $id=urldecode($param[1]);

                }
            }
        }


        if ($id!=null)
        {
            Zone::find($id)->delete();
        }
        return response()->json("supp ok");


    }
    public function storeCoordSalle(Request $request)
    {

        $query = $request->getContent();
        $monImageBase64=null;
        $id=null;
        $nom="null";
        $coordonnees=null;
        $offset=null;
        $idBat=null;

        foreach (explode('&', $query) as $chunk) {
            $param = explode("=", $chunk);



            if ($param) {

                if (urldecode($param[0])=="id")
                {
                    $id=urldecode($param[1]);

                }
                if (urldecode($param[0])=="coordonnees")
                {
                    $coordonnees=urldecode($param[1]);
                }
                if (urldecode($param[0])=="nom")
                {
                    $nom=urldecode($param[1]);
                }
                if (urldecode($param[0])=="offset")
                {
                    $offset=urldecode($param[1]);
                }
                if (urldecode($param[0])=="monImageBase64")
                {
                    $monImageBase64=urldecode($param[1]);
                }
                if (urldecode($param[0])=="idBat")
                {
                    $idBat=urldecode($param[1]);
                }

            }
        }

        $file="null";
            $path=public_path().'/images/salle/';
            $img=$monImageBase64;



            if ($nom=="null")  // update
            {
                $salle=Salle::find($id);

                $salle->nom=$salle->nom;
                $nom=$salle->nom;
                if ($img!=null)
                {

                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_en_base64 = base64_decode($image_parts[1]);
                    $nomImg=$nom. uniqid(). '.'.$image_type;
                    $file = $path .$nomImg;

                    file_put_contents($file, $image_en_base64);
                }
                $salle->cheminImage='/images/salle/'.$nomImg;
                $salle->coordPoint=$coordonnees;
                $salle->offset=$offset;

                $salle->batiment_id=$idBat;
                $salle->save();

            }
            else {  //insert
                if ($img!=null)
                {

                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_en_base64 = base64_decode($image_parts[1]);
                    $nomImg=$nom. uniqid(). '.'.$image_type;
                    $file = $path .$nomImg;


                    file_put_contents($file, $image_en_base64);
                }
                Salle::insert([
                    'batiment_id' => $idBat,
                    'nom' => $nom,
                    'cheminImage' => $file,
                    'coordPoint' => $coordonnees,
                    'offset' => $offset,

                ]);
                $id=DB::getPdo()->lastInsertId();

            }


            return response()->json(['id'=> $id]);


    }
    public function storeCoordZone(Request $request)
    {

        $query = $request->getContent();
        $monImageBase64=null;
        $id=null;
        $nom="null";
        $coordonnees=null;
        $offset=null;
        $idSalle=null;

        foreach (explode('&', $query) as $chunk) {
            $param = explode("=", $chunk);



            if ($param) {

                if (urldecode($param[0])=="id")
                {
                    $id=urldecode($param[1]);

                }
                if (urldecode($param[0])=="coordonnees")
                {
                    $coordonnees=urldecode($param[1]);
                }
                if (urldecode($param[0])=="nom")
                {
                    $nom=urldecode($param[1]);
                }
                if (urldecode($param[0])=="offset")
                {
                    $offset=urldecode($param[1]);
                }
                if (urldecode($param[0])=="monImageBase64")
                {
                    $monImageBase64=urldecode($param[1]);
                }
                if (urldecode($param[0])=="idSalle")
                {
                    $idSalle=urldecode($param[1]);
                }

            }
        }

        $file="null";
            $path=public_path().'/images/localisation/';
            $img=$monImageBase64;



            if ($nom=="null")  // update
            {
                $zone=Zone::find($id);

                $zone->nom=$zone->nom;
                $nom=$zone->nom;

                if ($img!=null)
                {

                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_en_base64 = base64_decode($image_parts[1]);
                    $nomImg=$nom. uniqid(). '.'.$image_type;
                    $file = $path .$nomImg;

                    file_put_contents($file, $image_en_base64);
                }
                $zone->cheminLocalisation='/images/localisation/'.$nomImg;
                $zone->coordPoint=$coordonnees;
                $zone->offset=$offset;

                $zone->salle_id=$zone->salle_id;
                $zone->save();

            }
            else {  //insert
                # code...
                Zone::insert([
                    'salle_id' => $idSalle,
                    'nom' => $nom,
                    'cheminLocalisation' => $file,
                    'coordPoint' => $coordonnees,
                    'offset' => $offset,

                ]);
                $id=DB::getPdo()->lastInsertId();

            }


            return response()->json(['id'=> $id]);


    }

    public function storePlanGlobal(Request $request){
        $bodyContent = $request->getContent();
        Storage::put('public/storePlanGlobal.json',$bodyContent);
        return response();
    }

    public function storeSalle(Request $request){
        $bodyContent = $request->getContent();
        $object = json_decode($bodyContent);
        foreach ($object as $arrImage) {
            foreach ($arrImage as $image) {
                $data = base64_decode(str_replace('data:image/png;base64,', '', $image->png));
                $name = uniqid('public/image/salle/image', true) . '.png';
                Storage::put($name,$data);
                Salle::upsert(
                    ['cheminImage'=>$name, 'coordPoint'=>(json_encode($image->json)), 'batiment_id'=>$image->id, 'nom'=> $image->nom],['coordPoint']
                );

            }
        }
        return response();
    }


    public function storeZone(Request $request){
        $bodyContent = $request->getContent();
        $object = json_decode($bodyContent);
        foreach ($object as $arrImage) {
            foreach ($arrImage as $image) {
                $data = base64_decode(str_replace('data:image/png;base64,', '', $image->png));
                $name = uniqid('public/image/zone/image', true) . '.png';
                Storage::put($name,$data);
                Zone::upsert(
                    ['cheminLocalisation'=>$name, 'coordPoint'=>(json_encode($image->json)), 'salle_id'=>$image->id],['CoordPoint']
                );

            }
        }
        return response();
    }
}
