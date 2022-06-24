<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'cheminImage',
        'cheminImageDetail',
        'coordPoint',
        'offset'
    ];

    public function salle(){
        return $this->belongsTo(Salle::class);
    }
}
