<div>

    <?php
        foreach($usuario as $usu){
    ?>
</div>
<div class="mt-5">
    <h3 class="display-4">Eliminar Usuario</h3>
</div>

<form action="<?php echo getUrl("Administrador", "Administrador", "postDelete"); ?>" method="post">
    <input type="hidden" name="usu_id" value="<?php echo $usu['usu_id']; ?>">

    <div class="row mt-5">
        <div class="col mt-4">
            <label for="usu_tipo_documento">Tipo Documento</label>
            <input type="text" name="usu_tipo_documento" class="form-control" placeholder="Tipo Documento" value="<?php echo $usu['tipo_doc_nombre']; ?>" readonly class="form-control">
        </div>
        <div class="col mt-4">
            <label for="usu_documento">Número Documento</label>
            <input type="text" name="usu_documento" class="form-control" placeholder="Número Documento" value="<?php echo $usu['usu_numero_documento']; ?>" readonly class="form-control">
        </div>
        <div class="col mt-4">
            <label for="usu_nombre">Nombre</label>
            <input type="text" name="usu_nombre" class="form-control" placeholder="Nombre" value="<?php echo $usu['usu_primer_nombre'] . " " . $usu['usu_segundo_nombre']; ?>" readonly class="form-control">
        </div>
        <div class="col mt-4">
            <label for="usu_apellido">Apellido</label>
            <input type="text" name="usu_apellido" class="form-control" placeholder="Apellido" value="<?php echo $usu['usu_primer_apellido'] . " " . $usu['usu_segundo_apellido']; ?>" readonly class="form-control">
        </div>
    </div>

    <div class="row mt-5">
        <div class="col mt-4">
            <label for="usu_correo">Correo</label>
            <input type="text" name="usu_correo" class="form-control" placeholder="Correo" value="<?php echo $usu['usu_correo']; ?>" readonly class="form-control">
        </div>
        <div class="col mt-4">
            <label for="usu_telefono">Teléfono</label>
            <input type="text" name="usu_telefono" class="form-control" placeholder="Teléfono" value="<?php echo $usu['usu_telefono']; ?>" readonly class="form-control">
        </div>
        <div class="col mt-4">
            <label for="usu_rol">Rol</label>
            <input type="text" name="usu_rol" class="form-control" placeholder="Rol" value="<?php echo $usu['rol_nombre']; ?>" readonly class="form-control">
        </div>
    </div>

    <div class="row mt-5">
        <div class="col mt-4">
            <label for="usu_estado">Estado</label>
            <input type="text" name="usu_estado" class="form-control" placeholder="Estado" value="<?php echo $usu['estado_nombre']; ?>" readonly class="form-control">
        </div>
    </div>

    <div class="mt-5">
        <p class="text-warning">¿Está seguro de que desea eliminar a este usuario?</p>
        <input type="submit" value="Eliminar Usuario" class="btn btn-danger">
    </div>
</form>
<?php
    }
?>