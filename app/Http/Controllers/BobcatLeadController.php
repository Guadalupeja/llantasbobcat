<?php

namespace App\Http\Controllers;

use App\Mail\BobcatLeadMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class BobcatLeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'empresa' => ['nullable', 'string', 'max:150'],
            'tipo_llanta' => ['required', 'string', 'max:100'],
            'medida' => ['required', 'string', 'max:100'],
            'telefono' => ['required', 'string', 'max:50'],
            'correo' => ['required', 'email', 'max:150'],
            'mensaje' => ['nullable', 'string', 'max:2000'],
            'origen' => ['nullable', 'string', 'max:150'],
        ]);

        try {
            Mail::to('bshgroupcrm@gmail.com')->send(
                new BobcatLeadMail($validated)
            );

            return response()->json([
                'ok' => true,
                'message' => 'Gracias. En breve será contactado por el departamento de ventas.',
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'ok' => false,
                'message' => 'No fue posible enviar tu solicitud. Intenta nuevamente.',
                'debug' => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
}