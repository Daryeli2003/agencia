<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/models/usuarioClienteCitaModel.php';

function registrarPaso1Cliente() {
    if (empty($_POST['nombre']) || empty($_POST['cedula']) || empty($_POST['correo'])) {
        header('Location: ' . BASE_URL . 'index.php?page=registrarCliente&error=faltan_datos');
        exit;
    }
    
    $_SESSION['datos_cliente_temporal'] = $_POST;
    header('Location: ' . BASE_URL . 'index.php?page=agendarCita');
    exit;
}

function registrarPaso2Cita($model) {
    if (!isset($_SESSION['datos_cliente_temporal'])) {
        header('Location: ' . BASE_URL . 'index.php?page=registrarCliente&error=sesion_expirada');
        exit;
    }
    
    if (empty($_POST['fecha']) || empty($_POST['hora'])) {
        header('Location: ' . BASE_URL . 'index.php?page=agendarCita&error=faltan_datos_cita');
        exit;
    }
    
    $datosCliente = $_SESSION['datos_cliente_temporal'];
    $datosCita = $_POST;
    $datosCompletos = array_merge($datosCliente, $datosCita);
    
    if ($model->registrarCitaCompleta($datosCompletos)) {
        unset($_SESSION['datos_cliente_temporal']);
        header('Location: ' . BASE_URL . 'index.php?page=estadoCita&status=success');
        exit;
    } else {
        unset($_SESSION['datos_cliente_temporal']);
        header('Location: ' . BASE_URL . 'index.php?page=registrarCliente&error=db_error');
        exit;
    }
}

function registrarUsuarioCliente($model) {
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['contrasena'])) {
        header('Location: ' . BASE_URL . 'index.php?page=registro&error=faltan_datos');
        exit;
    }
    
    $idUsuario = $model->registrarUsuario($_POST);

    if ($idUsuario) {
        $_SESSION['id_usuario_registrado'] = $idUsuario;
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit;
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=registro&error=db_error');
        exit;
    }
}

function solicitarCita($model) {
    if (!isset($_SESSION['id_usuario_registrado'])) {
        header('Location: ' . BASE_URL . 'index.php?page=login&error=no_autenticado');
        exit;
    }
    
    $idUsuario = $_SESSION['id_usuario_registrado'];
    $clienteExistente = $model->obtenerClientePorUsuarioId($idUsuario);
    $idCliente = $clienteExistente ? $clienteExistente->Id_Cliente : $model->registrarCliente($_POST['rif'], $idUsuario);

    if (!$idCliente) {
        header('Location: ' . BASE_URL . 'index.php?page=solicitar_cita&error=cliente_error');
        exit;
    }
    
    $datosCita = [
        'fecha' => $_POST['fecha'],
        'hora' => $_POST['hora'],
        'id_cliente' => $idCliente,
        'id_usuario' => $idUsuario
    ];
    
    if ($model->registrarCita($datosCita)) {
        unset($_SESSION['id_usuario_registrado']);
        header('Location: ' . BASE_URL . 'index.php?page=cita_exitosa');
        exit;
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=solicitar_cita&error=cita_error');
        exit;
    }
}

function solicitarCitaCompleta($model) {
    if (empty($_POST['nombre']) || empty($_POST['cedula']) || empty($_POST['correo']) || empty($_POST['fecha']) || empty($_POST['hora'])) {
        header('Location: ' . BASE_URL . 'index.php?page=solicitar_cita&error=faltan_datos');
        exit;
    }
    
    $exito = $model->registrarCitaCompleta($_POST);

    if ($exito) {
        header('Location: ' . BASE_URL . 'index.php?page=solicitud_exitosa');
        exit;
    } else {

        header('Location: ' . BASE_URL . 'index.php?page=solicitar_cita&error=db_error');
        exit;
    }
}

function adminActualizarCliente($model) {
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido. Se esperaba POST.']);
        exit;
    }
    
    $datos = $_POST;
    $idCliente = $datos['Id_Cliente'] ?? null;
    $idUsuario = $datos['Id_Usuario'] ?? null;

    if (!$idCliente || !$idUsuario) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Faltan IDs de cliente o usuario.']);
        exit;
    }
    
    try {
        if ($model->actualizarClienteYUsuario($idCliente, $idUsuario, $datos)) {
            echo json_encode(['success' => true, 'message' => 'Cliente actualizado correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'El modelo devolvió un error sin lanzar excepción.']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()]);
    }
    exit;
}

function adminActualizarCita($model) {
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit;
    }
    
    $datos = $_POST;
    $idCita = $datos['Id_Citas'] ?? null;

    if (!$idCita) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Falta el ID de la Cita.']);
        exit;
    }
    
    try {
        if ($model->actualizarCita($idCita, $datos)) {
            echo json_encode(['success' => true, 'message' => 'Cita actualizada correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la cita en el modelo.']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error de base de datos en citas: ' . $e->getMessage()]);
    }
    exit;
}

function adminEliminarCliente($model) {
    header('Content-Type: application/json');
    $idCliente = $_GET['id'] ?? null;
    $response = ['success' => false, 'message' => 'ID de cliente no proporcionado.'];
    
    if ($idCliente) {
        if ($model->eliminarCliente($idCliente)) {
            $response = ['success' => true, 'message' => 'Cliente eliminado correctamente.'];
        } else {
            $response = ['success' => false, 'message' => 'Error al eliminar el cliente. Puede tener datos asociados que impiden el borrado.'];
        }
    }
    
    echo json_encode($response);
    exit;
}

function adminEliminarCita($model) {
    header('Content-Type: application/json');
    $idCita = $_GET['id'] ?? null;
    $response = ['success' => false, 'message' => 'ID de cita no proporcionado.'];
    
    if ($idCita) {
        if ($model->eliminarCita($idCita)) {
            $response = ['success' => true, 'message' => 'Cita eliminada correctamente.'];
        } else {
            $response = ['success' => false, 'message' => 'Error al eliminar la cita.'];
        }
    }
    
    echo json_encode($response);
    exit;
}

$model = new UsuarioClienteCitaModel();
$action = $_POST['action'] ?? $_GET['action'] ?? null;

try {
    switch ($action) {
        case 'registrarUsuarioCliente':   registrarUsuarioCliente($model);   break;
        case 'solicitar_cita':            solicitarCita($model);             break;
        case 'solicitar_cita_completa':   solicitarCitaCompleta($model);     break;
        case 'admin_actualizar_cliente':  adminActualizarCliente($model);    break;
        case 'admin_actualizar_cita':     adminActualizarCita($model);       break;
        case 'admin_eliminar_cliente':    adminEliminarCliente($model);      break;
        case 'admin_eliminar_cita':       adminEliminarCita($model);         break;
        case 'registrar_paso1_cliente':   registrarPaso1Cliente();           break;
        case 'registrar_paso2_cita':      registrarPaso2Cita($model);        break;
        default:
            break;
    }
} catch (Exception $e) {
    error_log("Error fatal en el controlador: " . $e->getMessage());
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Ocurrió un error inesperado en el servidor.']);
    } else {
        header('Location: ' . BASE_URL . 'index.php?page=error&msg=inesperado');
    }
    exit;
}