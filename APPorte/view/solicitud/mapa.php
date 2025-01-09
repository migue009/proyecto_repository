<?php 
if (!extension_loaded("MapScript")) {
    dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
}

$mapObject = ms_newMapObj("/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/cali.map");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $pt = ms_newPointObj();
    $pt->setXY($map_pt[0], $map_pt[1]);
}

$mapImage = $mapObject->draw();
$urlImage = $mapImage->saveWebImage();
?>
<div class="container mt-5">
    <h1>Seleccione las coordenadas</h1>
    <div id="map-container">
        <img src="<?php echo $urlImage; ?>" id="map-image" class="img-fluid" alt="Mapa">
    </div>

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
                    <form id="accidenteForm" method="POST" action="<?php echo getUrl('Solicitud','Solicitud', 'postCreateSolicitud'); ?>">
                        <input type="hidden" id="coord_x" name="coord_x">
                        <input type="hidden" id="coord_y" name="coord_y">
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombre del lugar</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
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