<?php

if (!extension_loaded("MapScript")) {
    dl('php_mapscript.' . PHP_SHLIB_SUFFIX);
}

$mapObject = ms_newMapObj("Cali.map");

// Cambié el uso de ?? por isset() y el operador ternario.
$map_pt = click2map(isset($_POST['image_x']) ? $_POST['image_x'] : 0, isset($_POST['image_y']) ? $_POST['image_y'] : 0);

// Creo los puntos
$pt = ms_newPointObj();
$pt->setXY($map_pt[0], $map_pt[1]);

$mapImage = $mapObject->draw();
// Creamos y capturamos la ruta de imagen renderizada
$urlImage = $mapImage->saveWebImage();

// Funcion click2map calcular las coordenadas
function click2map($click_x, $click_y)
{
    global $mapObject;
    $e = $mapObject->extent;
    $x_pct = ($click_x / $mapObject->width);
    $y_pct = 1 - ($click_y / $mapObject->height);
    $x_map = $e->minx + (($e->maxx - $e->minx) * $x_pct);
    $y_map = $e->miny + (($e->maxy - $e->miny) * $y_pct);

    return array($x_map, $y_map);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura Coordenadas</title>

    <style>
        /* Estilos del Modal */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto;
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <img src="<?php echo $urlImage; ?>" border="1" id="mapImage" style="cursor: pointer;"/>
    <!-- Modal para mostrar las coordenadas -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Coordenadas seleccionadas</h2>
            <p><strong>Coordenadas en píxeles:</strong> <span id="pixelCoords"></span></p>
            <p><strong>Coordenadas en el mapa:</strong> <span id="mapCoords"></span></p>
        </div>
    </div>

    <script>
        // Obtener elementos del DOM
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        var mapImage = document.getElementById("mapImage");

        // Función para calcular las coordenadas del clic
        mapImage.onclick = function(event) {
            var rect = mapImage.getBoundingClientRect();
            var clickX = event.clientX - rect.left;
            var clickY = event.clientY - rect.top;

            // Mostrar coordenadas en píxeles en el modal
            document.getElementById("pixelCoords").textContent = clickX + " , " + clickY;

            // Calcular las coordenadas del mapa
            var x_pct = clickX / mapImage.width;
            var y_pct = 1 - (clickY / mapImage.height);

            // Aquí defines los límites del mapa (puedes cambiar estos valores según tus necesidades)
            var mapMinX = <?php echo $mapObject->extent->minx; ?>;
            var mapMaxX = <?php echo $mapObject->extent->maxx; ?>;
            var mapMinY = <?php echo $mapObject->extent->miny; ?>;
            var mapMaxY = <?php echo $mapObject->extent->maxy; ?>;

            var mapX = mapMinX + ((mapMaxX - mapMinX) * x_pct);
            var mapY = mapMinY + ((mapMaxY - mapMinY) * y_pct);

            // Mostrar coordenadas en el mapa en el modal
            document.getElementById("mapCoords").textContent = mapX.toFixed(6) + " , " + mapY.toFixed(6);

            // Mostrar el modal
            modal.style.display = "block";
        }

        // Cuando el usuario haga clic en el botón de cerrar, ocultar el modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Si el usuario hace clic fuera del modal, también cerrarlo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
