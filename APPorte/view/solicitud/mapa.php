
  <div class="container map-container">
    <div class="row">
      <div class="col-10"> <!-- Primera columna -->
        <div class="mscross" style="overflow: hidden; width: 500px; height: 600px; -moz-user-select: none; position:relative;" id="dc_main">
        </div>
      </div>
      <div class="col-2"> <!-- Segunda columna -->
        <div id="Layer2">
          <form name="select_layers">
            <p align="left">
              <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="Poligonos">
              <strong>Poligonos</strong>
            </p>
            <p align="left">
              <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="Cali">
              <strong>Cali</strong>
            </p>
            <p align="left">
              <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[1]" value="Comunas">
              <strong>Comunas</strong>
            </p>
            <p align="left">
              <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[2]" value="Barrios">
              <strong>Barrios</strong>
            </p>
            <p align="left">
              <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[3]" value="Vias">
              <strong>Vias</strong>
            </p>
          </form>
        </div>
        <div id="Layer1">
          <div style="overflow:auto; width: 100%; height: 140px; -moz-user-select: none; position:relative; z-index: 100;" id="dc_main2">
          </div>
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
  myMap1.setFullExtent(-76.6 , -76.45  , 3.35);
  myMap1.setLayers('Poligonos Cali Comunas Barrios Vias');

  myMap2 = new msMap(document.getElementById("dc_main2"));
  myMap2.setActionNone();
  myMap2.setFullExtent(-76.6 , -76.45  , 3.35);
  myMap2.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/cali.map');
  myMap2.setLayers('Poligonos Cali Comunas Barrios Vias');
  myMap1.setReferenceMap(myMap2);

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
  function investiguen(event, map, x, y, xx, yy){
    if(seleccionado){
        alert("Click sobre las coordenadas : x " +x+ "y: " +y+ "y reales : x" +xx+ "y: "+yy);
        //document.getElementById("boton1").click();
        consultar1 = new objectoAjax();

        consultar1.open("GET", "Insertar_punto.php?x="+xx+"&y="+yy,true);
        
        consultar1.onreadystatechange=function(){
            if(consultar1.readyState==4){
                var result= consultar1.responseText;
                alert(result); //resultado de consulta
            }
        }

        consultar1.send(null);
        seleccionado=false;
        map.getTagMap().style.cursor="default";
    }
  }
      //  abrr modal xx yy 
      //  obj = dpci,emt get element by 
  //]]>
</script>