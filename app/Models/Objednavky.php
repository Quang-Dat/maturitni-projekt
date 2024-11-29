<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objednavky extends Model
{
    use HasFactory;

    protected $table = "objednavky";

    protected $fillable = [
        'jmeno',
        'prijmeni',
        'email',
        'telefon',
        'ulice',
        'cp',
        'psc',
        'mesto',
        'typ_platby_id',
        'typ_dopravy_id',
        'user_id'
    ];


    public function typ_platby()
    {
        return $this->belongsTo(TypPlatby::class, 'typ_platby_id');
    }

    public function typ_dopravy()
    {
        return $this->belongsTo(TypDopravy::class, 'typ_dopravy_id');
    }
}
