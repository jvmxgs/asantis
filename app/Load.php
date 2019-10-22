<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    public function fromlocalidad()
    {
        return $this
            ->belongsTo('App\Localidade', 'fromlocalidad_id')
            ->with('municipio');
    }

    public function tolocalidad()
    {
        return $this
            ->belongsTo('App\Localidade', 'tolocalidad_id')
            ->with('municipio');
    }
}
