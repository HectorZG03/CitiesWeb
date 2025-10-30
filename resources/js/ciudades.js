// Escuchar evento cuando el modal de actualizar se abre
document.addEventListener('DOMContentLoaded', function() {
    const modalElement = document.getElementById('modalActualizar');
    
    if (modalElement) {
        modalElement.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            
            const id = button.getAttribute('data-id');
            const ciudad = button.getAttribute('data-ciudad');
            const provincia = button.getAttribute('data-provincia');
            const pais = button.getAttribute('data-pais');
            
            document.getElementById('edit_ciudad_nombre').value = ciudad;
            document.getElementById('edit_provincia_nombre').value = provincia;
            document.getElementById('edit_pais_nombre').value = pais;
            
            const form = document.getElementById('formActualizar');
            form.action = `/ciudades/${id}`;
        });
    }

});