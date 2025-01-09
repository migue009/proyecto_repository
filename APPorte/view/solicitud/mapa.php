<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
      $db = new PostgresConnection();
      $connection = $db->getConnect();

      if (isset($_POST['nombres'], $_POST['coord_x'], $_POST['coord_y'])) {
          $nombres = pg_escape_string($connection, $_POST['nombres']);
          $coord_x = (float) $_POST['coord_x'];
          $coord_y = (float) $_POST['coord_y'];

          $query = "INSERT INTO lugares (nombre, geom) VALUES ('$nombres', ST_SetSRID(ST_GeomFromText('POINT($coord_x $coord_y)'), 4326))";

          $result = pg_query($connection, $query);

          if ($result) {
              echo "<div class='alert alert-success'>Datos guardados exitosamente.</div>";
          } else {
              echo "<div class='alert alert-danger'>Error al guardar los datos: " . "</div>";
          }
      }

      $db->close(); // Cerrar la conexión al finalizar.
  } catch (Exception $e) {
      echo "<div class='alert alert-danger'>Se produjo un error: " . $e->getMessage() . "</div>";
  }
}
if (!extension_loaded("MapScript")) {
    dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
}

$mapObject = ms_newMapObj("/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/cali.map");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_x']) && isset($_POST['image_y'])) {
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


    <div class="container map-container">
        <h1>Seleccione las coordenadas</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
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
                      <form id="accidenteForm" method="POST">
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

            // Mostrar las coordenadas en píxeles en el modal
            document.getElementById('pixelCoords').textContent = x + ', ' + y;
            document.getElementById('coord_x').value = x;
            document.getElementById('coord_y').value = y;

            // Aquí puedes hacer la conversión a coordenadas geográficas. 
            // Por ejemplo, si el mapa tiene un área de 100x100 unidades geográficas
            var mapX = (x / e.target.width) * 100; // Coordenada X en el mapa (en unidades geográficas)
            var mapY = (y / e.target.height) * 100; // Coordenada Y en el mapa (en unidades geográficas)
            
            // Mostrar las coordenadas geográficas en el modal
            document.getElementById('mapCoords').textContent = mapX.toFixed(2) + ', ' + mapY.toFixed(2);

            // Abrir el modal
            var myModal = new bootstrap.Modal(document.getElementById('coordModal'));
            myModal.show();
        });
    </script>