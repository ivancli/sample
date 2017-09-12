<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $table = 'meta_tags';
    protected $guarded = [];

    const META_OPEN_GRAPH = 'og';
    const META_TWITTER = 'twitter';
    const META_SITE = 'site';

    /**
     * Get the client that owns the meta tag
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}