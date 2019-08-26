<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    public function frommunicipio()
    {
        return $this
            ->belongsTo('App\Municipio', 'frommunicipio_id')
            ->with('estado');
    }

    public function tomunicipio()
    {
        return $this
            ->belongsTo('App\Municipio', 'tomunicipio_id')
            ->with('estado');
    }
}
