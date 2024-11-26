<div>
    <?php
        foreach($usuario as $usu){
    ?>
</div>
<div class="mt-5">
    <h3 class="display-4 text-center">Actualizar Usuario</h3>
</div>

<form action="<?php echo getUrl("Administrador", "Administrador", "postUpdate"); ?>" method="post" class="p-4 bg-light border rounded shadow-sm">
    <input type="hidden" name="usu_id" value="<?php echo $usu['usu_id']; ?>">

    <div class="row g-3">

        <!-- Tipo de Documento -->
        <div class="col-md-4">
            <label for="usu_tipo_documento" class="form-label">Tipo de Documento</label>
            <select name="usu_tipo_documento" class="form-select">
                <?php
                    foreach ($tipoDocu as $tipo) {
                        $selected = ($usu['usu_tipo_documento'] == $tipo['tipo_doc_id']) ? "selected" : "";
                        echo "<option value='" . $tipo['tipo_doc_id'] . "' $selected>" . $tipo['tipo_doc_nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <!-- Número de Documento -->
        <div class="col-md-4">
            <label for="usu_numero_documento" class="form-label">Número de Documento</label>
            <input type="text" name="usu_numero_documento" class="form-control" placeholder="Número de Documento" value="<?php echo $usu['usu_numero_documento']; ?>" required>
        </div>

        <!-- Primer Nombre -->
        <div class="col-md-4">
            <label for="usu_primer_nombre" class="form-label">Primer Nombre</label>
            <input type="text" name="usu_primer_nombre" class="form-control" placeholder="Primer Nombre" value="<?php echo $usu['usu_primer_nombre']; ?>" required>
        </div>

        <!-- Segundo Nombre -->
        <div class="col-md-4">
            <label for="usu_segundo_nombre" class="form-label">Segundo Nombre</label>
            <input type="text" name="usu_segundo_nombre" class="form-control" placeholder="Segundo Nombre" value="<?php echo $usu['usu_segundo_nombre']; ?>">
        </div>

        <!-- Primer Apellido -->
        <div class="col-md-4">
            <label for="usu_primer_apellido" class="form-label">Primer Apellido</label>
            <input type="text" name="usu_primer_apellido" class="form-control" placeholder="Primer Apellido" value="<?php echo $usu['usu_primer_apellido']; ?>" required>
        </div>

        <!-- Segundo Apellido -->
        <div class="col-md-4">
            <label for="usu_segundo_apellido" class="form-label">Segundo Apellido</label>
            <input type="text" name="usu_segundo_apellido" class="form-control" placeholder="Segundo Apellido" value="<?php echo $usu['usu_segundo_apellido']; ?>">
        </div>

        <!-- Correo -->
        <div class="col-md-4">
            <label for="usu_correo" class="form-label">Correo</label>
            <input type="email" name="usu_correo" class="form-control" placeholder="Correo" value="<?php echo $usu['usu_correo']; ?>" required>
        </div>

        <!-- Teléfono -->
        <div class="col-md-4">
            <label for="usu_telefono" class="form-label">Teléfono</label>
            <input type="text" name="usu_telefono" class="form-control" placeholder="Teléfono" value="<?php echo $usu['usu_telefono']; ?>">
        </div>

        <!-- Rol -->
        <div class="col-md-4">
            <label for="rol_id" class="form-label">Rol</label>
            <select name="rol_id" class="form-select">
                <?php
                    foreach ($roles as $rol) {
                        $selected = ($usu['rol_id'] == $rol['rol_id']) ? "selected" : "";
                        echo "<option value='" . $rol['rol_id'] . "' $selected>" . $rol['rol_nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <!-- Estado -->
        <div class="col-md-4">
            <label for="estado_id" class="form-label">Estado</label>
            <select name="estado_id" class="form-select">
                <?php
                    foreach ($estado as $est) {
                        $selected = ($usu['estado_id'] == $est['estado_id']) ? "selected" : "";
                        echo "<option value='" . $est['estado_id'] . "' $selected>" . $est['estado_nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>

    </div>

    <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success btn-lg">Actualizar Usuario</button>
    </div>
</form>
<?php
    }
?>