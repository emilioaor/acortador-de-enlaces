<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';

    protected $fillable = ['link_id'];

    /**
     * Get visited link
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link() {
        return $this->belongsTo('App\ShortLink', 'link_id');
    }
}
