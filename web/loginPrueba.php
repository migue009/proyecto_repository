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


<div class="contenedor">
    <div class="wrapper">
        <form action="<?php echo getUrl("Acceso","Acceso","login", false, "ajax"); ?>" method="post" id="form">
            <h1>Inicia Sesi&oacute;nnnnnn</h1>
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

