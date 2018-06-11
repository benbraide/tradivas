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
        return App\Image::where('item_id', $this->id)->where('is_cover', 1)->get();
    }

    public function link() {
        return ;
    }

    public function salePrice() {
        return ;
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
