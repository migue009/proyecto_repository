<?php

if(!extension_loaded("MapScript")){
    dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
}

if (isset($_POST['R']) && isset($_POST['G']) && isset($_POST['B'])) {
    $mapObject = ms_newMapObj("Colombia.map");
    $r = $_POST['R'];
    $g = $_POST['G'];
    $b = $_POST['B'];

    $jCapas = $mapObject->getAllLayerNames();
    $jColor = $mapObject->getLayerByName("Poligonos")->getClass(0)->getStyle(0)->color;
    $jColor->setRGB($r, $g, $b);

    $mapImage=$mapObject->draw();
    $urlImage = $mapImage->saveWebImage();
}else {
    $mapObject = ms_newMapObj("Colombia.map");
    $jCapas = $mapObject->getAllLayerNames();
    $jColor = $mapObject->getLayerByName("Poligonos")->getClass(0)->getStyle(0)->color;
    $jColor->setRGB(10, 200, 10);

    $mapImage = $mapObject->draw();
    $urlImage = $mapImage->saveWebImage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ejemplo 02</title>
</head>
<body>  
        <div class="container-fluid">
            <input type="IMAGE"  class="img-fluid"  name="mapa" src="<?php echo $urlImage; ?>" border=1>
        </div>
        <div class= "container col-5"> 
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="R" class="form-label">Color R</label>
                        <input type="number" id="R" name="R" class="form-control" placeholder="Color-R" min="0" max="255" value="">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="G" class="form-label">Color G</label>
                        <input type="number" id="G" name="G" class="form-control" placeholder="Color-G" min="0" max="255" value="">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="B" class="form-label">Color B</label>
                        <input type="number" id="B" name="B" class="form-control" placeholder="Color-B" min="0" max="255" value="">
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Enviar" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>