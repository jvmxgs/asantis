<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Load;
use App\Estado;
use App\Municipio;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $load = Load::query();

        if ($request->has('fromestado_id') && $request->fromestado_id != "") {
            $load->where('fromestado_id', $request->fromestado_id);
            if ($request->has('frommunicipio_id') && $request->frommunicipio_id != "") {
                $load->where('frommunicipio_id', $request->frommunicipio_id);
            }
        }

        if ($request->has('toestado_id') && $request->toestado_id != "") {
            $load->where('toestado_id', $request->toestado_id);
            if ($request->has('tomunicipio_id') && $request->tomunicipio_id != "") {
                $load->where('tomunicipio_id', $request->tomunicipio_id);
            }
        }

        if ($request->has('keywords') && $request->keywords != "") {
            $load->orWhere('description', 'like', '%' . $request->keywords . '%');
        }

        if ($request->has('rangeweight') && is_array($request->rangeweight)) {
            $load->whereBetween('weight', $request->rangeweight);
        }

        $load->with('frommunicipio', 'tomunicipio')
                ->orderBy('updated_at', 'DESC');

        return $load->get();
    }

    public function rangeWeight()
    {
        $weight['min'] = Load::min('weight');
        $weight['max'] = Load::max('weight');
        return $weight;
    }

}
