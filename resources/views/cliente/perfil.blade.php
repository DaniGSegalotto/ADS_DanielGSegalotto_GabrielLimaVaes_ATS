@extends('cliente.layout')

@section('content')
<div class="card">
    <h2>Meu Perfil</h2>

    @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('cliente.perfil.update') }}">
        @csrf

        <label>Nome</label>
        <input type="text" name="nome" value="{{ $cliente->nome }}" required>

        <label>Telefone</label>
        <input type="text" name="telefone" value="{{ $cliente->telefone }}" required>

        <label>Nova Senha (opcional)</label>
        <input type="password" name="password" placeholder="••••••••">

        <label>Confirmar Nova Senha</label>
        <input type="password" name="password_confirmation" placeholder="••••••••">

        <button type="submit">Salvar Alterações</button>
    </form>
</div>
@endsection
