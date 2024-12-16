<?php
    include_once '../model/Acceso/AccesoModel.php';
    class AccesoController{
        // public function test(){
        //     alert("probando");
        // }
        public function getRegistrar(){
            $obj = new AccesoModel();

            $sqlRoles = "SELECT * FROM roles";
            $roles = $obj->consult($sqlRoles);
            
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
            $genero_id = $_POST['genero'];
            
            // Concatenar dirección
            $carrera = $_POST['carrera'];
            $calle = $_POST['calle'];
            $numero_adicional = $_POST['numero_adicional'];
            $complemento = $_POST['complemento'];
            $barrio = $_POST['barrio'];
            
            $usu_direccion = "$carrera $calle $numero_adicional $complemento, $barrio";
            
            // Generar la sal usando mt_rand (generador de números aleatorios)
            $salt = '$2y$10$' . substr(md5(mt_rand()), 0, 22) . '$';  // Usando mt_rand() para generar la sal
            
            // Encriptar la clave usando crypt
            $hashedPassword = crypt($usu_clave, $salt);
            
            // ID del tipo de documento
            $tip_doc = $usu_tipo_documento;
            $rol_id = 2;
            $est_id = 1;  // Valor predeterminado (esto puede cambiar según tus necesidades)
            
            // Crear la consulta SQL
            $sql = "INSERT INTO usuarios
                    (tip_doc, usu_num_doc, usu_primer_nom, usu_segundo_nom, 
                     usu_primer_ape, usu_segundo_ape, usu_correo, usu_num_cel, usu_clave, 
                     rol_id, sex_id, est_id, usu_momento_creacion, usu_direccion) 
                    VALUES 
                    ('$tip_doc', '$usu_documento', '$usu_primer_nombre', '$usu_segundo_nombre', 
                     '$usu_primer_apellido', '$usu_segundo_apellido', '$usu_correo', '$usu_telefono', 
                     '$hashedPassword', $rol_id, $genero_id, $est_id, NOW(), '$usu_direccion')";
            
            // Ejecutar la consulta
            $ejecutar = $obj->insert($sql);
            
            // Verificar si la inserción fue exitosa
            if ($ejecutar) {
                redirect(getUrl("Administrador", "Administrador", "getUsuarios"));
            } else {
                echo "Se ha presentado un error al insertar";
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