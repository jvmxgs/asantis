<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Estado;

class EstadosController extends Controller
{

    public function index()
    {
        return Estado::all();
    }

    public function municipios($idestado)
    {
        return Estado::find($idestado)->municipios;
    }
}
