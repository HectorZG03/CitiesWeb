<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\ProvinciaEstado;
use Illuminate\Http\Request;

class PaisProvinciaController extends Controller
{
   
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        // Paises
        $queryPaises = Pais::withCount('provinciasEstados');
        if ($buscar) {
            $queryPaises->where('nombre', 'like', "%{$buscar}%");
        }
        $paisesPaginados = $queryPaises->orderBy('nombre')
                                       ->paginate(10, ['*'], 'page_paises')
                                       ->appends($buscar ? ['buscar' => $buscar] : []);

        // Provincias
        $queryProvincias = ProvinciaEstado::with(['pais', 'ciudades']);
        if ($buscar) {
            $queryProvincias->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhereHas('pais', fn($paisQ) => $paisQ->where('nombre', 'like', "%{$buscar}%"));
            });
        }
        $provinciasPaginadas = $queryProvincias->orderBy('nombre')
                                               ->paginate(10, ['*'], 'page_provincias')
                                               ->appends($buscar ? ['buscar' => $buscar] : []);

        // Todos los países para modales
        $paises = Pais::orderBy('nombre')->get();

        return view('paises_provincias.index', compact('paisesPaginados', 'provinciasPaginadas', 'paises'));
    }

    /**
     * Actualizar país
     */
    public function updatePais(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:paises,nombre,' . $id,
        ]);

        Pais::findOrFail($id)->update($validated);

        return redirect()->route('paises-provincias.index')
                         ->with('success', 'País actualizado correctamente');
    }

    /**
     * Eliminar país
     */
    public function destroyPais($id)
    {
        try {
            $pais = Pais::findOrFail($id);

            if ($pais->provinciasEstados()->count() > 0) {
                return redirect()->route('paises-provincias.index')
                                 ->with('error', 'No se puede eliminar el país porque tiene provincias/estados asociados');
            }

            $pais->delete();
            return redirect()->route('paises-provincias.index')
                             ->with('success', 'País eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('paises-provincias.index')
                             ->with('error', 'Error al eliminar el país: ' . $e->getMessage());
        }
    }

    /**
     * Actualizar provincia/estado
     */
    public function updateProvincia(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais_id' => 'required|exists:paises,id',
        ]);

        ProvinciaEstado::findOrFail($id)->update($validated);

        return redirect()->route('paises-provincias.index')
                         ->with('success', 'Provincia/Estado actualizado correctamente');
    }

    /**
     * Eliminar provincia/estado
     */
    public function destroyProvincia($id)
    {
        try {
            $provincia = ProvinciaEstado::findOrFail($id);

            if ($provincia->ciudades()->count() > 0) {
                return redirect()->route('paises-provincias.index')
                                 ->with('error', 'No se puede eliminar la provincia/estado porque tiene ciudades asociadas');
            }

            $provincia->delete();
            return redirect()->route('paises-provincias.index')
                             ->with('success', 'Provincia/Estado eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('paises-provincias.index')
                             ->with('error', 'Error al eliminar la provincia/estado: ' . $e->getMessage());
        }
    }
}
