$(document).ready(function() {
    console.log('[DEBUG] crud-handler.js cargado y listo.');

    if (typeof API_URL === 'undefined') {
        console.error('Error: La constante global API_URL no está definida.');
        return;
    }

    const tablaBody = $('[id^="tabla-"]').first();
    const mensajeGlobalDiv = $('#mensaje-global');
    
    if (tablaBody.length === 0) return;

    let crudType = '';
    const tablaId = tablaBody.attr('id');
    if (tablaId.includes('clientes')) crudType = 'cliente';
    else if (tablaId.includes('citas')) crudType = 'cita';
    else if (tablaId.includes('vendedores')) crudType = 'vendedor';
    else if (tablaId.includes('proveedores')) crudType = 'proveedor';

    console.log('[DEBUG] Tipo de CRUD detectado:', crudType);

    tablaBody.on('click', 'button', function(event) {
        event.preventDefault();
        const btn = $(this);
        const fila = btn.closest('tr');

        if (btn.hasClass('btn-editar')) {
            console.log('[DEBUG] Botón "Editar" presionado.');
            activarModoEdicion(fila);
        }
        else if (btn.hasClass('btn-guardar')) guardarCambios(fila);
        else if (btn.hasClass('btn-cancelar')) cancelarModoEdicion(fila);
        else if (btn.hasClass('btn-eliminar')) eliminarFila(fila, btn.data('url'));
    });

    function activarModoEdicion(fila) {
        console.log('[DEBUG] Entrando a activarModoEdicion.');
        if (fila.hasClass('edit-mode')) return;
        fila.addClass('edit-mode');
        
        const camposEditables = {
            cliente: ['Nombre', 'Apellido', 'Cedula', 'Telefono', 'Correo', 'Rif', 'Direccion'],
            cita: ['Fecha', 'Hora', 'Estado'], 
            vendedor: ['Nombre_Apellido', 'Cedula', 'Telefono', 'Rif', 'Copia_Llaves', 'Garantia_Vehiculo', 'Certificado_Garantia', 'Manual_VehiculoGarantia'],
            proveedor: ['Nombre', 'Apellido', 'Direccion', 'Cedula', 'Telefono', 'Tipo']
        };

        fila.find('td[data-field]').each(function() {
            const celda = $(this);
            const nombreCampo = celda.data('field');
            console.log(`[DEBUG] Procesando campo: "${nombreCampo}" con crudType: "${crudType}"`);
            
            if (!camposEditables[crudType] || !camposEditables[crudType].includes(nombreCampo)) {
                console.log(`[DEBUG] El campo "${nombreCampo}" NO es editable. Saltando.`);
                return; 
            }
            
            console.log(`[DEBUG] El campo "${nombreCampo}" SÍ es editable.`);
            const valorActual = celda.text().trim();
            celda.attr('data-original-value', valorActual);
            let inputHtml = '';

            if (nombreCampo === 'Estado' && crudType === 'cita') {
                inputHtml = `
                    <select name="Estado">
                        <option value="Pendiente" ${valorActual === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
                        <option value="Confirmada" ${valorActual === 'Confirmada' ? 'selected' : ''}>Confirmada</option>
                        <option value="Cancelada" ${valorActual === 'Cancelada' ? 'selected' : ''}>Cancelada</option>
                    </select>`;
            } else if (nombreCampo === 'Tipo' && crudType === 'proveedor') {
                inputHtml = `<select name="Tipo"><option value="Local" ${valorActual === 'Local' ? 'selected' : ''}>Local</option><option value="Nacional" ${valorActual === 'Nacional' ? 'selected' : ''}>Nacional</option><option value="Internacional" ${valorActual === 'Internacional' ? 'selected' : ''}>Internacional</option></select>`;
            } else if (nombreCampo === 'Direccion') {
                inputHtml = `<textarea name="${nombreCampo}">${valorActual}</textarea>`;
            } else if (nombreCampo === 'Fecha') { 
                 inputHtml = `<input type="date" name="Fecha" value="${valorActual}">`;
            } else if (nombreCampo === 'Hora') { 
                 inputHtml = `<input type="time" name="Hora" value="${valorActual}">`;
            } else {
                inputHtml = `<input type="text" name="${nombreCampo}" value="${valorActual}">`;
            }
            
            console.log(`[DEBUG] HTML generado para el input:`, inputHtml);
            celda.html(inputHtml);
        });

        fila.find('.acciones').html(`<button class="btn-guardar">Guardar</button><button class="btn-cancelar">Cancelar</button>`);
    }

    function guardarCambios(fila) {
        let formData = new FormData();
        let action = '';

        switch(crudType) {
            case 'cliente': action = 'admin_actualizar_cliente'; formData.append('Id_Cliente', fila.data('id-cliente')); formData.append('Id_Usuario', fila.data('id-usuario')); break;
            case 'cita': action = 'admin_actualizar_cita'; formData.append('Id_Citas', fila.data('id-cita')); break;
            case 'vendedor': action = 'admin_actualizar_vendedor'; formData.append('Id_Vendedor', fila.data('id-vendedor')); break;
            case 'proveedor': action = 'admin_actualizar_proveedor'; formData.append('Id_Proveedor', fila.data('id-proveedor')); break;
        }
        formData.append('action', action);

        fila.find('input[type="text"], input[type="date"], input[type="time"], select, textarea').each(function() { formData.append($(this).attr('name'), $(this).val()); });
        fila.find('input[type="checkbox"]:checked').each(function() { formData.append($(this).attr('name'), $(this).val()); });

        $.ajax({
            url: API_URL, method: 'POST', data: formData, dataType: 'json', processData: false, contentType: false,
            success: function(response) {
                mostrarMensaje(response.message, 'exito');
                desactivarModoEdicion(fila, Object.fromEntries(formData.entries()), true);
            },
            error: function(jqXHR) {
                const errorMsg = jqXHR.responseJSON ? jqXHR.responseJSON.message : 'Error de conexión. Revisa la consola (F12).';
                mostrarMensaje(errorMsg, 'error');
            }
        });
    }

    function cancelarModoEdicion(fila) { desactivarModoEdicion(fila, null, false); }
    
    function desactivarModoEdicion(fila, nuevosDatos, fueExitoso) {
        fila.removeClass('edit-mode');
        
        fila.find('td[data-field]').each(function() {
            const celda = $(this);
            const nombreCampo = celda.data('field');
            if (celda.find('input, select, textarea').length > 0) {
                 let valorFinal = fueExitoso ? (nuevosDatos[nombreCampo] || '') : celda.data('original-value');
                 if (['Copia_Llaves', 'Garantia_Vehiculo', 'Certificado_Garantia', 'Manual_VehiculoGarantia'].includes(nombreCampo)) {
                    valorFinal = (fueExitoso && nuevosDatos[nombreCampo]) ? 'Sí' : 'No';
                    if (!fueExitoso) { valorFinal = celda.data('original-value'); }
                 }
                 celda.text(valorFinal);
            }
        });

        let id, urlEliminar, actionEliminar, controllerName = '';

        switch(crudType) {
            case 'cliente': id = fila.data('id-cliente'); actionEliminar = 'admin_eliminar_cliente'; controllerName = 'usuarioClienteCitaController.php'; break;
            case 'cita': id = fila.data('id-cita'); actionEliminar = 'admin_eliminar_cita'; controllerName = 'usuarioClienteCitaController.php'; break;
            case 'vendedor': id = fila.data('id-vendedor'); actionEliminar = 'admin_eliminar_vendedor'; controllerName = 'vendedorController.php'; break;
            case 'proveedor': id = fila.data('id-proveedor'); actionEliminar = 'admin_eliminar_proveedor'; controllerName = 'proveedorController.php'; break;
        }
        
        const controllerPath = API_URL.substring(0, API_URL.lastIndexOf('/') + 1);
        urlEliminar = `${controllerPath}${controllerName}?action=${actionEliminar}&id=${id}`;
        fila.find('.acciones').html(`<button class="btn-editar">Editar</button><button class="btn-eliminar" data-url="${urlEliminar}">Eliminar</button>`);
    }

    function eliminarFila(fila, url) {
        let confirmMessage = '¿Estás seguro?';
        if (crudType === 'proveedor') confirmMessage = '¿Estás seguro de eliminar este proveedor?';
        else if (crudType === 'vendedor') confirmMessage = '¿Estás seguro de eliminar este vendedor?';
        else if (crudType === 'cliente') confirmMessage = '¿Estás seguro de eliminar este cliente?';
        
        if (confirm(confirmMessage)) {
            $.ajax({
                url: url, type: 'GET', dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        mostrarMensaje(response.message, 'exito');
                        fila.addClass('fila-eliminada').fadeOut(500, function() { $(this).remove(); });
                    } else { mostrarMensaje(response.message, 'error'); }
                },
                error: function(jqXHR) { mostrarMensaje(jqXHR.responseJSON ? jqXHR.responseJSON.message : 'Error de conexión.', 'error'); }
            });
        }
    }

    function mostrarMensaje(texto, tipo) {
        mensajeGlobalDiv.text(texto).removeClass('exito error').addClass(tipo).fadeIn();
        setTimeout(() => mensajeGlobalDiv.fadeOut(), 4000);
    }
});