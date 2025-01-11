
<div class="container map-container">
  <div class="row">
    <div class="col-12 col-md-10"> <!-- Primera columna -->
      <div class="mscross" style="overflow: hidden;  width: 800px; height: 250px;  -moz-user-select: none; position:relative;" id="dc_main">
      </div>
    </div>
    <div class="col-12 col-md-2"> <!-- Segunda columna -->
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
              <p>
                  <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[5]" value="Puntos">
                  <strong>Reportes</strong>
              </p>
          </form>
      </div>
      <div id="Layer1">
        <div style="overflow:auto; width: 100%; height: 100px; -moz-user-select: none; position:relative; z-index: 100;" id="dc_main2">
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  //<![CDATA[
  myMap1 = new msMap(document.getElementById("dc_main"),'standardRight');
  myMap1.setCgi('/cgi-bin/mapserv.exe');
  myMap1.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/cali.map');
  myMap1.setFullExtent(-76.53 , -76.45  , 3.414);
  myMap1.setLayers('Poligonos Cali Comunas Barrios Vias Puntos');

  myMap2 = new msMap(document.getElementById("dc_main2"));
  myMap2.setActionNone();
  myMap2.setFullExtent(-76.6 , -76.45  , 3.35);
  myMap2.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/cali.map');
  myMap2.setLayers('Poligonos Cali Comunas Barrios Vias Puntos');
  myMap1.setReferenceMap(myMap2);
  myMap1.redraw(); 
  myMap2.redraw();
  chgLayers();


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
</script>
