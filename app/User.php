<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Obtiene todos los link acortados por el usuario instanciado
     *
     * Get all short link for the instance user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links() {
        return $this->hasMany('App\ShortLink', 'user_id');
    }
}
