<?php
    include_once '../model/Usuarios/UsuariosModel.php';
    class AdministradorController{
        public function test(){
            echo "probando";
        }
        public function getCreate(){
        /*El sistema debe permitir registrar usuarios ingresando un tipo de documento, un número de identificación, primer nombre, segundo nombre, primer apellido, segundo apellido, contraseña, correo electrónico, un número de teléfono celular, una dirección residencial.*/
            $obj = new UsuariosModel();

            $sql = "SELECT * FROM rol";

            $roles = $obj->consult($sql);
            
            include_once '../view/usuario/create.php';
            
        }

        public function postCreate() {
            $obj = new UsuariosModel();
        
            // Obtener datos del formulario
            $usu_nombre = $_POST['usu_nombre'];
            $usu_apellido = $_POST['usu_apellido'];
            $usu_correo = $_POST['usu_correo'];
            $usu_clave = $_POST['usu_clave'];
            $rol_id = $_POST['rol_id'];
            $usu_documento = $_POST['usu_documento'];
            $usu_tipo_documento = $_POST['usu_tipo_documento'];
        
            $validacion = true;
        
            // Validación de campos obligatorios
            if (empty($usu_nombre)) {
                $_SESSION['errores'][] = "El campo nombre es requerido";
                $validacion = false;
            }
            if (empty($usu_apellido)) {
                $_SESSION['errores'][] = "El campo apellido es requerido";
                $validacion = false;
            }
            if (empty($usu_correo)) {
                $_SESSION['errores'][] = "El campo correo es requerido";
                $validacion = false;
            }
            if (empty($usu_clave)) {
                $_SESSION['errores'][] = "El campo clave es requerido";
                $validacion = false;
            }
            if (empty($rol_id)) {
                $_SESSION['errores'][] = "El campo rol es requerido";
                $validacion = false;
            }
            if (empty($usu_documento)) {
                $_SESSION['errores'][] = "El campo documento es requerido";
                $validacion = false;
            }
            if (empty($usu_tipo_documento)) {
                $_SESSION['errores'][] = "El campo tipo de documento es requerido";
                $validacion = false;
            }
        
            // Validación de formatos
            if (validarCampoLetras($usu_nombre) == false) {
                $_SESSION['errores'][] = "El campo nombre debe contener solo letras";
                $validacion = false;
            }
            if (validarCampoLetras($usu_apellido) == false) {
                $_SESSION['errores'][] = "El campo apellido debe contener solo letras";
                $validacion = false;
            }
            if (validarCorreo($usu_correo) == false) {
                $_SESSION['errores'][] = "El campo correo debe contener letras o números y @ y un dominio válido (Ej: gmail.com)";
                $validacion = false;
            }
            if (validarClave($usu_clave) == false) {
                $_SESSION['errores'][] = "El campo clave debe contener al menos una mayúscula, una minúscula, un número, un símbolo y debe tener más de 8 caracteres";
                $validacion = false;
            }
            if (validarCampoNumeros($usu_documento) == false) {
                $_SESSION['errores'][] = "El documento debe contener solo números";
                $validacion = false;
            }
        
            // Si pasa la validación
            if ($validacion) {
                // Encriptar la contraseña
                $hashedPassword = password_hash($usu_clave, PASSWORD_DEFAULT);
        
                // Obtener ID automáticamente
                $id = $obj->autoIncrement("usu_id", "usuario");
        
                // Insertar en la base de datos
                $sql = "INSERT INTO usuario (usu_id, usu_nombre, usu_apellido, usu_documento, usu_tipo_documento, usu_correo, usu_clave, rol_id, usu_estado) 
                        VALUES ($id, '$usu_nombre', '$usu_apellido', '$usu_documento', '$usu_tipo_documento', '$usu_correo', '$hashedPassword', $rol_id, 1)";
        
                $ejecutar = $obj->insert($sql);
        
                // Verificar si la inserción fue exitosa
                if ($ejecutar) {
                    redirect(getUrl("Administrador", "Administrador", "getUsuarios"));
                } else {
                    echo "Se ha presentado un error al insertar";
                }
            } else {
                redirect(getUrl("Administrador", "Administrador", "getCreate"));
            }
        }
        

        public function getUsuarios(){
            $obj = new UsuariosModel();

            $sql = "SELECT u.*, r.rol_nombre, e.estado_nombre FROM usuario u, rol r, estado e WHERE u.rol_id = r.rol_id AND u.estado_id = e.estado_id ORDER BY u.usu_id ASC";

            $usuarios = $obj->consult($sql);

            include_once '../view/usuario/consult.php';
        }
        
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