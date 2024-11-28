<?php
    include_once '../model/Acceso/AccesoModel.php';
    class AccesoController{
        // public function test(){
        //     alert("probando");
        // }
        public function getRegistrar(){
            $obj = new AccesoModel();
        
            // Consulta para obtener los tipos de documento
            $sqlTipoDocu = "SELECT * FROM tipo_documento";
            $tipoDocu = $obj->consult($sqlTipoDocu);
        
            // Aquí se pasa la variable $tipoDocu a la vista
            include_once '../view/usuario/registrar.php';
        }
        public function registrar(){
            $obj = new AccesoModel();
        
            // Obtener los datos del formulario
            $usu_tipo_documento = $_POST['usu_tipo_documento'];
            $usu_documento = $_POST['usu_documento'];  // 'usu_documento' debe coincidir con el nombre del campo del formulario.
            $usu_primer_nombre = $_POST['usu_primer_nombre'];
            $usu_segundo_nombre = $_POST['usu_segundo_nombre'];
            $usu_primer_apellido = $_POST['usu_primer_apellido'];
            $usu_segundo_apellido = $_POST['usu_segundo_apellido'];
            $usu_correo = $_POST['usu_correo'];
            $usu_telefono = $_POST['usu_telefono'];
            $usu_clave = $_POST['usu_clave'];
            $confirmar_clave = $_POST['confirmar_clave'];
            $rol_id = 2;  // Asignamos el rol por defecto, por ejemplo, rol_id 2 para usuario regular
            $estado_id = 1;  // Estado activo (1 significa activo en la base de datos)
            
            // Si no hay errores, encriptamos la contraseña
            $hashedPassword = password_hash($usu_clave, PASSWORD_DEFAULT);
        
            // Generamos el ID automáticamente
            $id = $obj->autoIncrement("usu_id", "usuario");
        
            // Realizamos la consulta SQL para insertar los datos
            $sql = "INSERT INTO usuario (
                        usu_id, 
                        usu_tipo_documento, 
                        usu_numero_documento, 
                        usu_primer_nombre, 
                        usu_segundo_nombre, 
                        usu_primer_apellido, 
                        usu_segundo_apellido, 
                        usu_correo, 
                        usu_telefono, 
                        usu_clave, 
                        rol_id, 
                        estado_id
                    ) VALUES (
                        $id, 
                        '$usu_tipo_documento', 
                        '$usu_documento', 
                        '$usu_primer_nombre', 
                        '$usu_segundo_nombre', 
                        '$usu_primer_apellido', 
                        '$usu_segundo_apellido', 
                        '$usu_correo', 
                        '$usu_telefono', 
                        '$hashedPassword', 
                        $rol_id, 
                        $estado_id
                    )";
        
            // Ejecutamos la consulta
            $ejecutar = $obj->insert($sql);
        
            // Verificamos si la inserción fue exitosa
            if ($ejecutar) {
                redirect('login.php');
            } else {
                echo "Se ha presentado un error al insertar los datos.";
            }
        }
        
        public function login(){
            $obj = new AccesoModel();
    
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            
            $errors = [];
    
            if (empty($user)) {
                $errors['user'] = "El correo es obligatorio.";
            }
    
            if (empty($pass)) {
                $errors['pass'] = "La contraseña es obligatoria.";
            }
    
            if (empty($errors)) {
                $sql = "SELECT * FROM usuario WHERE usu_correo = '$user'";
                $usuario = $obj->consult($sql);
    
                if (mysqli_num_rows($usuario) > 0) {
                    foreach ($usuario as $usu) {
                        if(password_verify($pass,$usu['usu_clave'])){
                            $_SESSION['nombre']=$usu['usu_primer_nombre'];
                            $_SESSION['apellido']=$usu['usu_primer_apellido'];
                            $_SESSION['correo']=$usu['usu_correo'];
                            $_SESSION['auth'] = "ok";
    
                            redirect("index.php"); // Redirige al dashboard
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