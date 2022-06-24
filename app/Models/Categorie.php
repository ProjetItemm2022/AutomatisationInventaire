<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'niveau',
        'parent',
    ];

    public function parent (){
        return $this->hasOne(Categorie::class);
    }

    public function enfant(){
        return $this->belongsToMany(Categorie::class);
    }

    public function produit(){
        return $this->belongsTo(Produit::class);
    }
    public static function getAllCategorie()
    {
    return Categorie::all();
    }
}
