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
        return ('/item/' . $this->serial);
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

    public function scopeSalePrice($query) {
        return $query->leftJoin('sales', 'sales.item_id', '=', 'items.id')
            ->selectRaw('items.id, items.title, items.price as basePrice, items.created_at, sales.price as price');
    }

    public function discount() {
        return round(((($this->base_price - $this->price) / $this->base_price) * 100), 2);
    }
}
