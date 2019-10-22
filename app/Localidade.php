<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{
    public function municipio()
    {
        return $this
            ->belongsTo('App\Municipio')
            ->with('estado');
    }

    public function loads()
    {
        return $this
            ->hasMany('App\Load');
    }
}
