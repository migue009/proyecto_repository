<?php
if (is_array($usuarios) || is_object($usuarios)) {
    foreach($usuarios as $usu){
        $clase = "";
        $texto = "";
        echo "<tr>";
        echo "<td>" . $usu['usu_id'] . "</td>";
        echo "<td>" . $usu['tipo_doc_nombre'] . "</td>";
        echo "<td>" . $usu['usu_numero_documento'] . "</td>";
        echo "<td>" . $usu['usu_primer_nombre'] . " " . $usu['usu_segundo_nombre'] . "</td>";
        echo "<td>" . $usu['usu_primer_apellido'] . " " . $usu['usu_segundo_apellido'] . "</td>";
        echo "<td>" . $usu['usu_telefono'] . "</td>";
        echo "<td>" . $usu['usu_correo'] . "</td>";
        echo "<td>" . $usu['rol_nombre'] . "</td>";

        // Lógica para el botón de habilitar/deshabilitar
        if ($usu['estado_id'] == 1) {
            $estadoClase = "text-success";
            $texto = "habilitado";
        } else if ($usu['estado_id'] == 2) {
            $estadoClase = "text-danger";
            $texto = "inhabilitado";
        }

        echo "<td class='$estadoClase'>";
        echo "$texto";
        echo "</td>";
        echo "<td>"
            . "<a href='" . getUrl("Administrador", "Administrador", "getUpdate", array("usu_id" => $usu['usu_id'])) . "'>"
            . "<button class='btn btn-primary'>Editar</button>"
            . "</a>"
            . "</td>";
        echo "<td>"
            . "<a href='" . getUrl("Administrador", "Administrador", "getdelete", array("usu_id" => $usu['usu_id'])) . "'>"
            . "<button class='btn btn-danger'>Eliminar</button>"
            . "</a>"
            . "</td>";
        echo "</tr>";
    }
} else {
    // Si no hay resultados
    echo "<tr><td colspan='8' class='text-center text-danger'>No se encontraron usuarios con ese término de búsqueda.</td></tr>";
}
?>
