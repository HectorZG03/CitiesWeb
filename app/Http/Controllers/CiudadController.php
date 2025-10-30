<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\ProvinciaEstado;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        

        $query = Ciudad::with(['provinciaEstado.pais']);
        
 
        if ($buscar) {
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhereHas('provinciaEstado', function($subQ) use ($buscar) {
                      $subQ->where('nombre', 'like', "%{$buscar}%")
                           ->orWhereHas('pais', function($paisQ) use ($buscar) {
                               $paisQ->where('nombre', 'like', "%{$buscar}%");
                           });
                  });
            });
        }
        

        $ciudades = $query->orderBy('created_at', 'desc')->paginate(10);
        

        if ($buscar) {
            $ciudades->appends(['buscar' => $buscar]);
        }
        

        if ($request->ajax() || $request->wantsJson()) {
            return view('ciudades.index', compact('ciudades'));
        }
        
        return view('ciudades.index', compact('ciudades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pais_nombre' => 'required|string|max:255',
            'provincia_nombre' => 'required|string|max:255',
            'ciudad_nombre' => 'required|string|max:255',
        ]);

        $pais = Pais::firstOrCreate(
            ['nombre' => $validated['pais_nombre']]
        );


        $provincia = ProvinciaEstado::firstOrCreate(
            [
                'nombre' => $validated['provincia_nombre'],
                'pais_id' => $pais->id
            ]
        );


        Ciudad::create([
            'nombre' => $validated['ciudad_nombre'],
            'provincia_estado_id' => $provincia->id
        ]);

        return redirect()->route('ciudades.index')
            ->with('success', 'Ciudad registrada correctamente');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ciudad_nombre' => 'required|string|max:255',
            'provincia_nombre' => 'required|string|max:255',
            'pais_nombre' => 'required|string|max:255',
        ]);

        $ciudad = Ciudad::findOrFail($id);


        $pais = Pais::firstOrCreate(
            ['nombre' => $validated['pais_nombre']]
        );

   
        $provincia = ProvinciaEstado::firstOrCreate(
            [
                'nombre' => $validated['provincia_nombre'],
                'pais_id' => $pais->id
            ]
        );


        $ciudad->update([
            'nombre' => $validated['ciudad_nombre'],
            'provincia_estado_id' => $provincia->id
        ]);

        return redirect()->route('ciudades.index')
            ->with('success', 'Ciudad actualizada correctamente');
    }

    public function destroy($id)
    {
        try {
            $ciudad = Ciudad::findOrFail($id);
            $ciudad->delete();

            return redirect()->route('ciudades.index')
                ->with('success', 'Ciudad eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('ciudades.index')
                ->with('error', 'Error al eliminar la ciudad');
        }
    }
}