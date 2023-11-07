<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $table = 'categories';
    use HasFactory;
    protected $fillable = [
        'nom',
        'icon_path',
    ];
}
