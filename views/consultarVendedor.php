<?php
require_once dirname(__DIR__) . '/models/vendedorModel.php';
$modelo = new VendedorModel();
$vendedores = $modelo->obtenerTodosLosVendedores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Consultar Vendedor</title>
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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo ASSETS_URL; ?>js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="<?php echo ASSETS_URL; ?>js/sweet-alert.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/modernizr.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/main.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/form.js"></script>
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
                    <!-- ENLACES CORREGIDOS: Usan BASE_URL para apuntar al index.php de la raíz -->
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
                         <li><a href="<?php echo BASE_URL; ?>index.php?page=mantenimiento"><i class="zmdi zmdi-assignment-check"></i>Registrar Mantenimiento</a></li>
                        <li><a href="<?php echo BASE_URL; ?>index.php?page=serviciosrealizados"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>Servicios Realizados</a></li>
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
               
        <div class="contenido-crud">
            <h1>Vendedores Registrados</h1>
            
            <?php 
                if (isset($_GET['status']) && $_GET['status'] == 'success') {
                    echo '<div class="success-msg">Vendedor registrado correctamente.</div>';
                }
            ?>
            <div id="mensaje-global" class="mensaje" style="display:none;"></div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>Nombre y Apellido</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>RIF</th>
                        <th>Copia Llaves</th>
                        <th>Garantía</th>
                        <th>Certificado</th>
                        <th>Manual</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- El ID es crucial para que el JS sepa qué tipo de CRUD es -->
                <tbody id="tabla-vendedores-body">
                    <?php foreach ($vendedores as $vendedor): ?>
                    <tr data-id-vendedor="<?php echo htmlspecialchars($vendedor->Id_Vendedor); ?>">
                        <td data-field="Id_Vendedor"><?php echo htmlspecialchars($vendedor->Id_Vendedor); ?></td>
                        <td data-field="Nombre_Apellido"><?php echo htmlspecialchars($vendedor->Nombre_Apellido); ?></td>
                        <td data-field="Cedula"><?php echo htmlspecialchars($vendedor->Cedula); ?></td>
                        <td data-field="Telefono"><?php echo htmlspecialchars($vendedor->Telefono); ?></td>
                        <td data-field="Rif"><?php echo htmlspecialchars($vendedor->Rif); ?></td>
                        <td data-field="Copia_Llaves"><?php echo $vendedor->Copia_Llaves ? 'Sí' : 'No'; ?></td>
                        <td data-field="Garantia_Vehiculo"><?php echo $vendedor->Garantia_Vehiculo ? 'Sí' : 'No'; ?></td>
                        <td data-field="Certificado_Garantia"><?php echo $vendedor->Certificado_Garantia ? 'Sí' : 'No'; ?></td>
                        <td data-field="Manual_VehiculoGarantia"><?php echo $vendedor->Manual_VehiculoGarantia ? 'Sí' : 'No'; ?></td>
                        <td class="acciones">
                            <button class="btn-editar">Editar</button>
                            <button class="btn-eliminar" data-url="<?php echo BASE_URL; ?>controllers/vendedorController.php?action=admin_eliminar_vendedor&id=<?php echo htmlspecialchars($vendedor->Id_Vendedor); ?>">Eliminar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($vendedores)): ?>
                    <tr><td colspan="10" style="text-align:center;">No hay vendedores registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- SCRIPT ESPECÍFICO PARA ESTA PÁGINA -->
        <script>
            // Pasamos la URL del NUEVO controlador al script
            const API_URL = "<?php echo BASE_URL; ?>controllers/vendedorController.php";
        </script>
        <!-- Incluimos el manejador genérico de CRUD -->
        <script src="<?php echo ASSETS_URL; ?>js/crud-handler.js"></script>

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