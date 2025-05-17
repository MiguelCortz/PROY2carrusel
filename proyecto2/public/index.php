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

    <link rel="stylesheet" href="../assets/css/carrusel.css">
    <script src = "../assets/js/carr.js" defer></script>
                    
</head>
<body>

    <?php include 'partials/header.php'; ?>

    <main class="container">
        <h1>Bienvenido a nuestra tienda</h1>

        <div class="carousel">
            <div class="slides" id="slides">
                <img src="../img/img1.png" alt="Imagen 1">
                <img src="../img/img2.jpg" alt="Imagen 2">
                <img src="../img/img3.jpg" alt="Imagen 3">
            </div>
            <div class="buttons">
                <button onclick="prevSlide()">❮</button>
                <button onclick="nextSlide()">❯</button>
            </div>
        </div>


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
    <script src="../assets/js/scripts.js"></script>
</body>
</html>