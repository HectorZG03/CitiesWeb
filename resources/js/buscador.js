document.addEventListener('DOMContentLoaded', function() {
    // Buscar todos los inputs cuyo ID comience con "buscador"
    const buscadores = document.querySelectorAll('[id^="buscador"]');
    
    buscadores.forEach(function(buscador) {
        buscador.addEventListener('keyup', function() {
            const texto = this.value.toLowerCase();
            
            // Buscar la tabla más cercana al buscador
            const tabla = buscador.closest('.card-body').querySelector('tbody');
            
            if (tabla) {
                const filas = tabla.querySelectorAll('tr');
                
                filas.forEach(function(fila) {
                    const contenido = fila.textContent.toLowerCase();
                    
                    if (contenido.includes(texto)) {
                        fila.style.display = '';
                    } else {
                        fila.style.display = 'none';
                    }
                });
            }
        });
    });
});