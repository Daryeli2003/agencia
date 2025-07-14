<?php

require_once dirname(__DIR__) . '/config/conexion.php';

class VendedorModel extends Database {

    protected $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function registrarVendedor($datos) {
        try {
            $sql = "INSERT INTO c_vendedor (Cedula, Nombre_Apellido, Telefono, Rif, Copia_Llaves, Garantia_Vehiculo, Certificado_Garantia, Manual_VehiculoGarantia, Id_Documento) 
                    VALUES (:cedula, :nombre_apellido, :telefono, :rif, :copia_llaves, :garantia_vehiculo, :certificado_garantia, :manual_vehiculo, :id_documento)";
            
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':cedula' => $datos['Cedula'] ?? null,
                ':nombre_apellido' => $datos['Nombre_Apellido'],
                ':telefono' => $datos['Telefono'] ?? null,
                ':rif' => $datos['Rif'] ?? null,
                ':copia_llaves' => $datos['Copia_Llaves'] ?? 0,
                ':garantia_vehiculo' => $datos['Garantia_Vehiculo'] ?? 0,
                ':certificado_garantia' => $datos['Certificado_Garantia'] ?? 0,
                ':manual_vehiculo' => $datos['Manual_VehiculoGarantia'] ?? 0,
                ':id_documento' => $datos['Id_Documento'] ?? null
            ]);
            
            return true;
        } catch (PDOException $e) {
            error_log("Error en registrarVendedor: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodosLosVendedores() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM c_vendedor ORDER BY Nombre_Apellido ASC");
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodosLosVendedores: " . $e->getMessage());
            return [];
        }
    }

    public function actualizarVendedor($idVendedor, $datos) {
        try {
            $sql = "UPDATE c_vendedor SET 
                        Cedula = :cedula, 
                        Nombre_Apellido = :nombre_apellido, 
                        Telefono = :telefono, 
                        Rif = :rif,
                        Copia_Llaves = :copia_llaves,
                        Garantia_Vehiculo = :garantia_vehiculo,
                        Certificado_Garantia = :certificado_garantia,
                        Manual_VehiculoGarantia = :manual_vehiculo
                    WHERE Id_Vendedor = :id_vendedor";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':cedula' => $datos['Cedula'] ?? null,
                ':nombre_apellido' => $datos['Nombre_Apellido'] ?? '',
                ':telefono' => $datos['Telefono'] ?? null,
                ':rif' => $datos['Rif'] ?? null,
                ':copia_llaves' => $datos['Copia_Llaves'] ?? 0,
                ':garantia_vehiculo' => $datos['Garantia_Vehiculo'] ?? 0,
                ':certificado_garantia' => $datos['Certificado_Garantia'] ?? 0,
                ':manual_vehiculo' => $datos['Manual_VehiculoGarantia'] ?? 0,
                ':id_vendedor' => $idVendedor
            ]);

            return true;
        } catch (PDOException $e) {
            error_log("Error en actualizarVendedor: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarVendedor($idVendedor) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM c_vendedor WHERE Id_Vendedor = :id_vendedor");
            $stmt->bindParam(':id_vendedor', $idVendedor);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en eliminarVendedor: " . $e->getMessage());
            return false;
        }
    }
}