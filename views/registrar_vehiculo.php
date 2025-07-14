<?php
require_once dirname(__DIR__) . '/models/marcaModel.php';
require_once dirname(__DIR__) . '/models/modeloModel.php';

$marcaModel = new MarcaModel();
$listaMarcas = $marcaModel->leer(); 
$modeloModel = new ModeloModel();
$listaModelos = $modeloModel->leer(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo ASSETS_URL; ?>assets/icons/automall.ico" />

    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/sweet-alert.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/normalize.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/styles.css"> 
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/form-styles.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/agregarVehiculo.css">
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
    <script src="<?php echo ASSETS_URL; ?>js/custom-vehiculo-form.js"></script>
    <title>Registrar Vehículos</title>

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
            <h1>Registrar Vehículo</h1> 
        </div>
        <form id="formularioVehiculo" action="<?php echo BASE_URL; ?>controllers/vehiculoController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="paso1_registrar">
            <fieldset>
                <legend>Información del Vehículo</legend>
                
                <div class="campo">
                    <label for="placa">Placa:</label>
                    <input type="text" id="placa" name="placa" placeholder="Ej: P-123ABC" required>
                </div>

                <div class="campo">
                    <label for="id_marca">Marca:</label>
                    <select name="id_marca" id="id_marca" required>
                        <option value="" disabled selected>Selecciona una marca</option>
                        <?php
                        if ($listaMarcas) {
                            while($row = $listaMarcas->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='".htmlspecialchars($row['Id_Marca'])."'>".htmlspecialchars($row['Nombre'])."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="id_modelo">Modelo:</label>
                    <select name="id_modelo" id="id_modelo" required>
                        <option value="" disabled selected>Selecciona un modelo</option>
                        <?php
                        if ($listaModelos) {
                            while($row = $listaModelos->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='".htmlspecialchars($row['Id_Modelo'])."'>".htmlspecialchars($row['Nombre_modelo'])."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="anio">Año:</label>
                    <input type="number" id="anio" name="anio" min="1950" max="2025" placeholder="Ej: 2021" required>
                </div>

                <div class="campo">
                    <label for="color">Color:</label>
                    <select name="color_seleccion" id="color" required>
                        <option value="" disabled selected>Selecciona un color</option>
                        <option value="Negro">Negro</option>
                        <option value="Blanco">Blanco</option>
                        <option value="Gris">Gris</option>
                        <option value="Plata">Plata</option>
                        <option value="Rojo">Rojo</option>
                        <option value="Azul">Azul</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="campo" id="campo_otro_color">
                    <label for="otro_color">Especifica el color:</label>
                    <input type="text" id="otro_color" name="color_otro" placeholder="Ej: Verde Militar">
                </div>

                <div class="campo">
                    <label for="tipo_vehiculo">Tipo:</label>
                    <select name="tipo_vehiculo" id="tipo_vehiculo" required>
                        <option value="" disabled selected>Selecciona un tipo</option>
                        <option value="camioneta">Camioneta</option>
                        <option value="carro">Carro</option>
                        <option value="camion">Camión</option>
                        <option value="moto">Moto</option>
                    </select>
                </div>

                <div class="campo">
                    <label for="estado">Estado:</label>
                    <select name="estado" id="estado" required>
                        <option value="" disabled selected>Selecciona un Estado</option>
                        <option value="disponible">Disponible</option>
                        <option value="vendido">Vendido</option>
                    </select>
                </div>

                <div class="campo">
                    <label for="precio">Precio (USD):</label>
                    <input type="number" id="precio" name="precio" min="0" step="0.01" placeholder="Ej: 25000.50" required>
                </div>

                 <div class="campo grid-full-width"> 
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" 
                        placeholder="Añade detalles adicionales como condición, kilometraje, etc." required>
                    </textarea>
                </div>

                <div class="campo grid-full-width">
                    <label>Imágenes:</label> 
                    <div class="custom-file-input">
                        <input type="file" id="imagen_url" name="imagenes[]" multiple>
                        <label for="imagen_url" class="file-button">Seleccionar archivo</label>
                        <span class="file-name">Archivo seleccionado</span>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="boton-siguiente">Guardar y Continuar</button>
        </form>

        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore dignissimos qui molestias ipsum officiis unde aliquid consequatur, accusamus delectus asperiores sunt. Quibusdam veniam ipsa accusamus error. Animi mollitia corporis iusto.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i>   De acuerdo</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>