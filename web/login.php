
<?php
    include_once '../lib/helpers.php';
    include_once '../view/partials/header.php';
?>
    <?php
        if(isset($_SESSION['error'])){
            echo "<div class = 'alert alert-danger' role= 'alert'>";
            echo $_SESSION['error'];
            echo"</div>";
            unset($_SESSION['error']);
        }
    ?>
<div class="container d-flex justify-content-center align-items-center">
    <form action ="<?php echo getUrl("Acceso","Acceso","login", false, "ajax"); ?>" method="post" id="form">
        <h2 class="text-center">Iniciar Sesi&oacute;n</h2>

        <div class="mb-3">
            <label for="user">Correo:</label>
            <input type="email" name="user" class="form-control" id="user" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
            <label for="pass">Password:</label>
            <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>


<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .login-container {
            background-color: #fff;
            padding: 35px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            margin: 20px;
            font-size: 24px;
            text-align: center;
        }
        .login-container label {
            display: block;
            margin-bottom: 10px;
        }
        .login-container input {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="" method="post">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html> -->
