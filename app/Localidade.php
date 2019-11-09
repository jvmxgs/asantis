<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{
    public function municipio()
    {
        return $this
            ->belongsTo('App\Municipio');
    }

    public function estado()
    {
        return $this
            ->belongsTo('App\Estado');
    }

    public function freights()
    {
        return $this
            ->hasMany('App\Freight');
    }
}
