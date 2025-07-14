$(document).ready(function() {
    $('#formularioVehiculo').on('submit', function(event) {
        
        var inputFile = $('#imagen_url');
        if (inputFile.length > 0 && inputFile[0].files.length === 0) {
            event.preventDefault();
            swal({
                title: "¡Atención!",
                text: "Es obligatorio subir al menos una imagen del vehículo.",
                type: "warning",
                confirmButtonText: "De acuerdo"
            });
        }
    });

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
            fileNameSpan.text('Archivo seleccionado');
            fileNameSpan.removeClass('file-selected'); 
        }
    });
});