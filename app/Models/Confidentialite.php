<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confidentialite extends Model
{
    use HasFactory;

    public $table = 'confidentialite';
    protected $fillable = [
            'text',
    ];
}
