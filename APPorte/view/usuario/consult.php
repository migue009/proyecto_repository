<div class="container card">
    <div class="mt-5">
        <h3 class="display-4 text-center main-title">Consultar Usuarios</h3>
    </div>
    <div class="row">
        <div class="col-md-4 mt-4 mb-5">

            <span class="input-group-text">
                <i class="fas fa-search"></i> 
                <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Buscar por Nombre o Correo" 
                data-url='<?php echo getUrl("Administrador", "Administrador", "buscar", false, "ajax"); ?>' 
                aria-label="Buscar por Nombre o Correo" autocomplete="off">
            </span>
        </div>
        <div class="col-md-4 mt-4 mb-5">
            <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo getUrl('Administrador', 'Administrador', 'getCreate'); ?>'">Agregar otro usuario</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table users-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo Documento</th>
                    <th>Número Documento</th>
                    <th>Nombre(s)</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Fecha Creación</th>
                    <th>Rol</th>
                    <th>Sexo</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($usuarios) || is_object($usuarios)) {
                    foreach ($usuarios as $usu) {
                        $clase = "";
                        $texto = "";
                        echo "<tr>";
                        echo "<td>" . $usu['usuario_id'] . "</td>";
                        echo "<td>" . $usu['tip_doc_nombre'] . "</td>";
                        echo "<td>" . $usu['usu_num_doc'] . "</td>";
                        echo "<td>" . $usu['usu_primer_nom'] . " " . $usu['usu_segundo_nom'] . "</td>";
                        echo "<td>" . $usu['usu_primer_ape'] . " " . $usu['usu_segundo_ape'] . "</td>";
                        echo "<td>" . $usu['usu_num_cel'] . "</td>";
                        echo "<td>" . $usu['usu_correo'] . "</td>";
                        // Mostrar la dirección completa concatenando los campos
                        $direccion_completa = $usu['usu_carrera'] . ", " . $usu['usu_calle'] . ", " . ($usu['usu_num_adicional'] ? $usu['usu_num_adicional'] . ", " : "") .($usu['usu_complemento'] ? $usu['usu_complemento'] . ", " : "") . $usu['usu_barrio'];
                        echo "<td>" . $direccion_completa . "</td>";
                        echo "<td>" . $usu['usu_num_cel'] . "</td>";
                        echo "<td>" . $usu['usu_momento_creacion'] . "</td>";
                        echo "<td>" . $usu['rol_nombre'] . "</td>";
                        echo "<td>" . $usu['sexo_nombre'] . "</td>";

                        if ($usu['est_id'] == 1) {
                            $estadoClase = "text-habilitado";
                            $texto = "habilitado";
                        } else if ($usu['est_id'] == 2) {
                            $estadoClase = "text-inhabilitado";
                            $texto = "inhabilitado";
                        }

                        echo "<td class='$estadoClase'>";
                        echo "$texto";
                        echo "</td>";
                        echo "<td>"
                            . "<a href='" . getUrl("Administrador", "Administrador", "getUpdateUsuarios", array("usu_id" => $usu['usuario_id'])) . "'>"
                            . "<button class='btn btn-primary'>Editar</button>"
                            . "</a>"
                            . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='15' class='text-center text-danger'>No se encontraron usuarios o hubo un error en la consulta.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

