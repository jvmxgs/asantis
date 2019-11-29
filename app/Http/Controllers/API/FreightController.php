<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Freight;
use App\Estado;
use App\Municipio;
use App\Localidade;
use Carbon\Carbon;

class FreightController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $freight = Freight::with('fromlocalidad.municipio.estado', 'tolocalidad.municipio.estado');

                if (!auth()->user()->hasRole('admin')) {
                    $freight->where('user_id', auth()->id());
                }

        return $freight->orderBy('updated_at', 'DESC')
                ->get();
    }


    public function store(Request $request)
    {
        $freight = new Freight();
        $freight->freightnumber = $this->generateFreightNumber();
        $freight->description = $request->description;

        if ($request->fromlocalidad_id === "0") {
            $freight->fromlocalidad_id = Localidade::where('municipio_id', $request->origenmunicipioid)
                    ->where('clave', '0001')
                    ->first()->id;
        } else {
            $freight->fromlocalidad_id = $request->fromlocalidad_id;
        }

        $freight->fromaddress = $request->fromaddress;
        $freight->departuretime = $request->departuretime;

        if ($request->tolocalidad_id === "0") {
            $freight->tolocalidad_id = Localidade::where('municipio_id', $request->destinomunicipioid)
                    ->where('clave', '0001')
                    ->first()
                    ->id;
        } else {
            $freight->tolocalidad_id = $request->tolocalidad_id;
        }
        $freight->toaddress = $request->toaddress;
        $freight->arrivaltime = $request->arrivaltime;

        $freight->weight = $request->weight;
        $freight->user_id = auth()->id();
        $freight->save();
        return $freight;
    }


    public function show($freightnumber)
    {

        $freight = Freight::with('fromlocalidad.municipio.estado', 'tolocalidad.municipio.estado')
                ->where('freightnumber', $freightnumber)
                ->first();
        return $freight;
    }


    public function update(Request $request, $id)
    {
        $freight = Freight::find($id);
        $freight->freightnumber = $request->freightnumber;
        $freight->description = $request->description;
        $freight->pickupfrom = $request->pickupfrom;
        $freight->pickupfrom_latitude = $request->pickupfrom_latitude;
        $freight->pickupfrom_longitude = $request->pickupfrom_longitude;
        $freight->deliverto = $request->deliverto;
        $freight->deliverto_latitude = $request->deliverto_latitude;
        $freight->deliverto_longitude = $request->deliverto_longitude;
        $freight->weight = $request->weight;
        $freight->user_id = auth()->id();
        $freight->save();
    }


    public function destroy($id)
    {
        $freight = Freight::find($id);
        $freight->delete();
    }

    private function generateFreightNumber()
    {
        $prefix = "AS" . date("ym");

        $lastFreightNumber = Freight::latest('id')
                            ->Where('freightnumber', 'like', $prefix . '%')
                            ->OrderBy('id', 'DESC')
                            ->first();

        if (empty($lastFreightNumber)) {
            $freightNumber = $prefix . "0001";
        } else {
            $freightNumber = ++$lastFreightNumber->freightnumber;
        }
        return $freightNumber;
    }

}
