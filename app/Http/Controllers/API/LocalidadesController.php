<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Municipio;
use App\Localidade;

class LocalidadesController extends Controller
{

    public function buscarlocalidad($busqueda)
    {
        $num_words = str_word_count($busqueda);

        $localidades = Municipio::with('estado')
                        ->where('nombre', 'LIKE', $busqueda . '%')->limit(10)->get();

        return $localidades;
    }

}
