<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    public function carrier()
    {
        return $this
            ->belongsTo('App\User', 'carrier_id');
    }

    public function freight()
    {
        return $this->belongsTo('App\Freight');
    }

    public function proposal_responses()
    {
        return $this->hasMany('App\ProposalResponse');
    }
}
