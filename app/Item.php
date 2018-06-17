<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function subCategory(){
        return $this->belongsTo('App\SubCategory');
    }
    
    /**
     * Get the images for the item.
     */
    public function images() {
        return $this->hasMany('App\Image');
    }
    
    public function image() {
        $img = \App\Image::where('item_id', $this->id)->first();
        if ($img)
            return $img->path();
        
        $settings = \App\Setting::first();
        return ($settings->full_default_path() . $settings->default_image);
    }

    public function link() {
        return ('/item/' . str_slug($this->title) . '-' . $this->id);
    }

    public function salePrice() {
        return null;
    }

    public function scopeCategory($query, $cat) {
        if ($cat == 0)
            return $query;
        return $query->where('category', $cat);
    }

    public function scopeSubCategory($query, $cat) {
        if ($cat == 0)
            return $query;
        return $query->where('sub_category', $cat);
    }
}
