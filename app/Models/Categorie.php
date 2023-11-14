<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps= false;
    public $table = 'categories';
    use HasFactory;
    protected $fillable = [
        'nom',
        'icon_path',
    ];
    public function mission()
    {
        return $this->hasMany(Mission::class, 'categorie_id');
    }
    public function missionCount()
    {
        return $this->mission->count();
    }
    public function managerCount()
    {
        return $this->managers()->count();
    }
    public function managers()
    {
        return $this->belongsToMany(Manager::class, 'category_manager');
    }
}
