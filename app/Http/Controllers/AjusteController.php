<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();

        $path = public_path('divisas.json');
        $decoded = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
        $items = $decoded['data'] ?? $decoded;

        $divisas = array_values(array_filter(is_array($items) ? $items : [], fn ($item) => is_array($item) && isset($item['symbol'], $item['name'])));

        return view('admin.ajustes.index', compact('divisas', 'ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'divisa' => 'required|string|max:255',
            'web' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $ajuste = Ajuste::first() ?: new Ajuste;

        $ajuste->nombre = $request->nombre;
        $ajuste->descripcion = $request->descripcion;
        $ajuste->direccion = $request->direccion;
        $ajuste->telefono = $request->telefono;
        $ajuste->email = $request->email;
        $ajuste->divisa = $request->divisa;
        $ajuste->web = $request->web;

        if ($request->hasFile('logo')) {
            if ($ajuste->logo && Storage::disk('public')->exists($ajuste->logo)) {
                Storage::disk('public')->delete($ajuste->logo);
            }
            $ajuste->logo = $request->file('logo')->store('logos', 'public');
        }

        $ajuste->save();

        return redirect()->route('admin.ajustes.index')->with('success', 'Ajustes guardados correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ajuste $ajuste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
