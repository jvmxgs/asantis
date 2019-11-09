<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Municipio;

class MunicipiosController extends Controller
{
    public function localidades($idmunicipio)
    {
        return Municipio::find($idmunicipio)->localidade;
    }
}
