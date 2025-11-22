<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Funcionario;
use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class AgendamentoController extends Controller
{
    /* ============================================================
       LISTAR COM BUSCA (padrão ATS e case-insensitive)
    ============================================================ */
    public function index(Request $request)
{
    $query = strtolower($request->input('query'));

    $agendamentos = Agendamento::with(['funcionario', 'veiculo', 'cliente'])
        ->when($query, function ($q) use ($query) {

            return $q->whereRaw("LOWER(TO_CHAR(data, 'DD/MM/YYYY')) LIKE ?", ["%{$query}%"])
                ->orWhereRaw("LOWER(TO_CHAR(horario, 'HH24:MI')) LIKE ?", ["%{$query}%"])
                ->orWhereHas('funcionario', fn($s) =>
                    $s->whereRaw("LOWER(nome) LIKE ?", ["%{$query}%"])
                )
                ->orWhereHas('veiculo', fn($s) =>
                    $s->whereRaw("LOWER(modelo) LIKE ?", ["%{$query}%"])
                )
                ->orWhereHas('cliente', fn($s) =>
                    $s->whereRaw("LOWER(nome) LIKE ?", ["%{$query}%"])
                );
        })
        ->orderBy('data', 'asc')
        ->orderBy('horario', 'asc')
        ->get();

    return view('agendamentos.index', [
        'agendamentos' => $agendamentos,
        'query' => null // limpa o campo após buscar
    ]);
}


    /* ============================================================
       FORMULÁRIO DE CRIAÇÃO
    ============================================================ */
    public function create()
    {
        return view('agendamentos.create', [
            'funcionarios' => Funcionario::all(),
            'veiculos' => Veiculo::all(),
            'clientes' => Cliente::all(),
        ]);
    }

    /* ============================================================
       CRIAR NOVO AGENDAMENTO
    ============================================================ */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'data' => ['required', 'date', 'after_or_equal:' . now()->toDateString()],
                'horario' => ['required', 'date_format:H:i'],
                'funcionario_id' => ['required', 'exists:funcionarios,id'],
                'veiculo_id' => ['required', 'exists:veiculos,id'],

                // evita agendamentos duplicados
                'cliente_id' => [
                    'required',
                    Rule::unique('agendamentos')->where(function ($query) use ($request) {
                        return $query->where([
                            ['data', '=', $request->data],
                            ['horario', '=', $request->horario],
                            ['funcionario_id', '=', $request->funcionario_id],
                            ['veiculo_id', '=', $request->veiculo_id],
                        ]);
                    }),
                ],
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            Agendamento::create($validator->validated());

            return redirect()->route('agendamentos.index')
                ->with('success', 'Agendamento criado com sucesso!');

        } catch (QueryException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Já existe um agendamento com estes dados.'
            ]);
        }
    }

    /* ============================================================
       FORMULÁRIO DE EDIÇÃO
    ============================================================ */
    public function edit(string $id)
    {
        return view('agendamentos.edit', [
            'agendamento' => Agendamento::findOrFail($id),
            'funcionarios' => Funcionario::all(),
            'veiculos' => Veiculo::all(),
            'clientes' => Cliente::all(),
        ]);
    }

    /* ============================================================
       ATUALIZAR AGENDAMENTO
    ============================================================ */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'data' => ['required', 'date'],
                'horario' => ['required', 'date_format:H:i'],
                'funcionario_id' => ['required', 'exists:funcionarios,id'],
                'veiculo_id' => ['required', 'exists:veiculos,id'],

                // evita duplicidade no update
                'cliente_id' => [
                    'required',
                    Rule::unique('agendamentos')->where(function ($query) use ($request, $id) {
                        return $query->where([
                            ['data', '=', $request->data],
                            ['horario', '=', $request->horario],
                            ['funcionario_id', '=', $request->funcionario_id],
                            ['veiculo_id', '=', $request->veiculo_id],
                        ])->where('id', '!=', $id);
                    }),
                ],
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            Agendamento::findOrFail($id)->update($validator->validated());

            return redirect()->route('agendamentos.index')
                ->with('success', 'Agendamento atualizado com sucesso!');

        } catch (QueryException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Erro ao atualizar. Já existe outro agendamento com estes dados.'
            ]);
        }
    }

    /* ============================================================
       EXCLUIR
    ============================================================ */
    public function destroy(string $id)
    {
        Agendamento::findOrFail($id)->delete();

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento excluído com sucesso!');
    }

    /* ============================================================
       DETALHES
    ============================================================ */
    public function show(string $id)
    {
        return view('agendamentos.show', [
            'agendamento' => Agendamento::with(['funcionario', 'veiculo', 'cliente'])->findOrFail($id)
        ]);
    }
}
