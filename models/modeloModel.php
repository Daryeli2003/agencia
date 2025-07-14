<?php
require_once dirname(__DIR__) . '/config/conexion.php';

class ModeloModel extends Database {
    private $table_name = "modelo";
    protected $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function crear($nombre) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (Nombre_modelo) VALUES (:nombre)";
            $stmt = $this->pdo->prepare($query);
            
            $nombre = htmlspecialchars(strip_tags($nombre));
            $stmt->bindParam(':nombre', $nombre);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en ModeloModel::crear: " . $e->getMessage());
            return false;
        }
    }

    public function leer() {
        try {
            $query = "SELECT Id_Modelo, Nombre_modelo FROM " . $this->table_name . " ORDER BY Nombre_modelo ASC";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;

        } catch (PDOException $e) {
            error_log("Error en ModeloModel::leer: " . $e->getMessage());
            return false;
        }
    }

    public function leerUno($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE Id_Modelo = :id LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $id = (int)$id;
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ModeloModel::leerUno: " . $e->getMessage());
            return false;
        }
    }
    
    public function actualizar($id, $nombre) {
        try {
            $query = "UPDATE " . $this->table_name . " SET Nombre_modelo = :nombre WHERE Id_Modelo = :id";
            $stmt = $this->pdo->prepare($query);

            $nombre = htmlspecialchars(strip_tags($nombre));
            $id = (int)$id;
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en ModeloModel::actualizar: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE Id_Modelo = :id";
            $stmt = $this->pdo->prepare($query);

            $id = (int)$id;
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en ModeloModel::eliminar: " . $e->getMessage());
            return false; 
        }
    }
}
?>