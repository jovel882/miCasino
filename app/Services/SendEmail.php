<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    public function __invoke(array $data)
    {
        $messageBody = "Nombre: {$data['nombre']}\n"
                     . "Apellidos: {$data['apellidos']}\n"
                     . "Teléfono: {$data['telefono']}\n"
                     . "Correo: {$data['correo']}\n"
                     . "Imagen URL: {$data['imagen']}";

        Mail::raw(
            $messageBody,
            fn ($message) =>
                $message->to($data['correo'])
                    ->subject('Notificación de nuevo registro.')
        );

        sleep(5);
        Log::info("Mensaje enviado al correo: {$data['correo']}");
    }
}
