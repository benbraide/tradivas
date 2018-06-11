<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    public function subCategories(){
        return $this->hasMany('App\SubCategory');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }
}
