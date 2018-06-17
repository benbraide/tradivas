<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model{
    public function full_default_path() {
        return ($this->image_base . $this->default_path . '/');
    }
    
    protected $fillable = [
        'theme_id', 'images_base',
    ];
}
