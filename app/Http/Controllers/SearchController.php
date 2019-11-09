<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Freight;
use App\Estado;
use App\Municipio;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $freight = Freight::with('fromlocalidad.municipio.estado', 'tolocalidad.municipio.estado');

        if ($request->has('fromestado_id') && $request->fromestado_id != "") {
            $freight->orWhereHas('fromlocalidad.municipio.estado', function($q) use($request) {
                $q->where('estados.id', $request->fromestado_id);

                if ($request->has('frommunicipio_id') && $request->frommunicipio_id != "") {
                    $q->where('municipios.id', $request->frommunicipio_id);
                }
                if ($request->has('fromlocalidad_id') && $request->fromlocalidad_id != "") {
                    $q->where('localidades.id', $request->fromlocalidad_id);
                }
            });
        }

        if ($request->has('toestado_id') && $request->toestado_id != "") {
            $freight->orWhereHas('tolocalidad.municipio.estado', function($q) use($request) {
                $q->where('estados.id', $request->toestado_id);

                if ($request->has('tomunicipio_id') && $request->tomunicipio_id != "") {
                    $q->where('municipios.id', $request->tomunicipio_id);
                }
                if ($request->has('tolocalidad_id') && $request->tolocalidad_id != "") {
                    $q->where('localidades.id', $request->tolocalidad_id);
                }
            });
        }

        if ($request->has('keywords') && $request->keywords != "") {
            $freight->orWhere('description', 'like', '%' . $request->keywords . '%');
        }

        if ($request->has('rangeweight') && is_array($request->rangeweight)) {
            $freight->whereBetween('weight', $request->rangeweight);
        }

        $freight->orderBy('updated_at', 'DESC');

        return $freight->get();
    }

    public function rangeWeight()
    {
        $weight['min'] = Freight::min('weight');
        $weight['max'] = Freight::max('weight');
        return $weight;
    }

}
