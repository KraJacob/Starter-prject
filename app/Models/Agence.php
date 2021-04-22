<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'contact',
        'email',
        'adresse',
        'statut',
        'created_at',
        'updated_at',
    ];


    public function user()
{
    return $this->hasMany(user::class);
}

public function typeproduit()
{
    return $this->hasMany(typeproduit::class);
}
}

