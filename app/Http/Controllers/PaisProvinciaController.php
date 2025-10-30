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
        
        // Query para países
        $queryPaises = Pais::withCount('provinciasEstados');
        if ($buscar) {
            $queryPaises->where('nombre', 'like', "%{$buscar}%");
        }
        $paisesPaginados = $queryPaises->orderBy('nombre')->paginate(10, ['*'], 'page_paises');
        
        // Mantener búsqueda en paginación
        if ($buscar) {
            $paisesPaginados->appends(['buscar' => $buscar]);
        }
        
        // Query para provincias
        $queryProvincias = ProvinciaEstado::with(['pais', 'ciudades']);
        if ($buscar) {
            $queryProvincias->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhereHas('pais', function($paisQ) use ($buscar) {
                      $paisQ->where('nombre', 'like', "%{$buscar}%");
                  });
            });
        }
        $provinciasPaginadas = $queryProvincias->orderBy('nombre')->paginate(10, ['*'], 'page_provincias');
        
        // Mantener búsqueda en paginación
        if ($buscar) {
            $provinciasPaginadas->appends(['buscar' => $buscar]);
        }
        
        // Obtener todos los países para los modales
        $paises = Pais::orderBy('nombre')->get();
        
        // Si es una petición AJAX, devolver solo la vista
        if ($request->ajax() || $request->wantsJson()) {
            return view('paises_provincias.index', compact('paisesPaginados', 'provinciasPaginadas', 'paises'));
        }
        
        return view('paises_provincias.index', compact('paisesPaginados', 'provinciasPaginadas', 'paises'));
    }

    public function updatePais(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:paises,nombre,' . $id,
        ]);

        $pais = Pais::findOrFail($id);
        $pais->update($validated);

        return redirect()->route('paises-provincias.index')
            ->with('success', 'País actualizado correctamente');
    }

    public function destroyPais($id)
    {
        try {
            $pais = Pais::findOrFail($id);
            
            // Verificar si tiene provincias asociadas
            if ($pais->provinciasEstados()->count() > 0) {
                return redirect()->route('paises-provincias.index')
                    ->with('error', 'No se puede eliminar el país porque tiene provincias/estados asociados');
            }
            
            $pais->delete();

            return redirect()->route('paises-provincias.index')
                ->with('success', 'País eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('paises-provincias.index')
                ->with('error', 'Error al eliminar el país');
        }
    }

    public function updateProvincia(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais_id' => 'required|exists:paises,id',
        ]);

        $provincia = ProvinciaEstado::findOrFail($id);
        $provincia->update($validated);

        return redirect()->route('paises-provincias.index')
            ->with('success', 'Provincia/Estado actualizado correctamente');
    }

    public function destroyProvincia($id)
    {
        try {
            $provincia = ProvinciaEstado::findOrFail($id);
            
            // Verificar si tiene ciudades asociadas
            if ($provincia->ciudades()->count() > 0) {
                return redirect()->route('paises-provincias.index')
                    ->with('error', 'No se puede eliminar la provincia/estado porque tiene ciudades asociadas');
            }
            
            $provincia->delete();

            return redirect()->route('paises-provincias.index')
                ->with('success', 'Provincia/Estado eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('paises-provincias.index')
                ->with('error', 'Error al eliminar la provincia/estado');
        }
    }
}