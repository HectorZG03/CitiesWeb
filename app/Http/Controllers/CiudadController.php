<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\ProvinciaEstado;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Mostrar listado de ciudades con búsqueda y paginación
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $query = Ciudad::with('provinciaEstado.pais');

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhereHas('provinciaEstado', function ($subQ) use ($buscar) {
                      $subQ->where('nombre', 'like', "%{$buscar}%")
                           ->orWhereHas('pais', function ($paisQ) use ($buscar) {
                               $paisQ->where('nombre', 'like', "%{$buscar}%");
                           });
                  });
            });
        }

        $ciudades = $query->orderBy('created_at', 'desc')->paginate(10)
                           ->appends($buscar ? ['buscar' => $buscar] : []);

        return view('ciudades.index', compact('ciudades'));
    }

    /**
     * Guardar nueva ciudad
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pais_nombre' => 'required|string|max:255',
            'provincia_nombre' => 'required|string|max:255',
            'ciudad_nombre' => 'required|string|max:255',
        ]);

        $provincia = $this->crearPaisYProvincia($validated['pais_nombre'], $validated['provincia_nombre']);

        Ciudad::create([
            'nombre' => $validated['ciudad_nombre'],
            'provincia_estado_id' => $provincia->id
        ]);

        return redirect()->route('ciudades.index')
                         ->with('success', 'Ciudad registrada correctamente');
    }

    /**
     * Actualizar ciudad existente
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pais_nombre' => 'required|string|max:255',
            'provincia_nombre' => 'required|string|max:255',
            'ciudad_nombre' => 'required|string|max:255',
        ]);

        $ciudad = Ciudad::findOrFail($id);

        $provincia = $this->crearPaisYProvincia($validated['pais_nombre'], $validated['provincia_nombre']);

        $ciudad->update([
            'nombre' => $validated['ciudad_nombre'],
            'provincia_estado_id' => $provincia->id
        ]);

        return redirect()->route('ciudades.index')
                         ->with('success', 'Ciudad actualizada correctamente');
    }

    /**
     * Eliminar ciudad
     */
    public function destroy($id)
    {
        try {
            Ciudad::findOrFail($id)->delete();
            return redirect()->route('ciudades.index')
                             ->with('success', 'Ciudad eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('ciudades.index')
                             ->with('error', 'Error al eliminar la ciudad: ' . $e->getMessage());
        }
    }

    /**
     * Método privado para crear país y provincia si no existen
     */
    private function crearPaisYProvincia(string $paisNombre, string $provinciaNombre)
    {
        $pais = Pais::firstOrCreate(['nombre' => $paisNombre]);
        return ProvinciaEstado::firstOrCreate([
            'nombre' => $provinciaNombre,
            'pais_id' => $pais->id
        ]);
    }
}
