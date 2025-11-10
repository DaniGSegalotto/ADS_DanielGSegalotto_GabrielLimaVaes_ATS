@extends('cliente.layout')

@section('content')
<div class="card">
    <h2>Bem-vindo, {{ Auth::guard('cliente')->user()->nome }} 👋</h2>
    <p>Seja bem-vindo à sua área do cliente.</p>
    <p>Aqui você pode:</p>

    <ul style="text-align:left;display:inline-block;">
        <li>🚗 Ver veículos disponíveis para aluguel</li>
        <li>📅 Agendar um veículo</li>
        <li>👤 Atualizar seu perfil</li>
    </ul>
</div>
@endsection
