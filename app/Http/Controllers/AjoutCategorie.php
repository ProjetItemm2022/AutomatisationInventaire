<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjoutCategorie extends Controller
{
    public function create(Request $request)
    {
    //  Store data in database
  'App\Models\Categorie'::create($request->all());
    //
  return back()->with('success', 'Les données ont été enregistrées avec succès.');
    }
}
