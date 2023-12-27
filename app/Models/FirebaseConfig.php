<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirebaseConfig extends Model
{
    use HasFactory;

    public $table = 'FirebaseConfig';
    protected $fillable = [
            'apiKey',
            'authDomain',
            'databaseURL',
            'projectId',
           'storageBocket',
            'messagingSenderId',
            'appId',
            'measurementId',
    ];
}
