<?php

namespace App\Models;

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boite extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantite',
        'zone_id',
        'produit_id',
        'cheminQrCode'
    ];
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
