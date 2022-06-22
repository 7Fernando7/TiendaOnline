<!--Header con todas las funcionalidades del menú-->
<header>
  <div class="menu">
        <div class="cabezera" id="texto"></div>
            <!--Encabezado con barra superior y menu-->
            <div class="barraSuperior">
                <a href="/dashboard/TiendaOnline/index.php"><img src="/dashboard/TiendaOnline/img/logo.jpeg" alt="logo" /></i></a>
            <div class="buscardor">
                <h2>Barbara Boutique de Moda</h2>
                <form method="POST" action="">
                    <div>
                    <input type="search" id="search "name="search" placeholder="Buscar"/>
                        <input type="submit" name="submit" />
                    </div>
                </form>
            </div>
            <div class="login">
                <?php
                /**Hago un controle para saber si está logueado el usuario y que monstraré */
                if (!$logueado) {
                    echo '<div class="carrito">';
                    echo '<a href="/dashboard/TiendaOnline/php/controlador/carritoCompra.php"><i class="fa-solid fa-cart-shopping"></i>';
                    echo '<div id="cantidadProductos">'.$cantidadCestaTotal.'</div></a>';
                    echo '</div>';
                    echo '<div class="loguear">';
                    echo    '<a href="/dashboard/TiendaOnline/php/controlador/loginUsuario.php"><i class="fa-solid fa-right-to-bracket"></i>Login</a>';
                    echo '</div>';
                }
                ?>
                <?php
                /*Hago un controle para saber si está logueado el administrador y enseño funciones de adminsitrador */
                    if ($logueado && $administrador) {
                    echo  '<div class="logout">';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/logOutUsuario.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>';
                    echo  '</div>';
                    echo  '<div class="logout ocultaMenu" onclick="menuAdmin()" role="presentation">';
                    echo  '<i class="fa-solid fa-gear ocultaMenu"></i>';
                    echo  '<div id="miDesplegableAdmin" class="despegable-contenido">';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarUsuario.php"><p>Mi cuenta</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/registrarProductos.php"><p>Insertar productos</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarProductos.php"><p>Consultar productos</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarTodosPedidos.php"><p>Ver pedidos</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarUsuarioBD.php"><p>Buscar usuario</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/registrarUsuarioAdmin.php"><p>Crear usuario administrador</p></a>';
                    echo  '</div>';
                    echo  '</div>';
                    }
                ?>
                <?php
                /*Hago un controle para saber si está logueado un usuario y enseño el perfil de usuario */
                    if ($logueado && !$administrador) {
                    echo '<div class="carrito">';
                    echo '<a href="/dashboard/TiendaOnline/php/controlador/carritoCompra.php"><i class="fa-solid fa-cart-shopping"></i>';
                    echo '<div id="cantidadProductos">'.$cantidadCestaTotal.'</div></a>';
                    echo '</div>';
                    echo  '<div class="logout">';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/logOutUsuario.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>';
                    echo  '</div>';
                    echo  '<div class="logout ocultaMenu" onclick="menuPerfil()" role="presentation">';
                    echo  '<i class="fa-solid fa-user ocultaMenu"></i>';
                    echo  '<div id="miDesplegablePerfil" class="despegable-contenido">';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarUsuario.php"><p>Mi cuenta</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarDirecciones.php"><p>Mis direcciones</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarPedidos.php"><p>Ver pedidos</p></a>';
                    echo  '<a href="/dashboard/TiendaOnline/php/controlador/buscarTarjetas.php"><p>Métodos de pago</p></a>';
                    echo  '</div>';
                    echo  '</div>';
                    }
                ?>
            </div>
        </div>
        <nav class="navSuperior">
            <a href="/dashboard/TiendaOnline/php/controlador/camisas.php">Camisas</a>
            <a href="/dashboard/TiendaOnline/php/controlador/accesorios.php">Accesorios</a>
            <a href="/dashboard/TiendaOnline/php/controlador/vestidos.php">Vestidos</a>
            <a href="/dashboard/TiendaOnline/php/controlador/bolsos.php">Bolsos</a>
        </nav>
    </div>
    <div id="ohsnap"></div>
</header>