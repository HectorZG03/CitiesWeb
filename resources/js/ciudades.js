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
            
            const selectEditPais = document.getElementById('edit_pais_nombre');
            const selectEditProvincia = document.getElementById('edit_provincia_nombre');
            const selectEditCiudad = document.getElementById('edit_ciudad_nombre');
            
            // Cargar países primero
            if (selectEditPais && window.cargarPaises) {
                window.cargarPaises(selectEditPais).then(() => {
                    // Buscar el país por nombre (ahora el value es el nombre)
                    const paisOption = Array.from(selectEditPais.options).find(opt => 
                        opt.value === pais
                    );
                    
                    if (paisOption) {
                        selectEditPais.value = paisOption.value;
                        const paisIso = paisOption.getAttribute('data-iso');
                        
                        // Cargar estados del país
                        if (selectEditProvincia && window.cargarEstados) {
                            window.cargarEstados(selectEditProvincia, paisIso).then(() => {
                                // Buscar el estado por nombre (ahora el value es el nombre)
                                const provinciaOption = Array.from(selectEditProvincia.options).find(opt => 
                                    opt.value === provincia
                                );
                                
                                if (provinciaOption) {
                                    selectEditProvincia.value = provinciaOption.value;
                                    const estadoIso = provinciaOption.getAttribute('data-iso');
                                    
                                    // Cargar ciudades del estado
                                    if (selectEditCiudad && window.cargarCiudades) {
                                        window.cargarCiudades(selectEditCiudad, paisIso, estadoIso, ciudad);
                                    }
                                }
                            });
                        }
                    }
                });
            }
            
            // Actualizar la acción del formulario
            const form = document.getElementById('formActualizar');
            form.action = `/ciudades/${id}`;
        });
        
        // Eventos de cambio en el modal de edición
        const selectEditPais = document.getElementById('edit_pais_nombre');
        const selectEditProvincia = document.getElementById('edit_provincia_nombre');
        const selectEditCiudad = document.getElementById('edit_ciudad_nombre');
        
        if (selectEditPais) {
            selectEditPais.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const paisIso = selectedOption.getAttribute('data-iso');
                
                // Resetear estados y ciudades
                if (selectEditProvincia) {
                    selectEditProvincia.innerHTML = '<option value="">Seleccione un estado/provincia</option>';
                    selectEditProvincia.disabled = true;
                }
                if (selectEditCiudad) {
                    selectEditCiudad.innerHTML = '<option value="">Seleccione una ciudad</option>';
                    selectEditCiudad.disabled = true;
                }
                
                // Cargar estados del país seleccionado
                if (paisIso && selectEditProvincia && window.cargarEstados) {
                    window.cargarEstados(selectEditProvincia, paisIso);
                }
            });
        }
        
        if (selectEditProvincia) {
            selectEditProvincia.addEventListener('change', function() {
                const selectedPaisOption = selectEditPais.options[selectEditPais.selectedIndex];
                const paisIso = selectedPaisOption.getAttribute('data-iso');
                
                const selectedProvinciaOption = this.options[this.selectedIndex];
                const estadoIso = selectedProvinciaOption.getAttribute('data-iso');
                
                // Resetear ciudades
                if (selectEditCiudad) {
                    selectEditCiudad.innerHTML = '<option value="">Seleccione una ciudad</option>';
                    selectEditCiudad.disabled = true;
                }
                
                // Cargar ciudades del estado seleccionado
                if (paisIso && estadoIso && selectEditCiudad && window.cargarCiudades) {
                    window.cargarCiudades(selectEditCiudad, paisIso, estadoIso);
                }
            });
        }
    }
});