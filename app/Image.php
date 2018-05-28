<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the item that owns the image.
     */
    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function path() {
        return (App\Setting::first()->images_base . $this->item->serial . '/' . $this->name . '.' . $this->ext);
    }
}
