// Función para cargar países desde la API
async function cargarPaises(selectElement, paisSeleccionado = '') {
    try {
        // Mostrar la carga en el select
        selectElement.innerHTML = '<option value="">Cargando países...</option>';
        
        //Esta api no require de una API KEY
        const response = await fetch('https://restcountries.com/v3.1/all?fields=name,translations');
        const countries = await response.json();
        

        countries.sort((a, b) => {
            const nameA = a.translations.spa?.common || a.name.common;
            const nameB = b.translations.spa?.common || b.name.common;
            return nameA.localeCompare(nameB);
        });
        
        // Limpiar y llenar el select
        selectElement.innerHTML = '<option value="">Seleccione un país</option>';
        
        countries.forEach(country => {
            const countryName = country.translations.spa?.common || country.name.common;
            const option = document.createElement('option');
            option.value = countryName;
            option.textContent = countryName;
            
            if (countryName === paisSeleccionado) {
                option.selected = true;
            }
            
            selectElement.appendChild(option);
        });
        
    } catch (error) {
        console.error('Error al cargar países:', error);
        selectElement.innerHTML = '<option value="">Error al cargar países</option>';
    }
}

// Cargar países cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const selectPais = document.getElementById('pais_nombre');
    const selectEditPais = document.getElementById('edit_pais_nombre');
    
    // Cargar países en el formulario principal
    if (selectPais) {
        cargarPaises(selectPais);
    }
    
    // Cargar países en el modal de edición cuando se abra
    const modalActualizar = document.getElementById('modalActualizar');
    if (modalActualizar) {
        modalActualizar.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const pais = button.getAttribute('data-pais');
            
            if (selectEditPais) {
                // Primero cargar todos los países, luego seleccionar el correcto
                cargarPaises(selectEditPais, pais);
            }
        });
    }
});