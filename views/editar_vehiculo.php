<?php
require_once dirname(__DIR__) . '/models/VehiculoModel.php';
require_once dirname(__DIR__) . '/models/MarcaModel.php';    
require_once dirname(__DIR__) . '/models/ModeloModel.php';   

$vehiculo = null;
$listaMarcas = [];
$listaModelos = [];

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $idVehiculo = (int)$_GET['id'];
    
    $vehiculoModel = new VehiculoModel();
    $marcaModel = new MarcaModel();
    $modeloModel = new ModeloModel();
    $vehiculo = $vehiculoModel->leerUno($idVehiculo);
    $listaMarcas = $marcaModel->leer();
    $listaModelos = $modeloModel->leer();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editar Vehiculo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo ASSETS_URL; ?>assets/icons/automall.ico" />

    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/sweet-alert.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/styles.css"> 
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/form-styles.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/editarVehiculo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo ASSETS_URL; ?>js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="<?php echo ASSETS_URL; ?>js/sweet-alert.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/modernizr.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/form.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/form-vehiculos.js"></script>
</head>
<body>
<div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile nav-lateral-scroll">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                AutoMall Center
            </div>
            <div class="nav-lateral-divider full-reset"></div>
            <div class="nav-lateral-divider full-reset"></div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">

                    <li><a href="<?php echo BASE_URL; ?>index.php?page=home"><i class="zmdi zmdi-home zmdi-hc-fw"></i>Inicio</a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-car"></i>Vehiculo<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=registrar_vehiculo"><i class="zmdi zmdi-car-wash"></i>Registrar</a></li>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=lista_vehiculos"><i class="zmdi zmdi-sort"></i>Listado</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-brightness-high"></i>Revisión<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=mantenimiento"><i class="zmdi zmdi-developer-board"></i>Registrar Mantenimiento</a></li>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=serviciosrealizados"><i class="zmdi zmdi-filter-frames"></i>Servicios Realizados</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-apps"></i>Catálogo<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=mostrar_catalogo"><i class="zmdi zmdi-format-subject"></i>Mostrar</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-calendar-note"></i>Citas<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=agendarCita"><i class="zmdi zmdi-assignment-check"></i>Agendar</a></li>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=estadoCita"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>Estado</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Proveedor<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=registrarProveedor"><i class="zmdi zmdi-accounts-add"></i>Agregar</a></li>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=consultarProveedor"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>Listado</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-settings-square"></i>Configuración Avanzada<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li>
                                <div class="dropdown-menu-button"><i class="zmdi zmdi-accounts-alt"></i>Cliente<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo BASE_URL; ?>index.php?page=registrarCliente"><i class="zmdi zmdi-accounts-add"></i>Registrar</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>index.php?page=consultarCliente"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>Consultar</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=gestion_marcas"><i class="zmdi zmdi-car"></i>Marca</a></li>
                            <li><a href="<?php echo BASE_URL; ?>index.php?page=gestion_modelo"><i class="zmdi zmdi-assignment"></i>Modelo</a></li>
                            <li>
                                <div class="dropdown-menu-button"><i class="zmdi zmdi-male-alt"></i>Vendedor <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo BASE_URL; ?>index.php?page=registrarVendedor"><i class="zmdi zmdi-developer-board"></i> Registrar</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>index.php?page=consultarVendedor"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>Consultar</a></li>
                                </ul>
                            </li>
                            <li><a href=""><i class="zmdi zmdi-account-circle"></i>Rol</a></li>
                            <li>
                                <div class="dropdown-menu-button"><i class="zmdi zmdi-account-circle"></i>Usuarios <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                                <ul class="list-unstyled">
                                    <li><a href=""><i class="zmdi zmdi-format-subject"></i>Registrar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content-page-container full-reset custom-scroll-containers">
       
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure><img src="<?php echo ASSETS_URL; ?>assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box"></figure>
                <li><span class="all-tittles">Admin</span></li>
                <li class="tooltips-general exit-system-button" data-placement="bottom" title="Salir del sistema"><i class="zmdi zmdi-power"></i></li>
                <li class="tooltips-general search-book-button" data-href="searchbook.php" data-placement="bottom" title="Buscar"><i class="zmdi zmdi-search"></i></li>
                <li class="tooltips-general btn-help" data-placement="bottom" title="Ayuda"><i class="zmdi zmdi-help-outline zmdi-hc-fw"></i></li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;"><i class="zmdi zmdi-menu"></i></li>
                <li class="desktop-menu-button hidden-xs" style="float: left !important;"><i class="zmdi zmdi-swap"></i></li>
            </ul>
        </nav>
        <div class="contenido-pagina">
            <h1>Editar Vehículo</h1>
            <div class="content-box">
                <?php 
                if ($vehiculo): 
                ?>
                    <form id="formularioVehiculo" action="<?php echo BASE_URL; ?>controllers/vehiculoController.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="procesar_actualizacion">
                        <input type="hidden" name="id_vehiculo" value="<?php echo htmlspecialchars($vehiculo['Id_Vehiculo']); ?>">
                        <input type="hidden" name="id_documento" value="<?php echo htmlspecialchars($vehiculo['Id_Documento']); ?>">

                    <fieldset>
                        <legend>Información del Vehículo</legend>
                        <div class="form-grid">
                            
                            <div class="campo">
                                <label for="placa">Placa:</label>
                                <input type="text" id="placa" name="placa" value="<?php echo htmlspecialchars($vehiculo['Placa']); ?>" required>
                            </div>

                            <div class="campo">
                                <label for="id_marca">Marca:</label>
                                <select name="id_marca" id="id_marca" required>
                                    <?php foreach ($listaMarcas as $marca): ?>
                                        <option value="<?php echo $marca['Id_Marca']; ?>" <?php echo ($marca['Id_Marca'] == $vehiculo['Id_Marca']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($marca['Nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="campo">
                                <label for="id_modelo">Modelo:</label>
                                <select name="id_modelo" id="id_modelo" required>
                                    <?php foreach ($listaModelos as $modelo): ?>
                                        <option value="<?php echo $modelo['Id_Modelo']; ?>" <?php echo ($modelo['Id_Modelo'] == $vehiculo['Id_Modelo']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($modelo['Nombre_modelo']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="campo">
                                <label for="anio">Año:</label>
                                <input type="number" id="anio" name="anio" value="<?php echo htmlspecialchars($vehiculo['Anio']); ?>" required>
                            </div>

                            <div class="campo">
                                <label for="color">Color:</label>
                                <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($vehiculo['Color']); ?>" required>
                            </div>

                            <div class="campo">
                                <label for="tipo">Tipo:</label>
                                <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($vehiculo['Tipo']); ?>" required>
                            </div>

                            <div class="campo">
                                <label for="estado">Estado:</label>
                                <select name="estado" id="estado" required>
                                    <option value="disponible" <?php if ($vehiculo['Estado'] == 'disponible') echo 'selected'; ?>>Disponible</option>
                                    <option value="vendido" <?php if ($vehiculo['Estado'] == 'vendido') echo 'selected'; ?>>Vendido</option>
                                </select>
                            </div>

                            <div class="campo">
                                <label for="precio">Precio (USD):</label>
                                <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($vehiculo['Precio']); ?>" step="0.01" required>
                            </div>
                            
                            <div class="campo grid-full-width">
                                <label for="descripcion">Descripción:</label>
                                <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($vehiculo['Descripcion'] ?? $vehiculo['descripcion'] ?? ''); ?></textarea>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Documentación del Vehículo</legend>
                        <div class="form-grid">
                            <div class="campo">
                                <label for="kilometraje">Kilometraje:</label>
                                <input type="number" id="kilometraje" name="kilometraje" value="<?php echo htmlspecialchars($vehiculo['Kilometraje']); ?>" required>
                            </div>

                            <div class="campo">
                                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo htmlspecialchars($vehiculo['Fecha_Ingreso']); ?>" required>
                            </div>

                            <div class="campo">
                                <label for="fecha_venta">Fecha de Venta:</label>
                                <input type="date" id="fecha_venta" name="fecha_venta" value="<?php echo htmlspecialchars($vehiculo['Fecha_Venta']); ?>" >
                            </div>
                            
                            <div class="campo grid-full-width checkbox-group">
                                <label>Documentos Incluidos:</label>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="propiedad" name="documentacion[Original_TotalPropiedad]" value="1" <?php echo ($vehiculo['Original_TotalPropiedad'] == 1) ? 'checked' : ''; ?>>
                                    <label for="propiedad">Título de Propiedad Original</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="transito" name="documentacion[Experticia_Transito]" value="1" <?php echo ($vehiculo['Experticia_Transito'] == 1) ? 'checked' : ''; ?>>
                                    <label for="transito">Experticia de Tránsito</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="certificado" name="documentacion[Certificado_Origen]" value="1" <?php echo ($vehiculo['Certificado_Origen'] == 1) ? 'checked' : ''; ?>>
                                    <label for="certificado">Certificado de Origen</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="carnet" name="documentacion[Carnet_Circulacion]" value="1" <?php echo ($vehiculo['Carnet_Circulacion'] == 1) ? 'checked' : ''; ?>>
                                    <label for="carnet">Carnet de Circulación</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="reserva" name="documentacion[Reserva_Dominio]" value="1" <?php echo ($vehiculo['Reserva_Dominio'] == 1) ? 'checked' : ''; ?>>
                                    <label for="reserva">Reserva d Dominio</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="finiquito" name="documentacion[Finiquito]" value="1" <?php echo ($vehiculo['Finiquito'] == 1) ? 'checked' : ''; ?>>
                                    <label for="finiquito">Finiquito</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="factura" name="documentacion[Factura_Compra]" value="1" <?php echo ($vehiculo['Factura_Compra'] == 1) ? 'checked' : ''; ?>>
                                    <label for="factura">Factura de Compra</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="resguardo" name="documentacion[Resguardo]" value="1" <?php echo ($vehiculo['Resguardo'] == 1) ? 'checked' : ''; ?>>
                                    <label for="resguardo">Resguardo</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="transferencia" name="documentacion[Fecha_Transferencia]" value="1" <?php echo ($vehiculo['Fecha_Transferencia'] == 1) ? 'checked' : ''; ?>>
                                    <label for="transferencia">Fecha de Tranferencia</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="gato" name="documentacion[Gato]" value="1" <?php echo ($vehiculo['Gato'] == 1) ? 'checked' : ''; ?>>
                                    <label for="gato">Gato</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="repuesto" name="documentacion[Repuesto]" value="1" <?php echo ($vehiculo['Repuesto'] == 1) ? 'checked' : ''; ?>>
                                    <label for="repuesto">Repuesto</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="triangulo" name="documentacion[Triangulo]" value="1" <?php echo ($vehiculo['Triangulo'] == 1) ? 'checked' : ''; ?>>
                                    <label for="triangulo">Triángulo</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="seguro" name="documentacion[Seguro]" value="1" <?php echo ($vehiculo['Seguro'] == 1) ? 'checked' : ''; ?>>
                                    <label for="seguro">Seguro</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Imágenes</legend>
                        <div class="campo grid-full-width">
                            <label>Añadir nuevas imágenes (opcional):</label>
                            <div class="custom-file-input">
                                <input type="file" id="imagen_url" name="imagenes[]" multiple>
                                <label for="imagen_url" class="file-button">Seleccionar archivos</label>
                                <span class="file-name">Las nuevas imágenes se añadirán a las existentes</span>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                            <button type="submit" class="btn-principal">Actualizar Vehículo</button>
                            <a href="<?php echo BASE_URL; ?>index.php?page=lista_vehiculos" class="btn-secundario">Cancelar</a>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="no-data">No se pudo cargar la información del vehículo. Verifique que el ID es correcto o que el vehículo no ha sido eliminado.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore dignissimos qui molestias ipsum officiis unde aliquid consequatur, accusamus delectus asperiores sunt. Quibusdam veniam ipsa accusamus error. Animi mollitia corporis iusto.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>