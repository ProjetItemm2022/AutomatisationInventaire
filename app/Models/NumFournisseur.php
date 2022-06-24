<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumFournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit_id',
        'fournisseur_id',
    ];
    public function produit(){
        return $this->belongsTo('fournisseur_id');
    }
    public function Fournisseur(){
        return $this->hasOne(Fournisseur::class);
    }
}
