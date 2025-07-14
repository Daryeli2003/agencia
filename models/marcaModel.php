<?php
require_once dirname(__DIR__) . '/config/conexion.php';

class MarcaModel extends Database {
    private $table_name = "marca";
    protected $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function crear($nombre) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (Nombre) VALUES (:nombre)";
            $stmt = $this->pdo->prepare($query);
            
            $nombre = htmlspecialchars(strip_tags($nombre));
            $stmt->bindParam(':nombre', $nombre);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en MarcaModel::crear: " . $e->getMessage());
            return false;
        }
    }

    public function leer() {
        try {
            $query = "SELECT Id_Marca, Nombre FROM " . $this->table_name . " ORDER BY Nombre ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;

        } catch (PDOException $e) {
            error_log("Error en MarcaModel::leer: " . $e->getMessage());
            return false;
        }
    }

    public function leerUno($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE Id_Marca = :id LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $id = (int)$id;
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en MarcaModel::leerUno: " . $e->getMessage());
            return false;
        }
    }
    
    public function actualizar($id, $nombre) {
        try {
            $query = "UPDATE " . $this->table_name . " SET Nombre = :nombre WHERE Id_Marca = :id";
            $stmt = $this->pdo->prepare($query);

            $nombre = htmlspecialchars(strip_tags($nombre));
            $id = (int)$id;
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en MarcaModel::actualizar: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE Id_Marca = :id";
            $stmt = $this->pdo->prepare($query);

            $id = (int)$id;
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en MarcaModel::eliminar: " . $e->getMessage());
            return false; 
        }
    }
}
?>