document.addEventListener('DOMContentLoaded', function() {
    const buscador = document.getElementById('buscador');
    
    if (buscador) {
        buscador.addEventListener('keyup', function() {
            const texto = this.value.toLowerCase();
            const filas = document.querySelectorAll('tbody tr');
            
            filas.forEach(function(fila) {
                const contenido = fila.textContent.toLowerCase();
                
                if (contenido.includes(texto)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    }
});