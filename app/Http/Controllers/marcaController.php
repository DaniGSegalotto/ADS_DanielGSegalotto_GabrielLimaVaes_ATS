<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Veiculo;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('query'));

        if ($query) {
            $marcas = Marca::whereRaw('LOWER(descricao) LIKE ?', [
                '%' . strtolower($query) . '%'
            ])->get();

            // Limpa o campo da busca automaticamente
            $query = "";
        } else {
            $marcas = Marca::all();
        }

        return view('marcas.index', compact('marcas', 'query'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        Marca::create([
            'descricao' => $request->descricao,
            'observacao' => $request->observacao,
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    public function edit(string $id)
    {
        $marca = Marca::findOrFail($id);

        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, string $id)
    {
        $marca = Marca::findOrFail($id);

        $request->validate([
            'descricao' => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        $marca->update([
            'descricao' => $request->descricao,
            'observacao' => $request->observacao
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca alterada com sucesso!');
    }

    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);

        if (Veiculo::where('marca_id', $marca->id)->exists()) {
            return redirect()->route('marcas.index')
                ->with('error', 'Não é possível excluir a marca, pois está vinculada a um veículo.');
        }

        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca excluída com sucesso!');
    }

    public function show(string $id)
    {
        $marca = Marca::findOrFail($id);

        return view('marcas.show', compact('marca'));
    }
}
