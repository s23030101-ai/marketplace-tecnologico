<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyStudent($qrToken)
    {
        $user = User::where('verification_qr_code', $qrToken)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario NO registrado o no perteneciente a la comunidad del Tec.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'verified' => $user->is_verified_student,
            'nombre' => $user->name,
            'numero_control' => $user->control_number,
            'carrera' => 'Ingeniería en Sistemas Computacionales', // O el campo de carrera
            'mensaje' => 'Estudiante verificado activamente en la plataforma.'
        ], 200);
    }
}


abstract class Controller
{
    //
}
