<?php
$base_url = '/proyecto2'; 
?>
<nav class="navbar">
    <div class="logo">
        <a href="<?php echo $base_url; ?>/public/index.php">GK-SHOP</a>
    </div>
    <ul class="nav-links">
        <li><a href="<?php echo $base_url; ?>/public/index.php">Inicio</a></li>
        <li><a href="<?php echo $base_url; ?>/public/forms/login.php">Login</a></li>
        <li><a href="<?php echo $base_url; ?>/public/forms/register.php">Registro</a></li>
        <li><a href="<?php echo $base_url; ?>/public/forms/logout.php">Cerrar Sesion</a></li>
        <li><a href="<?php echo $base_url; ?>/public/forms/contact.php">Contacto</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Productos</a>
            <div class="dropdown-content">
                <a href="<?php echo $base_url; ?>/public/forms/product_list.php">Ver Productos</a>
                <a href="<?php echo $base_url; ?>/public/forms/product_create.php">Agregar Producto</a>
            </div>
        </li>
    </ul>
</nav>