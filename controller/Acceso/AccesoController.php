<?php
    include_once '../model/Acceso/AccesoModel.php';
    include_once '../model/Usuarios/UsuariosModel.php';
    class AccesoController{
        // public function test(){
        //     alert("probando");
        // }
        public function login(){
            $obj = new UsuariosModel();
    
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
                            $_SESSION['nombre']=$usu['usu_nombre'];
                            $_SESSION['apellido']=$usu['usu_apellido'];
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