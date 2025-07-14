<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/models/VehiculoModel.php';

function registrarPaso1Vehiculo() {
    $_SESSION['form_data_vehiculo'] = $_POST;
    
    if (isset($_FILES['imagenes']) && $_FILES['imagenes']['error'][0] === UPLOAD_ERR_OK) {
        $temp_files = [];
        $upload_dir_temp = ROOT_PATH . '/uploads/temp/';
        
        if (!is_dir($upload_dir_temp)) {
            mkdir($upload_dir_temp, 0777, true);
        }

        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['imagenes']['error'][$key] === UPLOAD_ERR_OK) {
                $file_name = uniqid() . '-' . basename($_FILES['imagenes']['name'][$key]);
                $temp_destination = $upload_dir_temp . $file_name;
                
                if (move_uploaded_file($tmp_name, $temp_destination)) {
                    $temp_files[] = $temp_destination;
                }
            }
        }
        $_SESSION['form_data_vehiculo']['temp_files'] = $temp_files;
    }

    header('Location: ' . BASE_URL . 'index.php?page=registrar_documentacion');
    exit();
}

function finalizarRegistroVehiculo($model) {
    if (!isset($_SESSION['form_data_vehiculo'])) {
        header('Location: ' . BASE_URL . 'index.php?page=registrar_vehiculo&error=sesion_expirada');
        exit;
    }
    
    $vehiculo_data = $_SESSION['form_data_vehiculo'];
    $doc_data = $_POST;
    
    $img_urls = [];
    if (isset($vehiculo_data['temp_files'])) {
        $upload_dir_final = ROOT_PATH . '/uploads/vehiculos/';
        if (!is_dir($upload_dir_final)) { mkdir($upload_dir_final, 0777, true); }

        foreach ($vehiculo_data['temp_files'] as $temp_file_path) {
            if (file_exists($temp_file_path)) {
                $file_name = basename($temp_file_path);
                $final_destination = $upload_dir_final . $file_name;
                
                if (rename($temp_file_path, $final_destination)) {
                    $img_urls[] = 'uploads/vehiculos/' . $file_name;
                }
            }
        }
    }

    if ($model->crearCompleto($vehiculo_data, $doc_data, $img_urls)) {
        unset($_SESSION['form_data_vehiculo']); 
        header('Location: ' . BASE_URL . 'index.php?page=lista_vehiculos&status=success');
        exit();
    } else {
        if (isset($vehiculo_data['temp_files'])) {
            foreach ($vehiculo_data['temp_files'] as $temp_file_path) {
                if (file_exists($temp_file_path)) unlink($temp_file_path);
            }
        }
        unset($_SESSION['form_data_vehiculo']);
        header('Location: ' . BASE_URL . 'index.php?page=registrar_vehiculo&error=db_error');
        exit();
    }
}

$model = new VehiculoModel();
$action = $_GET['action'] ?? $_POST['action'] ?? null; 

try {
    switch ($action) {
        case 'paso1_registrar':
            registrarPaso1Vehiculo();
            break;
        
        case 'finalizar_registro':
            finalizarRegistroVehiculo($model);
            break;
        
        case 'obtener_documentos':
            if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'ID de vehículo no válido.']);
                exit;
            }
            
            $idVehiculo = (int)$_GET['id'];
            $documentos = $model->leerDocumentacionPorVehiculoId($idVehiculo);
            
            header('Content-Type: application/json');

            if ($documentos) {
                echo json_encode($documentos);
            } else {
                echo json_encode(['error' => 'No se encontró la documentación para este vehículo.']);
            }
            exit; 
            break;

            case 'procesar_actualizacion':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $datos = $_POST; 
                    if ($model->actualizarCompleto($datos)) {
                        header('Location: ' . BASE_URL . 'index.php?page=lista_vehiculos&status=actualizado');
                    } else {
                        header('Location: ' . BASE_URL . 'index.php?page=editar_vehiculo&id=' . $_POST['id_vehiculo'] . '&error=actualizacion_fallida');
                    }
                    exit;
                }
                break;

                case 'eliminar':
                    if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
                        $idVehiculo = (int)$_GET['id'];
                        if ($model->eliminar($idVehiculo)) {
                            header('Location: ' . BASE_URL . 'index.php?page=lista_vehiculos&status=eliminado');
                        } else {
                            header('Location: ' . BASE_URL . 'index.php?page=lista_vehiculos&error=eliminacion_fallida');
                        }
                    } else {
                        header('Location: ' . BASE_URL . 'index.php?page=lista_vehiculos&error=id_invalido');
                    }
                    exit; 
                    break;
        
            
        default:
            header('Location: ' . BASE_URL . 'index.php?page=home');
            exit();
    }
} catch (Exception $e) {
    error_log("Error fatal en vehiculoController: " . $e->getMessage());
    header('Location: ' . BASE_URL . 'index.php?page=home&error=inesperado');
    exit;
}
?>