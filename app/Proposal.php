<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    public function user()
    {
        return $this
            ->belongsTo('App\User');
    }

    public function freight()
    {
        return $this->belongsTo('App\Freight');
    }
}
