
<!-- Ctrl+Shift+L para corregir varias lineas -->
<?php 
    $map = null;
    if(!extension_loaded('MapScript')){
        dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
    }
    if (isset($_FILES['carga']) && $_FILES['carga']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['carga']['name']; 
        if(pathinfo($fileName, PATHINFO_EXTENSION) !== 'map') {
            echo "Error: solo se permite cargar archivos .map";
            exit;
        }
        $map = ms_newMapObj($fileName); 
    }else{
        $map = ms_newMapObj("colombia.map");
    }
    if(isset($_POST["mapa_x"]) && isset($_POST["mapa_y"]) && !isset($_POST["full"]))
    {
        $extent_to_set = explode(" ",$_POST["extent"]);//explode coge los espacios & los convierte en vectore, captura la extent del mapa                            
        $map -> setextent($extent_to_set[0],$extent_to_set[1],$extent_to_set[2],$extent_to_set[3]);//valores de la extension del mapa

        $my_point = ms_newpointObj(); //instancia del objeto punto
        $my_point -> setXY($_POST["mapa_x"],$_POST["mapa_y"]); //se necesitan las posiciones x & y para llenar el punto

        $my_extent = ms_newrectObj();
        $my_extent -> setextent($extent_to_set[0],$extent_to_set[1],$extent_to_set[2],$extent_to_set[3]);

        $zoom_factor= $_POST["zoom"]*$_POST["zsize"]; //zoom de la imagen

        if($zoom_factor==0){

            $zoom_factor=1;
            $check_pan="CHECKED";//MOVER EL MAPA
            $check_zout="";//ALEJARSE DEL MAPA
            $check_zin="";//ACERCARSE AL MAPA

        }

        elseif($zoom_factor<0){
            $check_pan = "";
            $check_zout = "CHECKED";
            $check_zin = "";
        }

        else{
            $check_pan = "";
            $check_zout = "";
            $check_zin = "CHECKED";
        }

        $val_zsize=abs($zoom_factor); //abs= valor absoluto
        $map->zoompoint($zoom_factor,$my_point,$map->width,$map->height,$my_extent);
    }
    if ($map !== null) {
        $image = $map->draw();
        $image_url = $image->saveWebImage();
        $extent_to_html = $map->extent->minx . " " . $map->extent->miny . " " . $map->extent->maxx . " " . $map->extent->maxy;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>MAPA 4</title>
    <script>
        // Función que se ejecuta cuando el archivo es cargado
        function recargarMapa() {
            document.getElementById('formMapa').submit();  // Enviar el formulario para recargar el mapa
        }
    </script>
</head>
<body>
        <div class="card-header">
            <h3 class="card-title">Cargar y Navegar en el Mapa</h3>
        </div>
        <div class="card-body">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="formMapa">
                    <div class="mb-3">
                        <label for="carga" class="form-label">Selecciona un archivo .map</label>
                        <input type="file" id="carga" name="carga" class="form-control" onchange="recargarMapa()">
                    </div>

                    <div class="text-center mb-3">
                        <input type="IMAGE" name ="mapa" src="<?php echo $image_url?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pan</label>
                        <div>
                            <input type="radio" name="zoom" value="0" <?php echo $check_pan ?>> Pan
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Zoom In</label>
                        <div>
                            <input type="radio" name="zoom" value="1" <?php echo $check_zin ?>> Acercar
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Zoom Out</label>
                        <div>
                            <input type="radio" name="zoom" value="-1" <?php echo $check_zout ?>> Alejar
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="zsize" class="form-label">Tamaño del Zoom</label>
                        <input type="text" name="zsize" value="<?php echo $val_zsize ?>" class="form-control" size="2">
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" name="full" class="btn btn-primary">Ver Extensión Completa</button>
                    </div>

                    <input type="hidden" name="extent" value="<?php echo $extent_to_html ?>">
                </form>
            </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>