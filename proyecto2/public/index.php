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

</head>
<body>

    <?php include 'partials/header.php'; ?>

    <main class="container">
        <h1>Bienvenido a nuestra tienda</h1>
        <div class="carousel">
            <div class="slides" id="slides">
                <img src="../assets/img/img1.png" alt="Imagen 1">
                <img src="../assets/img/img2.jpg" alt="Imagen 2">
                <img src="../assets/img/img3.jpg" alt="Imagen 3">
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
                '/proyecto2/public/forms/showbycategory.php?categoria=1'" class="btn">electrónica</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=2'" class="btn">ropa</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=3'" class="btn">hogar</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=4'" class="btn">juguetes</button>
                <button onclick="window.location.href=
                '/proyecto2/public/forms/showbycategory.php?categoria=2'" class="btn">alimentos</button>

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