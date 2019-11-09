<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function municipios()
    {
        return $this
            ->hasMany('App\Municipio');
    }
    public function localidades()
    {
        return $this
            ->hasMany('App\Localidade');
    }
}
