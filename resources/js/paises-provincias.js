//MOdales para paises provincias

document.addEventListener('DOMContentLoaded', function() {
    
    // MODAL EDITAR PAÍS
    const modalEditarPais = document.getElementById('modalEditarPais');
    if (modalEditarPais) {
        modalEditarPais.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            
            document.getElementById('edit_nombre_pais').value = nombre;
            document.getElementById('formEditarPais').action = `/paises-provincias/pais/${id}`;
        });
    }

    // MODAL EDITAR PROVINCIA
    const modalEditarProvincia = document.getElementById('modalEditarProvincia');
    if (modalEditarProvincia) {
        modalEditarProvincia.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nombre = button.getAttribute('data-nombre');
            const paisId = button.getAttribute('data-pais-id');
            
            document.getElementById('edit_nombre_provincia').value = nombre;
            document.getElementById('edit_pais_id').value = paisId;
            document.getElementById('formEditarProvincia').action = `/paises-provincias/provincia/${id}`;
        });
    }

});