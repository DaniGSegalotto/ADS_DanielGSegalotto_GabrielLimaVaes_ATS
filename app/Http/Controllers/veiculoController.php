<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Agendamento;
use App\Models\Marca;
use App\Models\Status;

class VeiculoController extends Controller
{
    public function index()
    {
        // Carrega marca e status juntos
        $veiculos = Veiculo::with(['marca', 'status'])->get();

        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $marcas   = Marca::all();
        $statuses = Status::orderBy('descricao')->get();

        return view('veiculos.create', compact('marcas', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo'     => 'required|string|max:255',
            'categoria'  => 'required|string|max:255',
            'placa'      => 'required|string|max:10|unique:veiculos,placa',
            'ano'        => 'required|integer|min:1900',
            'marca_id'   => 'required|exists:marcas,id',
            'status_id'  => 'required|exists:statuses,id', // agora é FK
        ]);

        Veiculo::create([
            'modelo'     => $request->modelo,
            'categoria'  => $request->categoria,
            'placa'      => $request->placa,
            'ano'        => $request->ano,
            'marca_id'   => $request->marca_id,
            'status_id'  => $request->status_id,  // salva o status correto
        ]);

        return redirect()->route('veiculos.index')
            ->with('success', 'Veículo criado com sucesso!');
    }

    public function edit($id)
    {
        $veiculo  = Veiculo::findOrFail($id);
        $marcas   = Marca::all();
        $statuses = Status::orderBy('descricao')->get();

        return view('veiculos.edit', compact('veiculo', 'marcas', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $request->validate([
            'modelo'     => 'required|string|max:255',
            'categoria'  => 'required|string|max:255',
            'placa'      => 'required|string|max:10|unique:veiculos,placa,' . $veiculo->id,
            'ano'        => 'required|integer|min:1900',
            'marca_id'   => 'required|exists:marcas,id',
            'status_id'  => 'required|exists:statuses,id', // FK
        ]);

        $veiculo->update([
            'modelo'     => $request->modelo,
            'categoria'  => $request->categoria,
            'placa'      => $request->placa,
            'ano'        => $request->ano,
            'marca_id'   => $request->marca_id,
            'status_id'  => $request->status_id, // salva FK correta
        ]);

        return redirect()->route('veiculos.index')
            ->with('success', 'Veículo alterado com sucesso!');
    }

    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        if (Agendamento::where('veiculo_id', $veiculo->id)->exists()) {
            return redirect()->route('veiculos.index')
                ->with('error', 'Não é possível excluir o veículo, pois está vinculado a um agendamento.');
        }

        $veiculo->delete();

        return redirect()->route('veiculos.index')
            ->with('success', 'Veículo excluído com sucesso!');
    }

    public function show($id)
    {
        $veiculo = Veiculo::with(['marca', 'status'])->findOrFail($id);

        return view('veiculos.show', compact('veiculo'));
    }
}
