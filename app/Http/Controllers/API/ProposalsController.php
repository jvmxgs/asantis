<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Proposal;
use App\ProposalResponse;

class ProposalsController extends Controller
{

    public function index()
    {
        $proposals = Proposal::with('freight');

        if (!auth()->user()->hasRole('representative')) {
            $proposals->where('carrier_id', auth()->id());
        }

        return $proposals->get();
    }

    public function show($freight_id)
    {
        $proposals = Proposal::with('carrier', 'proposal_responses');

        $proposals->where('freight_id', $freight_id);

        if (!auth()->user()->hasRole('representative')) {
            $proposals->where('carrier_id', auth()->id());
        }

        return $proposals->get();
    }

    public function store(Request $request)
    {
        $proposal = new Proposal();

        $proposal->proposalText = $request->proposalText;
        $proposal->amount = $request->amount;
        $proposal->freight_id = $request->freight_id;
        $proposal->carrier_id = auth()->id();

        $proposal->save();
        return $proposal;
    }

    public function storeResponse(Request $request)
    {
        $proposal = new ProposalResponse();

        $proposal->responseText = $request->responseText;
        $proposal->proposal_id = $request->proposal_id;
        $proposal->representative_id = auth()->id();

        $proposal->save();
        return $proposal;
    }

    public function unattended()
    {
        $proposals = Proposal::with('freight');

        $proposals->doesnthave('proposal_responses');

        return $proposals->get();
    }
}
