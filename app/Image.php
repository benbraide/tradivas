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
        $settings = \App\Setting::first();
        if ($settings)
            $image_base = $settings->images_base;
        else
            $image_base = "http://image.tradivas.com/";
        return ($image_base . $this->item->serial . '/' . $this->name);
    }
}
