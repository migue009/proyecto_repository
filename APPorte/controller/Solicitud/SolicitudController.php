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
            try {
                if (isset($_POST['nombres'], $_POST['coord_x'], $_POST['coord_y'])) {
                    $nombres = $_POST['nombres'];  
                    $coord_x = $_POST['coord_x']; 
                    $coord_y = $_POST['coord_y']; 
        
                    $obj = new SolicitudModel();
        
                    // Paso 1: Insertar en la tabla de lugares y obtener el lugar_id
                    $sql_lugar = "INSERT INTO lugares (nombre, geom) 
                                  VALUES ('$nombres', ST_SetSRID(ST_GeomFromText('POINT($coord_x $coord_y)'), 4326))";
        
                    $lugar_id = $obj->insert($sql_lugar);
        
                    if ($lugar_id) {
                        $mensaje = "Datos del lugar guardados exitosamente.";
                    } else {
                        $mensaje = "Se ha presentado un error al guardar los datos del lugar.";
                    }
                } else {
                    $mensaje = "Error: Faltan datos en el formulario.";
                }
            } catch (Exception $e) {
                $mensaje = "Se produjo un error: " . $e->getMessage();
            }
        
            // Pasar mensaje a la vista
            include_once '../view/solicitud/create.php';
        }
    }
