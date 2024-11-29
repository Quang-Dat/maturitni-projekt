<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaleMenu extends Model
{
    use HasFactory;

    protected $table = "stale_menu";

    protected $fillable = ["nazev", "popis", "cena", "kategorie_id", "user_id"];

    public function kategorie()
    {
        return $this->belongsTo(Kategorie::class, 'kategorie_id');
    }
}
