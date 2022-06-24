<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'cheminImage',
        'coordPoint',
    ];
    public function batiment(){
        return $this->hasMany(Batiment::class);
    }
    public function zone (){
        return $this->belongsTo(Zone::class);
    }
}
