<?php
    include_once '../model/Usuarios/UsuariosModel.php';
    class UsuariosController{

//        public function test(){
//            echo "probando";
//        }

        public function getUpdate(){
            $obj = new UsuariosModel();

            $usu_id = $_GET['usu_id'];

            $sql = "SELECT * FROM usuario WHERE usu_id = $usu_id";
            $usuarios = $obj->consult($sql);

            $sql = "SELECT * FROM rol";
            $roles = $obj->consult($sql);
            
            $sql = "SELECT * FROM estado";
            $estado = $obj->consult($sql);

            include_once '../view/usuario/update.php';


        }

        public function postUpdate() {
            $obj = new UsuariosModel();
        
            $usu_id = $_POST['usu_id'];
            $usu_nombre = $_POST['usu_nombre'];
            $usu_apellido = $_POST['usu_apellido'];
            $usu_correo = $_POST['usu_correo'];
            $rol_id = $_POST['rol_id'];
            $estado_id = $_POST['estado_id'];

            $sql = "UPDATE usuario SET usu_nombre = '$usu_nombre', usu_apellido = '$usu_apellido', usu_id = '$usu_id', rol_id = '$rol_id' , estado_id = '$estado_id' WHERE usu_id = $usu_id";
            $ejecutar = $obj->update($sql);
        
            if ($ejecutar) {
                redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            } else {
                echo "Se ha presentado un error al actualizar";
            }
        }

        public function getDelete(){
            $obj = new UsuariosModel();

            $usu_id = $_GET['usu_id'];

            $sql = "SELECT * FROM usuario WHERE usu_id = $usu_id";
            $usuarios = $obj->consult($sql);

            include_once '../view/usuario/delete.php';

        }

        public function postDelete() {
            $obj = new UsuariosModel();
        
            $usu_id = $_POST['usu_id'];
        
            $sql = "DELETE FROM usuario WHERE usu_id = $usu_id";
            $ejecutar = $obj->update($sql);
        
            if ($ejecutar) {
                redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            } else {
                echo "Se ha presentado un error al eliminar";
            }
        }   

        public function buscar(){
            $obj = new UsuariosModel();

            $buscar= $_POST['buscar'];

            $sql = "SELECT u.*, r.rol_nombre, e.estado_nombre FROM usuario u, rol r, estado e WHERE u.rol_id = r.rol_id AND u.estado_id =e.estado_id AND (u.usu_nombre LIKE '%$buscar%' OR u.usu_apellido LIKE '%$buscar%' OR u.usu_correo LIKE '%$buscar%') ORDER BY u.usu_id ASC";

            $usuarios = $obj->consult($sql);

      
            include_once '../view/usuario/buscar.php';
        }

        public function postUpdateStatus(){
            $obj = new UsuariosModel();
            $estado_id= $_POST['id'];
            $usu_id= $_POST['user'];
            if($estado_id == 1){
                $statusToModify =2;
            }else if($estado_id == 2){
                $statusToModify =1;
            }
            $sql="UPDATE usuario SET estado_id = $statusToModify WHERE usu_id =$usu_id";
            
            $ejecutar = $obj->update($sql);

            if($ejecutar){
                $sql = "SELECT u.*, r.rol_nombre, e.estado_nombre FROM usuario u, rol r, estado e WHERE u.rol_id = r.rol_id AND u.estado_id =e.estado_id ORDER BY u.usu_id ASC";

                $usuarios = $obj->consult($sql);
                
                include_once '../view/usuario/buscar.php';
            }else{
                echo"No se pudo actualizar el estado";
            }
        }
    }
?>