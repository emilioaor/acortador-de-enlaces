<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Generator\RandomGeneratorFactory;

class ShortLink extends Model
{
    protected $table = 'short_links';

    protected $fillable = [
        'link', 'short', 'visited', 'user_id'
    ];


    /**
     * Genera link acortado
     * @return string
     */
    public static function generateShortedLink() {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $short = '';

        for ($x = 1; $x <= 15; $x++) {
            $random = rand(0, 61);
            $short .= substr($characters, $random, 1);
        }

        return $short;
    }

    /**
     * Obtiene el usuario propietario del link
     *
     * Get the property user link
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\ShortLink', 'user_id');
    }

    /**
     * Obtiene todas las visitas registradas al link
     *
     * Get all visits registered for this link
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits() {
        return $this->hasMany('App\Visit', 'link_id');
    }
}
