document.addEventListener('DOMContentLoaded', function() {
    // Buscar todos los inputs cuyo ID comience con "buscador"
    const buscadores = document.querySelectorAll('[id^="buscador"]');
    
    buscadores.forEach(function(buscador) {
        let timeoutId = null;
        
        buscador.addEventListener('keyup', function() {
            const texto = this.value.toLowerCase();
            

            clearTimeout(timeoutId);
            

            timeoutId = setTimeout(function() {               
                const url = new URL(window.location.href);
                
                if (texto.trim() !== '') {
                    url.searchParams.set('buscar', texto);
                } else {
                    url.searchParams.delete('buscar');
                }


                fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {

                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    
                    const tablaActual = buscador.closest('.card-body').querySelector('tbody');
                    

                    const tablaId = tablaActual ? tablaActual.id : null;
                    const nuevaTabla = tablaId ? doc.getElementById(tablaId) : doc.querySelector('tbody');
                    
                    if (tablaActual && nuevaTabla) {
                        tablaActual.innerHTML = nuevaTabla.innerHTML;
                    }

                    window.history.pushState({}, '', url.toString());
                })
                .catch(error => {
                    console.error('Error en la búsqueda:', error);
                });
            }, 500);
        });
    });
});