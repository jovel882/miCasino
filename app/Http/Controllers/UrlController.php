<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidarUrlRequest;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function show(ValidarUrlRequest $request)
    {
        return view('url', $request->only([
            'nombre',
            'apellidos',
            'telefono',
            'correo',
            'imagen',
        ]));
    }
}
