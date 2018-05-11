<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the item that owns the image.
     */
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
