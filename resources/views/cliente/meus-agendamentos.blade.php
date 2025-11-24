@extends('layouts.app_cliente')

@section('content')

<style>
    .ag-title {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 28px;
        color: #222;
        text-align: center;
    }

    .ag-card {
        padding: 22px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e5e5;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: .25s;
    }

    .ag-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.14);
    }

    .ag-label {
        font-weight: 700;
        color: #222;
    }

    .ag-empty {
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        text-align: center;
        font-size: 16px;
        color: #555;
        border: 1px solid #e5e5e5;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .btn-edit {
        padding:8px 14px;
        background:#ff9800;
        color:#fff;
        border-radius:8px;
    }

    .btn-delete {
        padding:8px 14px;
        background:#e53935;
        color:#fff;
        border:none;
        border-radius:8px;
    }
</style>

<h2 class="ag-title">Meus Agendamentos</h2>

{{-- Carregar funcionários --}}
@php
$funcionarios = \App\Models\Funcionario::orderBy('nome')->get();
@endphp

@forelse($agendamentos as $a)

<div class="ag-card">

    <div><span class="ag-label">Veículo:</span>
        {{ $a->veiculo->modelo ?? 'Veículo removido' }}
        @if($a->veiculo) ({{ $a->veiculo->placa }}) @endif
    </div>

    <div><span class="ag-label">Funcionário:</span>
        {{ $a->funcionario->nome ?? 'Funcionário removido' }}
    </div>

    <div><span class="ag-label">Data:</span>
        {{ \Carbon\Carbon::parse($a->data)->format('d/m/Y') }}
    </div>

    <div><span class="ag-label">Horário:</span>
        {{ substr($a->horario, 0, 5) }}
    </div>

    <div style="margin-top:12px; display:flex; gap:10px;">

        <button class="btn-edit"
            onclick="editarAgendamento(
                {{ $a->id }},
                '{{ \Carbon\Carbon::parse($a->data)->format('Y-m-d') }}',
                '{{ substr($a->horario,0,5) }}',
                {{ $a->funcionario_id }}
            )">
            Editar
        </button>

        <button class="btn-delete" onclick="excluirAgendamento({{ $a->id }})">
            Excluir
        </button>

    </div>

</div>

@empty
<div class="ag-empty">Nenhum agendamento encontrado.</div>
@endforelse

<script>
const funcionarios = @json($funcionarios);

/* Gera automaticamente as opções do select */
function gerarOptions(funcionarioID) {
    return funcionarios.map(f => `
        <option value="${f.id}" ${f.id == funcionarioID ? 'selected' : ''}>
            ${f.nome}
        </option>
    `).join('');
}

/* ================================
      EXCLUIR AGENDAMENTO
================================ */
function excluirAgendamento(id) {
    Swal.fire({
        title: 'Excluir Agendamento?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e53935',
        confirmButtonText: 'Sim, excluir'
    }).then(result => {
        if (result.isConfirmed) {
            fetch(`/cliente/agendamento/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => {
                Swal.fire('Excluído!', '', 'success');
                setTimeout(() => location.reload(), 1200);
            });
        }
    });
}

/* ================================
         EDITAR AGENDAMENTO
================================ */
function editarAgendamento(id, data, horario, funcionarioAtual) {

    let funcionariosOptions = '';
    funcionarios.forEach(f => {
        funcionariosOptions += `
            <option value="${f.id}" ${f.id == funcionarioAtual ? 'selected' : ''}>
                ${f.nome}
            </option>`;
    });

    Swal.fire({
        title: '<span style="font-size:22px;font-weight:700;color:#222;">Editar Agendamento</span>',
        html: `
            <style>
                .swal-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px 25px;
                    text-align: left;
                    margin-top: 20px;
                }

                .swal-grid label {
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 4px;
                    display: block;
                }

                .swal-grid input,
                .swal-grid select {
                    width: 100%;
                    padding: 10px 12px;
                    border-radius: 10px;
                    border: 1px solid #ccc;
                    height: 44px;
                    font-size: 15px;
                }

                .swal-footer-flex {
                    display: flex;
                    justify-content: center;
                    gap: 12px;
                    margin-top: 20px;
                }
            </style>

            <div class="swal-grid">
                <div>
                    <label>Data:</label>
                    <input type="date" id="swal-data" value="${data}">
                </div>

                <div>
                    <label>Horário:</label>
                    <input type="time" id="swal-horario" value="${horario}">
                </div>

                <div style="grid-column: span 2;">
                    <label>Funcionário:</label>
                    <select id="swal-funcionario">${funcionariosOptions}</select>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Salvar Alterações',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn-salvar',
            cancelButton: 'btn-cancelar',
            popup: 'popup-edit'
        }
    }).then((result) => {
        if (result.isConfirmed) {

            const body = {
                data: document.getElementById('swal-data').value,
                horario: document.getElementById('swal-horario').value,
                funcionario_id: document.getElementById('swal-funcionario').value
            };

            fetch(`/cliente/agendamento/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(body)
            }).then(async (response) => {

                if (!response.ok) {
                    Swal.fire('Erro', 'Conflito de horário ou dados inválidos.', 'error');
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Atualizado!',
                    text: 'Agendamento alterado com sucesso.',
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1600);
            });
        }
    });
}

</script>

@endsection
