<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Proposal;

class ProposalsController extends Controller
{

    public function index()
    {
        $proposals = Proposal::with('freight')->get();
        return $proposals;
    }

    public function show($freight_id)
    {
        $proposal = Proposal::where('freight_id', $freight_id)->first();
        return $proposal;
    }

    public function store(Request $request)
    {
        $proposal = new Proposal();

        $proposal->proposalText = $request->proposalText;
        $proposal->freight_id = $request->freight_id;
        $proposal->carrier_id = auth()->id();

        $proposal->save();
        return $proposal;
    }
}
