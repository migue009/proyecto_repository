<?php
    include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="stylesheet" href="login.css">
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
  </head>
<?php
    if(isset($_SESSION['error'])){
        echo "<div class = 'alert alert-danger' role= 'alert'>";
        echo $_SESSION['error'];
        echo"</div>";
        unset($_SESSION['error']);
    }
?>


<div class="contenedor">
    <div class="wrapper">
        <form action="<?php echo getUrl("Acceso","Acceso","login", false, "ajax"); ?>" method="post" id="form">
            <h1>Inicia Sesi&oacute;n</h1>
            <div class="input-box">
                <input type="email" name="user" class="form-control" id="user" placeholder="Enter email" required> 
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label class = "remember-forgot-text"><input type="checkbox">Recordarme</label>
                    <a href="#">¿Has olvidado tu contraseña?</a>
            </div>
            <button type="submit" class="btn">Ingresar</button>
            <div class="register-link">
                <p>No tienes cuenta? <a href="#">Registrarse</a></p>
            </div>
        </form>
    </div>
</div>

