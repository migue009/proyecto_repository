<!-- apache //htdocs// misc// img y cambiar  los iconos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maqueta1-</title>
    <link rel="stylesheet" type="text/css" href="../mapa/misc/img/dc.css">
   <script src="../mapa/misc/lib/mscross-1.1.9.js" type="text/javascript"></script>

    <style type ="text/css">
    /* Posición del contenedor de capas */
    #Layer1 {
        position: absolute;  /* Posición absoluta para controlarla de manera libre */
        top: 20px;           /* Espacio desde la parte superior */
        left: 20px;          /* Espacio desde la parte izquierda */
        z-index: 101;        /* Asegura que esté por encima del mapa pero debajo de #Layer2 */
        width: 160px;        /* Ancho fijo para el formulario de capas */
        height: 150px;       /* Altura fija para el formulario */
        background-color: rgba(255, 255, 255, 0.8);  /* Fondo semitransparente */
        border-radius: 8px;  /* Bordes redondeados */
        padding: 10px;       /* Espaciado interno */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);  /* Sombra para destacarlo */
    }

    /* Mejorar el aspecto de los controles dentro de #Layer1 */
    #Layer1 form {
        margin: 0;
        padding: 0;
    }

    #Layer1 input[type="checkbox"] {
        margin-right: 10px;  /* Espaciado entre checkbox y texto */
    }

    /* Estilo para las etiquetas en el formulario */
    #Layer1 strong {
        font-weight: bold;
        color: #333;
    }

    #Layer1 p {
        margin-bottom: 8px;
    }
          
      #Layer2{
        position: absolute; /* Coloca el formulario de las capas sobre el mapa */
        top: 20px; /* Espacio desde la parte superior */
        right: 20px; /* Espacio desde la derecha */
        background-color: rgba(255, 255, 255, 0.8); /* Fondo con algo de transparencia */
        border-radius: 8px; /* Bordes redondeados */
        padding: 15px; /* Espaciado interno */
        z-index: 102; /* Asegura que el formulario esté por encima del mapa */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Sombra para dar contraste */
        width: auto; /* Ajustar el tamaño según el contenido */
        max-width: 250px; /* Limitar el ancho máximo */
      }
      #Layer2 form {
          margin: 0;
          padding: 0;
      }

      #Layer2 input[type="checkbox"] {
          margin-right: 10px; /* Espaciado entre checkbox y texto */
      }

      /* Espaciado entre los controles */
      #Layer2 p {
          margin-bottom: 10px;
      }

      /* Estilo para la etiqueta de cada capa */
      #Layer2 strong {
          font-weight: bold;
          color: #333;
      }

    </style>
</head>
<div class= "mscross" style ="overflow: hidden; width:700px; height:600px;-moz-user-select: none; position:relative;" id="dc_main"> </div>
<div id="Layer2">

        <form name ="select_layers">
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[0]" value="Poligonos">
                <strong>Poligonos</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[1]" value="Puntos">
                <strong>Puntos</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[2]" value="Lineas">
                <strong>Lineas</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[3]" value="Countries">
                <strong>Countries</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[4]" value="cali">
                <strong>Cali</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[5]" value="comuna">
                <strong>Comunas</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[6]" value="barrio">
                <strong>Barrio</strong>
            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name ="layer[7]" value="calle">
                <strong>Calle</strong>
        </form>
    </div>
    <!-- input mi modal boton como id -->
    <div id="Layer1">
        <div style ="overflow:auto; width:240px;height:140px;-moz-user-select: none; position:relative; z-index: 100;" id="dc_main2">
        </div>
    </div>
    <script type="text/javascript">
        //<![CDATA[
            myMap1 = new msMap(document.getElementById("dc_main"),'standardRight');
            myMap1.setCgi('/cgi-bin/mapserv.exe');
            myMap1.setMapFile('/ms4w/apache/htdocs/proyecto_repository/APPorte/mapa/Colombia.map');
            myMap1.setFullExtent(-88,-62,-5);
            myMap1.setLayers('Poligonos Lineas Puntos');

            myMap2 = new msMap(document.getElementById("dc_main2"));
            myMap2.setActionNone();
            myMap2.setFullExtent(-88,-62,-5);
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