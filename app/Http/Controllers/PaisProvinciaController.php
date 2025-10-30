<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\ProvinciaEstado;
use Illuminate\Http\Request;

class PaisProvinciaController extends Controller
{
    public function index()
    {
        // Obtener todos los países con sus relaciones para los modales
        $paises = Pais::with('provinciasEstados.ciudades')->orderBy('nombre', 'asc')->get();
        
        // Paginación para países
        $paisesPaginados = Pais::withCount('provinciasEstados')
            ->orderBy('nombre', 'asc')
            ->paginate(10, ['*'], 'paises_page');
        
        // Paginación para provincias
        $provinciasPaginadas = ProvinciaEstado::with(['pais', 'ciudades'])
            ->orderBy('nombre', 'asc')
            ->paginate(10, ['*'], 'provincias_page');
        
        return view('paises_provincias.index', compact('paises', 'paisesPaginados', 'provinciasPaginadas'));
    }

    public function updatePais(Request $request, $id)
    {
        $pais = Pais::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:paises,nombre,' . $id,
        ], [
            'nombre.required' => 'El nombre del país es requerido',
            'nombre.unique' => 'Este país ya está registrado',
        ]);

        $pais->update(['nombre' => trim($request->nombre)]);

        return redirect()->route('paises-provincias.index')
            ->with('success', 'País actualizado correctamente');
    }

    public function destroyPais($id)
    {
        $pais = Pais::findOrFail($id);
        
        // Verificar si tiene provincias asociadas
        if ($pais->provinciasEstados()->count() > 0) {
            return redirect()->route('paises-provincias.index')
                ->withErrors(['error' => 'No se puede eliminar el país porque tiene provincias/estados asociados']);
        }

        $pais->delete();

        return redirect()->route('paises-provincias.index')
            ->with('success', 'País eliminado correctamente');
    }

    public function updateProvincia(Request $request, $id)
    {
        $provincia = ProvinciaEstado::findOrFail($id);

        $request->validate([
            'pais_id' => 'required|exists:paises,id',
            'nombre' => 'required|string|max:255',
        ], [
            'pais_id.required' => 'Debe seleccionar un país',
            'nombre.required' => 'El nombre de la provincia/estado es requerido',
        ]);

        $nombreProvincia = trim($request->nombre);
        $paisId = $request->pais_id;

        // Verificar duplicado (excepto el actual)
        $existe = ProvinciaEstado::where('nombre', $nombreProvincia)
            ->where('pais_id', $paisId)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nombre' => 'Esta provincia/estado ya existe en el país seleccionado']);
        }

        $provincia->update([
            'nombre' => $nombreProvincia,
            'pais_id' => $paisId,
        ]);

        return redirect()->route('paises-provincias.index')
            ->with('success', 'Provincia/Estado actualizado correctamente');
    }

    public function destroyProvincia($id)
    {
        $provincia = ProvinciaEstado::findOrFail($id);
        
        // Verificar si tiene ciudades asociadas
        if ($provincia->ciudades()->count() > 0) {
            return redirect()->route('paises-provincias.index')
                ->withErrors(['error' => 'No se puede eliminar la provincia/estado porque tiene ciudades asociadas']);
        }

        $provincia->delete();

        return redirect()->route('paises-provincias.index')
            ->with('success', 'Provincia/Estado eliminado correctamente');
    }
}