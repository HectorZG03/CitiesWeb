
//modal usado en todas las vistas para eliminacion
document.addEventListener('DOMContentLoaded', function() {

    const modalesEliminar = document.querySelectorAll('[id^="modalEliminar"]');
    
    modalesEliminar.forEach(modalElement => {
        const modalId = modalElement.id;
        
        modalElement.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            
            const id = button.getAttribute('data-id');
            const elementoNombre = button.getAttribute('data-elemento-nombre');
            const urlEliminar = button.getAttribute('data-url-eliminar');
            
            // Actualizar el texto del elemento a eliminar
            const elementoEliminar = document.getElementById(`elemento-eliminar-${modalId}`);
            if (elementoEliminar) {
                elementoEliminar.textContent = elementoNombre;
            }
            
            // Actualizar la acción del formulario
            const form = document.getElementById(`formEliminar-${modalId}`);
            if (form && urlEliminar) {
                form.action = urlEliminar;
            }
        });
    });
});