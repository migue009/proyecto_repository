<style>
.table-responsive {
    max-width: 100%;   /* Puedes ajustar esto si deseas limitar el ancho máximo */
    overflow-x: auto;  /* Habilita el scroll horizontal */
    -webkit-overflow-scrolling: touch; /* Mejora la experiencia en dispositivos móviles */
}
</style>
<div class = "mt-5">
    <h3 class = "display-4">Consultar Usuarios</h3>
</div>
<div class = "row">
    <div class = "col-md-4 mt-4 mb-5">
        <input type="text" name="buscar" id="buscar" class ="form-control" placeholder="buscar por Nombre o Correo" data-url ='<?php echo getUrl("Administrador","Administrador","buscar",false,"ajax");?>'>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo Documento</th>
                    <th>Número Documento</th>
                    <th>Nombre(s)</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (is_array($usuarios) || is_object($usuarios)) {
                        // Si $usuarios es un array u objeto, entonces ejecuta el foreach
                        foreach ($usuarios as $usu) {
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
                        // Si $usuarios no es un array u objeto (es false), muestra un mensaje de error
                        echo "<tr><td colspan='8' class='text-center text-danger'>No se encontraron usuarios o hubo un error en la consulta.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>