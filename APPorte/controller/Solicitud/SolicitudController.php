<?php
    include_once '../model/Solicitud/SolicitudModel.php';
    class SolicitudController{
            // Método para cargar la vista con los tipos de solicitud
        public function getCreateSolicitud() {
            $obj = new SolicitudModel();

            $sqlSolicitudes = "SELECT * FROM tipos_reportes";
            $tiposSolicitud = $obj->consult($sqlSolicitudes);
                // Consultar las categorías
            $sqlCategorias = "SELECT * FROM categorias";
            $categorias = $obj->consult($sqlCategorias);

            // Consultar los tipos de señalización con su categoría correspondiente
            $sqlTiposSenalizaciones = "SELECT ts.tipo_senalizacion_id, ts.tip_snl_nombre, ts.tip_snl_descripcion, ts.cat_id, c.cat_nombre 
                                        FROM tipos_senalizaciones ts
                                        JOIN categorias c ON ts.cat_id = c.categoria_id
                                        ";
            $tiposSenalizaciones = $obj->consult($sqlTiposSenalizaciones);

            $sqlSenalizaciones = "SELECT s.senalizacion_id, s.snl_descripcion,s.tip_snl_id, ts.tip_snl_nombre, c.cat_nombre
                                    FROM senalizaciones s
                                    JOIN tipos_senalizaciones ts ON s.tip_snl_id = ts.tipo_senalizacion_id
                                    JOIN categorias c ON ts.cat_id = c.categoria_id
                                ";
            $senalizaciones = $obj->consult($sqlSenalizaciones);

             // Consultar los daños
             $sqlDanios = "SELECT * FROM danos";

            $danos = $obj->consult($sqlDanios);

            // Consultar los tipos de daños
            $sqlTiposDanio = "SELECT * FROM tipos_danos";
            $tiposDanio = $obj->consult($sqlTiposDanio);

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
