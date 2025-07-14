<?php
require_once dirname(__DIR__) . '/config/config.php'; 
require_once dirname(__DIR__) . '/models/marcaModel.php';

class MarcaController {
    public function listar() {
        $marcaModel = new MarcaModel();
        $listaMarcas = $marcaModel->leer();
        require_once dirname(__DIR__) . '/views/gestion_marcas.php';
    }

    public function editar() {
        $marca = null;
        if (isset($_GET['id'])) {
            $marcaModel = new MarcaModel();
            $marca = $marcaModel->leerUno($_GET['id']);
        }
        require_once dirname(__DIR__) . '/views/editar_marca.php';
    }

    public function crear() {
        if (isset($_POST['nombre']) && !empty(trim($_POST['nombre']))) {
            $model = new MarcaModel();
            $model->crear($_POST['nombre']);
            header("Location: " . BASE_URL . "index.php?page=gestion_marcas&status=creado");
        } else {
            header("Location: " . BASE_URL . "index.php?page=gestion_marcas&error=nombre_vacio");
        }
        exit();
    }

    public function actualizar() {
        $id = $_POST['id_marca'] ?? null;
        $nombre = $_POST['nombre'] ?? null;

        if ($id && $nombre && !empty(trim($nombre))) {
            $model = new MarcaModel();
            $model->actualizar($id, $nombre);
            header("Location: " . BASE_URL . "index.php?page=gestion_marcas&status=actualizado");
        } else {
            header("Location: " . BASE_URL . "index.php?page=gestion_marcas&error=datos_invalidos");
        }
        exit();
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model = new MarcaModel();
            if ($model->eliminar($id)) {
                header("Location: " . BASE_URL . "index.php?page=gestion_marcas&status=eliminado");
            } else {
                header("Location: " . BASE_URL . "index.php?page=gestion_marcas&error=en_uso");
            }
        } else {
            header("Location: " . BASE_URL . "index.php?page=gestion_marcas&error=id_invalido");
        }
        exit();
    }
}

$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action) {
    $controller = new MarcaController();
    switch ($action) {
        case 'crear':
            $controller->crear();
            break;
        case 'actualizar':
            $controller->actualizar();
            break;
        case 'eliminar':
            $controller->eliminar();
            break;
        default:
            header("Location: " . BASE_URL . "index.php?page=gestion_marcas&error=accion_invalida");
            exit();
    }
}
?>