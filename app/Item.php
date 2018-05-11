<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Get the SKU for the item.
     */
    public function sku()
    {
        return $this->belongsTo('App\Sku');
    }
    
    /**
     * Get the images for the item.
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
