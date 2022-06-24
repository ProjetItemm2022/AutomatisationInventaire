<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;


class FileUploadController extends Controller
{
    public function index()
    {
        return view('ajouterProduit.image');
    }


    public function upload(Request $request)
    {
        //echo 'Here for upload file';

        $validatedData = $request->validate([
            '_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

           ]);
           $path = 'images/produits';
           $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());

           $upload = $request->_file->move(public_path($path), $newname);

           if($upload){
               echo 'Le fichier a bien ete upload';
           }else{
               echo 'Le fichier na pas ete upload';
           }
    }
}
