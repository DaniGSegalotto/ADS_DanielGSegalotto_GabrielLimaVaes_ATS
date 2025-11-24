<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Agendamento;
use App\Models\Marca;
use App\Models\Status;
use Illuminate\Support\Facades\Storage;

class VeiculoController extends Controller
{
    public function index()
    {
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
            'status_id'  => 'required|exists:statuses,id',
            'imagem'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
        ]);

        // Upload da imagem
        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('veiculos', 'public');
        }

        Veiculo::create([
            'modelo'     => $request->modelo,
            'categoria'  => $request->categoria,
            'placa'      => $request->placa,
            'ano'        => $request->ano,
            'marca_id'   => $request->marca_id,
            'status_id'  => $request->status_id,
            'imagem'     => $imagemPath,
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
            'status_id'  => 'required|exists:statuses,id',
            'imagem'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
        ]);

        // Se enviou nova imagem → substitui
        if ($request->hasFile('imagem')) {

            // apaga imagem antiga se existir
            if ($veiculo->imagem && Storage::disk('public')->exists($veiculo->imagem)) {
                Storage::disk('public')->delete($veiculo->imagem);
            }

            $veiculo->imagem = $request->file('imagem')->store('veiculos', 'public');
        }

        $veiculo->update([
            'modelo'     => $request->modelo,
            'categoria'  => $request->categoria,
            'placa'      => $request->placa,
            'ano'        => $request->ano,
            'marca_id'   => $request->marca_id,
            'status_id'  => $request->status_id,
            'imagem'     => $veiculo->imagem, // garante persistência
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

        // excluir imagem associada
        if ($veiculo->imagem && Storage::disk('public')->exists($veiculo->imagem)) {
            Storage::disk('public')->delete($veiculo->imagem);
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
