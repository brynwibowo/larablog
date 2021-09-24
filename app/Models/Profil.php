<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_profil',
        'name',
        'sex',
        'address',
        'phone',
        'position',
        'status',
        'bio',
    ];
}
