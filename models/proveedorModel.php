<?php

require_once dirname(__DIR__) . '/config/conexion.php';

class ProveedorModel extends Database {

    protected $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function registrarProveedor($datos) {
        try {
            $sql = "INSERT INTO proveedor (Nombre, Apellido, Direccion, Cedula, Telefono, Tipo) 
                    VALUES (:nombre, :apellido, :direccion, :cedula, :telefono, :tipo)";
            
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':nombre' => $datos['Nombre'],
                ':apellido' => $datos['Apellido'],
                ':direccion' => $datos['Direccion'] ?? null,
                ':cedula' => $datos['Cedula'] ?? null,
                ':telefono' => $datos['Telefono'] ?? null,
                ':tipo' => $datos['Tipo'] ?? 'Local'
            ]);
            
            return true;
        } catch (PDOException $e) {
            error_log("Error en registrarProveedor: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodosLosProveedores() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM proveedor ORDER BY Nombre, Apellido ASC");
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodosLosProveedores: " . $e->getMessage());
            return [];
        }
    }

    public function actualizarProveedor($idProveedor, $datos) {
        try {
            $sql = "UPDATE proveedor SET 
                        Nombre = :nombre, 
                        Apellido = :apellido, 
                        Direccion = :direccion,
                        Cedula = :cedula, 
                        Telefono = :telefono, 
                        Tipo = :tipo
                    WHERE Id_Proveedor = :id_proveedor";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':nombre' => $datos['Nombre'] ?? '',
                ':apellido' => $datos['Apellido'] ?? '',
                ':direccion' => $datos['Direccion'] ?? '',
                ':cedula' => $datos['Cedula'] ?? '',
                ':telefono' => $datos['Telefono'] ?? '',
                ':tipo' => $datos['Tipo'] ?? 'Local',
                ':id_proveedor' => $idProveedor
            ]);

            return true;
        } catch (PDOException $e) {
            error_log("Error en actualizarProveedor: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarProveedor($idProveedor) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM proveedor WHERE Id_Proveedor = :id_proveedor");
            $stmt->bindParam(':id_proveedor', $idProveedor);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en eliminarProveedor: " . $e->getMessage());
            return false;
        }
    }
}