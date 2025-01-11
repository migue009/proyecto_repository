<?php
    // Aquí, se pueden cargar los usuarios por defecto, o todos los usuarios si no hay búsqueda.
    if (is_array($usuarios) || is_object($usuarios)) {
        foreach ($usuarios as $usu) {
            echo "<tr>";
            echo "<td>" . $usu['usuario_id'] . "</td>";
            echo "<td>" . $usu['tip_doc_nombre'] . "</td>";
            echo "<td>" . $usu['usu_num_doc'] . "</td>";
            echo "<td>" . $usu['usu_primer_nom'] . " " . $usu['usu_segundo_nom'] . "</td>";
            echo "<td>" . $usu['usu_primer_ape'] . " " . $usu['usu_segundo_ape'] . "</td>";
            echo "<td>" . $usu['usu_num_cel'] . "</td>";
            echo "<td>" . $usu['usu_correo'] . "</td>";
            $direccion_completa = $usu['carrera'] . ", " . $usu['calle'] . ", " . ($usu['num_adicional'] ? $usu['num_adicional'] . ", " : "") .($usu['complemento'] ? $usu['complemento'] . ", " : "") . $usu['barrio'];
            echo "<td>" . $direccion_completa . "</td>";
            echo "<td>" . $usu['usu_num_cel'] . "</td>";
            echo "<td>" . $usu['usu_momento_creacion'] . "</td>";
            echo "<td>" . $usu['rol_nombre'] . "</td>";
            echo "<td>" . $usu['sexo_nombre'] . "</td>";

            $estadoClase = ($usu['est_id'] == 1) ? "text-habilitado" : "text-inhabilitado";
            $texto = ($usu['est_id'] == 1) ? "habilitado" : "inhabilitado";

            echo "<td class='$estadoClase'>$texto</td>";
            echo "<td><a href='" . getUrl("Administrador", "Administrador", "getUpdateUsuarios", array("usu_id" => $usu['usuario_id'])) . "'><button class='btn btn-primary'>Editar</button></a></td>";
            echo "<td><a href='" . getUrl("Administrador", "Administrador", "getdelete", array("usu_id" => $usu['usuario_id'])) . "'><button class='btn btn-danger'>Eliminar</button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='15' class='text-center text-danger'>No se encontraron usuarios o hubo un error en la consulta.</td></tr>";
    }
?>
