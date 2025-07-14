<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/config.php';
require_once 'config/conexion.php'; 

$pagina_solicitada = $_GET['page'] ?? 'home';

$paginas_permitidas = [
    'home'                   => 'views/home.php',

    'registrar_vehiculo'     => 'views/registrar_vehiculo.php',
    'registrar_documentacion'=> 'views/registrar_documentacion.php', 
    'lista_vehiculos'        => 'views/lista_vehiculos.php',
    'editar_vehiculo'        => 'views/editar_vehiculo.php',

    'gestion_marcas'  => 'views/gestion_marcas.php',
    'editar_marca'    => 'views/editar_marca.php',

    'gestion_modelo'  => 'views/gestion_modelo.php',
    'editar_modelo'   => 'views/editar_modelo.php',

    'mantenimiento'         => 'views/mantenimiento.php',
    'serviciosrealizados'   => 'views/serviciosrealizados.php',

    'mostrar_catalogo'  => 'views/mostrar_catalogo.php',
    'catalogo_pagina'   => 'views/catalogo_pagina.php',
    'login'             => 'views/login.php',

    'registrarCliente'  => 'views/registrarCliente.php',
    'consultarCliente'  => 'views/consultarCliente.php',

    'agendarCita'       => 'views/agendarCita.php',
    'estadoCita'        => 'views/estadoCita.php',

    'registrarProveedor' => 'views/registrarProveedor.php',
    'consultarProveedor' => 'views/consultarProveedor.php',

    'registrarVendedor'  => 'views/registrarVendedor.php',
    'consultarVendedor'  => 'views/consultarVendedor.php',
];

if (array_key_exists($pagina_solicitada, $paginas_permitidas)) {
    $ruta_archivo = $paginas_permitidas[$pagina_solicitada];
    }

if (array_key_exists($pagina_solicitada, $paginas_permitidas)) {
    $ruta_archivo = $paginas_permitidas[$pagina_solicitada];
    
    if (file_exists($ruta_archivo)) {
        require_once $ruta_archivo;
    } else {
        http_response_code(404);
        echo "<h1>Error 404: Archivo de vista no encontrado.</h1>";
        error_log("Error en index.php: El archivo para '{$pagina_solicitada}' no fue encontrado en '{$ruta_archivo}'.");
    }
} else {
    http_response_code(404);
    echo "<h1>Error 404: La página que busca no existe.</h1>";
}
?>