<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class Client extends Authenticatable 
{
    use HasFactory;
    use HasApiTokens;
    
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'clients';
    protected $fillable = [
        'nom',
        'prenom',
        'password',
        'approved',
        'email',
        'phone',
        'pays',
        'ville',
        'CIN_recto_path',
        'CIN_verso_path',
        'profile_photo_path',
        'RIB',
        'NomBanque',
        'badge',
        'credit',
        'missioncomplete',
        'payment',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    // protected $appends = [
    //     'profile_photo_path',
    // ];


    public function getChatType()
    {
        return 'client';
    }
}
