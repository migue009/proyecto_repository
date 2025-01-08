<!-- apache //htdocs// misc// img y cambiar  los iconos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maqueta1-</title>
    <link rel="stylesheet" type="text/css" href="misc/img/dc.css">
   <script src="misc/lib/mscross-1.1.9.js" type="text/javascript"></script>

    <style type ="text/css">
        #Layer1{
            position:absolute;
            width:162px;
            height:158px;
            z-index:101;
            left:751px;
            top:26px;
        }
            
        #Layer2{
            position:absolute;
            width:141px;
            height:315px;
            z-index:102;
            left:751px;
            top:216px;
            background-color: #E1E8ED;
        }

    </style>
</head>
<body>
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

            var infola= new  msTool('crear punto', infolay,'misc/img/marker-gold.png',investiguen);
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
</body>
</html>