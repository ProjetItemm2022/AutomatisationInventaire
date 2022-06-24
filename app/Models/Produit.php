<?php

namespace App\Models;

use Database\Seeders\FournisseurSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom',
        'quantite',
        'seuilMin',
        'seuilAlerte',
        'ref',
        'description',
        'numBon',
        'cheminImage',
        'cheminLocalisation',
        'categorie_id',
        'fournisseur_id'

    ];
    public function fournisseur(){
        return $this->hasOne('fournisseur_id');
    }
    public function categorie(){
        return $this->hasOne('categorie_id');
    }
    public function numEmplacement(){
        return $this->hasMany('numero');
    }
    public static function getAllProduit()
    {
    return Produit::all();
    }
}
