<?php
    include_once '../model/Usuarios/UsuariosModel.php';
    class AdministradorController{
        // public function test(){
        //     echo "probando";
        // }
        public function getPerfil() {
            if (isset($_SESSION['id'])) {
                $usuario_id = $_SESSION['id'];
                
                $obj = new UsuariosModel();
                $sql = "SELECT u.*, d.* FROM usuarios u 
                        JOIN direccion d ON u.usu_direccion = d.direccion_id 
                        WHERE u.usuario_id = $usuario_id";
                
                $usuario = $obj->consult($sql);
                include_once '../view/usuario/perfil.php';
            } else {
                // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
                echo "Por favor, inicia sesión para ver tu perfil.";

            }
        }
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
            
            // Generar la sal usando mt_rand (generador de números aleatorios)
            $salt = '$2y$10$' . substr(md5(mt_rand()), 0, 22) . '$';  // Usando mt_rand() para generar la sal
            
            // Encriptar la clave usando crypt
            $hashedPassword = crypt($usu_clave, $salt);
            
            // ID del tipo de documento
            $tip_doc = $usu_tipo_documento;
            
            $est_id = 1;  // Valor predeterminado (esto puede cambiar según tus necesidades)
            
            // Paso 1: Insertar en la tabla direccion y obtener el direccion_id
            $sql_direccion = "INSERT INTO direccion (usu_carrera, usu_calle, usu_num_adicional, usu_complemento, usu_barrio) 
                              VALUES ('$carrera', '$calle', '$numero_adicional', '$complemento', '$barrio') RETURNING direccion_id";
            
            $direccion_id = $obj->insertUltimoId($sql_direccion); // Método que ejecuta la consulta y devuelve el último ID insertado.
            
            if ($direccion_id) {
                // Paso 2: Insertar en la tabla usuarios con el direccion_id
                $sql_usuario = "INSERT INTO usuarios
                                (tip_doc, usu_num_doc, usu_primer_nom, usu_segundo_nom, 
                                 usu_primer_ape, usu_segundo_ape, usu_correo, usu_num_cel, usu_clave, 
                                 rol_id, sex_id, est_id, usu_momento_creacion, usu_direccion) 
                                VALUES 
                                ('$tip_doc', '$usu_documento', '$usu_primer_nombre', '$usu_segundo_nombre', 
                                 '$usu_primer_apellido', '$usu_segundo_apellido', '$usu_correo', '$usu_telefono', 
                                 '$hashedPassword', $rol_id, $genero_id, $est_id, NOW(), $direccion_id)";
                
                // Ejecutar la consulta de inserción en la tabla usuarios
                $ejecutar = $obj->insert($sql_usuario);
                
                // Verificar si la inserción fue exitosa
                if ($ejecutar) {
                    redirect(getUrl("Administrador", "Administrador", "getUsuarios"));
                } else {
                    echo "Se ha presentado un error al insertar el usuario";
                }
            } else {
                echo "Se ha presentado un error al insertar la dirección";
            }
        }
        
        
        

        public function getUsuarios() {
            $obj = new UsuariosModel();
        
            // Consulta SQL actualizada para seleccionar todos los campos de la tabla usuarios y direccion
            $sql = "SELECT 
                        u.usuario_id, 
                        u.usu_num_doc,
                        u.usu_primer_nom,
                        u.usu_segundo_nom,
                        u.usu_primer_ape,
                        u.usu_segundo_ape,
                        u.usu_correo, 
                        u.usu_num_cel, 
                        u.usu_clave, 
                        u.est_id,
                        u.usu_momento_creacion,
                        r.rol_nombre, 
                        td.tip_doc_nombre, 
                        s.sexo_nombre,
                        e.est_nombre,
                        d.usu_carrera, 
                        d.usu_calle, 
                        d.usu_num_adicional, 
                        d.usu_complemento, 
                        d.usu_barrio
                    FROM 
                        usuarios u
                    JOIN roles r ON u.rol_id = r.rol_id      
                    JOIN tipos_documentos td ON u.tip_doc = td.tipo_documento_id
                    JOIN sexos s ON u.sex_id = s.sexo_id  
                    JOIN estados e ON u.est_id = e.estado_id
                    JOIN direccion d ON u.usu_direccion = d.direccion_id  -- Aquí unimos la tabla direccion
                    ORDER BY u.usuario_id ASC";
        
            // Ejecución de la consulta
            $usuarios = $obj->consult($sql);
        
            // Incluye la vista con los usuarios
            include_once '../view/usuario/consult.php';
        }
        
        public function getUpdateUsuarios(){
            $obj = new UsuariosModel();
                
            // Obtener el ID del usuario desde la URL
            $usu_id = $_GET['usu_id'];
            
            // Consulta para obtener los datos del usuario incluyendo la dirección
            $sql = "SELECT u.*, d.* FROM usuarios u JOIN direccion d ON u.usu_direccion = d.direccion_id   WHERE u.usuario_id = $usu_id";  
            
            // Ejecutar la consulta
            $usuario = $obj->consult($sql);
            // Obtener los estados
            $sqlEstados = "SELECT * FROM estados WHERE tip_est_id = 1";
            $estados = $obj->consult($sqlEstados);

            // Obtener los roles
            $sqlRoles = "SELECT * FROM roles";
            $roles = $obj->consult($sqlRoles);

            // Obtener los tipos de documentos
            $sqlTipoDocu = "SELECT * FROM tipos_documentos";
            $tipoDocu = $obj->consult($sqlTipoDocu);

            // Obtener los géneros
            $sqlSexo = "SELECT * FROM sexos";
            $genero = $obj->consult($sqlSexo);
            // Incluir la vista de actualización
            include_once '../view/usuario/update.php';
        }

        public function postUpdateUsuarios() {
            $obj = new UsuariosModel();
            // Obtener los datos del formulario
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
            $genero_id = $_POST['genero_id'];
            $estado_id = $_POST['estado_id'];

            // Concatenar dirección (si es necesario)
            $direccion_id = $_POST['direccion_id'];
            $carrera = $_POST['carrera'];
            $calle = $_POST['calle'];
            $numero_adicional = $_POST['numero_adicional'];
            $complemento = $_POST['complemento'];
            $barrio = $_POST['barrio'];
            
            if ($carrera || $calle || $numero_adicional || $complemento || $barrio) {
                // Si hay algún cambio en la dirección, actualizamos la tabla `direccion`
                $sql_direccion = "UPDATE direccion
                                  SET usu_carrera = '$carrera', usu_calle = '$calle', usu_num_adicional = '$numero_adicional',
                                      usu_complemento = '$complemento', usu_barrio = '$barrio'
                                  WHERE direccion_id = $direccion_id";  // Actualizamos la dirección
        
                $direccion_actualizada = $obj->update($sql_direccion);  // Ejecutamos la actualización
        
                if (!$direccion_actualizada) {
                    echo "Error al actualizar la dirección.";
                    return;
                }
            }
            // Generar la sal y encriptar la contraseña si es modificada
            $usu_clave = $_POST['usu_clave'];
            if (!empty($usu_clave)) {
                $salt = '$2y$10$' . substr(md5(mt_rand()), 0, 22) . '$';  // Usando mt_rand() para generar la sal
                $hashedPassword = crypt($usu_clave, $salt);  // Encriptar la clave
            } else {
                // Mantener la clave actual si no se ha cambiado
                $hashedPassword = $_POST['usu_clave_actual'];
            }
            
            // Consulta SQL para actualizar la información del usuario
            $sql = "UPDATE usuarios 
                    SET 
                        tip_doc = '$usu_tipo_documento',
                        usu_num_doc = '$usu_numero_documento',
                        usu_primer_nom = '$usu_primer_nombre',
                        usu_segundo_nom = '$usu_segundo_nombre',
                        usu_primer_ape = '$usu_primer_apellido',
                        usu_segundo_ape = '$usu_segundo_apellido',
                        usu_correo = '$usu_correo',
                        usu_num_cel = '$usu_telefono',
                        usu_clave = '$hashedPassword',
                        rol_id = $rol_id,
                        sex_id = $genero_id,
                        est_id = $estado_id,
                        usu_direccion = $direccion_id
                    WHERE usuario_id = $usu_id";  // Actualizamos el usuario según su ID
            
            // Ejecutar la consulta
            $ejecutar = $obj->update($sql);
        
            if ($ejecutar) {
                // Si la actualización fue exitosa, redirigir a la vista de usuarios
                redirect(getUrl("Administrador", "Administrador", "getUsuarios"));
            } else {
                echo "Se ha presentado un error al actualizar.";
            }
        }

        // public function getDelete(){
        //     $obj = new UsuariosModel();
        
        //     $usu_id = $_GET['usu_id'];
        //     $sql = "SELECT 
        //                 u.usu_id,
        //                 u.usu_numero_documento,
        //                 u.usu_primer_nombre,
        //                 u.usu_segundo_nombre,
        //                 u.usu_primer_apellido,
        //                 u.usu_segundo_apellido,
        //                 u.usu_correo,
        //                 u.usu_telefono,
        //                 u.usu_clave,
        //                 r.rol_nombre,              
        //                 td.tipo_doc_nombre,          
        //                 e.estado_nombre
        //             FROM 
        //                 usuario u
        //             JOIN rol r ON u.rol_id = r.rol_id      
        //             JOIN tipo_documento td ON u.usu_tipo_documento = td.tipo_doc_id
        //             JOIN estado e ON u.estado_id = e.estado_id
        //             WHERE u.usu_id = $usu_id";  // Filtramos por el ID del usuario
        
        //     $usuario = $obj->consult($sql);
        
        //     if ($usuario) {
        //         include_once '../view/usuario/delete.php';  // Vista para confirmar eliminación
        //     } else {
        //         echo "No se encontró el usuario con el ID proporcionado.";
        //     }
        // }

        // public function postDelete() {
        //     $obj = new UsuariosModel();
            
        //     $usu_id = $_POST['usu_id']; // Obtener el ID del usuario desde el formulario
            
        //     $sql = "DELETE FROM usuario WHERE usu_id = $usu_id"; // Consulta SQL para eliminar al usuario
        //     $ejecutar = $obj->update($sql); // Ejecutar la consulta
            
        //     if ($ejecutar) {
        //         redirect(getUrl("Administrador", "Administrador", "getUsuarios")); // Redirigir al listado de usuarios si la eliminación es exitosa
        //     } else {
        //         echo "Se ha presentado un error al eliminar"; // Mostrar error si algo falla
        //     }
        // } 

        public function buscar() {
            // Obtener el término de búsqueda
            $buscar = $_POST['buscar'];
            
            // Crear la instancia del modelo UsuariosModel
            $obj = new UsuariosModel();
            
            // Consulta SQL con todas las uniones y campos requeridos
            $sql = "SELECT 
                        u.*, 
                        r.rol_nombre, 
                        e.est_nombre,
                        td.tip_doc_nombre,
                        s.sexo_nombre,
                        d.usu_carrera, 
                        d.usu_calle, 
                        d.usu_num_adicional, 
                        d.usu_complemento, 
                        d.usu_barrio
                    FROM 
                        usuarios u
                    JOIN roles r ON u.rol_id = r.rol_id      
                    JOIN estados e ON u.est_id = e.estado_id
                    JOIN tipos_documentos td ON u.tip_doc = td.tipo_documento_id
                    JOIN sexos s ON u.sex_id = s.sexo_id
                    JOIN direccion d ON u.usu_direccion = d.direccion_id
                    WHERE 
                        u.usu_primer_nom LIKE '%$buscar%' 
                        OR u.usu_segundo_nom LIKE '%$buscar%'
                        OR u.usu_primer_ape LIKE '%$buscar%'
                        OR u.usu_segundo_ape LIKE '%$buscar%'
                        OR u.usu_correo LIKE '%$buscar%'
                    ORDER BY u.usuario_id ASC";
            
            // Ejecutar la consulta con el término de búsqueda
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