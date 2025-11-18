<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ClienteForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.cliente.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validar email
        $request->validate(['email' => 'required|email']);

        // 🚀 Enviar link de redefinição usando o broker "clientes"
        $status = Password::broker('clientes')->sendResetLink(
            $request->only('email')
        );

        // Retornar resultado
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
