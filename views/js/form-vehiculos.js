document.addEventListener('DOMContentLoaded', function() {

    const selectorColor = document.getElementById('color');
    const campoOtroColor = document.getElementById('campo_otro_color');
    const inputOtroColor = document.getElementById('otro_color');

    if (selectorColor && campoOtroColor && inputOtroColor) {
        
        campoOtroColor.style.display = 'none';
        
        selectorColor.addEventListener('change', function() {
            if (this.value === 'Otro') {
                campoOtroColor.style.display = 'block'; 
                inputOtroColor.required = true;
            } else {
                campoOtroColor.style.display = 'none';
                inputOtroColor.required = false;
                inputOtroColor.value = '';
            }
        });
    }

});

const modal = document.getElementById('modal-detalles');
const modalBody = document.getElementById('modal-body');

function verDetalles(idVehiculo) {
    const modal = document.getElementById('modal-detalles');
    const modalBody = document.getElementById('modal-body');

    modalBody.innerHTML = 'Cargando documentación...';
    modal.style.display = 'flex'; 

    fetch(`${BASE_URL}controllers/vehiculoController.php?action=obtener_documentos&id=${idVehiculo}`)
        .then(response => {
            if (!response.ok) {
                console.error('Error de red o servidor:', response.status, response.statusText);
                throw new Error('La respuesta del servidor no fue OK');
            }
            return response.json();
        })
        .then(data => { 

            if (data.error) {
                modalBody.innerHTML = `<p class="error-msg">Error: ${data.error}</p>`;
                return;
            }
            
            const crearItemDoc = (etiqueta, valor) => {
                const statusClass = valor == 1 ? 'doc-presente' : 'doc-ausente';
                const statusTexto = valor == 1 ? 'Sí' : 'No';
                return `<li><strong>${etiqueta}:</strong> <span class="${statusClass}">${statusTexto}</span></li>`;
            };

            let html = `<h2>Documentación del Vehículo</h2>
                        <div class="detalles-grid">
                            <ul>
                                ${crearItemDoc('Título de Propiedad', data.Original_TotalPropiedad)}
                                ${crearItemDoc('Experticia de Tránsito', data.Experticia_Transito)}
                                ${crearItemDoc('Certificado de Origen', data.Certificado_Origen)}
                                ${crearItemDoc('Carnet de Circulación', data.Carnet_Circulacion)}
                                ${crearItemDoc('Reserva de Dominio', data.Reserva_Dominio)}
                                ${crearItemDoc('Finiquito', data.Finiquito)}  
                            </ul>
                            <ul>
                                ${crearItemDoc('Resguardo', data.Resguardo)}
                                ${crearItemDoc('Gato', data.Gato)}
                                ${crearItemDoc('Repuesto', data.Repuesto)}
                                ${crearItemDoc('Triángulo', data.Triangulo)}
                                ${crearItemDoc('Seguro', data.Seguro)}
                                ${crearItemDoc('Factura de Compra', data.Factura_Compra)}
                            </ul>
                        </div>
                        <hr>
                        <div class="detalles-extra">
                            <p><strong>Kilometraje Registrado:</strong> ${data.Kilometraje ? data.Kilometraje + ' km' : 'No especificado'}</p>
                            <p><strong>Fecha de Ingreso:</strong> ${data.Fecha_Ingreso ? new Date(data.Fecha_Ingreso).toLocaleDateString() : 'No especificada'}</p>
                        </div>`;

            if (data.Otro_Documento) {
                html += `<div class="detalles-otros">
                            <h3>Observaciones / Otros Documentos:</h3>
                            <p>${data.Otro_Documento}</p>
                         </div>`;
            }

            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = `<p class="error-msg">No se pudieron cargar los datos. Verifique la consola.</p>`;
            console.error('Error en fetch:', error);
        });
}

function cerrarModal() {
    const modal = document.getElementById('modal-detalles');
    if (modal) {
        modal.style.display = 'none';
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('modal-detalles');
    if (event.target == modal) {
        cerrarModal();
    }
}

$(document).ready(function() {
    $('#imagen_url').on('change', function() {
        var files = $(this)[0].files; 
        var fileNameSpan = $(this).siblings('.file-name');

        if (files.length > 1) {
            fileNameSpan.text(files.length + ' archivos seleccionados');
            fileNameSpan.addClass('file-selected'); 
        } else if (files.length === 1) {
            fileNameSpan.text(files[0].name);
            fileNameSpan.addClass('file-selected');
        } else {
            fileNameSpan.text('Las nuevas imágenes se añadirán a las existentes');
            fileNameSpan.removeClass('file-selected'); 
        }
    });

});