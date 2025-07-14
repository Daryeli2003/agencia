<?php
require_once dirname(__DIR__) . '/config/conexion.php';

class VehiculoModel extends Database {
    protected $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function crearCompleto($vehiculo_data, $doc_data, $img_data) {
        $this->pdo->beginTransaction();
        try {
            $documentos = isset($doc_data['documentacion']) ? $doc_data['documentacion'] : [];
            $sql_doc = "INSERT INTO documentacion (
                            Original_TotalPropiedad, Experticia_Transito, Certificado_Origen, Carnet_Circulacion, 
                            Reserva_Dominio, Finiquito, Factura_Compra, Resguardo, Fecha_Transferencia, 
                            Gato, Repuesto, Triangulo, Seguro, Kilometraje, Fecha_Ingreso, Fecha_Venta, Otro_Documento
                        ) VALUES (
                            :original_totalpropiedad, :experticia_transito, :certificado_origen, :carnet_circulacion,
                            :reserva_dominio, :finiquito, :factura_compra, :resguardo, :fecha_transferencia,
                            :gato, :repuesto, :triangulo, :seguro, :kilometraje, :fecha_ingreso, :fecha_venta, :otro_documento
                        )";

            $stmt_doc = $this->pdo->prepare($sql_doc);

            $stmt_doc->bindValue(':original_totalpropiedad', isset($documentos['Original_TotalPropiedad']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':experticia_transito',    isset($documentos['Experticia_Transito']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':certificado_origen',     isset($documentos['Certificado_Origen']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':carnet_circulacion',      isset($documentos['Carnet_Circulacion']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':reserva_dominio',        isset($documentos['Reserva_Dominio']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':finiquito',               isset($documentos['Finiquito']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':factura_compra',         isset($documentos['Factura_Compra']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':resguardo',               isset($documentos['Resguardo']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':fecha_transferencia',    isset($documentos['Fecha_Transferencia']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':gato',                    isset($documentos['Gato']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':repuesto',                isset($documentos['Repuesto']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':triangulo',               isset($documentos['Triangulo']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':seguro',                  isset($documentos['Seguro']) ? 1 : 0, PDO::PARAM_INT);
            $stmt_doc->bindValue(':kilometraje', $doc_data['kilometraje']);
            $stmt_doc->bindValue(':fecha_ingreso', !empty($doc_data['fecha_ingreso']) ? $doc_data['fecha_ingreso'] : null);
            $stmt_doc->bindValue(':fecha_venta', !empty($doc_data['fecha_venta']) ? $doc_data['fecha_venta'] : null);
            $stmt_doc->bindValue(':otro_documento', !empty($doc_data['otro_documento']) ? $doc_data['otro_documento'] : null);

            $stmt_doc->execute();
            $id_documento = $this->pdo->lastInsertId();

            // Insertar Vehículo
            $sql_vehiculo = "INSERT INTO vehiculo (Placa, Color, Anio, Tipo, Id_Marca, Id_Modelo, Id_Documento) VALUES (:placa, :color, :anio, :tipo, :id_marca, :id_modelo, :id_doc)";
            $stmt_vehiculo = $this->pdo->prepare($sql_vehiculo);
            $color = ($vehiculo_data['color_seleccion'] === 'Otro') ? $vehiculo_data['color_otro'] : $vehiculo_data['color_seleccion'];
            $stmt_vehiculo->execute([
                ':placa' => $vehiculo_data['placa'],
                ':color' => $color,
                ':anio' => $vehiculo_data['anio'],
                ':tipo' => $vehiculo_data['tipo_vehiculo'],
                ':id_marca' => $vehiculo_data['id_marca'],
                ':id_modelo' => $vehiculo_data['id_modelo'],
                ':id_doc' => $id_documento
            ]);
            $id_vehiculo = $this->pdo->lastInsertId();

            // Insertar Catálogo
            $sql_catalogo = "INSERT INTO catalogo (Precio, Descripcion, Estado, Fecha_Publicacion, Id_Vehiculo) VALUES (:precio, :desc, :estado, :fecha, :id_v)";
            $stmt_cat = $this->pdo->prepare($sql_catalogo);
            $stmt_cat->execute([
                ':precio' => $vehiculo_data['precio'],
                ':desc' => $vehiculo_data['descripcion'],
                ':estado' => $vehiculo_data['estado'],
                ':fecha' => date('Y-m-d H:i:s'),
                ':id_v' => $id_vehiculo
            ]);

            // Insertar Imágenes
            if (!empty($img_data)) {
                $sql_img = "INSERT INTO imagen (URL, Id_Vehiculo) VALUES (:url, :id_vehiculo)";
                $stmt_img = $this->pdo->prepare($sql_img);
                foreach ($img_data as $url) {
                    $stmt_img->execute([':url' => $url, ':id_vehiculo' => $id_vehiculo]);
                }
            }

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error en crearCompleto (VehiculoModel): " . $e->getMessage());
            return false;
        }
    }

    public function leerTodos() {
        $query = "SELECT
                    v.Id_Vehiculo, 
                    v.Placa, 
                    v.Anio,
                    c.Estado, 
                    m.Nombre AS Nombre_marca, 
                    mo.Nombre_modelo,
                    c.Precio,
                    (SELECT i.URL FROM imagen i WHERE i.Id_Vehiculo = v.Id_Vehiculo LIMIT 1) AS URL
                FROM
                    vehiculo as v
                LEFT JOIN 
                    marca as m ON v.Id_Marca = m.Id_Marca
                LEFT JOIN 
                    modelo as mo ON v.Id_Modelo = mo.Id_Modelo
                LEFT JOIN 
                    catalogo as c ON v.Id_Vehiculo = c.Id_Vehiculo
                ORDER BY
                    v.Id_Vehiculo DESC";

        $stmt = $this->pdo->prepare($query); 
        $stmt->execute(); 
        return $stmt;
    }

    public function leerUno($id) {
        $query = "SELECT 
                    v.Id_Vehiculo, v.Placa, v.Color, v.Anio, v.Tipo, v.Id_Marca, v.Id_Modelo, v.Id_Documento,
                    m.Nombre AS Nombre_marca,
                    mo.Nombre_modelo,
                    c.Precio,
                    c.Descripcion,
                    c.Estado,
                    d.Original_TotalPropiedad, d.Experticia_Transito, d.Certificado_Origen, 
                    d.Carnet_Circulacion, d.Reserva_Dominio, d.Finiquito, d.Factura_Compra, 
                    d.Resguardo, d.Fecha_Transferencia, d.Gato, d.Repuesto, d.Triangulo, 
                    d.Seguro, d.Kilometraje, d.Fecha_Ingreso, d.Fecha_Venta, d.Otro_Documento
                FROM vehiculo v
                LEFT JOIN marca m ON v.Id_Marca = m.Id_Marca
                LEFT JOIN modelo mo ON v.Id_Modelo = mo.Id_Modelo
                LEFT JOIN catalogo c ON v.Id_Vehiculo = c.Id_Vehiculo
                LEFT JOIN documentacion d ON v.Id_Documento = d.Id_Documento
                WHERE v.Id_Vehiculo = :id";
        
        $stmt = $this->pdo->prepare($query); 
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $data) {
        try {
            $sql_vehiculo = "UPDATE vehiculo SET
                                Placa = :placa,
                                Color = :color,
                                Anio = :anio,
                                Tipo = :tipo,
                                Id_Marca = :id_marca,
                                Id_Modelo = :id_modelo
                            WHERE Id_Vehiculo = :id_vehiculo";
            
            $stmt_vehiculo = $this->pdo->prepare($sql_vehiculo); 
            $color = ($data['color'] === 'Otro') ? $data['color'] : $data['color'];

            $stmt_vehiculo->bindParam(':placa', $data['placa']);
            $stmt_vehiculo->bindParam(':color', $color);
            $stmt_vehiculo->bindParam(':anio', $data['anio']);
            $stmt_vehiculo->bindParam(':tipo', $data['tipo']);
            $stmt_vehiculo->bindParam(':id_marca', $data['id_marca']);
            $stmt_vehiculo->bindParam(':id_modelo', $data['id_modelo']);
            $stmt_vehiculo->bindParam(':id_vehiculo', $id);
            $stmt_vehiculo->execute();

            $sql_catalogo = "UPDATE catalogo SET
                                Precio = :precio,
                                Descripcion = :descripcion,
                                Estado = :estado
                            WHERE Id_Vehiculo = :id_vehiculo";

            $stmt_cat = $this->pdo->prepare($sql_catalogo); 
            $stmt_cat->bindParam(':precio', $data['precio']);
            $stmt_cat->bindParam(':descripcion', $data['descripcion']);
            $stmt_cat->bindParam(':estado', $data['estado']);
            $stmt_cat->bindParam(':id_vehiculo', $id);
            $stmt_cat->execute();

            return true; 

        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function leerDocumentacionPorVehiculoId($id_vehiculo) {
        $query = "SELECT d.* 
                FROM vehiculo v
                LEFT JOIN documentacion d ON v.Id_Documento = d.Id_Documento
                WHERE v.Id_Vehiculo = :id_vehiculo";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_vehiculo', $id_vehiculo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function actualizarCompleto($datos) {
        $this->pdo->beginTransaction();
        try {
            $sql_doc = "UPDATE documentacion SET
                            Original_TotalPropiedad = :p1, Experticia_Transito = :p2, Certificado_Origen = :p3, 
                            Carnet_Circulacion = :p4, Reserva_Dominio = :p5, Finiquito = :p6, Factura_Compra = :p7, 
                            Resguardo = :p8, Fecha_Transferencia = :p9, Gato = :p10, Repuesto = :p11, 
                            Triangulo = :p12, Seguro = :p13, Kilometraje = :kilometraje, Fecha_Ingreso = :fecha_ingreso, 
                            Fecha_Venta = :fecha_venta
                        WHERE Id_Documento = :id_documento";
            $stmt_doc = $this->pdo->prepare($sql_doc);

            $docs_post = $datos['documentacion'] ?? []; 
            $stmt_doc->execute([
                ':p1' => isset($docs_post['Original_TotalPropiedad']) ? 1 : 0,
                ':p2' => isset($docs_post['Experticia_Transito']) ? 1 : 0,
                ':p3' => isset($docs_post['Certificado_Origen']) ? 1 : 0,
                ':p4' => isset($docs_post['Carnet_Circulacion']) ? 1 : 0,
                ':p5' => isset($docs_post['Reserva_Dominio']) ? 1 : 0,
                ':p6' => isset($docs_post['Finiquito']) ? 1 : 0,
                ':p7' => isset($docs_post['Factura_Compra']) ? 1 : 0,
                ':p8' => isset($docs_post['Resguardo']) ? 1 : 0,
                ':p9' => isset($docs_post['Fecha_Transferencia']) ? 1 : 0,
                ':p10' => isset($docs_post['Gato']) ? 1 : 0,
                ':p11' => isset($docs_post['Repuesto']) ? 1 : 0,
                ':p12' => isset($docs_post['Triangulo']) ? 1 : 0,
                ':p13' => isset($docs_post['Seguro']) ? 1 : 0,
                ':kilometraje' => $datos['kilometraje'],
                ':fecha_ingreso' => $datos['fecha_ingreso'],
                ':fecha_venta' => !empty($datos['fecha_venta']) ? $datos['fecha_venta'] : null,
                ':id_documento' => $datos['id_documento']
            ]);

            $sql_vehiculo = "UPDATE vehiculo SET Placa = :placa, Color = :color, Anio = :anio, Tipo = :tipo, Id_Marca = :id_marca, Id_Modelo = :id_modelo WHERE Id_Vehiculo = :id_vehiculo";
            $stmt_vehiculo = $this->pdo->prepare($sql_vehiculo);
            $stmt_vehiculo->execute([
                ':placa' => $datos['placa'], ':color' => $datos['color'], ':anio' => $datos['anio'],
                ':tipo' => $datos['tipo'], ':id_marca' => $datos['id_marca'], ':id_modelo' => $datos['id_modelo'],
                ':id_vehiculo' => $datos['id_vehiculo']
            ]);

            $sql_catalogo = "UPDATE catalogo SET Precio = :precio, Descripcion = :descripcion, Estado = :estado WHERE Id_Vehiculo = :id_vehiculo";
            $stmt_cat = $this->pdo->prepare($sql_catalogo);
            
            $stmt_cat->execute([
                ':precio' => $datos['precio'], 
                ':descripcion' => $datos['descripcion'], 
                ':estado' => $datos['estado'], 
                ':id_vehiculo' => $datos['id_vehiculo']
            ]);

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error en actualizarCompleto (VehiculoModel): " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM imagen WHERE Id_Vehiculo = :id"); 
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $this->pdo->prepare("DELETE FROM catalogo WHERE Id_Vehiculo = :id"); 
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $stmt = $this->pdo->prepare("SELECT Id_Documento FROM vehiculo WHERE Id_Vehiculo = :id"); 
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $id_documento = $stmt->fetchColumn();

            $stmt = $this->pdo->prepare("DELETE FROM vehiculo WHERE Id_Vehiculo = :id"); 
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($id_documento) {
                $stmt = $this->pdo->prepare("DELETE FROM documentacion WHERE Id_Documento = :id_doc"); 
                $stmt->bindParam(':id_doc', $id_documento);
                $stmt->execute();
            }

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }
}
?>