<?php
    include_once '../model/Acceso/AccesoModel.php';
    class AccesoController{
        // public function test(){
        //     alert("probando");
        // }
        public function getRegistrar(){
            $obj = new AccesoModel();

            $sqlTipoDocu = "SELECT * FROM tipos_documentos";
            $tipoDocu = $obj->consult($sqlTipoDocu);
            
            $sqlSexo = "SELECT * FROM sexos";
            $genero = $obj->consult($sqlSexo);
        
            include_once '../view/usuario/registrar.php';
        }
        
        public function registrar(){
            $obj = new AccesoModel();
            
            // Obtener datos del formulario
            $usu_tipo_documento = $_POST['usu_tipo_documento'];
            $usu_documento = $_POST['usu_documento'];
            $usu_primer_nombre = $_POST['usu_primer_nombre'];
            $usu_segundo_nombre = $_POST['usu_segundo_nombre'];
            $usu_primer_apellido = $_POST['usu_primer_apellido'];
            $usu_segundo_apellido = $_POST['usu_segundo_apellido'];
            $usu_clave = $_POST['usu_clave'];
            $usu_correo = $_POST['usu_correo'];
            $usu_telefono = $_POST['usu_telefono'];
            $confirmar_clave = $_POST['confirmar_clave']; 
            $genero_id = $_POST['genero']; // 'genero' como ID del sexo
            // Concatenar dirección
            $carrera = $_POST['carrera'];
            $calle = $_POST['calle'];
            $numero_adicional = $_POST['numero_adicional'];
            $complemento = $_POST['complemento'];
            $barrio = $_POST['barrio'];
            
            $sql_direccion = "INSERT INTO direccion (carrera, calle, num_adicional, complemento, barrio) 
                              VALUES ('$carrera', '$calle', '$numero_adicional', '$complemento', '$barrio') RETURNING direccion_id";
            $direccion_id = $obj->insertUltimoId($sql_direccion);

            // Generar la sal usando mt_rand (generador de números aleatorios)
            $salt = '$2y$10$' . substr(md5(mt_rand()), 0, 22) . '$';  // Usando mt_rand() para generar la sal
            

            // Encriptar la clave usando crypt
            $hashedPassword = crypt($usu_clave, $salt);
            
            // ID del tipo de documento
            $rol_id = 2;  // Rol predeterminado (puede ser modificado según la lógica)
            $est_id = 1;  // Estado predeterminado (activo)
            
            if ($direccion_id) {
                // Paso 2: Insertar en la tabla usuarios con el direccion_id
                $sql_usuario = "INSERT INTO usuarios
                                (tip_doc, usu_num_doc, usu_primer_nom, usu_segundo_nom, 
                                 usu_primer_ape, usu_segundo_ape, usu_correo, usu_num_cel, usu_clave, 
                                 rol_id, sex_id, est_id, usu_momento_creacion, usu_direccion) 
                                VALUES 
                                ('$usu_tipo_documento', '$usu_documento', '$usu_primer_nombre', '$usu_segundo_nombre', 
                                 '$usu_primer_apellido', '$usu_segundo_apellido', '$usu_correo', '$usu_telefono', 
                                 '$hashedPassword', $rol_id, $genero_id, $est_id, NOW(), $direccion_id)";
                
                // Ejecutar la consulta de inserción en la tabla usuarios
                $ejecutar = $obj->insert($sql_usuario);
                
                // Verificar si la inserción fue exitosa
                if ($ejecutar) {
                    redirect('index.php');
                } else {
                    echo "Se ha presentado un error al insertar el usuario";
                }
            } else {
                echo "Se ha presentado un error al insertar la dirección";
            }
        }
        
        public function login(){
            $obj = new AccesoModel();
        
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            

            if (empty($user)) {
                $errors['user'] = "El correo es obligatorio.";
            }
        
            if (empty($pass)) {
                $errors['pass'] = "La contraseña es obligatoria.";
            }
        
            if (empty($errors)) {
                $sql = "SELECT * FROM usuarios WHERE usu_correo = '$user'";
                $usuario = $obj->consult($sql);
                if ($usuario && count($usuario) > 0) { // Si 'consult' devuelve un array de usuarios
                    foreach ($usuario as $usu) {
                        if (crypt($pass, $usu['usu_clave']) == $usu['usu_clave']) {
                            $_SESSION['nombre'] = $usu['usu_primer_nom'];
                            $_SESSION['apellido'] = $usu['usu_primer_ape'];
                            $_SESSION['correo'] = $usu['usu_correo'];
                            $_SESSION['rol'] = $usu['rol_id'];
                            $_SESSION['id'] = $usu['usuario_id'];
                            $_SESSION['auth'] = "ok";
        
                            redirect("index.php"); // Redirige al dashboard
                            exit;
                        } else {
                            $errors['pass'] = "Contraseña incorrecta.";
                        }
                    }
                } else {
                    $errors['user'] = "Correo electrónico no registrado.";
                }
            }
        
            // Si hay errores, pasar los mensajes de error a la vista de login
            if (!empty($errors)) {
                // Aquí pasas los errores al login para mostrarlos en los inputs
                $_SESSION['errors'] = $errors; 
                redirect("login.php");
            }
        }
        public function logout(){
            session_destroy();
            redirect("login.php");
        }
    }
?>