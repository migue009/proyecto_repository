<?php
    // Aquí, cargarías las PQRS por defecto o todas las PQRS si no hay búsqueda.
    if (is_array($pqrs) || is_object($pqrs)) {
        foreach ($pqrs as $p) {
            echo "<tr>";
            echo "<td>" . $p['tip_pqrs_nombre'] . "</td>";
            echo "<td>" . $p['usu_primer_nom'] . " " . $p['usu_segundo_nom'] . "</td>";
            echo "<td>" . $p['pqrs_mensaje'] . "</td>";
            echo "<td>" . $p['fecha_pqrs'] . "</td>";
            if ($p['estado_id'] == 8) {
                echo "<td>No Leído</td>";  // Mostrar estado "No Leído"
            } else if ($p['estado_id'] == 9) {
                echo "<td>Leído</td>";  // Mostrar estado "Leído"
            } else {
                echo "<td>Estado Desconocido</td>";  // Si el estado no es 8 ni 9
            }
            // Estado
            $clase = "";
            $texto = "";
            if ($p['estado_id'] == 8) {
                // Si el estado es "No Leído"
                $clase = "btn btn-danger";  // Estilo de botón para "No Leído"
                $texto = "Marcar como Leído";  // Texto del botón
            } else if ($p['estado_id'] == 9) {
                // Si el estado es "Leído"
                $clase = "btn btn-primary";  // Estilo de botón para "Leído"
                $texto = "Marcar como No Leído";  // Texto del botón
            }

            echo "<td>";
            if (!empty($clase)) {
                // Mostrar el botón para cambiar el estado
                echo "<button type='button' class='$clase' id='cambiar_estado_pqrs' data-url='" . getUrl("Pqrs", "Pqrs", "postUpdateStatus", false, "ajax") . "' 
                    data-id='" . $p['estado_id'] . "' 
                    data-pqrs-id='" . $p['pqrs_id'] . "'>
                    $texto
                </button>";
            }
            echo "</td>";
            echo "</tr>";
        }

    } else {
        echo "<tr><td colspan='7' class='text-center text-danger'>No se encontraron PQRS o hubo un error en la consulta.</td></tr>";
    }
?>