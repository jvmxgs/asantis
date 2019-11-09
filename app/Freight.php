<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }

    public function fromlocalidad()
    {
        return $this
            ->belongsTo('App\Localidade', 'fromlocalidad_id');
    }

    public function tolocalidad()
    {
        return $this
            ->belongsTo('App\Localidade', 'tolocalidad_id');
    }
}
