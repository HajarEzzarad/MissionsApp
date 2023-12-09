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
        'duration',
        'status',
    ];
    public function category()  
    {
        return $this->belongsTo(Categorie::class);
    }
    protected $dates = ['created_at', 'updated_at', 'time_to_stop'];

    public function calculateTimeToStop()
    {
        return $this->created_at->addMinutes($this->duration);
    }
    
   
}
