<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'cheminLocalisation',
        'coordPoint',
        'salle_id',
        'offset'
    ];

    public function emplacement(){
        return $this->belongsTo(Boites::class);
    }

    public function salle(){
        return $this->hasMany(Salle::class);
    }
}
