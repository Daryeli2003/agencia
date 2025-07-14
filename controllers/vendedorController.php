<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/models/vendedorModel.php';

function registrarVendedor($model) {

    if (empty($_POST['Nombre_Apellido']) || empty($_POST['Cedula'])) {
        header('Location: ' . BASE_URL . 'index.php?page=registrarVendedor&error=faltan_datos');
        exit;
    }

    if ($model->registrarVendedor($_POST)) {
        header('Location: ' . BASE_URL . 'index.php?page=consultarVendedor&status=success');
        exit;
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=registrarVendedor&error=db_error');
        exit;
    }
}

function adminActualizarVendedor($model) {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit;
    }

    $datos = $_POST;
    $idVendedor = $datos['Id_Vendedor'] ?? null;

    if (!$idVendedor) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Falta el ID del Vendedor.']);
        exit;
    }

    if ($model->actualizarVendedor($idVendedor, $datos)) {
        echo json_encode(['success' => true, 'message' => 'Vendedor actualizado correctamente.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el vendedor en la base de datos.']);
    }
    exit;
}

function adminEliminarVendedor($model) {
    header('Content-Type: application/json');
    $idVendedor = $_GET['id'] ?? null;

    if (!$idVendedor) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID de vendedor no proporcionado.']);
        exit;
    }

    if ($model->eliminarVendedor($idVendedor)) {
        echo json_encode(['success' => true, 'message' => 'Vendedor eliminado correctamente.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el vendedor.']);
    }
    exit;
}

$model = new VendedorModel();
$action = $_POST['action'] ?? $_GET['action'] ?? null;

try {
    switch ($action) {
        case 'registrar_vendedor':
            registrarVendedor($model);
            break;
        case 'admin_actualizar_vendedor':
            adminActualizarVendedor($model);
            break;
        case 'admin_eliminar_vendedor':
            adminEliminarVendedor($model);
            break;
        default:
            break;
    }
} catch (Exception $e) {
    error_log("Error fatal en vendedorController.php: " . $e->getMessage());
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Ocurrió un error inesperado en el servidor.']);
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=error&msg=inesperado');
    }
    exit;
}