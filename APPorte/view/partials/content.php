<div class="container">
        <h2 class="main-title">Dashboard</h2>
        <div class="row stat-cards">
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">1478 286</p>
                <p class="stat-cards-info__title">Total visits</p>
                <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <i data-feather="trending-up" aria-hidden="true"></i>4.07%
                  </span>
                  Last month
                </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">1478 286</p>
                <p class="stat-cards-info__title">Total visits</p>
                <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit success">
                    <i data-feather="trending-up" aria-hidden="true"></i>0.24%
                  </span>
                  Last month
                </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon purple">
                <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">1478 286</p>
                <p class="stat-cards-info__title">Total visits</p>
                <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit danger">
                    <i data-feather="trending-down" aria-hidden="true"></i>1.64%
                  </span>
                  Last month
                </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
                <i data-feather="feather" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">1478 286</p>
                <p class="stat-cards-info__title">Total visits</p>
                <p class="stat-cards-info__progress">
                  <span class="stat-cards-info__profit warning">
                    <i data-feather="trending-up" aria-hidden="true"></i>0.00%
                  </span>
                  Last month
                </p>
              </div>
            </article>
          </div>
        </div>
</div>

<div class="container map-container">
  <div class="row">
    <div class="col-6"> <!-- Primera columna -->
      <div class="mscross" style="overflow: hidden; width: 500px; height: 600px; -moz-user-select: none; position:relative;" id="dc_main">
      </div>
    </div>
    <div class="col-6"> <!-- Segunda columna -->
      <div id="Layer2">
        <form name="select_layers">
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="Poligonos">
            <strong>Poligonos</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[1]" value="Puntos">
            <strong>Puntos</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[2]" value="Lineas">
            <strong>Lineas</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[3]" value="Countries">
            <strong>Countries</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[4]" value="cali">
            <strong>Cali</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[5]" value="comuna">
            <strong>Comunas</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[6]" value="barrio">
            <strong>Barrio</strong>
          </p>
          <p align="left">
            <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[7]" value="calle">
            <strong>Calle</strong>
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

<script type="text/javascript">
  //<![CDATA[
  myMap1 = new msMap(document.getElementById("dc_main"),'standardRight');
  myMap1.setCgi('/cgi-bin/mapserv.exe');
  myMap1.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/Colombia.map');
  myMap1.setFullExtent(-90, -60, -5);
  myMap1.setLayers('Poligonos Lineas Puntos');

  myMap2 = new msMap(document.getElementById("dc_main2"));
  myMap2.setActionNone();
  myMap2.setFullExtent(-90, -60, -5);
  myMap2.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/Colombia.map');
  myMap2.setLayers('Poligonos Lineas Puntos Countries cali');
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
<!-- <div class="container mt-4">
    <a href="javascript:void(0);" onclick="redirectToExample();">
        <button id='redirectBtn' class='btn btn-primary'>Ir a Ejemplo</button>
    </a>
</div> -->
<!-- 
<script>
   function detectTheme() {
        // Verificar la preferencia del usuario sobre el tema en el navegador
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            // Modo oscuro
            localStorage.setItem('theme', 'dark');
        } else {
            // Modo claro
            localStorage.setItem('theme', 'light');
        }
    }

    // Llamar a la función para detectar el tema cuando la página se carga
    detectTheme();
    // Esta función solo se ejecutará cuando se haga clic en el botón
    function redirectToExample() {
        // Obtener las variables de sesión de PHP

        var theme = localStorage.getItem('theme');

        // Construir la URL con los parámetros
        var url = 'ejemplo.php?nombre=' + encodeURIComponent(nombre) + 
                  '&apellido=' + encodeURIComponent(apellido) + 
                  '&correo=' + encodeURIComponent(correo);
                  '&rol=' + encodeURIComponent(rol);
                  '&theme=' + encodeURIComponent(theme);

        // Redirigir a la nueva página
        window.location.href = url;
    }
</script> -->
