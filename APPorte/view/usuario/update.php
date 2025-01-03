<div>
    <?php
        foreach($usuario as $usu){
    ?>
</div>
<div class="container card">
    <div class="mt-5">
        <h3 class="display-4 text-center main-title">Actualizar Usuario</h3>
    </div>
    <div class="mt-5">
        <form action="<?php echo getUrl('Administrador', 'Administrador', 'postUpdateUsuarios'); ?>" method="post" id="actualizar-admin-form">
            <input type="hidden" name="usu_id" value="<?php echo $usu['usu_id']; ?>">

            <div class="row mt-4">
                <!-- tipo de documento y numero -->
                <div class="col-md-6 mb-3">
                    <label for="usu_tipo_documento">Tipo de Documento</label>
                    <select name="usu_tipo_documento" id="usu_tipo_documento" class="form-select">
                        <?php
                            foreach ($tipoDocu as $tipo) {
                                $selected = ($usu['usu_tipo_documento'] == $tipo['tipo_documento_id']) ? "selected" : "";
                                echo "<option value='" . $tipo['tipo_documento_id'] . "' $selected>" . $tipo['tip_doc_nombre'] . "</option>";
                            }
                        ?>
                    </select>
                    <div class="text-danger" id="error_usu_tipo_documento"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usu_numero_documento">Número de Documento</label>
                    <input type="text" id="usu_numero_documento" name="usu_numero_documento" class="form-control" placeholder="Número de Documento" value="<?php echo $usu['usu_num_doc']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_usu_documento"></div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Primer nombre y segundo nombre -->
                <div class="col-md-6 mb-3">
                    <label for="usu_primer_nombre">Primer Nombre</label>
                    <input type="text" id="usu_primer_nombre" name="usu_primer_nombre" class="form-control" placeholder="Primer Nombre" value="<?php echo $usu['usu_primer_nom']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_primer_nombre"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usu_segundo_nombre">Segundo Nombre</label>
                    <input type="text" id="usu_segundo_nombre" name="usu_segundo_nombre" class="form-control" placeholder="Segundo Nombre" value="<?php echo $usu['usu_segundo_nom']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_segundo_nombre"></div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Primer apellido y segundo apellido -->
                <div class="col-md-6 mb-3">
                    <label for="usu_primer_apellido">Primer Apellido</label>
                    <input type="text" id="usu_primer_apellido" name="usu_primer_apellido" class="form-control" placeholder="Primer Apellido" value="<?php echo $usu['usu_primer_ape']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_primer_apellido"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usu_segundo_apellido">Segundo Apellido</label>
                    <input type="text" id="usu_segundo_apellido" name="usu_segundo_apellido" class="form-control" placeholder="Segundo Apellido" value="<?php echo $usu['usu_segundo_ape']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_segundo_apellido"></div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Correo y Teléfono -->
                <div class="col-md-6 mb-3">
                    <label for="usu_correo">Correo Electrónico</label>
                    <input type="email" id="usu_correo" name="usu_correo" class="form-control" placeholder="Correo Electrónico" value="<?php echo $usu['usu_correo']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_correo"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usu_telefono">Teléfono</label>
                    <input type="text" id="usu_telefono" name="usu_telefono" class="form-control" placeholder="Teléfono" value="<?php echo $usu['usu_num_cel']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_telefono"></div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Clave y Confirmar Clave -->
                <div class="col-md-6 mb-3">
                    <label for="usu_clave">Clave</label>
                    <input type="password" id="usu_clave" name="usu_clave" class="form-control" placeholder="Clave" value="<?php echo $usu['usu_clave']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_clave"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="confirmar_clave">Confirmar Clave</label>
                    <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" placeholder="Confirmar Clave"  value="<?php echo $usu['usu_clave']; ?>" autocomplete="off">
                    <div class="text-danger" id="error_confirmar_clave"></div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Dirección -->
                <div class="col-md-6 mb-3">
                    <label for="carrera">Carrera</label>
                    <input type="text" name="carrera" class="form-control" id="carrera" placeholder="Carrera" value="<?php echo $usu['usu_carrera']; ?>" autocomplete="off">
                    <div id="error_carrera" class="text-danger"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="calle">Calle</label>
                    <input type="text" name="calle" class="form-control" id="calle" placeholder="Calle" value="<?php echo $usu['usu_calle']; ?>" autocomplete="off">
                    <div id="error_calle" class="text-danger"></div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label for="numero_adicional">Número Adicional</label>
                    <input type="text" name="numero_adicional" class="form-control" id="numero_adicional" placeholder="Número Adicional" value="<?php echo $usu['usu_num_adicional']; ?>" autocomplete="off">
                    <div id="error_numero_adicional" class="text-danger"></div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Complemento (Apartamento, Casa, Local)" value="<?php echo $usu['usu_complemento']; ?>" autocomplete="off">
                    <div id="error_complemento" class="text-danger"></div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <label for="barrio">Barrio</label>
                    <input type="text" name="barrio" class="form-control" id="barrio" placeholder="Barrio" value="<?php echo $usu['usu_barrio']; ?>" autocomplete="off">
                    <div id="error_barrio" class="text-danger"></div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Rol -->
                <div class="col-md-6 mb-3">
                    <label for="rol_id">Rol</label>
                    <select name="rol_id" id="rol_id" class="form-select">
                        <?php
                            foreach ($roles as $rol) {
                                $selected = ($usu['rol_id'] == $rol['rol_id']) ? "selected" : "";
                                echo "<option value='" . $rol['rol_id'] . "' $selected>" . $rol['rol_nombre'] . "</option>";
                            }
                        ?>
                    </select>
                    <div class="text-danger" id="error_rol_id"></div>
                </div>

                <!-- Estado -->
                <div class="col-md-6 mb-3">
                    <label for="estado_id">Estado</label>
                    <select name="estado_id" id="estado_id" class="form-select">
                        <?php
                            foreach ($estados as $est) {
                                $selected = ($usu['estado_id'] == $est['estado_id']) ? "selected" : "";
                                echo "<option value='" . $est['estado_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
                            }
                        ?>
                    </select>
                    <div class="text-danger" id="error_estado_id"></div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-success">Actualizar Usuario</button>
            </div>
        </form>
    </div>
    <?php
        }   
    ?>
</div>



