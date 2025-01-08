<?php 
if (!extension_loaded("MapScript")) {
    dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
}

$mapObject = ms_newMapObj("cali.map");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $map_pt = click2map($_POST['image_x'], $_POST['image_y']);
    
    $pt = ms_newPointObj();
    $pt->setXY($map_pt[0], $map_pt[1]);
}

$mapImage = $mapObject->draw();
$urlImage = $mapImage->saveWebImage();

function click2map($click_x, $click_y) {
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Interactivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Mapa Interactivo</h1>
        <div id="map-container">
            <img src="<?php echo $urlImage; ?>" id="map-image" class="img-fluid" alt="Mapa">
        </div>

        <!-- Modal -->
        <div class="modal fade" id="coordModal" tabindex="-1" aria-labelledby="coordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="coordModalLabel">Reporte de Accidente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Coordenadas en píxeles:</strong> <span id="pixelCoords"></span></p>
                        <p><strong>Coordenadas del mapa:</strong> <span id="mapCoords"></span></p>
                        <form id="accidenteForm" action="procesar.php" method="POST">
                            <input type="hidden" id="coord_x" name="coord_x">
                            <input type="hidden" id="coord_y" name="coord_y">
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="identificacion" class="form-label">Número de Identificación</label>
                                <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo_accidente" class="form-label">Tipo de Accidente</label>
                                <select class="form-select" id="tipo_accidente" name="tipo_accidente" required>
                                    <option value="">Seleccione el tipo de accidente</option>
                                    <option value="laboral">Laboral</option>
                                    <option value="transito">Tránsito</option>
                                    <option value="domestico">Doméstico</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('map-image').addEventListener('click', function(e) {
            var rect = e.target.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            
            // Actualizar el modal con las coordenadas
            document.getElementById('pixelCoords').textContent = x + ', ' + y;
            document.getElementById('coord_x').value = x;
            document.getElementById('coord_y').value = y;
            
            // Simular las coordenadas del mapa (esto debería ser calculado en el servidor)
            var mapX = (x / e.target.width) * 100; // Ejemplo simple
            var mapY = (y / e.target.height) * 100; // Ejemplo simple
            document.getElementById('mapCoords').textContent = mapX.toFixed(2) + ', ' + mapY.toFixed(2);
            
            // Abrir el modal
            var myModal = new bootstrap.Modal(document.getElementById('coordModal'));
            myModal.show();
        });
    </script>
</body>
</html>