<meta charset="UTF-8">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $identificacion = $_POST['identificacion'];
    $tipo_accidente = $_POST['tipo_accidente'];
    $descripcion = $_POST['descripcion'];
    $coord_x = $_POST['coord_x'];
    $coord_y = $_POST['coord_y'];

    // Aquí deberías usar la función click2map para convertir las coordenadas de píxeles a coordenadas del mapa
    // Por ahora, usaremos las coordenadas de píxeles directamente

    // Aquí puedes procesar los datos como desees
    // Por ejemplo, guardarlos en una base de datos o enviar un correo electrónico

    // Por ahora, solo imprimiremos los datos recibidos
    echo "<h2>Datos del Reporte de Accidente:</h2>";
    echo "<p><strong>Nombres:</strong> $nombres</p>";
    echo "<p><strong>Apellidos:</strong> $apellidos</p>";
    echo "<p><strong>Identificación:</strong> $identificacion</p>";
    echo "<p><strong>Tipo de Accidente:</strong> $tipo_accidente</p>";
    echo "<p><strong>Descripción:</strong> $descripcion</p>";
    echo "<p><strong>Coordenadas X:</strong> $coord_x</p>";
    echo "<p><strong>Coordenadas Y:</strong> $coord_y</p>";

    // Puedes agregar más lógica aquí, como redireccionar a una página de confirmación
    // header("Location: confirmacion.php");
    // exit();
} else {
    // Si alguien intenta acceder directamente a este archivo, lo redirigimos a la página principal
    header("Location: index.php");
    exit();
}
?>