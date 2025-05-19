<?php
$base_url = '/proyecto2'; 

$base_url = '/proyecto2';
require_once '../api/config/database.php';
require_once '../api/models/Product.php';

$database = new Database();
$db = $database->connect();

$product = new Product($db);
$products = $product->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GK-SHOP</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/scripts.js" defer></script>
    
    <!-- carrusel -->
    <link rel="stylesheet" href="../assets/css/carrusel.css">
    <script src = "../assets/js/carr.js" defer></script>
    <!-- carrusel -->

    <!-- barra lateral -->
    <link rel="stylesheet" href="../assets/css/varios.css">
    <script src = "../assets/js/lateralcontrol.js" defer></script>
    <!-- barra lateral -->


    <style>
.btna {

    display: inline-block;
    background: #7a237a;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
    margin-left: 10%;
    flex-direction: column;
}

</style>

</head>
<body>

    <?php include 'partials/header.php'; ?>

    <main class="container">
        <h1>Bienvenido a nuestra tienda</h1>
        <div class="carousel">
            <div class="slides" id="slides">
                <img src="../assets/img/1.jpg" alt="Imagen 1">
                <img src="../assets/img/2.jpg" alt="Imagen 2">
                <img src="../assets/img/3.jpg" alt="Imagen 3">
                <img src="../assets/img/4.jpg" alt="Imagen 4">
                <img src="../assets/img/5.jpg" alt="Imagen 5">
            </div>
            <div class="buttons">
                <button onclick="prevSlide()">❮</button>
                <button onclick="nextSlide()">❯</button>
            </div>
        </div>

        

        <!--esto será la barra lateral-->
        <button id= "callinaside">👆</button> 
       
        <aside id="aside">
    
                <h1> Filtre según una categoría </h1>
                
                <!--sublista de elementos seleccionados-->
                <!--argunmentos con los que llega-->
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=1'" class="btna">electrónica</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=2'" class="btna">ropa</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=3'" class="btna">hogar</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=4'" class="btna">juguetes</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=2'" class="btna">alimentos</button>

        </aside>

        <div class="product-grid">
            <?php while($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="product-card">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <p class="price">$<?= number_format($row['price'], 2) ?></p>
                    <a href="product_view.php?id=<?= $row['id'] ?>" class="btn">Ver detalles</a>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <?php include 'partials/footer.php'; ?>
 
</body>
</html>