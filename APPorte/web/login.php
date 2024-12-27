<?php
    include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=decive-width,initial-scale=1,0">
    <title>Login for html</title>
    <link rel="stylesheet" href="../web/assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
    
</body>
</html>

<body>
    <div class="wrapper">
        <form action="<?php echo getUrl("Acceso","Acceso","login", false, "ajax"); ?>" method="POST" id="login-form">
            <h1>Iniciar Sesi&oacute;n</h1>
            <div class="input-box">
            <input type="text" name="user" class="form-control" id="user" placeholder="Usuario" autocomplete="off">
                <i class='bx bxs-user'></i>
                <?php if (isset($_SESSION['errors']['user'])): ?>
                  <div class="text-danger"><?php echo $_SESSION['errors']['user']; //esto es para imprimir el mensaje de error, no afecta?></div>
                <?php endif; ?>
            </div>
            <div class="input-box">
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
                <?php if (isset($_SESSION['errors']['pass'])): ?>
                    <div class="text-danger"><?php echo $_SESSION['errors']['pass']; //esto es para imprimir el mensaje de error, no afecta?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="remember-forgot">
                    <a href="#">Has olvidado tu contraseña?</a>
            </div>
            <button type="submit" class="btn">Ingresar</button>
            <div class="register-link">
                <p>No tienes cuenta? <a href=<?php echo getUrl("Acceso","Acceso","getRegistrar",false,"ajax");?>>Registrarse</a></p>
            </div>
        </form>
        <?php unset($_SESSION['errors']); ?>
    </div>

</body>

</html>
