<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypPlatby extends Model
{
    use HasFactory;

    protected $table = "typ_platby";

    protected $fillable = ['name'];
}
