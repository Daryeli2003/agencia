<?php
session_start();
require_once dirname(__DIR__) . '/models/catalogoModel.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$catalogoModelo = new CatalogoModel();

switch ($action) {
    case 'eliminar_producto':
        if (isset($_GET['id'])) {
            $idProducto = filter_var($_GET['id'], FILTER_VALIDATE_INT);

            if ($idProducto) {
                if ($catalogoModelo->eliminarProducto($idProducto)) {
                    $_SESSION['mensaje'] = "Producto eliminado correctamente.";
                    $_SESSION['mensaje_tipo'] = "success"; 
                } else {
                    $_SESSION['mensaje'] = "Error al eliminar el producto.";
                    $_SESSION['mensaje_tipo'] = "danger"; 
                }
            } else {
                $_SESSION['mensaje'] = "ID de producto no válido.";
                $_SESSION['mensaje_tipo'] = "warning";
            }
        } else {
            $_SESSION['mensaje'] = "No se especificó un ID de producto para eliminar.";
            $_SESSION['mensaje_tipo'] = "warning";
        }

        header('Location: ../index.php?page=mostrar_catalogo');
        exit(); 

    case 'crear_producto':
        break;

    case 'actualizar_producto':
        break;

    default:
        header('Location: ../index.php?page=mostrar_catalogo');
        exit();
}
?>