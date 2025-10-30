<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\ProvinciaEstado;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function index()
    {
        $ciudades = Ciudad::with('provinciaEstado.pais')->orderBy('created_at', 'desc')->get();
        return view('ciudades.index', compact('ciudades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pais_nombre' => 'required|string|max:255',
            'provincia_nombre' => 'required|string|max:255',
            'ciudad_nombre' => 'required|string|max:255',
        ]);

        $nombrePais = trim($request->pais_nombre);
        $nombreProvincia = trim($request->provincia_nombre);
        $nombreCiudad = trim($request->ciudad_nombre);

        // Buscar o crear país
        $pais = Pais::where('nombre', $nombrePais)->first();
        if (!$pais) {
            $pais = Pais::create(['nombre' => $nombrePais]);
        }

        // Buscar o crear provincia/estado
        $provincia = ProvinciaEstado::where('nombre', $nombreProvincia)
                                    ->where('pais_id', $pais->id)
                                    ->first();
        if (!$provincia) {
            $provincia = ProvinciaEstado::create([
                'nombre' => $nombreProvincia,
                'pais_id' => $pais->id
            ]);
        }

        // VALIDAR: Ciudad duplicada en la misma provincia
        $ciudadExistente = Ciudad::where('nombre', $nombreCiudad)
                                ->where('provincia_estado_id', $provincia->id)
                                ->exists();

        if ($ciudadExistente) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['ciudad_nombre' => 'Esta ciudad ya existe en ' . $nombreProvincia . ', ' . $nombrePais]);
        }

        // Crear ciudad
        Ciudad::create([
            'nombre' => $nombreCiudad,
            'provincia_estado_id' => $provincia->id,
        ]);

        return redirect()->route('ciudades.index')->with('success', 'Ciudad registrada correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pais_nombre' => 'required|string|max:255',
            'provincia_nombre' => 'required|string|max:255',
            'ciudad_nombre' => 'required|string|max:255',
        ]);

        $ciudad = Ciudad::findOrFail($id);

        $nombrePais = trim($request->pais_nombre);
        $nombreProvincia = trim($request->provincia_nombre);
        $nombreCiudad = trim($request->ciudad_nombre);

        // Buscar o crear país
        $pais = Pais::where('nombre', $nombrePais)->first();
        if (!$pais) {
            $pais = Pais::create(['nombre' => $nombrePais]);
        }

        // Buscar o crear provincia
        $provincia = ProvinciaEstado::where('nombre', $nombreProvincia)
                                    ->where('pais_id', $pais->id)
                                    ->first();
        if (!$provincia) {
            $provincia = ProvinciaEstado::create([
                'nombre' => $nombreProvincia,
                'pais_id' => $pais->id
            ]);
        }

        // Validar ciudad duplicada (excepto la actual)
        $ciudadExistente = Ciudad::where('nombre', $nombreCiudad)
                                ->where('provincia_estado_id', $provincia->id)
                                ->where('id', '!=', $id)
                                ->exists();

        if ($ciudadExistente) {
            return redirect()->back()->withErrors(['ciudad_nombre' => 'Esta ciudad ya existe en ' . $nombreProvincia . ', ' . $nombrePais]);
        }

        // Actualizar ciudad
        $ciudad->update([
            'nombre' => $nombreCiudad,
            'provincia_estado_id' => $provincia->id,
        ]);

        return redirect()->route('ciudades.index')->with('success', 'Ciudad actualizada correctamente');
    }

    public function destroy($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->delete();

        return redirect()->route('ciudades.index')->with('success', 'Ciudad eliminada correctamente');
    }
}