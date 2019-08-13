<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Load;

class LoadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Load::where('user_id', auth()->id())->get();
    }


    public function store(Request $request)
    {
        $load = new Load();
        $load->loadnumber = $request->loadnumber;
        $load->description = $request->description;
        $load->pickupfrom = $request->pickupfrom;
        $load->pickupfrom_latitude = $request->pickupfrom_latitude;
        $load->pickupfrom_longitude = $request->pickupfrom_longitude;
        $load->deliverto = $request->deliverto;
        $load->deliverto_latitude = $request->deliverto_latitude;
        $load->deliverto_longitude = $request->deliverto_longitude;
        $load->weight = $request->weight;
        $load->user_id = auth()->id();
        $load->save();
        return $load;
    }


    public function show($id)
    {
        $load = Load::find($id);
        return $load;
    }


    public function update(Request $request, $id)
    {
        $load = Load::find($id);
        $load->loadnumber = $request->loadnumber;
        $load->description = $request->description;
        $load->pickupfrom = $request->pickupfrom;
        $load->pickupfrom_latitude = $request->pickupfrom_latitude;
        $load->pickupfrom_longitude = $request->pickupfrom_longitude;
        $load->deliverto = $request->deliverto;
        $load->deliverto_latitude = $request->deliverto_latitude;
        $load->deliverto_longitude = $request->deliverto_longitude;
        $load->weight = $request->weight;
        $load->user_id = auth()->id();
        $load->save();
    }


    public function destroy($id)
    {
        $load = Load::find($id);
        $load->delete();
    }
}