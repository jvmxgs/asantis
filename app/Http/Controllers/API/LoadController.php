<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Load;
use App\Estado;
use App\Municipio;
use Carbon\Carbon;

class LoadController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $load = Load::with('frommunicipio', 'tomunicipio')
                ->where('user_id', auth()->id())
                ->orderBy('updated_at', 'DESC')
                ->get();

        return $load;
    }


    public function store(Request $request)
    {
        $load = new Load();
        $load->loadnumber = $this->generateLoadNumber();
        $load->description = $request->description;

        $load->fromestado_id = $request->fromestado_id;
        $load->frommunicipio_id = $request->frommunicipio_id;
        $load->fromaddress = $request->fromaddress;
        $load->departuretime = $request->departuretime;

        $load->toestado_id = $request->toestado_id;
        $load->tomunicipio_id = $request->tomunicipio_id;
        $load->toaddress = $request->toaddress;
        $load->arrivaltime = $request->arrivaltime;

        $load->weight = $request->weight;
        $load->user_id = auth()->id();
        $load->save();
        return $load;
    }


    public function show($loadnumber)
    {
        $load = Load::with('frommunicipio', 'tomunicipio')
                ->where('loadnumber', $loadnumber)
                ->first();
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

    private function generateLoadNumber()
    {
        $prefix = "AS" . date("ym");

        $lastLoadNumber = Load::latest('id')
                            ->Where('loadnumber', 'like', $prefix . '%')
                            ->OrderBy('id', 'DESC')
                            ->first();

        if (empty($lastLoadNumber)) {
            $loadNumber = $prefix . "0001";
        } else {
            $loadNumber = ++$lastLoadNumber->loadnumber;
        }
        return $loadNumber;
    }

}
