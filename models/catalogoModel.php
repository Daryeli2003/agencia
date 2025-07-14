<?php
require_once dirname(__DIR__) . '/config/conexion.php';

class CatalogoModel extends Database {
    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function obtenerTodosLosProductos() {
        try {
            $sql = "SELECT id, imagen, precio, descripcion, estado, fecha_publicacion FROM catalogo ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (PDOException $e) {
            error_log('CatalogoModel::obtenerTodosLosProductos -> ' . $e->getMessage());
            return []; 
        }
    }

    public function eliminarProducto($id) {
        try {
            $sql = "DELETE FROM catalogo WHERE id = ?";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('CatalogoModel::eliminarProducto -> ' . $e->getMessage());
            return false;
        }
    }

    public function crearProducto($datos) {
        try {
            $sql = "INSERT INTO catalogo (imagen, precio, descripcion, estado, fecha_publicacion) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $datos['imagen'],
                $datos['precio'],
                $datos['descripcion'],
                $datos['estado']
            ]);
        } catch (PDOException $e) {
            error_log('CatalogoModel::crearProducto -> ' . $e->getMessage());
            return false;
        }
    }

    public function actualizarProducto($datos) {
        try {
            $sql = "UPDATE catalogo SET imagen = ?, precio = ?, descripcion = ?, estado = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            
            return $stmt->execute([
                $datos['imagen'],
                $datos['precio'],
                $datos['descripcion'],
                $datos['estado'],
                $datos['id']
            ]);
        } catch (PDOException $e) {
            error_log('CatalogoModel::actualizarProducto -> ' . $e->getMessage());
            return false;
        }
    }
}
?>