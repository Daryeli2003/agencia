<?php

session_start();

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/models/MantenimientoModel.php';

$model = new MantenimientoModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $accionesPermitidas = ['crear', 'editar', 'eliminar'];

    if (!in_array($accion, $accionesPermitidas)) {
        header('Location: ' . BASE_URL . 'index.php?page=mantenimiento&error=accion_invalida');
        exit;
    }

    try {
        switch ($accion) {
            case 'crear':
                $datos = [
                    'id_Mantenimiento' => $_POST['id_Mantenimiento'],
                    'Fecha' => $_POST['Fecha'],
                    'Descripcion' => $_POST['Descripcion'],
                    'quien_autoriza' => $_POST['quien_autoriza']
                ];
                if ($model->crearMantenimiento($datos)) {
                    // ===== CORRECCIÓN: Redirige al listado 'serviciosrealizados' =====
                    header('Location: ' . BASE_URL . 'index.php?page=serviciosrealizados&status=creado');
                } else {
                    throw new Exception("Error al crear el mantenimiento.");
                }
                break;

            case 'editar':
                $datos = [
                    'id_Mantenimiento' => $_POST['id_Mantenimiento'],
                    'Fecha' => $_POST['Fecha'],
                    'Descripcion' => $_POST['Descripcion'],
                    'quien_autoriza' => $_POST['quien_autoriza']
                ];
                if ($model->editarMantenimiento($datos)) {
    
                    header('Location: ' . BASE_URL . 'index.php?page=serviciosrealizados&status=actualizado');
                } else {
                    throw new Exception("Error al actualizar el mantenimiento.");
                }
                break;

            case 'eliminar':
                $idEliminar = $_POST['id_eliminar'];
                if ($model->eliminarMantenimiento($idEliminar)) {
                    
                    header('Location: ' . BASE_URL . 'index.php?page=serviciosrealizados&status=eliminado');
                } else {
                    throw new Exception("Error al eliminar el mantenimiento.");
                }
                break;
        }
    } catch (Exception $e) {
        $_SESSION['form_data'] = $_POST;
        
        header('Location: ' . BASE_URL . 'index.php?page=mantenimiento&error=' . urlencode($e->getMessage()));
    }
    exit;
} else {
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}