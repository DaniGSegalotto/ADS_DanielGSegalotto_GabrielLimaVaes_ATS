@extends('cliente.layout')

@section('content')
<div class="card">
    <h2>Veículos Disponíveis</h2>

    @if($veiculos->isEmpty())
        <p>Nenhum veículo disponível no momento.</p>
    @else
        <ul style="list-style:none;padding:0;">
            @foreach($veiculos as $v)
                <li style="margin-bottom:15px;">
                    <strong>{{ $v->modelo }}</strong> — {{ $v->marca->nome ?? 'Sem marca' }}<br>
                    <small>Placa: {{ $v->placa }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
