<?php
    include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registrar Usuario</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" href="assets/css/registrar.css">
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

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

<body>
    <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $_SESSION['error'];
            echo "</div>";
            unset($_SESSION['error']);
        }
    ?>

    <div class="contenedor">
        <div class="wrapper">
            <form action="<?php echo getUrl('Administrador', 'Administrador', 'postCreate'); ?>" method="post" id="form">
                <h1 class="text-center">Registro</h1>

                <!-- Tipo de Documento y Documento -->
                <div class="form-row">
                    <div class="input-box">
                        <select name="usu_tipo_documento" class="form-control" id="usu_tipo_documento">
                            <?php
                                foreach ($tipoDocu as $tipo) {
                                    echo "<option value='" . $tipo['tipo_doc_id'] . "'>" . $tipo['tipo_doc_nombre'] . "</option>";
                                }
                            ?>
                        </select>
                        <i class='bx bxs-id-card'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="usu_documento" class="form-control" id="usu_documento" placeholder="Número de documento" required>
                        <i class='bx bxs-file'></i>
                    </div>
                </div>

                <!-- Primer Nombre y Segundo Nombre -->
                <div class="form-row">
                    <div class="input-box">
                        <input type="text" name="usu_primer_nombre" class="form-control" id="primer_nombre" placeholder="Primer Nombre" required>
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="usu_segundo_nombre" class="form-control" id="segundo_nombre" placeholder="Segundo Nombre">
                        <i class='bx bxs-user'></i>
                    </div>
                </div>

                <!-- Primer Apellido y Segundo Apellido -->
                <div class="form-row">
                    <div class="input-box">
                        <input type="text" name="usu_primer_apellido" class="form-control" id="primer_apellido" placeholder="Primer Apellido" required>
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="usu_segundo_apellido" class="form-control" id="segundo_apellido" placeholder="Segundo Apellido">
                        <i class='bx bxs-user'></i>
                    </div>
                </div>

                <!-- Correo y Teléfono -->
                <div class="form-row">
                    <div class="input-box">
                        <input type="email" name="usu_correo" class="form-control" id="correo" placeholder="Correo Electrónico" required>
                        <i class='bx bxs-envelope'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="usu_telefono" class="form-control" id="telefono" placeholder="Número de teléfono" required>
                        <i class='bx bxs-phone'></i>
                    </div>
                </div>

                <!-- Clave y Confirmar Clave -->
                <div class="form-row">
                    <div class="input-box">
                        <input type="password" name="usu_clave" class="form-control" id="clave" placeholder="Clave" required>
                        <i class='bx bxs-lock'></i>
                    </div>

                    <div class="input-box">
                        <input type="password" name="confirmar_clave" class="form-control" id="confirmar_clave" placeholder="Confirmar Clave" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>

                <!-- Rol -->

                <h2 class="mt-4">Dirección</h2>

                <!-- Carrera, calle,n. adicional -->
                <div class="form-row">
                    <div class="input-box">
                        <input type="text" name="carrera" class="form-control" id="carrera" placeholder="Carrera" required>
                        <i class='bx bxs-location-plus'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" required>
                        <i class='bx bxs-location-plus'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="numero_adicional" class="form-control" id="numero_adicional" placeholder="Número Adicional">
                        <i class='bx bxs-location-plus'></i>
                    </div>
                </div>

                <!-- Complemento,barrio -->
                <div class="form-row">
                    <div class="input-box">
                        <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Complemento (Apartamento, Casa, Local)">
                        <i class='bx bxs-location-plus'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" name="barrio" class="form-control" id="barrio" placeholder="Barrio" required>
                        <i class='bx bxs-location-plus'></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-4">Registrar</button>

                <div class="register-link mt-4">
                    <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
