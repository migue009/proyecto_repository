<?php
if(!extension_loaded("MapScript")){
    dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
}

$mapObject = ms_newMapObj("Colombia.map");

$jCapas = $mapObject->getAllLayerNames();
$jColor = $mapObject->getLayerByName("Poligonos")->getClass(0)->getStyle(0)->color;

$jColor ->setRGB(10,100,10);


$mapImage = $mapObject->draw();
$urlImage = $mapImage->saveWebImage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 02</title>
</head>
<body>
    <input type="IMAGE" name="mapa" src="<?php echo $urlImage; ?>" border=1>
</body>
</html>