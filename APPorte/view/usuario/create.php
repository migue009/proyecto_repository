<div class="container card">
    <div class="mt-5">
        <h3 class="display-4 text-center main-title">Registrar Usuario</h3>
    </div>
    <form action="<?php echo getUrl('Administrador', 'Administrador', 'postCreate'); ?>" method="post" id="registrar-admin-form" class="form">
        <div class="row mt-4">
            <!-- tipo de documento y numero -->
            <div class="col-md-6 mb-3">
                <label for="usu_tipo_documento" id="label-dark">Tipo de Documento</label>
                <select name="usu_tipo_documento" id="usu_tipo_documento" class="form-select">
                    <option value="">Seleccione...</option>
                    <?php
                        foreach ($tipoDocu as $tipo) {
                            echo "<option value='" . $tipo['tipo_documento_id'] . "'>" . $tipo['tip_doc_nombre'] . "</option>";
                        }
                    ?>
                </select>
                <div class="text-danger" id="error_usu_tipo_documento"></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="usu_documento" id="label-dark">Documento</label>
                <input type="text" id="usu_documento" name="usu_documento" class="form-control" placeholder="Número de documento">
                <div class="text-danger" id="error_usu_documento"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Primer nombre y segundo nombre -->
            <div class="col-md-6 mb-3">
                <label for="primer_nombre" id="label-dark">Primer Nombre</label>
                <input type="text" id="primer_nombre" name="usu_primer_nombre" class="form-control" placeholder="Ingrese el primer nombre">
                <div class="text-danger" id="error_primer_nombre"></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_nombre" id="label-dark">Segundo Nombre</label>
                <input type="text" id="segundo_nombre" name="usu_segundo_nombre" class="form-control" placeholder="Ingrese el segundo nombre">
                <div class="text-danger" id="error_segundo_nombre"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Primer apellido y segundo apellido -->
            <div class="col-md-6 mb-3">
                <label for="primer_apellido" id="label-dark">Primer Apellido</label>
                <input type="text" id="primer_apellido" name="usu_primer_apellido" class="form-control" placeholder="Ingrese el primer apellido">
                <div class="text-danger" id="error_primer_apellido"></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_apellido" id="label-dark">Segundo Apellido</label>
                <input type="text" id="segundo_apellido" name="usu_segundo_apellido" class="form-control" placeholder="Ingrese el segundo apellido">
                <div class="text-danger" id="error_segundo_apellido"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Correo y Teléfono -->
            <div class="col-md-6 mb-3">
                <label for="correo" id="label-dark">Correo Electrónico</label>
                <input type="text" id="correo" name="usu_correo" class="form-control" placeholder="correo@ejemplo.com">
                <div class="text-danger" id="error_correo"></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono" id="label-dark">Teléfono</label>
                <input type="text" id="telefono" name="usu_telefono" class="form-control" placeholder="Número de teléfono">
                <div class="text-danger" id="error_telefono"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Clave y confirmación -->
            <div class="col-md-6 mb-3">
                <label for="clave" id="label-dark">Clave</label>
                <input type="password" id="clave" name="usu_clave" class="form-control" placeholder="Ingrese la clave">
                <div class="text-danger" id="error_clave"></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="confirmar_clave" id="label-dark">Confirmar Clave</label>
                <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" placeholder="Confirme la clave">
                <div class="text-danger" id="error_confirmar_clave"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- genero -->
            <div class="col-md-6 mb-3">
                <label for="genero" id="label-dark">Género</label>
                <select name="genero" id="genero" class="form-select">
                    <option value="">Seleccione...</option>
                    <?php
                        foreach ($genero as $gen) {
                            echo "<option value='" . $gen['sexo_id'] . "'>" . $gen['sexo_nombre'] . "</option>";
                        }
                    ?>
                </select>
                <div class="text-danger" id="error_genero"></div>
            </div>
            <!-- Rol -->
            <div class="col-md-6 mb-3">
                <label for="rol_id" id="label-dark">Rol</label>
                <select name="rol_id" id="rol_id" class="form-select">
                    <option value="">Seleccione...</option>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<option value='" . $rol['rol_id'] . "'>" . $rol['rol_nombre'] . "</option>";
                    }
                    ?>
                </select>
                <div class="text-danger" id="error_rol_id"></div>
            </div>
        </div>
        <div class="row mt-4">
            <h5 id="label-dark">Dirección</h5>
            <!-- Carrera -->
            <div class="col-md-3 mb-3">
                <label for="carrera" id="label-dark">Carrera</label>
                <input type="text" id="carrera" name="carrera" class="form-control" placeholder="Ej. 23">
                <div class="text-danger" id="error_carrera"></div>
            </div>
            <!-- Calle -->
            <div class="col-md-3 mb-3">
                <label for="calle" id="label-dark">Calle</label>
                <input type="text" id="calle" name="calle" class="form-control" placeholder="Ej. 13">
                <div class="text-danger" id="error_calle"></div>
            </div>
            <!-- Número Adicional -->
            <div class="col-md-3 mb-3">
                <label for="numero_adicional" id="label-dark">Número Adicional</label>
                <input type="text" id="numero_adicional" name="numero_adicional" class="form-control" placeholder="Ej. 13A o 12-45">
                <div class="text-danger" id="error_numero_adicional"></div>
            </div>
            <!-- Complemento (Apartamento, Casa, Local) -->
            <div class="col-md-3 mb-3">
                <label for="complemento" id="label-dark">Complemento</label>
                <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Ej. Apt 101, Casa 5">
                <div class="text-danger" id="error_complemento"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Barrio -->
            <div class="col-md-6 mb-3">
                <label for="barrio" id="label-dark">Barrio</label>
                <input type="text" id="barrio" name="barrio" class="form-control" placeholder="Ej. San Fernando">
                <div class="text-danger" id="error_barrio"></div>
            </div>
        </div>
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success">Registrar</button>
        </div>
    </form>
</div>
