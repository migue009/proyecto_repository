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
            echo "<td>" . $usu['rol_nombre'] . "</td>";

            // Lógica para el botón de habilitar/deshabilitar
            if ($usu['estado_id'] == 1) {
                $clase = "btn btn-danger";
                $texto = "Inhabilitar";
            } else if ($usu['estado_id'] == 2) {
                $clase = "btn btn-success";
                $texto = "Habilitar";
            }

            echo "<td>";
            if (!empty($clase)) echo "<button type='button' class='$clase' id='cambiar_estado_usuario' data-url='" . getUrl("Usuarios", "Usuarios", "postUpdateStatus", false, "ajax") . "' data-id ='" . $usu['estado_id'] . "' data-user ='" . $usu['usu_id'] . "'>$texto</button>";
            echo "</td>";
            echo "<td>"
                . "<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "'>"
                . "<button class='btn btn-primary'>Editar</button>"
                . "</a>"
                . "</td>";
            echo "<td>"
                . "<a href='" . getUrl("Usuarios", "Usuarios", "getdelete", array("usu_id" => $usu['usu_id'])) . "'>"
                . "<button class='btn btn-danger'>Eliminar</button>"
                . "</a>"
                . "</td>";
            echo "</tr>";
        }
    }else{
         // Si $usuarios no es un array u objeto (es false), muestra un mensaje de error
         echo "<tr><td colspan='8' class='text-center text-danger'>No se encontraron usuarios o hubo un error en la consulta.</td></tr>";
    }
?>