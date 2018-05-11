<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    /**
     * Get the page update for the theme.
     */
    public function page_update()
    {
        return $this->hasOne('App\PageThemeUpdate');
    }
}
