<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recenze extends Model
{
    use HasFactory;

    protected $table = "recenze";

    protected $fillable = ['recenze', 'hodnoceni', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
