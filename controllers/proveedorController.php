<?php
// controllers/proveedorController.php

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/models/proveedorModel.php';

// --- FUNCIONES DEL CONTROLADOR PARA EL CRUD DE PROVEEDOR ---

function registrarProveedor($model) {
    if (empty($_POST['Nombre']) || empty($_POST['Apellido'])) {
        header('Location: ' . BASE_URL . 'index.php?page=registrarProveedor&error=faltan_datos');
        exit;
    }

    if ($model->registrarProveedor($_POST)) {
        header('Location: ' . BASE_URL . 'index.php?page=consultarProveedor&status=success');
        exit;
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=registrarProveedor&error=db_error');
        exit;
    }
}

function adminActualizarProveedor($model) {
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit;
    }
    $datos = $_POST;
    $idProveedor = $datos['Id_Proveedor'] ?? null;
    if (!$idProveedor) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Falta el ID del Proveedor.']);
        exit;
    }
    if ($model->actualizarProveedor($idProveedor, $datos)) {
        echo json_encode(['success' => true, 'message' => 'Proveedor actualizado correctamente.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el proveedor en la base de datos.']);
    }
    exit;
}

function adminEliminarProveedor($model) {
    header('Content-Type: application/json');
    $idProveedor = $_GET['id'] ?? null;
    if (!$idProveedor) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID de proveedor no proporcionado.']);
        exit;
    }
    if ($model->eliminarProveedor($idProveedor)) {
        echo json_encode(['success' => true, 'message' => 'Proveedor eliminado correctamente.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el proveedor.']);
    }
    exit;
}

// -------------------
// ENRUTADOR PRINCIPAL DEL CONTROLADOR
// -------------------
$model = new ProveedorModel();
$action = $_POST['action'] ?? $_GET['action'] ?? null;

try {
    switch ($action) {
        case 'registrar_proveedor':
            registrarProveedor($model);
            break;
        case 'admin_actualizar_proveedor':
            adminActualizarProveedor($model);
            break;
        case 'admin_eliminar_proveedor':
            adminEliminarProveedor($model);
            break;
        default:
            // Si el archivo es llamado sin una acción válida, redirige al inicio para evitar páginas en blanco.
            header('Location: ' . BASE_URL . 'index.php?page=home');
            exit;
    }
} catch (Exception $e) {
    error_log("Error fatal en proveedorController.php: " . $e->getMessage());
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Ocurrió un error inesperado.']);
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=error&msg=inesperado');
    }
    exit;
}