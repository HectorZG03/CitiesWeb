<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    
    protected $fillable = ['nombre', 'provincia_estado_id', 'poblacion'];

    public function provinciaEstado()
    {
        return $this->belongsTo(ProvinciaEstado::class);
    }
}