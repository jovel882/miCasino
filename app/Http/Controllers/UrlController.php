<?php

namespace App\Http\Controllers;

use App\Exceptions\FailedUploadImageExeption;
use App\Http\Requests\ValidateRedirectRequest;
use App\Http\Requests\ValidateUrlGenerateRequest;
use App\Http\Requests\ValidateUrlRequest;
use App\Jobs\ValidateIsNew;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function show(ValidateUrlRequest $request): View
    {
        $data = $request->only([
            'nombre',
            'apellidos',
            'telefono',
            'correo',
            'imagen',
        ]);

        $this->validateIsNew($data);

        return view('url', $data);
    }

    public function upload(ValidateUrlGenerateRequest $request): RedirectResponse
    {
        try {
            return redirect()
                ->route('redirect', [
                    'url' => route('url', [
                        'nombre' => $request->nombre,
                        'apellidos' => $request->apellidos,
                        'telefono' => $request->telefono,
                        'correo' => $request->correo,
                        'imagen' => $this->loadFileInStorage($request),
                    ]),
                ]);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'imagen' => $th->getMessage(),
                ]);
        }
    }

    public function redirect(ValidateRedirectRequest $request)
    {
        return view('redirect', $request->only(['url']));
    }

    protected function validateIsNew(array $data): void
    {
        if (count(array_filter($data)) === 5) {
            ValidateIsNew::dispatch($data);
        }
    }

    protected function loadFileInStorage(ValidateUrlGenerateRequest $request): string
    {
        if (! $request->hasFile('imagen')) {
            throw new FailedUploadImageExeption('Error al cargar la imagen');
        }

        $imagenPath = $request->file('imagen')
            ->store('public/imagenes');

        if (! $imagenPath) {
            throw new FailedUploadImageExeption('Error al cargar la imagen');
        }

        return asset(Storage::url($imagenPath));
    }
}
