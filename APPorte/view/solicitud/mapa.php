
    <div class="container">
        <h3 class="text-center main-title">Elige la dirección del reporte!</h3>
    </div>
    
    <div class="container map-container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="mscross" style="overflow: hidden; width: 500px; height: 600px; -moz-user-select: none; position:relative;" id="dc_main">
                </div>
            </div>
            <div class="col-12 col-md-2">
              <div id="Layer2">
                <form name="select_layers">
                    <p align="left">
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="Cali">
                        <strong>Poligonos</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[1]" value="Comunas">
                        <strong>Comunas</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[2]" value="Barrios">
                        <strong>Barrio</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[3]" value="Vias">
                        <strong>Calles</strong>
                    </p>
                    <p>
                        <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[4]" value="Puntos">
                        <strong>Solicitudes</strong>
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
        <p><strong>Coordenadas en píxeles:</strong> <span id="pixelCoords"></span></p>
        <p><strong>Coordenadas reales:</strong> <span id="mapCoords"></span></p>
        <form id="coordForm" method="POST" action="<?php echo getUrl('Solicitud', 'Solicitud', 'postCreateSolicitud'); ?>">
          <input type="hidden" id="coord_x" name="coord_x">
          <input type="hidden" id="coord_y" name="coord_y">
          <div class="mb-3">
            <label for="nombres" class="form-label">Nombre del Lugar</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
          </div>
          <button type="submit" class="btn btn-primary">Enviar Reporte</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  //<![CDATA[
  myMap1 = new msMap(document.getElementById("dc_main"),'standardRight');
  myMap1.setCgi('/cgi-bin/mapserv.exe');
  myMap1.setMapFile('/ms4w/apache/htdocs/mapa/cali.map');
  myMap1.setFullExtent(-76.51 , -76.48  , 3.41);
  myMap1.setLayers('Poligonos Cali Comunas Barrios Vias');


  var infola= new  msTool('crear punto', infolay,'../mapa/misc/img/marker-gold.png',investiguen);
  myMap1.getToolbar(0).addMapTool(infola);


  myMap1.redraw(); 
  myMap2.redraw();
  chgLayers();

  var selectlayer = -1;
  var lyactive = false;
  var legendactive = false;

  function chgLayers()
  {
      var list = "Layers ";
      var objForm = document.forms[0];
      for(i = 0; i < document.forms[0].length; i++){
          if (objForm.elements["layer[" + i + "]"].checked) {
              list = list + objForm.elements["layer[" + i + "]"].value + " ";
          }
      }
      myMap1.setLayers( list );
      myMap1.redraw();
      myMap2.setLayers( list );
      myMap2.redraw();
  }
  var seleccionado = false;
  function infolay(e,map){
      map.getTagMap().style.cursor="crosshair";
      seleccionado=true;
  }

  function infolay(e,map){
      map.getTagMap().style.cursor="crosshair";
      seleccionado=true;
  }
  
  function objectoAjax(){
      var xmlhttp=false;

      try{
          xmlhttp = new ActiveXObject("Msxm2.XMLHttpRequest");
      }catch (e){
          try{
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }catch (E){
              xmlhttp=false;
          }

      }
      if(!xmlhttp && typeof XMLHttpRequest != 'undefined'){
          xmlhttp = new XMLHttpRequest();
          return xmlhttp;
      }
  }
  // Función para manejar el clic y capturar las coordenadas
  function investiguen(event, map, x, y, xx, yy) {
    if (seleccionado) {
      // Mostrar las coordenadas en píxeles y reales
      document.getElementById('pixelCoords').textContent = x + ', ' + y;
      document.getElementById('mapCoords').textContent = xx.toFixed(2) + ', ' + yy.toFixed(2);

      // Rellenar los campos ocultos con las coordenadas reales
      document.getElementById('coord_x').value = xx.toFixed(2);
      document.getElementById('coord_y').value = yy.toFixed(2);

      // Mostrar el modal con las coordenadas
      var myModal = new bootstrap.Modal(document.getElementById('coordModal'));
      myModal.show();

      // Desactivar la herramienta después de capturar la coordenada
      seleccionado = false;
      map.getTagMap().style.cursor = "default"; // Restaurar cursor
    }
  }
      //  abrr modal xx yy 
      //  obj = dpci,emt get element by 
  //]]>
</script>
