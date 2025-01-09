<?php
    include_once '../model/Solicitud/SolicitudModel.php';
    class SolicitudController{
            // Método para cargar la vista con los tipos de solicitud
        public function getCreateSolicitud() {
            $obj = new SolicitudModel();

            $sqlSolicitudes = "SELECT * FROM tipos_reportes";
            $tiposSolicitud = $obj->consult($sqlSolicitudes);
            
            include_once '../view/solicitud/create.php';
        }

            // Método para procesar el formulario de solicitud
        public function postCreateSolicitud() {
            // Obtener los datos enviados desde el formulario
            $tipo_solicitud = $_POST['tipo_solicitud'];
            $escenario = $_POST['escenario'];
            // Otros campos del formulario dependiendo del tipo de solicitud

            // Validación básica (ajustar según sea necesario)
            if (!$tipo_solicitud || !$escenario) {
                echo "Faltan campos requeridos.";
                return;
            }

            // Dependiendo del tipo de solicitud, realiza diferentes acciones.
            if ($tipo_solicitud == '1') {  // Registro de accidentes
                // Procesar los datos del registro de accidentes
                $lugar_accidente = $_POST['lugar_accidente'];
                $fecha_accidente = $_POST['fecha_accidente'];
                $gravedad_accidente = $_POST['gravedad_accidente'];
                // Otros campos...

                // Insertar los datos en la base de datos
                $sql_accidente = "INSERT INTO registros_accidentes (lugar, fecha, gravedad, tipo_solicitud) 
                                    VALUES ('$lugar_accidente', '$fecha_accidente', '$gravedad_accidente', '$tipo_solicitud')";
                $ejecutar = Database::query($sql_accidente);

                if ($ejecutar) {
                    echo "Solicitud de accidente registrada con éxito";
                    // Redirigir a la lista de solicitudes o a alguna otra página
                } else {
                    echo "Error al registrar el accidente";
                }
            } 
            else if ($tipo_solicitud == '2') {  // Señalización vial en mal estado
                // Procesar los datos de señalización vial
                $tipo_senal = $_POST['tipo_senal'];
                $descripcion_senal = $_POST['descripcion_senal'];
                // Otros campos...

                // Insertar en la base de datos
                $sql_senal = "INSERT INTO senalizacion_vial (tipo_senal, descripcion, tipo_solicitud) 
                                VALUES ('$tipo_senal', '$descripcion_senal', '$tipo_solicitud')";
                $ejecutar = Database::query($sql_senal);

                if ($ejecutar) {
                    echo "Solicitud de señalización registrada con éxito";
                    // Redirigir a la lista de solicitudes o a alguna otra página
                } else {
                    echo "Error al registrar la señalización";
                }
            }
            // Puedes agregar más tipos de solicitud según sea necesario
        }
    }
