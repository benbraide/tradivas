<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageThemeUpdate extends Model
{
    /**
     * Get the theme that owns the page update.
     */
    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }
}
