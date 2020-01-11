<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


use App\Freight;
use App\Estado;
use App\Municipio;
use App\Localidade;
use Carbon\Carbon;

class FreightController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $freight = Freight::with('fromlocalidad.municipio.estado', 'tolocalidad.municipio.estado');

                if (!auth()->user()->hasRole('admin')) {
                    $freight->where('user_id', auth()->id());
                }

        $freight = $freight->orderBy('updated_at', 'DESC')
                ->paginate(5);
    	return response()->json($freight);
    }


    public function store(Request $request)
    {

        $attributes = [
            'weight' => 'peso',
            'weightunit' => 'unidad de peso',
            'trucktype' => 'tipo de unidad',
            'fromlocalidad_id' => 'origen',
            'fromaddress' => 'dirección de origen',
            'departuretime' => 'fecha de salida',
            'tolocalidad_id' => 'destino',
            'toaddress' => 'dirección de destino',
            'arrivaltime' => 'fecha de llegada',
            'amount' => 'presupuesto disponible'
        ];

        $v = Validator::make($request->all(), [
            'weight' => ['required', 'numeric'],
            'weightunit' => ['required', 'in:kg,lb'],
            'trucktype' => ['required', 'in:panel,rabon,caja53,termorefrigerado'],

            'fromlocalidad_id' => ['required', 'numeric'],
            'fromaddress' => ['required', 'string'],
            'departuretime' => ['required', 'date_format:Y/m/d H:i'],

            'tolocalidad_id' => ['required', 'numeric'],
            'toaddress' => ['required', 'string'],
            'arrivaltime' => ['required', 'date_format:Y/m/d H:i', 'before:departuretime'],

            'amount' => ['required', 'numeric']
        ]);

        $v->setAttributeNames($attributes);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

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
        $freight->weightunit = $request->weightunit;
        $freight->trucktype = $request->trucktype;
        $freight->amount = $request->amount;

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


    public function update(Request $request, $freightnumber)
    {
        $freight = Freight::where('freightnumber', $freightnumber)->firstOrFail();

        $attributes = [
            'weight' => 'peso',
            'weightunit' => 'unidad de peso',
            'trucktype' => 'tipo de unidad',
            'fromlocalidad_id' => 'origen',
            'fromaddress' => 'dirección de origen',
            'departuretime' => 'fecha de salida',
            'tolocalidad_id' => 'destino',
            'toaddress' => 'dirección de destino',
            'arrivaltime' => 'fecha de llegada',
            'amount' => 'presupuesto disponible'
        ];

        $v = Validator::make($request->all(), [
            'weight' => ['required', 'numeric'],
            'weightunit' => ['required', 'in:kg,lb'],
            'trucktype' => ['required', 'in:panel,rabon,caja53,termorefrigerado'],

            'fromlocalidad_id' => ['required', 'numeric'],
            'fromaddress' => ['required', 'string'],
            'departuretime' => ['required', 'date_format:Y/m/d H:i'],

            'tolocalidad_id' => ['required', 'numeric'],
            'toaddress' => ['required', 'string'],
            'arrivaltime' => ['required', 'date_format:Y/m/d H:i', 'before:departuretime'],

            'amount' => ['required', 'numeric']
        ]);

        $v->setAttributeNames($attributes);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }


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
        $freight->weightunit = $request->weightunit;
        $freight->trucktype = $request->trucktype;
        $freight->amount = $request->amount;

        $freight->user_id = auth()->id();
        $freight->save();
        return $freight;
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

    private function lbToKg($val)
    {
        return $val * 0.453592;
    }

}
