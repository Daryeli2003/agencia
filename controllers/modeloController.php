<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/models/modeloModel.php';

function crearModelo($model) {
    if (isset($_POST['nombre_modelo']) && !empty(trim($_POST['nombre_modelo']))) {
        $model->crear($_POST['nombre_modelo']);
        header("Location: " . BASE_URL . "index.php?page=gestion_modelo&status=creado");
    } else {
        header("Location: " . BASE_URL . "index.php?page=gestion_modelo&error=nombre_vacio");
    }
    exit();
}

function actualizarModelo($model) {
    $id = $_POST['id_modelo'] ?? null;
    $nombre = $_POST['nombre_modelo'] ?? null;

    if ($id && $nombre && !empty(trim($nombre))) {
        $model->actualizar($id, $nombre);
        header("Location: " . BASE_URL . "index.php?page=gestion_modelo&status=actualizado");
    } else {
        header("Location: " . BASE_URL . "index.php?page=gestion_modelo&error=datos_invalidos");
    }
    exit();
}

function eliminarModelo($model) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        if ($model->eliminar($id)) {
            header("Location: " . BASE_URL . "index.php?page=gestion_modelo&status=eliminado");
        } else {
            header("Location: " . BASE_URL . "index.php?page=gestion_modelo&error=en_uso");
        }
    } else {
        header("Location: " . BASE_URL . "index.php?page=gestion_modelo&error=id_invalido");
    }
    exit();
}

$model = new ModeloModel();
$action = $_POST['action'] ?? $_GET['action'] ?? 'default';

switch ($action) {
    case 'crear':
        crearModelo($model);
        break;

    case 'actualizar':
        actualizarModelo($model);
        break;

    case 'eliminar':
        eliminarModelo($model);
        break;
        
    default:
        header("Location: " . BASE_URL . "index.php?page=gestion_modelo");
        exit();
}
?>