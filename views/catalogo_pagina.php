<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="<?php echo ASSETS_URL; ?>js/app.js" async></script>
    <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo ASSETS_URL; ?>assets/icons/automall.ico" />
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/inicio.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>AutoMall</title>
</head>
<body>
    <header>
		<div class="container-hero">
			<div class="container hero">
				<div class="customer-support">
					<i class="fa-solid fa-basket-shopping"></i>
					<div class="content-shopping-cart">
						<span class="text">Carrito</span>
						<span class="number">(0)</span>
					</div>
				</div>

                
				<div class="container-user">
					<i class="fa-solid fa-user"></i>
                    <div class="content-shopping-cart">
						<span class="text"><a href="<?php echo BASE_URL; ?>index.php?page=login">Iniciar</span></a>
						<span class="text">Sesión</span>
					</div>
				</div>
			</div>
		</div>

		<div class="container-navbar">
			<nav class="navbar container">
                <div class="container-logo">
					<i class="fa-solid fa-car-side"></i>
					<h1 class="logo"><a href="index.php">AutoMall</a></h1>
				</div>

                <form class="search-form">
					<input type="search" placeholder="Buscar..." />
					<button class="btn-search">
						<i class="fa-solid fa-magnifying-glass"></i>
					</button>
				</form>

				<i class="fa-solid fa-bars"></i>
				<ul class="menu">
					<li><a href="<?php echo BASE_URL; ?>index.php?page=catalogo_pagina">Inicio</a></li>
					<li><a href="">¿Quienes Somos?</a></li>
                    <li><a href="<?php echo BASE_URL; ?>index.php?page=login">Iniciar Sesión</a></li>
				</ul>
			</nav>
		</div>
	</header>

    <section class="contenedor">
        <div class="contenedor-items">
            <div class="item">
                <span class="precio-item">Box Engasse</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/1140-subaru-forester-sport-hero-esp.jpg" alt="" class="img-item">
                <span class="precio-item">$15.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">English Horse</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/18f5cec820dd9bc6fe533af614b82233.jpg" alt="" class="img-item">
                <span class="precio-item">$25.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Knock Nap</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/597a52b0e9d26e6e735be5d650862b94.jpg" alt="" class="img-item">
                <span class="precio-item">$35.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">La Night</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/b498e8ca5fe10da54c2412b95ee6c854.jpg" alt="" class="img-item">
                <span class="precio-item">$18.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Silver All</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/b717580b53fdeca4b60c639a2720aec0.jpg" alt="" class="img-item">
                <span class="precio-item">$32.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Skin Glam</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/bc1c9750320246c4146c4585195f79ee.jpg" alt="" class="img-item">
                <span class="precio-item">$18.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Midimix</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/c_url_original.2ilya8lorff75x.jpg" alt="" class="img-item">
                <span class="precio-item">$54.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Sir Blue</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/D_966003-MLA82031829100_022025-C.jpg" alt="" class="img-item">
                <span class="precio-item">$32.000</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/descarga.jpg" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/dfsk-cl_blog_tipos-de-vehiculos-conoce-cuales-existen-en-chile-03.jpg" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/ea253575-e6eb-42d3-9e32-8a8ba1ef01b9.webp" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/fiat_pulse_exterior_1.jpg" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/images (1).jpg" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/images.jpg" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/original.jpeg" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="precio-item">Middlesteel</span>
                <span class="titulo-item">Box Engasse</span>
                <img src="<?php echo ASSETS_URL; ?>imagenes/parts-80-1.avif" alt="" class="img-item">
                <span class="precio-item">$42.800</span>
                <span class="titulo-item">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias.</span>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
        </div>
        <div class="carrito" id="carrito">
            <div class="header-carrito">
                <h2>Tu Carrito</h2>
            </div>

            <div class="carrito-items">
            </div>
            <div class="carrito-total">
                <div class="fila">
                    <strong>Tu Total</strong>
                    <span class="carrito-precio-total">
                        $120.000,00
                    </span>
                </div>
                <button class="btn-pagar">Agendar Cita <i class="fa-regular fa-calendar-minus"></i> </button>
            </div>
        </div>
    </section>
</body>
</html>