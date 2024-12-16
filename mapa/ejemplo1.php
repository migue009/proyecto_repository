<?php

    if(!extension_loaded("MapScript")){
        dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
    }

    $mapObject =ms_newMapObj("Cali.map");

    $map_pt = click2map($_POST['image_x'],$_POST['image_y']);

    //creo los puntos
    $pt=ms_newPointObj();
    $pt->setXY($map_pt[0], $map_pt[1]);

    $mapImage= $mapObject->draw();
    //creamos y capturamos la ruta de imagen renderizada
    $urlImage = $mapImage->saveWebImage();

    //funcion click2map calcular las coordenadas

    function click2map($click_x, $click_y){
        global $mapObject;
        $e = $mapObject->extent;
        $x_pct = ($click_x /$mapObject->width);
        $y_pct = 1 - ($click_y /$mapObject->height);
        $x_map = $e->minx + (($e->maxx-$e->minx)*$x_pct);
        $y_map = $e->miny + (($e->maxy-$e->miny)*$y_pct);

        return array($x_map, $y_map);
    }

    //para identificar la posición cero cero
    //investigar una modal para que cargue las coordenadas
    //En grupo debemos pensar una idea para pasarlo de coordenada
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form method ="post" action="ejemplo1.php">
            <input type=IMAGE name="image" src="<?php echo $urlImage; ?>" border=1>
        </form>
        <p>
            <b>
                Coordenadas en pixeles :
            </b><?php echo  $_POST['image_x']." , ".$_POST['image_y'];?>
            <br>
            <b>
                Coordenadas mapa:
            </b><?php echo $map_pt[0] ." , ". $map_pt[1]; ?>
        </p>
    </body>
    </html>
