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
        // se no Model for status(), use 'status'; se for outro nome, ajuste aqui
        $veiculos = Veiculo::with(['marca','status'])->get();
        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $marcas   = Marca::all();
        $statuses = Status::orderBy('descricao')->get(['id','descricao']);
        return view('veiculos.create', compact('marcas','statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo'     => 'required|string|max:255',
            'categoria'  => 'required|string|max:255',
            'placa'      => 'required|string|max:10|unique:veiculos,placa',
            'ano'        => 'required|integer|min:1900',
            'marca_id'   => 'required|exists:marcas,id',
            'status_id'  => 'required|exists:statuses,id', // <- FK correta
        ]);

        $veiculo = new Veiculo([
            'modelo'     => $request->input('modelo'),
            'categoria'  => $request->input('categoria'),
            'placa'      => $request->input('placa'),
            'ano'        => $request->input('ano'),
            'marca_id'   => (int) $request->input('marca_id'),
            'status_id'  => (int) $request->input('status_id'), // <- aqui
        ]);

        $veiculo->save();

        return redirect()->route('veiculos.index')->with('success', 'Veículo criado com sucesso!');
    }

    public function edit(string $id)
    {
        $veiculo  = Veiculo::findOrFail($id);
        $marcas   = Marca::all();
        $statuses = Status::orderBy('descricao')->get(['id','descricao']);
        return view('veiculos.edit', compact('veiculo','marcas','statuses'));
    }

    public function update(Request $request, string $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $request->validate([
            'modelo'     => 'required|string|max:255',
            'categoria'  => 'required|string|max:255',
            'placa'      => 'required|string|max:10|unique:veiculos,placa,' . $veiculo->id,
            'ano'        => 'required|integer|min:1900',
            'marca_id'   => 'required|exists:marcas,id',
            'status_id'  => 'required|exists:statuses,id', // <- FK correta
        ]);

        $veiculo->modelo    = $request->input('modelo');
        $veiculo->categoria = $request->input('categoria');
        $veiculo->placa     = $request->input('placa');
        $veiculo->ano       = $request->input('ano');
        $veiculo->marca_id  = (int) $request->input('marca_id');
        $veiculo->status_id = (int) $request->input('status_id'); // <- aqui

        $veiculo->save();

        return redirect()->route('veiculos.index')->with('success', 'Veículo alterado com sucesso!');
    }

    public function destroy(string $id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $agendamentos = Agendamento::where('veiculo_id', $veiculo->id)->exists();

        if ($agendamentos) {
            return redirect()->route('veiculos.index')->with('error', 'Não é possível excluir o veículo, pois está vinculado a um agendamento.');
        }

        $veiculo->delete();

        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }

    public function show(string $id)
    {
        $veiculo = Veiculo::with(['marca','status'])->findOrFail($id);
        return view('veiculos.show', compact('veiculo'));
    }
}
