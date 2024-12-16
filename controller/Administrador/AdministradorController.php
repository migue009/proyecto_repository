<?php
    include_once '../model/Usuarios/UsuariosModel.php';
    class AdministradorController{
        // public function test(){
        //     echo "probando";
        // }
        public function getCreate(){
        /*El sistema debe permitir registrar usuarios ingresando un tipo de documento, un número de identificación, primer nombre, segundo nombre, primer apellido, segundo apellido, contraseña, correo electrónico, un número de teléfono celular, una dirección residencial.*/
            $obj = new UsuariosModel();

            $sqlRoles = "SELECT * FROM roles";
            $roles = $obj->consult($sqlRoles);
            
            $sqlTipoDocu = "SELECT * FROM tipos_documentos";
            $tipoDocu = $obj->consult($sqlTipoDocu);
            
            $sqlSexo = "SELECT * FROM sexos";
            $genero = $obj->consult($sqlSexo);
            include_once '../view/usuario/create.php';
            
        }

        public function postCreate() {
            $obj = new UsuariosModel();
            
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
            $rol_id = $_POST['rol_id'];
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
        
        
        

        public function getUsuarios(){
            $obj = new UsuariosModel();

            $sql = "SELECT 
                        u.usu_id,
                        u.usu_numero_documento,
                        u.usu_primer_nombre,
                        u.usu_segundo_nombre,
                        u.usu_primer_apellido,
                        u.usu_segundo_apellido,
                        u.usu_correo,
                        u.usu_telefono,
                        u.usu_clave,
                        r.rol_nombre,              
                        td.tipo_doc_nombre,          
                        u.estado_id
                    FROM 
                        usuario u
                    JOIN rol r ON u.rol_id = r.rol_id      
                    JOIN tipo_documento td ON u.usu_tipo_documento = td.tipo_doc_id 
                    ORDER BY u.usu_id ASC";

            $usuarios = $obj->consult($sql);
            if ($usuarios === false) {
                // Error en la consulta
                echo "Hubo un problema con la consulta SQL.";
            }
            include_once '../view/usuario/consult.php';
        }
        
        public function getUpdate(){
            $obj = new UsuariosModel();
            
            $usu_id = $_GET['usu_id'];
        
            $sql = "SELECT * FROM usuario WHERE usu_id = $usu_id";
            $usuario = $obj->consult($sql);
            
            $sqlRoles = "SELECT * FROM rol";
            $roles = $obj->consult($sqlRoles);
            
            $sqlEstado = "SELECT * FROM estado";
            $estado = $obj->consult($sqlEstado);
        
            $sqlTipoDocu = "SELECT * FROM tipo_documento";
            $tipoDocu = $obj->consult($sqlTipoDocu);
        
            include_once '../view/usuario/update.php';
        }

        public function postUpdate() {
            $obj = new UsuariosModel();
        
            $usu_id = $_POST['usu_id'];
            $usu_tipo_documento = $_POST['usu_tipo_documento'];
            $usu_numero_documento = $_POST['usu_numero_documento'];
            $usu_primer_nombre = $_POST['usu_primer_nombre'];
            $usu_segundo_nombre = $_POST['usu_segundo_nombre'];
            $usu_primer_apellido = $_POST['usu_primer_apellido'];
            $usu_segundo_apellido = $_POST['usu_segundo_apellido'];
            $usu_correo = $_POST['usu_correo'];
            $usu_telefono = $_POST['usu_telefono'];
            $rol_id = $_POST['rol_id'];
            $estado_id = $_POST['estado_id'];
        
            $sql = "UPDATE usuario 
                    SET 
                        usu_tipo_documento = '$usu_tipo_documento',
                        usu_numero_documento = '$usu_numero_documento',
                        usu_primer_nombre = '$usu_primer_nombre',
                        usu_segundo_nombre = '$usu_segundo_nombre',
                        usu_primer_apellido = '$usu_primer_apellido',
                        usu_segundo_apellido = '$usu_segundo_apellido',
                        usu_correo = '$usu_correo',
                        usu_telefono = '$usu_telefono',
                        rol_id = '$rol_id',
                        estado_id = '$estado_id'
                    WHERE usu_id = $usu_id";
        
            $ejecutar = $obj->update($sql);
        
            if ($ejecutar) {
                redirect(getUrl("Administrador", "Administrador", "getUsuarios"));
            } else {
                echo "Se ha presentado un error al actualizar.";
            }
        }

        public function getDelete(){
            $obj = new UsuariosModel();
        
            $usu_id = $_GET['usu_id'];
            $sql = "SELECT 
                        u.usu_id,
                        u.usu_numero_documento,
                        u.usu_primer_nombre,
                        u.usu_segundo_nombre,
                        u.usu_primer_apellido,
                        u.usu_segundo_apellido,
                        u.usu_correo,
                        u.usu_telefono,
                        u.usu_clave,
                        r.rol_nombre,              
                        td.tipo_doc_nombre,          
                        e.estado_nombre
                    FROM 
                        usuario u
                    JOIN rol r ON u.rol_id = r.rol_id      
                    JOIN tipo_documento td ON u.usu_tipo_documento = td.tipo_doc_id
                    JOIN estado e ON u.estado_id = e.estado_id
                    WHERE u.usu_id = $usu_id";  // Filtramos por el ID del usuario
        
            $usuario = $obj->consult($sql);
        
            if ($usuario) {
                include_once '../view/usuario/delete.php';  // Vista para confirmar eliminación
            } else {
                echo "No se encontró el usuario con el ID proporcionado.";
            }
        }

        public function postDelete() {
            $obj = new UsuariosModel();
            
            $usu_id = $_POST['usu_id']; // Obtener el ID del usuario desde el formulario
            
            $sql = "DELETE FROM usuario WHERE usu_id = $usu_id"; // Consulta SQL para eliminar al usuario
            $ejecutar = $obj->update($sql); // Ejecutar la consulta
            
            if ($ejecutar) {
                redirect(getUrl("Administrador", "Administrador", "getUsuarios")); // Redirigir al listado de usuarios si la eliminación es exitosa
            } else {
                echo "Se ha presentado un error al eliminar"; // Mostrar error si algo falla
            }
        } 

        public function buscar(){
            $obj = new UsuariosModel();
            $buscar = $_POST['buscar'];
            $sql = "SELECT 
                        u.usu_id,
                        u.usu_numero_documento,
                        u.usu_primer_nombre,
                        u.usu_segundo_nombre,
                        u.usu_primer_apellido,
                        u.usu_segundo_apellido,
                        u.usu_correo,
                        u.usu_telefono,
                        u.usu_clave,
                        r.rol_nombre,              
                        td.tipo_doc_nombre,          
                        u.estado_id
                    FROM 
                        usuario u
                    JOIN rol r ON u.rol_id = r.rol_id      
                    JOIN tipo_documento td ON u.usu_tipo_documento = td.tipo_doc_id 
                    WHERE 
                        u.usu_primer_nombre LIKE '%$buscar%' 
                        OR u.usu_segundo_nombre LIKE '%$buscar%' 
                        OR u.usu_primer_apellido LIKE '%$buscar%' 
                        OR u.usu_segundo_apellido LIKE '%$buscar%' 
                        OR u.usu_correo LIKE '%$buscar%' 
                        OR u.usu_numero_documento LIKE '%$buscar%' 
                    ORDER BY u.usu_id ASC";
        
            $usuarios = $obj->consult($sql);
            
            if ($usuarios === false) {
                // Error en la consulta
                echo "Hubo un problema con la consulta SQL.";
            }     
            // }else {
            //     // Mostrar los resultados de la consulta (esto es solo para depuración)
            //     echo "<pre>";
            //     var_dump($usuarios);  // Mostrar el contenido de los usuarios
            //     echo "</pre>";
            // }
            // Retornar solo el contenido de la tabla
            if ($usuarios !== false && !empty($usuarios)) {
                include_once '../view/usuario/buscar.php';
            } else {
                echo "No se encontraron usuarios con ese término de búsqueda.";
            }
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