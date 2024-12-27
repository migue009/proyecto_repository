<?php
    include_once '../lib/helpers.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,0">
    <title>Login for html</title>
    <link rel="stylesheet" href="assets/css/regis.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    
    <div class="wrapper">
        <!-- Aquí se agrega el autocomplete="off" al formulario -->
        <form action="<?php echo getUrl('Acceso', 'Acceso', 'registrar');?>" method="post" id="registrar-ciudadano-form" autocomplete="off">
            <h1>Registro</h1>
            
            <div class="container">
                <div class="input-box">
                    <select name="usu_tipo_documento" class="form-control" id="usu_tipo_documento" autocomplete="off">
                        <option value="">Tipo de documento</option>
                        <?php
                            foreach ($tipoDocu as $tipo) {
                                echo "<option value='" . $tipo['tipo_documento_id'] . "'>" . $tipo['tip_doc_nombre'] . "</option>";
                            }
                        ?>
                    </select>
                    <div id="error_usu_tipo_documento" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="usu_documento" class="form-control" id="usu_documento" placeholder="Número de documento" autocomplete="off">
                    <div id="error_usu_documento" class="invalid-feedback"></div>
                </div>

                <!-- Género -->
                <div class="input-box">
                    <select name="genero" class="form-control" id="genero" autocomplete="off">
                        <option value="">Género</option>
                        <?php
                            foreach ($genero as $gen) {
                                echo "<option value='" . $gen['sexo_id'] . "'>" . $gen['sexo_nombre'] . "</option>";
                            }
                        ?>
                    </select>
                    <div id="error_genero" class="invalid-feedback"></div>
                </div>
            </div>

            <!-- Primer Nombre y Segundo Nombre -->
            <div class="container">
                <div class="input-box">
                    <input type="text" name="usu_primer_nombre" class="form-control" id="primer_nombre" placeholder="Primer Nombre" autocomplete="off">
                    <div id="error_primer_nombre" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="usu_segundo_nombre" class="form-control" id="segundo_nombre" placeholder="Segundo Nombre" autocomplete="off">
                    <div id="error_segundo_nombre" class="invalid-feedback"></div>
                </div>
            </div>

            <!-- Primer Apellido y Segundo Apellido -->
            <div class="container">
                <div class="input-box">
                    <input type="text" name="usu_primer_apellido" class="form-control" id="primer_apellido" placeholder="Primer Apellido" autocomplete="off">
                    <div id="error_primer_apellido" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="usu_segundo_apellido" class="form-control" id="segundo_apellido" placeholder="Segundo Apellido" autocomplete="off">
                    <div id="error_segundo_apellido" class="invalid-feedback"></div>
                </div>
            </div>

            <!-- Correo y Teléfono -->
            <div class="container">
                <div class="input-box">
                    <input type="email" name="usu_correo" class="form-control" id="correo" placeholder="Correo Electrónico" autocomplete="off">
                    <div id="error_correo" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="usu_telefono" class="form-control" id="telefono" placeholder="Número de teléfono" autocomplete="off">
                    <div id="error_telefono" class="invalid-feedback"></div>
                </div>
            </div>

            <!-- Clave y Confirmar Clave -->
            <div class="container">
                <div class="input-box">
                    <input type="password" name="usu_clave" class="form-control" id="clave" placeholder="Clave" autocomplete="off">
                    <br>
                    <div id="error_clave" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="password" name="confirmar_clave" class="form-control" id="confirmar_clave" placeholder="Confirmar Clave" autocomplete="off">
                    <div id="error_confirmar_clave" class="invalid-feedback"></div>
                </div>
            </div>

            <!-- Dirección -->
            <h2 class="mt-4">Dirección</h2>

            <div class="container">
                <div class="input-box">
                    <input type="text" name="carrera" class="form-control" id="carrera" placeholder="Carrera" autocomplete="off">
                    <div id="error_carrera" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" autocomplete="off">
                    <div id="error_calle" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="numero_adicional" class="form-control" id="numero_adicional" placeholder="Número Adicional" autocomplete="off">
                    <div id="error_numero_adicional" class="invalid-feedback"></div>
                </div>
            </div>

            <div class="container">
                <div class="input-box">
                    <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Complemento (Apartamento, Casa, Local)" autocomplete="off">
                    <div id="error_complemento" class="invalid-feedback"></div>
                </div>

                <div class="input-box">
                    <input type="text" name="barrio" class="form-control" id="barrio" placeholder="Barrio" autocomplete="off">
                    <div id="error_barrio" class="invalid-feedback"></div>
                </div>
            </div>

            <center><button type="submit" class="btn mt-4">Registrar</button></center>
            <div class="register-link mt-4">
                <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
            </div>
        </form>
    </div>
<script src="js/query.js"></script>
<script src="js/global.js"></script>
</body>
</html>
