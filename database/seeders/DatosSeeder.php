<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pais;
use App\Models\ProvinciaEstado;
use App\Models\Ciudad;

class DatosSeeder extends Seeder
{
    public function run(): void
    {
        // ARGENTINA
        $argentina = Pais::create(['nombre' => 'Argentina']);
        
        $buenosAires = ProvinciaEstado::create(['nombre' => 'Buenos Aires', 'pais_id' => $argentina->id]);
        Ciudad::create(['nombre' => 'La Plata', 'provincia_estado_id' => $buenosAires->id]);
        Ciudad::create(['nombre' => 'Mar del Plata', 'provincia_estado_id' => $buenosAires->id]);
        Ciudad::create(['nombre' => 'Bahía Blanca', 'provincia_estado_id' => $buenosAires->id]);
        
        $cordoba = ProvinciaEstado::create(['nombre' => 'Córdoba', 'pais_id' => $argentina->id]);
        Ciudad::create(['nombre' => 'Córdoba', 'provincia_estado_id' => $cordoba->id]);
        Ciudad::create(['nombre' => 'Villa María', 'provincia_estado_id' => $cordoba->id]);
        Ciudad::create(['nombre' => 'Río Cuarto', 'provincia_estado_id' => $cordoba->id]);
        
        $santaFe = ProvinciaEstado::create(['nombre' => 'Santa Fe', 'pais_id' => $argentina->id]);
        Ciudad::create(['nombre' => 'Santa Fe', 'provincia_estado_id' => $santaFe->id]);
        Ciudad::create(['nombre' => 'Rosario', 'provincia_estado_id' => $santaFe->id]);
        Ciudad::create(['nombre' => 'Rafaela', 'provincia_estado_id' => $santaFe->id]);
        
        $mendoza = ProvinciaEstado::create(['nombre' => 'Mendoza', 'pais_id' => $argentina->id]);
        Ciudad::create(['nombre' => 'Mendoza', 'provincia_estado_id' => $mendoza->id]);
        Ciudad::create(['nombre' => 'San Rafael', 'provincia_estado_id' => $mendoza->id]);

        // MÉXICO
        $mexico = Pais::create(['nombre' => 'México']);
        
        $cdmx = ProvinciaEstado::create(['nombre' => 'Ciudad de México', 'pais_id' => $mexico->id]);
        Ciudad::create(['nombre' => 'Cuauhtémoc', 'provincia_estado_id' => $cdmx->id]);
        Ciudad::create(['nombre' => 'Coyoacán', 'provincia_estado_id' => $cdmx->id]);
        Ciudad::create(['nombre' => 'Iztapalapa', 'provincia_estado_id' => $cdmx->id]);
        
        $jalisco = ProvinciaEstado::create(['nombre' => 'Jalisco', 'pais_id' => $mexico->id]);
        Ciudad::create(['nombre' => 'Guadalajara', 'provincia_estado_id' => $jalisco->id]);
        Ciudad::create(['nombre' => 'Zapopan', 'provincia_estado_id' => $jalisco->id]);
        Ciudad::create(['nombre' => 'Puerto Vallarta', 'provincia_estado_id' => $jalisco->id]);
        
        $nuevoLeon = ProvinciaEstado::create(['nombre' => 'Nuevo León', 'pais_id' => $mexico->id]);
        Ciudad::create(['nombre' => 'Monterrey', 'provincia_estado_id' => $nuevoLeon->id]);
        Ciudad::create(['nombre' => 'San Pedro Garza García', 'provincia_estado_id' => $nuevoLeon->id]);
        Ciudad::create(['nombre' => 'Apodaca', 'provincia_estado_id' => $nuevoLeon->id]);
        
        $queretaro = ProvinciaEstado::create(['nombre' => 'Querétaro', 'pais_id' => $mexico->id]);
        Ciudad::create(['nombre' => 'Santiago de Querétaro', 'provincia_estado_id' => $queretaro->id]);
        Ciudad::create(['nombre' => 'San Juan del Río', 'provincia_estado_id' => $queretaro->id]);

        // COLOMBIA
        $colombia = Pais::create(['nombre' => 'Colombia']);
        
        $cundinamarca = ProvinciaEstado::create(['nombre' => 'Cundinamarca', 'pais_id' => $colombia->id]);
        Ciudad::create(['nombre' => 'Bogotá', 'provincia_estado_id' => $cundinamarca->id]);
        Ciudad::create(['nombre' => 'Soacha', 'provincia_estado_id' => $cundinamarca->id]);
        Ciudad::create(['nombre' => 'Facatativá', 'provincia_estado_id' => $cundinamarca->id]);
        
        $antioquia = ProvinciaEstado::create(['nombre' => 'Antioquia', 'pais_id' => $colombia->id]);
        Ciudad::create(['nombre' => 'Medellín', 'provincia_estado_id' => $antioquia->id]);
        Ciudad::create(['nombre' => 'Bello', 'provincia_estado_id' => $antioquia->id]);
        Ciudad::create(['nombre' => 'Itagüí', 'provincia_estado_id' => $antioquia->id]);
        
        $valle = ProvinciaEstado::create(['nombre' => 'Valle del Cauca', 'pais_id' => $colombia->id]);
        Ciudad::create(['nombre' => 'Cali', 'provincia_estado_id' => $valle->id]);
        Ciudad::create(['nombre' => 'Palmira', 'provincia_estado_id' => $valle->id]);
        Ciudad::create(['nombre' => 'Buenaventura', 'provincia_estado_id' => $valle->id]);

        // CHILE
        $chile = Pais::create(['nombre' => 'Chile']);
        
        $metropolitana = ProvinciaEstado::create(['nombre' => 'Región Metropolitana', 'pais_id' => $chile->id]);
        Ciudad::create(['nombre' => 'Santiago', 'provincia_estado_id' => $metropolitana->id]);
        Ciudad::create(['nombre' => 'Puente Alto', 'provincia_estado_id' => $metropolitana->id]);
        Ciudad::create(['nombre' => 'Maipú', 'provincia_estado_id' => $metropolitana->id]);
        
        $valparaiso = ProvinciaEstado::create(['nombre' => 'Valparaíso', 'pais_id' => $chile->id]);
        Ciudad::create(['nombre' => 'Valparaíso', 'provincia_estado_id' => $valparaiso->id]);
        Ciudad::create(['nombre' => 'Viña del Mar', 'provincia_estado_id' => $valparaiso->id]);
        Ciudad::create(['nombre' => 'Quilpué', 'provincia_estado_id' => $valparaiso->id]);
        
        $biobio = ProvinciaEstado::create(['nombre' => 'Biobío', 'pais_id' => $chile->id]);
        Ciudad::create(['nombre' => 'Concepción', 'provincia_estado_id' => $biobio->id]);
        Ciudad::create(['nombre' => 'Talcahuano', 'provincia_estado_id' => $biobio->id]);
        Ciudad::create(['nombre' => 'Los Ángeles', 'provincia_estado_id' => $biobio->id]);

        // PERÚ
        $peru = Pais::create(['nombre' => 'Perú']);
        
        $lima = ProvinciaEstado::create(['nombre' => 'Lima', 'pais_id' => $peru->id]);
        Ciudad::create(['nombre' => 'Lima', 'provincia_estado_id' => $lima->id]);
        Ciudad::create(['nombre' => 'Callao', 'provincia_estado_id' => $lima->id]);
        Ciudad::create(['nombre' => 'San Juan de Lurigancho', 'provincia_estado_id' => $lima->id]);
        
        $arequipa = ProvinciaEstado::create(['nombre' => 'Arequipa', 'pais_id' => $peru->id]);
        Ciudad::create(['nombre' => 'Arequipa', 'provincia_estado_id' => $arequipa->id]);
        Ciudad::create(['nombre' => 'Cayma', 'provincia_estado_id' => $arequipa->id]);
        
        $cusco = ProvinciaEstado::create(['nombre' => 'Cusco', 'pais_id' => $peru->id]);
        Ciudad::create(['nombre' => 'Cusco', 'provincia_estado_id' => $cusco->id]);
        Ciudad::create(['nombre' => 'Wanchaq', 'provincia_estado_id' => $cusco->id]);

        // ESPAÑA
        $espana = Pais::create(['nombre' => 'España']);
        
        $madrid = ProvinciaEstado::create(['nombre' => 'Comunidad de Madrid', 'pais_id' => $espana->id]);
        Ciudad::create(['nombre' => 'Madrid', 'provincia_estado_id' => $madrid->id]);
        Ciudad::create(['nombre' => 'Móstoles', 'provincia_estado_id' => $madrid->id]);
        Ciudad::create(['nombre' => 'Alcalá de Henares', 'provincia_estado_id' => $madrid->id]);
        
        $cataluna = ProvinciaEstado::create(['nombre' => 'Cataluña', 'pais_id' => $espana->id]);
        Ciudad::create(['nombre' => 'Barcelona', 'provincia_estado_id' => $cataluna->id]);
        Ciudad::create(['nombre' => 'Tarragona', 'provincia_estado_id' => $cataluna->id]);
        Ciudad::create(['nombre' => 'Girona', 'provincia_estado_id' => $cataluna->id]);
        
        $andalucia = ProvinciaEstado::create(['nombre' => 'Andalucía', 'pais_id' => $espana->id]);
        Ciudad::create(['nombre' => 'Sevilla', 'provincia_estado_id' => $andalucia->id]);
        Ciudad::create(['nombre' => 'Málaga', 'provincia_estado_id' => $andalucia->id]);
        Ciudad::create(['nombre' => 'Granada', 'provincia_estado_id' => $andalucia->id]);

        // ESTADOS UNIDOS
        $usa = Pais::create(['nombre' => 'Estados Unidos']);
        
        $california = ProvinciaEstado::create(['nombre' => 'California', 'pais_id' => $usa->id]);
        Ciudad::create(['nombre' => 'Los Ángeles', 'provincia_estado_id' => $california->id]);
        Ciudad::create(['nombre' => 'San Francisco', 'provincia_estado_id' => $california->id]);
        Ciudad::create(['nombre' => 'San Diego', 'provincia_estado_id' => $california->id]);
        
        $texas = ProvinciaEstado::create(['nombre' => 'Texas', 'pais_id' => $usa->id]);
        Ciudad::create(['nombre' => 'Houston', 'provincia_estado_id' => $texas->id]);
        Ciudad::create(['nombre' => 'Dallas', 'provincia_estado_id' => $texas->id]);
        Ciudad::create(['nombre' => 'Austin', 'provincia_estado_id' => $texas->id]);
        
        $newYork = ProvinciaEstado::create(['nombre' => 'Nueva York', 'pais_id' => $usa->id]);
        Ciudad::create(['nombre' => 'Nueva York', 'provincia_estado_id' => $newYork->id]);
        Ciudad::create(['nombre' => 'Buffalo', 'provincia_estado_id' => $newYork->id]);
        Ciudad::create(['nombre' => 'Rochester', 'provincia_estado_id' => $newYork->id]);

        // BRASIL
        $brasil = Pais::create(['nombre' => 'Brasil']);
        
        $saoPaulo = ProvinciaEstado::create(['nombre' => 'São Paulo', 'pais_id' => $brasil->id]);
        Ciudad::create(['nombre' => 'São Paulo', 'provincia_estado_id' => $saoPaulo->id]);
        Ciudad::create(['nombre' => 'Campinas', 'provincia_estado_id' => $saoPaulo->id]);
        Ciudad::create(['nombre' => 'Santos', 'provincia_estado_id' => $saoPaulo->id]);
        
        $rioDeJaneiro = ProvinciaEstado::create(['nombre' => 'Río de Janeiro', 'pais_id' => $brasil->id]);
        Ciudad::create(['nombre' => 'Río de Janeiro', 'provincia_estado_id' => $rioDeJaneiro->id]);
        Ciudad::create(['nombre' => 'Niterói', 'provincia_estado_id' => $rioDeJaneiro->id]);
        
        $minasGerais = ProvinciaEstado::create(['nombre' => 'Minas Gerais', 'pais_id' => $brasil->id]);
        Ciudad::create(['nombre' => 'Belo Horizonte', 'provincia_estado_id' => $minasGerais->id]);
        Ciudad::create(['nombre' => 'Uberlândia', 'provincia_estado_id' => $minasGerais->id]);

        // ECUADOR
        $ecuador = Pais::create(['nombre' => 'Ecuador']);
        
        $pichincha = ProvinciaEstado::create(['nombre' => 'Pichincha', 'pais_id' => $ecuador->id]);
        Ciudad::create(['nombre' => 'Quito', 'provincia_estado_id' => $pichincha->id]);
        Ciudad::create(['nombre' => 'Cayambe', 'provincia_estado_id' => $pichincha->id]);
        
        $guayas = ProvinciaEstado::create(['nombre' => 'Guayas', 'pais_id' => $ecuador->id]);
        Ciudad::create(['nombre' => 'Guayaquil', 'provincia_estado_id' => $guayas->id]);
        Ciudad::create(['nombre' => 'Durán', 'provincia_estado_id' => $guayas->id]);

        // VENEZUELA
        $venezuela = Pais::create(['nombre' => 'Venezuela']);
        
        $miranda = ProvinciaEstado::create(['nombre' => 'Miranda', 'pais_id' => $venezuela->id]);
        Ciudad::create(['nombre' => 'Los Teques', 'provincia_estado_id' => $miranda->id]);
        Ciudad::create(['nombre' => 'Guarenas', 'provincia_estado_id' => $miranda->id]);
        
        $carabobo = ProvinciaEstado::create(['nombre' => 'Carabobo', 'pais_id' => $venezuela->id]);
        Ciudad::create(['nombre' => 'Valencia', 'provincia_estado_id' => $carabobo->id]);
        Ciudad::create(['nombre' => 'Puerto Cabello', 'provincia_estado_id' => $carabobo->id]);

 
        echo "Países creados: 11\n";
        echo "Provincias/Estados creados: aproximadamente 35\n";
        echo "Ciudades creadas: aproximadamente 100\n";
    }
}