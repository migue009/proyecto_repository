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
    <!--
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
            height:215px;
            z-index:102;
            left:751px;
            top:216px;
            background-color: #E1E8ED;
        }
    -->
    </style>
</head>
<body>
    <div class= "mscross" style ="overflow: hidden; width:700px; height:500px;-moz-user-select: none; position:relative;" id="dc_main"> </div>
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
        </form>
    </div>
    <div id="Layer1">
        <div style ="overflow:auto; width:240px;height:140px;-moz-user-select: none; position:relative; z-index: 100;" id="dc_main2">
        </div>
    </div>
    <script type="text/javascript">
        //<![CDATA[
            myMap1 = new msMap(document.getElementById("dc_main"),'standardRight');
            myMap1.setCgi('/cgi-bin/mapserv.exe');
            myMap1.setMapFile('/ms4w/apache/htdocs/Colombia.map');
            myMap1.setFullExtent(-88,-62,-5);
            myMap1.setLayers('Poligonos Lineas Puntos');

            myMap2 = new msMap(document.getElementById("dc_main2"));
            myMap2.setActionNone();
            myMap2.setFullExtent(-88,-62,-5);
            myMap2.setMapFile('/ms4w/apache/htdocs/Colombia.map');
            myMap2.setLayers('Poligonos Lineas Puntos Countries');
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
        //]]>
    </script>
</body>
</html>