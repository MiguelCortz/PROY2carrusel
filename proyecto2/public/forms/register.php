<?php

$base_url = '/proyecto2'; 

session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit;
}

require_once '../../api/utils/helpers.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirm_password = sanitizeInput($_POST['confirm_password']);

    if(validateEmail($email) && validatePassword($password) && $password === $confirm_password) {
        require_once '../../api/config/database.php';
        require_once '../../api/models/User.php';

        $database = new Database();
        $db = $database->connect();

        $user = new User($db);
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        if(!$user->emailExists()) {
            if($user->create()) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['user_email'] = $user->email;

                header("Location: ../dashboard.php");
                exit;
            } else {
                $error = "Error al registrar el usuario";
            }
        } else {
            $error = "El email ya está registrado";
        }
    } else {
        $error = "Por favor complete todos los campos correctamente";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - E-commerce</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../partials/header.php'; ?>

    <main class="container">
        <h1>Registro de Usuario</h1>
        
        <?php if(isset($error)): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <form id="registerForm" method="POST" action="register.php">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required minlength="8">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn">Registrarse</button>
                <a href="../index.php" class="btn cancel">Cancelar</a>
            </div>
        </form>
    </main>

    <?php include '../partials/footer.php'; ?>
    <script src="../../assets/js/scripts.js"></script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if(!name || !email || !password || !confirmPassword) {
                alert('Por favor complete todos los campos');
                e.preventDefault();
                return false;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailRegex.test(email)) {
                alert('Por favor ingrese un email válido');
                e.preventDefault();
                return false;
            }
            
            if(password.length < 8) {
                alert('La contraseña debe tener al menos 8 caracteres');
                e.preventDefault();
                return false;
            }
            
            if(password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>