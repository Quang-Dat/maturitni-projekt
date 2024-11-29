<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod_V_Obj extends Model
{
    use HasFactory;

    protected $table = "prod_v_obj";

    protected $fillable = [
        "stale_menu_id",
        "objednavky_id",
        "pocet",
        "cena",
    ];

    public function menu_id()
    {
        return $this->belongsTo(StaleMenu::class, 'stale_menu_id');
    }

    public function objednavka_id()
    {
        return $this->belongsTo(Objednavky::class, 'objednavky_id');
    }
}
