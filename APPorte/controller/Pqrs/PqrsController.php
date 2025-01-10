<?php
    include_once '../model/Pqrs/PqrsModel.php';
    
    class PqrsController{
        
        // Función para mostrar el formulario de creación de PQRS
        public function getCreate(){
            if (isset($_SESSION['id'])) {
                $usuario_id = $_SESSION['id'];
                
                $obj = new PqrsModel();
                $sql = "SELECT u.*, d.* FROM usuarios u 
                        JOIN direccion d ON u.usu_direccion = d.direccion_id 
                        WHERE u.usuario_id = $usuario_id";
                
                $usuario = $obj->consult($sql);

                $sql_tipo_pqrs = "SELECT * FROM tipos_pqrs";
                $tipos_pqrs = $obj->consult($sql_tipo_pqrs);

                include_once '../view/pqrs/create.php';
            } else {
                // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
                echo "Por favor, inicia sesión para ver tu perfil.";
            }
        }

        // Función para manejar la creación de una nueva PQRS
        public function postCreate() {
            $obj = new PqrsModel();
            
            // Obtener datos del formulario
            $pqrs_tipo = $_POST['tipo_solicitud'];  // Tipo de PQRS (Petición, Queja, Reclamo, Sugerencia)
            $pqrs_mensaje = $_POST['pqrs_mensaje'];  // Descripción de la PQRS
            $usu_id = $_SESSION['id'];  // ID del usuario que está enviando la PQRS
            $estado_id = 8;  // Estado "No leído" por defecto
            
            // Insertar la PQRS en la base de datos
            $sql = "INSERT INTO pqrs (tip_pqrs_id, fecha_pqrs, usu_id, pqrs_mensaje, estado_id)
            VALUES ('$pqrs_tipo', NOW(), '$usu_id', '$pqrs_mensaje', $estado_id)";
            
            $ejecutar = $obj->insert($sql); // Ejecutar la consulta
            if ($ejecutar) {
                // Redirigir al usuario a la vista de consulta de PQRS
                redirect(getUrl("Pqrs", "Pqrs", "getCreate"));
            } else {
                echo "Se ha presentado un error al crear la PQRS.";
            }
        }

        // Función para mostrar todas las PQRS
        public function getConsult() {
            $obj = new PqrsModel();
            $sql = "SELECT p.*, u.usu_primer_nom, u.usu_segundo_nom, u.usu_primer_ape, u.usu_segundo_ape, tp.tip_pqrs_nombre, e.est_nombre
                    FROM pqrs p
                    JOIN usuarios u ON p.usu_id = u.usuario_id
                    JOIN tipos_pqrs tp ON p.tip_pqrs_id = tp.tipo_pqrs_id
                    JOIN estados e ON p.estado_id = e.estado_id
                    ORDER BY p.pqrs_id DESC";

            $pqrs = $obj->consult($sql); // Ejecutar la consulta
            
            // Incluir la vista con la lista de PQRS (ya sea con búsqueda o no)
            include_once '../view/pqrs/consult.php';
        }

        // Función para mostrar el formulario de actualización de una PQRS
        public function getUpdate() {
            $obj = new PqrsModel();
            
            // Obtener el ID de la PQRS desde la URL
            $pqrs_id = $_GET['pqrs_id'];
            
            // Consulta para obtener los detalles de la PQRS
            $sql = "SELECT * FROM pqrs WHERE pqrs_id = $pqrs_id";
            
            // Ejecutar la consulta
            $pqrs = $obj->consult($sql);

            // Incluir la vista de actualización
            include_once '../view/pqrs/update.php';
        }

        // Función para actualizar una PQRS
        public function postUpdate() {
            $obj = new PqrsModel();
            
            // Obtener los datos del formulario
            $pqrs_id = $_POST['pqrs_id'];
            $pqrs_tipo = $_POST['pqrs_tipo'];
            $pqrs_mensaje = $_POST['pqrs_mensaje'];
            
            // Consulta SQL para actualizar la PQRS
            $sql = "UPDATE pqrs 
                    SET tip_pqrs_id = '$pqrs_tipo', pqrs_mensaje = '$pqrs_mensaje'
                    WHERE pqrs_id = $pqrs_id";

            // Ejecutar la consulta
            $ejecutar = $obj->update($sql);

            // Verificar si la actualización fue exitosa
            if ($ejecutar) {
                redirect(getUrl("Pqrs", "Pqrs", "getConsult")); // Redirigir a la lista de PQRS
            } else {
                echo "Se ha presentado un error al actualizar la PQRS.";
            }
        }
        public function postUpdateStatus() {
            $obj = new PqrsModel();
            
            $estado_id = $_POST['id'];  // Estado actual de la PQRS (Leído/No leído)
            $pqrs_id = $_POST['pqrs_id'];  // ID de la PQRS que vamos a actualizar
            
            // Alternar entre "Leído" (estado_id 9) y "No leído" (estado_id 8)
            if ($estado_id == 8) {
                $statusToModify = 9; // Cambiar a "Leído"
            } else if ($estado_id == 9) {
                $statusToModify = 8; // Cambiar a "No leído"
            }
        
            // Actualizar el estado en la base de datos
            $sql = "UPDATE pqrs SET estado_id = $statusToModify WHERE pqrs_id = $pqrs_id";
            $ejecutar = $obj->update($sql);
        
            if ($ejecutar) {
                // Si la actualización es exitosa, obtener la lista actualizada de PQRS
                $sql = "SELECT p.*, u.usu_primer_nom, u.usu_segundo_nom, u.usu_primer_ape, u.usu_segundo_ape, tp.tip_pqrs_nombre, e.est_nombre
                        FROM pqrs p
                        JOIN usuarios u ON p.usu_id = u.usuario_id
                        JOIN tipos_pqrs tp ON p.tip_pqrs_id = tp.tipo_pqrs_id
                        JOIN estados e ON p.estado_id = e.estado_id
                        ORDER BY p.pqrs_id DESC";
        
                $pqrs = $obj->consult($sql);
        
                include_once '../view/pqrs/buscar.php';
            } else {
                echo "No se pudo actualizar el estado de la PQRS.";
            }
        }

        public function buscar() {
            $obj = new PqrsModel();
            $buscar= $_POST['buscar'];
        
            // Consulta SQL para obtener PQRS basadas en el tipo o el nombre del usuario
            $sql = "SELECT p.*, u.usu_primer_nom, u.usu_segundo_nom, u.usu_primer_ape, u.usu_segundo_ape, tp.tip_pqrs_nombre, e.est_nombre
                    FROM pqrs p
                    JOIN usuarios u ON p.usu_id = u.usuario_id
                    JOIN tipos_pqrs tp ON p.tip_pqrs_id = tp.tipo_pqrs_id
                    JOIN estados e ON p.estado_id = e.estado_id
                    WHERE tp.tip_pqrs_nombre LIKE '%$buscar%'  OR (p.pqrs_mensaje LIKE '%$buscar%' 
                    OR (u.usu_primer_nom LIKE '%$buscar%' OR u.usu_segundo_nom LIKE '%$buscar%'))
                    ORDER BY p.pqrs_id DESC";
        
            $pqrs = $obj->consult($sql); // Ejecutar la consulta y obtener las PQRS que coinciden con la búsqueda.
        
            // Incluir la vista con los resultados de la búsqueda
            include_once '../view/pqrs/buscar.php'; // Asegúrate de que este archivo sea el correcto.
        }
    }
?>
