<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarPermissaoCliente
{
    /**
     * Impede que clientes acessem rotas restritas a funcionários.
     */
    public function handle(Request $request, Closure $next)
    {
        // Se o usuário logado for um cliente
        if (Auth::guard('cliente')->check()) {
            $rotaAtual = $request->route()->getName();

            // ✅ Rotas que o cliente pode acessar
            $rotasPermitidas = [
                'cliente.home',                // Página inicial do cliente
                'cliente.logout',              // Logout
                'cliente.veiculos',            // Visualizar veículos
                'cliente.agendamento',         // Tela de agendamento
                'cliente.agendamento.store',   // Salvar agendamento
                'cliente.perfil',              // Ver perfil
                'cliente.perfil.update',       // Atualizar dados
            ];

            // ❌ Se tentar acessar rota não permitida
            if (!in_array($rotaAtual, $rotasPermitidas)) {
                return redirect()->route('cliente.home')->with('error', 'Acesso negado para clientes.');
            }
        }

        // Continua o fluxo normalmente
        return $next($request);
    }
}
