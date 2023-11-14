<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public $timestamps= false;
    public $table = 'missions';
    use HasFactory;
    protected $fillable = [
        'nom',
        'prix',
        'description',
        'link',
    ];
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
}
