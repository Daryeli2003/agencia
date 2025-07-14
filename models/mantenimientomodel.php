<?php
require_once dirname(__DIR__) . '/config/conexion.php'; 

class MantenimientoModel extends Database {

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function crearMantenimiento($datos) {
        try {
            $query = "INSERT INTO mantenimiento (id_Mantenimiento, Fecha, Descripcion, quien_autoriza) 
                      VALUES (:id_Mantenimiento, :Fecha, :Descripcion, :quien_autoriza)";
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([
                ':id_Mantenimiento' => $datos['id_Mantenimiento'],
                ':Fecha' => $datos['Fecha'],
                ':Descripcion' => htmlspecialchars($datos['Descripcion'], ENT_QUOTES, 'UTF-8'),
                ':quien_autoriza' => htmlspecialchars($datos['quien_autoriza'], ENT_QUOTES, 'UTF-8')
            ]);
        } catch (PDOException $e) {
            error_log("Error en crearMantenimiento: " . $e->getMessage());
            return false;
        }
    }
    
    public function editarMantenimiento($datos) {
        try {
            $query = "UPDATE mantenimiento SET 
                        Fecha = :Fecha, 
                        Descripcion = :Descripcion, 
                        quien_autoriza = :quien_autoriza
                      WHERE id_Mantenimiento = :id_Mantenimiento";
            $stmt = $this->conn->prepare($query);

            return $stmt->execute([
                ':Fecha' => $datos['Fecha'],
                ':Descripcion' => htmlspecialchars($datos['Descripcion'], ENT_QUOTES, 'UTF-8'),
                ':quien_autoriza' => htmlspecialchars($datos['quien_autoriza'], ENT_QUOTES, 'UTF-8'),
                ':id_Mantenimiento' => $datos['id_Mantenimiento']
            ]);
        } catch (PDOException $e) {
            error_log("Error en editarMantenimiento: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarMantenimiento($id_Mantenimiento) {
        try {
            $query = "DELETE FROM mantenimiento WHERE id_Mantenimiento = ?";
            $stmt = $this->conn->prepare($query);
            
            return $stmt->execute([$id_Mantenimiento]);
        } catch (PDOException $e) {
            error_log("Error en eliminarMantenimiento: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerMantenimientoPorId($id) {
        try {
            $query = "SELECT * FROM mantenimiento WHERE id_Mantenimiento = ?";
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerMantenimientoPorId: " . $e->getMessage());
            return null;
        }
    }
    
    public function obtenerTodosLosMantenimientos() {
        try {
            $query = "SELECT id_Mantenimiento, Fecha, Descripcion, quien_autoriza FROM mantenimiento ORDER BY Fecha DESC";
            $stmt = $this->conn->query($query);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodosLosMantenimientos: " . $e->getMessage());
            return [];
        }
    }
}