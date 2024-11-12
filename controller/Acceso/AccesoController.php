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

            $sql = "SELECT * FROM usuario WHERE usu_correo ='$user'";
            $usuario = $obj ->consult($sql);


            if(mysqli_num_rows($usuario)>0){
                foreach($usuario as $usu){
                    if(password_verify($pass,$usu['usu_clave'])){
                        $_SESSION['nombre']=$usu['usu_nombre'];
                        $_SESSION['apellido']=$usu['usu_apellido'];
                        $_SESSION['correo']=$usu['usu_correo'];
                        $_SESSION['auth'] = "ok";

                        redirect("index.php");
                    
                    }else{
                        $_SESSION['error'] = "contrasenia incorrecta";
                        redirect('login.php');
                    }
                }
            }else{
                $_SESSION['error']="correo incorrecto";
                redirect("login.php");
            }
        }
        public function logout(){
            session_destroy();
            redirect("login.php");
        }
    }
?>