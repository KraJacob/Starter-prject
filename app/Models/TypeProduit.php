<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'agence_id',
        'statut',
    ];


    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

}
