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

        if ($request->has('frommunicipio_id') && $request->frommunicipio_id != "") {
            $load->where('frommunicipio_id', $request->frommunicipio_id);
        }

        if ($request->has('tomunicipio_id') && $request->tomunicipio_id != "") {
            $load->where('tomunicipio_id', $request->tomunicipio_id);
        }

        if ($request->has('keywords') && $request->keywords != "") {
            $load->orWhere('description', 'like', '%' . $request->keywords . '%');
        }

        $load->with('frommunicipio', 'tomunicipio')
                ->orderBy('updated_at', 'DESC');

        return $load->get();
    }

}
