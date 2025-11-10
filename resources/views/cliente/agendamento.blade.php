@extends('cliente.layout')

@section('content')
<div class="card">
    <h2>Agendar Veículo</h2>

    <form method="POST" action="{{ route('cliente.agendamento.store') }}">
        @csrf

        <label>Selecione o Veículo</label>
        <select name="veiculo_id" required>
            <option value="">Selecione...</option>
            @foreach($veiculos as $v)
                <option value="{{ $v->id }}">{{ $v->modelo }} ({{ $v->placa }})</option>
            @endforeach
        </select>

        <label>Data Início</label>
        <input type="date" name="data_inicio" required>

        <label>Data Fim</label>
        <input type="date" name="data_fim" required>

        <button type="submit">Confirmar Agendamento</button>
    </form>
</div>
@endsection
