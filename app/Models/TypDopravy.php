<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypDopravy extends Model
{
    use HasFactory;

    protected $table = "typ_dopravy";

    protected $fillable = ['name'];
}
