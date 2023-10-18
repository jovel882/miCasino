<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ValidateUrlRequest;
use App\Http\Requests\ValidateRedirectRequest;
use App\Http\Requests\ValidateUrlGenerateRequest;

class UrlController extends Controller
{
    public function show(ValidateUrlRequest $request): View
    {
        return view('url', $request->only([
            'nombre',
            'apellidos',
            'telefono',
            'correo',
            'imagen',
        ]));
    }

    public function upload(ValidateUrlGenerateRequest $request)
    {
        try {
            if ($request->hasFile('imagen')) {
                $imagenPath = $request->file('imagen')->store('public/imagenes');
    
                if (!$imagenPath) {
                    throw new \Throwable('Error al cargar la imagen');
                }
            } else {
                throw new \Throwable('Error al cargar la imagen');
            }
            return redirect()
                ->route('redirect', [
                    'url' => route('url', [
                        'nombre' => $request->nombre,
                        'apellidos' => $request->apellidos,
                        'telefono' => $request->telefono,
                        'correo' => $request->correo,
                        'imagen' => asset(Storage::url($imagenPath)),
                    ])
                ]);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['imagen' => $th->getMessage()]);
        }
    }

    public function redirect(ValidateRedirectRequest $request)
    {
        return view('redirect', $request->only(['url']));
    }
}
