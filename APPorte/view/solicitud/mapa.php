
<div class="container">
    <label for="tipo_reporte" class="form-label">Tipo de reporte</label>
    <select class="form-select" id="tipo_reporte" name="tipo_reporte" required onchange="toggleMapAndForm()">
        <option value="">Seleccione el tipo de reporte</option>
        <?php 
          foreach ($tiposSolicitud as $tipo) {
            echo '<option value="' . $tipo['tipo_reporte_id'] . '">' . $tipo['tp_rep_nombre'] . '</option>';
          }
        ?>
    </select>
</div>

<div class="container map-container" id="mapContainer" style="display: none;">
    <h3 class="text-center main-title">Elige la dirección del reporte!</h3>
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
            <div class="mscross" style="overflow: hidden; width: 500px; height: 600px; -moz-user-select: none; position:relative;" id="dc_main"></div>
        </div>
        <div class="col-12 col-md-1">
            <div id="Layer2">
                <form name="select_layers">
                    <p align="left">
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="Poligonos">
                        <strong>Colombia</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[1]" value="Cali">
                        <strong>Cali</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[2]" value="Comunas">
                        <strong>Comunas</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[3]" value="Barrios">
                        <strong>Barrios</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[4]" value="Vias">
                        <strong>Vias</strong>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="coordModal" tabindex="-1" aria-labelledby="coordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coordModalLabel">Coordenadas del Mapa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Coordenadas reales:</strong> <span id="mapCoords"></span></p>
                <form id="coordForm" method="POST" action="<?php echo getUrl('Solicitud', 'Solicitud', 'postCreateSolicitud'); ?>">
                    <input type="hidden" id="coord_x" name="coord_x">
                    <input type="hidden" id="coord_y" name="coord_y">
                    <div id="dynamicFormFields"></div>
                    <button type="submit" class="btn btn-primary">Enviar Reporte</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  myMap1 = new msMap(document.getElementById("dc_main"),'standardRight');
  myMap1.setCgi('/cgi-bin/mapserv.exe');
  myMap1.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/cali.map');
  myMap1.setFullExtent(-76.51 , -76.48  , 3.41);
  myMap1.setLayers('Poligonos Cali Comunas Barrios Vias');

  var infola = new msTool('crear punto', infolay, '../mapa/misc/img/marker-gold.png', investiguen);
  myMap1.getToolbar(0).addMapTool(infola);
  myMap1.redraw(); 

  function chgLayers() {
      var list = "Layers ";
      var objForm = document.forms[0];
      for(i = 0; i < document.forms[0].length; i++) {
          if (objForm.elements["layer[" + i + "]"].checked) {
              list = list + objForm.elements["layer[" + i + "]"].value + " ";
          }
      }
      myMap1.setLayers(list);
      myMap1.redraw();
  }

  var seleccionado = false;
  function infolay(e, map) {
      map.getTagMap().style.cursor = "crosshair";
      seleccionado = true;
  }

  function objectoAjax() {
      var xmlhttp = false;
      try {
          xmlhttp = new ActiveXObject("Msxm2.XMLHttpRequest");
      } catch (e) {
          try {
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (E) {
              xmlhttp = false;
          }
      }
      if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
          xmlhttp = new XMLHttpRequest();
          return xmlhttp;
      }
  }

  function investiguen(event, map, x, y, xx, yy) {
    if (seleccionado) {
      document.getElementById('mapCoords').textContent = xx.toFixed(2) + ', ' + yy.toFixed(2);
      document.getElementById('coord_x').value = xx.toFixed(2);
      document.getElementById('coord_y').value = yy.toFixed(2);
      var myModal = new bootstrap.Modal(document.getElementById('coordModal'));
      myModal.show();
      seleccionado = false;
      map.getTagMap().style.cursor = "default";
    }
  }

  function toggleMapAndForm() {
      const tipoReporte = document.getElementById('tipo_reporte').value;
      const mapContainer = document.getElementById('mapContainer');
      const dynamicFormFields = document.getElementById('dynamicFormFields');
      const coordModalLabel = document.getElementById('coordModalLabel');

      if (tipoReporte === '') {
          mapContainer.style.display = 'none';
      } else {
          mapContainer.style.display = 'block'; 
          updateFormFields(tipoReporte); 
      }
  }

  function updateFormFields(tipoReporte) {
    const dynamicFormFields = document.getElementById('dynamicFormFields');
    let formHtml = '';

    if (tipoReporte == '1') {  // Registro de accidente
      formHtml = `
        <div class="mb-3">
          <label for="gravedad" class="form-label">Gravedad</label>
          <select class="form-select" id="gravedad" name="gravedad" required>
            <option value="">Seleccione gravedad</option>
            <option value="con_muertos">Con muertos</option>
            <option value="con_heridos">Con heridos</option>
            <option value="solo_danos">Solo daños</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="lugar" class="form-label">Lugar del accidente</label>
          <input type="text" class="form-control" id="lugar" name="lugar" required>
        </div>
        <div class="mb-3">
          <label for="fecha_accidente" class="form-label">Fecha y hora del accidente</label>
          <input type="datetime-local" class="form-control" id="fecha_accidente" name="fecha_accidente" required>
        </div>
        <div class="mb-3">
          <label for="clase_accidente" class="form-label">Clase de accidente</label>
          <select class="form-select" id="clase_accidente" name="clase_accidente" required>
            <option value="">Seleccione clase de accidente</option>
            <option value="choque">Choque</option>
            <option value="atropello">Atropello</option>
            <option value="volcamiento">Volcamiento</option>
            <option value="caida_ocupante">Caída ocupante</option>
            <option value="incendio">Incendio</option>
            <option value="otro">Otro</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="caracteristicas_lugar" class="form-label">Características del lugar</label>
          <textarea class="form-control" id="caracteristicas_lugar" name="caracteristicas_lugar" rows="3" required></textarea>
        </div>
      `;
      document.getElementById('coordModalLabel').innerText = 'Registro de Accidente';
    }
    else if (tipoReporte == '2') {  // Señalización vial en mal estado
      formHtml = `
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select class="form-select" id="categoria" name="categoria" required onchange="updateTiposSenales()">
                <option value="">Seleccione categoría</option>
                <?php 
                  foreach ($categorias as $categoria) {
                      echo '<option value="' . $categoria['categoria_id'] . '">' . $categoria['cat_nombre'] . '</option>';
                  }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_senal" class="form-label">Tipo de señal</label>
            <select class="form-select" id="tipo_senal" name="tipo_senal" required onchange="mostrarSenales()">
                <option value="">Seleccione tipo de señal</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="senalizacion" class="form-label">Señales disponibles</label>
            <select class="form-select" id="senalizacion" name="senalizacion" required>
                <option value="">Seleccione una señal</option>
                <!-- Opciones se añadirán dinámicamente -->
            </select>
        </div>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required> Describe brevemente la señal</textarea>
        </div>
        <div class="mb-3">
          <label for="tipo_dano" class="form-label">Tipo de daño</label>
          <select class="form-select" id="tipo_dano" name="tipo_dano" required>
            <option value="">Seleccione tipo de daño</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección para ubicar la señal</label>
          <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
          <label for="imagen_senal" class="form-label">Imagen de la señal afectada</label>
          <input type="file" class="form-control" id="imagen_senal" name="imagen_senal" accept="image/jpeg, image/png" required>
        </div>
      `;
      document.getElementById('coordModalLabel').innerText = 'Señalización Vial en Mal Estado';
    }
    else if (tipoReporte == '3') {  // Nueva señalización vial
      formHtml = `
        <div class="mb-3">
          <label for="categoria" class="form-label">Categoría</label>
          <select class="form-select" id="categoria" name="categoria" required>
            <option value="">Seleccione categoría</option>
            <option value="vertical">Vertical</option>
            <option value="horizontal">Horizontal</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="tipo_senal" class="form-label">Tipo de señal</label>
          <select class="form-select" id="tipo_senal" name="tipo_senal" required>
            <option value="">Seleccione tipo de señal</option>
            <option value="alto">Alto</option>
            <option value="limite_velocidad">Límite de velocidad</option>
            <!-- Agregar otros tipos de señal aquí -->
          </select>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección para ubicar la señal</label>
          <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
          <label for="imagen_senal" class="form-label">Imagen de ubicación de la señal</label>
          <input type="file" class="form-control" id="imagen_senal" name="imagen_senal" accept="image/jpeg, image/png" required>
        </div>
      `;
      document.getElementById('coordModalLabel').innerText = 'Nueva Señalización Vial';
    }
    else if (tipoReporte == '4') {  // Reductor de velocidad en mal estado
      formHtml = `
        <div class="mb-3">
          <label for="categoria_reductor" class="form-label">Categoría de reductor</label>
          <select class="form-select" id="categoria_reductor" name="categoria_reductor" required>
            <option value="">Seleccione categoría</option>
            <option value="estructural">Estructural</option>
            <option value="modular">Modular</option>
            <option value="señalizacion">Señalización</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="tipo_reductor" class="form-label">Tipo de reductor</label>
          <input type="text" class="form-control" id="tipo_reductor" name="tipo_reductor" required>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción del daño</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="direccion_reductor" class="form-label">Dirección del reductor</label>
          <input type="text" class="form-control" id="direccion_reductor" name="direccion_reductor" required>
        </div>
        <div class="mb-3">
          <label for="imagen_reductor" class="form-label">Imagen del reductor afectado</label>
          <input type="file" class="form-control" id="imagen_reductor" name="imagen_reductor" accept="image/jpeg, image/png" required>
        </div>
      `;
      document.getElementById('coordModalLabel').innerText = 'Reductor de Velocidad en Mal Estado';
    }
    else if (tipoReporte == '5') {  // Nuevo reductor de velocidad
      formHtml = `
        <div class="mb-3">
          <label for="categoria_reductor" class="form-label">Categoría de reductor</label>
          <select class="form-select" id="categoria_reductor" name="categoria_reductor" required>
            <option value="">Seleccione categoría</option>
            <option value="estructural">Estructural</option>
            <option value="modular">Modular</option>
            <option value="señalizacion">Señalización</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="tipo_reductor" class="form-label">Tipo de reductor</label>
          <input type="text" class="form-control" id="tipo_reductor" name="tipo_reductor" required>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="direccion_reductor" class="form-label">Dirección para el nuevo reductor</label>
          <input type="text" class="form-control" id="direccion_reductor" name="direccion_reductor" required>
        </div>
        <div class="mb-3">
          <label for="imagen_reductor" class="form-label">Imagen del reductor</label>
          <input type="file" class="form-control" id="imagen_reductor" name="imagen_reductor" accept="image/jpeg, image/png" required>
        </div>
      `;
      document.getElementById('coordModalLabel').innerText = 'Nuevo Reductor de Velocidad';
    }
    else if (tipoReporte == '6') {  // Vía pública en mal estado
      formHtml = `
        <div class="mb-3">
          <label for="descripcion_via" class="form-label">Descripción de la vía pública</label>
          <textarea class="form-control" id="descripcion_via" name="descripcion_via" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="tipo_dano_via" class="form-label">Tipo de daño</label>
          <select class="form-select" id="tipo_dano_via" name="tipo_dano_via" required>
            <option value="">Seleccione tipo de daño</option>
            <option value="baches">Baches o huecos</option>
            <option value="grietas">Grietas</option>
            <option value="hundimientos">Hundimientos</option>
            <option value="piel_cocodrilo">Piel de cocodrilo</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="direccion_via" class="form-label">Dirección de la vía afectada</label>
          <input type="text" class="form-control" id="direccion_via" name="direccion_via" required>
        </div>
        <div class="mb-3">
          <label for="imagen_via" class="form-label">Imagen del daño en la vía</label>
          <input type="file" class="form-control" id="imagen_via" name="imagen_via" accept="image/jpeg, image/png" required>
        </div>
      `;
      document.getElementById('coordModalLabel').innerText = 'Vía Pública en Mal Estado';
    }

    dynamicFormFields.innerHTML = formHtml;
  }

  // Lista de tipos de señalización cargados desde PHP
  const tiposSenalizaciones = <?php echo json_encode($tiposSenalizaciones); ?>;

function updateTiposSenales() {
    // Obtener el valor de la categoría seleccionada
    const categoriaSeleccionada = document.getElementById("categoria").value;
    // Obtener el select de tipo de señal
    const tipoSenalSelect = document.getElementById("tipo_senal");

    const senalesSelect = document.getElementById("senalizacion");
    

    senalesSelect.innerHTML = '<option value="">Seleccione una señal</option>';
    tipoSenalSelect.innerHTML = '<option value="">Seleccione tipo de señal</option>';

    // Filtrar los tipos de señalización según la categoría seleccionada
    const tiposFiltrados = tiposSenalizaciones.filter(function(tipo) {
        return tipo.cat_id == categoriaSeleccionada;
    });
    // Si hay tipos de señalización para la categoría seleccionada
      tiposFiltrados.forEach(function(tipo) {
          const option = document.createElement("option");
          option.value = tipo.tipo_senalizacion_id;
          option.textContent = tipo.tip_snl_nombre;
          tipoSenalSelect.appendChild(option);
      });
}
function mostrarSenales() {
    const tipoSeleccionado = document.getElementById("tipo_senal").value;
    const senalesSelect = document.getElementById("senalizacion");
    const senales = <?php echo json_encode($senalizaciones); ?>;

    // Limpiar el select de señales
    senalesSelect.innerHTML = '<option value="">Seleccione una señal</option>';

    // Si no se selecciona tipo de señal, no mostrar señales
    if (!tipoSeleccionado) {
        return;
    }

    // Filtrar las señales según el tipo seleccionado
    const senalesFiltradas = senales.filter(function(senales) {
        return senales.tip_snl_id == tipoSeleccionado;
    });

    // Agregar las opciones de señales al select
    senalesFiltradas.forEach(function(senales) {
        const option = document.createElement("option");
        option.value = senales.senalizacion_id;
        option.textContent = senales.snl_descripcion;
        senalesSelect.appendChild(option);
    });
}

var danos = <?php echo json_encode($danos); ?>;

function actualizarFormulario() {
  const tipo_reporte = document.getElementById("tipo_reporte").value;
  console.log(danos);
  // Limpiar el campo de daños
  var danosSelect = document.getElementById("tipo_dano");
  danosSelect.innerHTML = '<option value="">Seleccione tipo de daño</option>';

  // Filtrar los daños disponibles según el tipo de reporte
  const danosfiltrados = danos.filter(function(dan) {
    return dan.tip_dan_id == tipo_reporte;  // Asegúrate de que esta condición sea la correcta
  });

  // Si el reporte tiene daños disponibles, agregar las opciones
  danosfiltrados.forEach(function(dano) {
    var option = document.createElement("option");
    option.value = dano.dano_id;
    option.textContent = dano.dano_nombre;
    danosSelect.appendChild(option);
  });
}

document.getElementById('tipo_reporte').addEventListener('change', function() {
    actualizarFormulario();
});
</script>
