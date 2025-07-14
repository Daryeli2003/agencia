<?php

require_once dirname(__DIR__) . '/config/conexion.php';

class UsuarioClienteCitaModel extends Database {

    protected $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }
    
    public function registrarUsuario($datosUsuario) {
        try {
            $sql = "INSERT INTO usuario (Nombre, Apellido, Cedula, Correo, Telefono, Direccion, Contrasena, Id_Rol) 
                    VALUES (:nombre, :apellido, :cedula, :correo, :telefono, :direccion, :contrasena, :id_rol)";
            
            $stmt = $this->pdo->prepare($sql);

            $contrasenaHasheada = password_hash($datosUsuario['contrasena'], PASSWORD_DEFAULT);

            $stmt->bindParam(':nombre', $datosUsuario['nombre']);
            $stmt->bindParam(':apellido', $datosUsuario['apellido']);
            $stmt->bindParam(':cedula', $datosUsuario['cedula']);
            $stmt->bindParam(':correo', $datosUsuario['correo']);
            $stmt->bindParam(':telefono', $datosUsuario['telefono']);
            $stmt->bindParam(':direccion', $datosUsuario['direccion']);
            $stmt->bindParam(':contrasena', $contrasenaHasheada);
            $stmt->bindParam(':id_rol', $datosUsuario['id_rol']);

            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en registrarUsuario: " . $e->getMessage());
            return false;
        }
    }

    public function registrarCliente($rif, $idUsuario) {
        try {
            $sql = "INSERT INTO cliente (Rif, Id_Usuario) VALUES (:rif, :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':rif', $rif);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en registrarCliente: " . $e->getMessage());
            return false;
        }
    }

    public function registrarCita($datosCita) {
        try {
            $sql = "INSERT INTO citas (Estado, Fecha, Hora, Id_Cliente, Id_Usuario) 
                    VALUES ('Pendiente', :fecha, :hora, :id_cliente, :id_usuario)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':fecha', $datosCita['fecha']);
            $stmt->bindParam(':hora', $datosCita['hora']);
            $stmt->bindParam(':id_cliente', $datosCita['id_cliente']);
            $stmt->bindParam(':id_usuario', $datosCita['id_usuario']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en registrarCita: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerClientePorUsuarioId($idUsuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE Id_Usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function registrarCitaCompleta($datos) {
        $this->pdo->beginTransaction();
        try {
            $contrasenaHasheada = password_hash($datos['cedula'], PASSWORD_DEFAULT);
            $rolCliente = 3;
            $sqlUsuario = "INSERT INTO usuario (Nombre, Apellido, Cedula, Correo, Telefono, Direccion, Contrasena, Id_Rol) VALUES (:nombre, :apellido, :cedula, :correo, :telefono, :direccion, :contrasena, :id_rol)";
            $stmtUsuario = $this->pdo->prepare($sqlUsuario);
            $stmtUsuario->execute([':nombre' => $datos['nombre'], ':apellido' => $datos['apellido'], ':cedula' => $datos['cedula'], ':correo' => $datos['correo'], ':telefono' => $datos['telefono'], ':direccion' => $datos['direccion'], ':contrasena' => $contrasenaHasheada, ':id_rol' => $rolCliente]);
            $idUsuario = $this->pdo->lastInsertId();
            $sqlCliente = "INSERT INTO cliente (Rif, Id_Usuario) VALUES (:rif, :id_usuario)";
            $stmtCliente = $this->pdo->prepare($sqlCliente);
            $stmtCliente->execute([':rif' => $datos['rif'], ':id_usuario' => $idUsuario]);
            $idCliente = $this->pdo->lastInsertId();
            $estadoInicial = 'Pendiente';
            $sqlCita = "INSERT INTO citas (Estado, Fecha, Hora, Id_Cliente, Id_Usuario) VALUES (:estado, :fecha, :hora, :id_cliente, :id_usuario)";
            $stmtCita = $this->pdo->prepare($sqlCita);
            $stmtCita->execute([':estado' => $estadoInicial, ':fecha' => $datos['fecha'], ':hora' => $datos['hora'], ':id_cliente' => $idCliente, ':id_usuario' => $idUsuario]);
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error en registrarCitaCompleta: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodosLosClientes() {
        $sql = "SELECT c.Id_Cliente, c.Rif, c.Poder, c.Traspaso, u.Id_Usuario, u.Nombre, u.Apellido, u.Cedula, u.Telefono, u.Correo, u.Direccion FROM cliente c JOIN usuario u ON c.Id_Usuario = u.Id_Usuario ORDER BY c.Id_Cliente ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function obtenerTodasLasCitas() {
        $sql = "SELECT ci.Id_Citas, ci.Estado, ci.Fecha, ci.Hora, u.Nombre, u.Apellido, u.Cedula FROM citas ci JOIN cliente c ON ci.Id_Cliente = c.Id_Cliente JOIN usuario u ON c.Id_Usuario = u.Id_Usuario ORDER BY ci.Id_Citas ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function actualizarClienteYUsuario($idCliente, $idUsuario, $datos) {
        $this->pdo->beginTransaction();
        try {
            $sqlUsuario = "UPDATE usuario SET Nombre = :nombre, Apellido = :apellido, Cedula = :cedula, Telefono = :telefono, Correo = :correo, Direccion = :direccion
                           WHERE Id_Usuario = :id_usuario";
            $stmtUsuario = $this->pdo->prepare($sqlUsuario);           
            $stmtUsuario->execute([
                ':nombre'    => $datos['Nombre'] ?? '',
                ':apellido'  => $datos['Apellido'] ?? '',
                ':cedula'    => $datos['Cedula'] ?? '',
                ':telefono'  => $datos['Telefono'] ?? '',
                ':correo'    => $datos['Correo'] ?? '',
                ':direccion' => $datos['Direccion'] ?? '',
                ':id_usuario' => $idUsuario
            ]);

            $sqlCliente = "UPDATE cliente SET Rif = :rif
                           WHERE Id_Cliente = :id_cliente";
            $stmtCliente = $this->pdo->prepare($sqlCliente);
            $stmtCliente->execute([
                ':rif' => $datos['Rif'] ?? '',
                ':id_cliente' => $idCliente
            ]);
            
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error en actualizarClienteYUsuario: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarCita($idCita, $datos) {
        $this->pdo->beginTransaction();
        try {
            $sql = "UPDATE citas SET Estado = :estado, Fecha = :fecha, Hora = :hora WHERE Id_Citas = :id_cita";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':estado' => $datos['Estado'] ?? 'Pendiente',
                ':fecha'  => $datos['Fecha'] ?? null,
                ':hora'   => $datos['Hora'] ?? null,
                ':id_cita'=> $idCita
            ]);
            
            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error en actualizarCita: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarCita($idCita) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM citas WHERE Id_Citas = :id_cita");
            $stmt->bindParam(':id_cita', $idCita);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en eliminarCita: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarCliente($idCliente) {
        $stmt = $this->pdo->prepare("SELECT Id_Usuario FROM cliente WHERE Id_Cliente = :id_cliente");
        $stmt->bindParam(':id_cliente', $idCliente);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) return false;
        
        $idUsuario = $resultado['Id_Usuario']; 
        
        $this->pdo->beginTransaction();
        try {
            $stmtCitas = $this->pdo->prepare("DELETE FROM citas WHERE Id_Cliente = :id_cliente");
            $stmtCitas->bindParam(':id_cliente', $idCliente);
            $stmtCitas->execute();

            $stmtCliente = $this->pdo->prepare("DELETE FROM cliente WHERE Id_Cliente = :id_cliente");
            $stmtCliente->bindParam(':id_cliente', $idCliente);
            $stmtCliente->execute();

            $stmtUsuario = $this->pdo->prepare("DELETE FROM usuario WHERE Id_Usuario = :id_usuario");
            $stmtUsuario->bindParam(':id_usuario', $idUsuario);
            $stmtUsuario->execute();

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error en eliminarCliente: " . $e->getMessage());
            return false;
        }
    }
}