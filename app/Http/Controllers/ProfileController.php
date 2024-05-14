<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /* Exibe o formulário de perfil do usuário. */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /* Atualiza as informações do perfil do usuário. */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Preenche o modelo do usuário com os dados validados do request
        $request->user()->fill($request->validated());

        // Se o e-mail do usuário foi alterado, definir a verificação de e-mail como nula
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Salva as alterações no banco de dados
        $request->user()->save();

        // Redireciona de volta para o formulário de edição de perfil com uma mensagem de sucesso
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /* Exclui a conta do usuário. */
    public function destroy(Request $request): RedirectResponse
    {
        // Valida se a senha atual foi fornecida
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Obtém o usuário atual
        $user = $request->user();

        // Faz logout do usuário
        Auth::logout();

        // Deleta a conta do usuário
        $user->delete();

        // Invalida a sessão atual do usuário e regenera o token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireciona para a página inicial após a exclusão da conta
        return Redirect::to('/');
    }
}
