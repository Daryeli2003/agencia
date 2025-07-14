document.addEventListener('DOMContentLoaded', function() {
    const catalogoSelect = document.getElementById('catalogo');

    fetch('/api/catalogo') 
        .then(response => response.json())
        .then(data => {
            data.forEach(servicio => {
                const option = document.createElement('option');
                option.value = servicio.id_catalogo;
                option.textContent = servicio.nombre_servicio; 
                catalogoSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar el catálogo:', error);
        });
});