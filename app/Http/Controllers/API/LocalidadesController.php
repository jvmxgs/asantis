<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Estado;
use App\Municipio;

class LocalidadesController extends Controller
{

    public function index()
    {
        return Estado::all();
    }

    public function show($id)
    {
        return Estado::find($id)->municipios;
    }
}
