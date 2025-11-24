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
        // Se o usuário logado for um CLIENTE
        if (Auth::guard('cliente')->check()) {

            // Nome da rota atual (evita null errors)
            $rotaAtual = $request->route()?->getName() ?? '';

            /**
             * Rotas que o cliente TEM permissão para acessar
             * Essas rotas vêm diretamente do arquivo web.php
             */
            $rotasPermitidas = [

                // ====== ÁREA DO CLIENTE ======
                'cliente.home',
                'cliente.logout',

                // ====== PERFIL ======
                'cliente.perfil',
                'cliente.perfil.update',

                // ====== VEÍCULOS ======
                'cliente.veiculos',

                // ====== AGENDAMENTOS ======
                'cliente.agendamento',        // Tela criar
                'cliente.agendamento.store',  // Salvar
                'cliente.agendamentos',       // Listar

                // Edição via SweetAlert (PUT)
                'cliente.agendamento.update',

                // Exclusão via SweetAlert (DELETE)
                'cliente.agendamento.delete',
            ];

            // Se a rota atual não estiver na lista
            if (!in_array($rotaAtual, $rotasPermitidas, true)) {
                return redirect()
                    ->route('cliente.home')
                    ->with('error', 'Acesso negado para clientes.');
            }
        }

        return $next($request);
    }
}
