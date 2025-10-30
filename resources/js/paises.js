// Configuración de la API
const API_KEY = 'dGhkQ3JNdWw4bmtZek04Vkkxd0ZRcXQzSWdlY0F4QXVuSTRqVEcyVA==';
const API_BASE_URL = 'https://api.countrystatecity.in/v1';

// Headers para las peticiones
const headers = {
    'X-CSCAPI-KEY': API_KEY
};

// Función para cargar países
async function cargarPaises(selectElement, paisSeleccionadoIso = '') {
    try {
        selectElement.innerHTML = '<option value="">Cargando países...</option>';
        selectElement.disabled = true;
        
        const response = await fetch(`${API_BASE_URL}/countries`, { headers });
        const countries = await response.json();
        
        selectElement.innerHTML = '<option value="">Seleccione un país</option>';
        
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country.name; // Guardar el nombre completo
            option.textContent = country.name;
            option.setAttribute('data-iso', country.iso2); // ISO2 como data-attribute
            
            if (country.name === paisSeleccionadoIso) {
                option.selected = true;
            }
            
            selectElement.appendChild(option);
        });
        
        selectElement.disabled = false;
        
    } catch (error) {
        console.error('Error al cargar países:', error);
        selectElement.innerHTML = '<option value="">Error al cargar países</option>';
        selectElement.disabled = false;
    }
}

// Función para cargar estados/provincias
async function cargarEstados(selectElement, paisIso, estadoSeleccionadoIso = '') {
    try {
        if (!paisIso) {
            selectElement.innerHTML = '<option value="">Primero seleccione un país</option>';
            selectElement.disabled = true;
            return;
        }
        
        selectElement.innerHTML = '<option value="">Cargando estados...</option>';
        selectElement.disabled = true;
        
        const response = await fetch(`${API_BASE_URL}/countries/${paisIso}/states`, { headers });
        const states = await response.json();
        
        selectElement.innerHTML = '<option value="">Seleccione un estado/provincia</option>';
        
        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state.name; // Guardar el nombre completo
            option.textContent = state.name;
            option.setAttribute('data-iso', state.iso2); // ISO2 como data-attribute
            
            if (state.name === estadoSeleccionadoIso) {
                option.selected = true;
            }
            
            selectElement.appendChild(option);
        });
        
        selectElement.disabled = false;
        
    } catch (error) {
        console.error('Error al cargar estados:', error);
        selectElement.innerHTML = '<option value="">Error al cargar estados</option>';
        selectElement.disabled = false;
    }
}

// Función para cargar ciudades
async function cargarCiudades(selectElement, paisIso, estadoIso, ciudadSeleccionada = '') {
    try {
        if (!paisIso || !estadoIso) {
            selectElement.innerHTML = '<option value="">Primero seleccione país y estado</option>';
            selectElement.disabled = true;
            return;
        }
        
        selectElement.innerHTML = '<option value="">Cargando ciudades...</option>';
        selectElement.disabled = true;
        
        const response = await fetch(`${API_BASE_URL}/countries/${paisIso}/states/${estadoIso}/cities`, { headers });
        const cities = await response.json();
        
        selectElement.innerHTML = '<option value="">Seleccione una ciudad</option>';
        
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.name;
            option.textContent = city.name;
            
            if (city.name === ciudadSeleccionada) {
                option.selected = true;
            }
            
            selectElement.appendChild(option);
        });
        
        selectElement.disabled = false;
        
    } catch (error) {
        console.error('Error al cargar ciudades:', error);
        selectElement.innerHTML = '<option value="">Error al cargar ciudades</option>';
        selectElement.disabled = false;
    }
}

// Inicializar formulario de creación
document.addEventListener('DOMContentLoaded', function() {
    const selectPais = document.getElementById('pais_nombre');
    const selectProvincia = document.getElementById('provincia_nombre');
    const selectCiudad = document.getElementById('ciudad_nombre');
    
    if (selectPais) {
        // Cargar países al inicio
        cargarPaises(selectPais);
        
        // Evento cuando cambia el país
        selectPais.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const paisIso = selectedOption.getAttribute('data-iso');
            
            // Resetear estados y ciudades
            if (selectProvincia) {
                selectProvincia.innerHTML = '<option value="">Seleccione un estado/provincia</option>';
                selectProvincia.disabled = true;
            }
            if (selectCiudad) {
                selectCiudad.innerHTML = '<option value="">Seleccione una ciudad</option>';
                selectCiudad.disabled = true;
            }
            
            // Cargar estados del país seleccionado
            if (paisIso && selectProvincia) {
                cargarEstados(selectProvincia, paisIso);
            }
        });
    }
    
    if (selectProvincia) {
        // Evento cuando cambia el estado/provincia
        selectProvincia.addEventListener('change', function() {
            const selectedPaisOption = selectPais.options[selectPais.selectedIndex];
            const paisIso = selectedPaisOption.getAttribute('data-iso');
            
            const selectedProvinciaOption = this.options[this.selectedIndex];
            const estadoIso = selectedProvinciaOption.getAttribute('data-iso');
            
            // Resetear ciudades
            if (selectCiudad) {
                selectCiudad.innerHTML = '<option value="">Seleccione una ciudad</option>';
                selectCiudad.disabled = true;
            }
            
            // Cargar ciudades del estado seleccionado
            if (paisIso && estadoIso && selectCiudad) {
                cargarCiudades(selectCiudad, paisIso, estadoIso);
            }
        });
    }
});

// Exportar funciones para usar en otros archivos
window.cargarPaises = cargarPaises;
window.cargarEstados = cargarEstados;
window.cargarCiudades = cargarCiudades;