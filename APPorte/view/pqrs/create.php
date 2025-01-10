<div>
    <?php
        foreach($usuario as $usu) {
    ?>
</div>
<div class="container card">
    <div class="mt-5">
        <h3 class="display-4 text-center main-title">Registrar PQRS</h3>
    </div>
    <form action="<?php echo getUrl('Pqrs', 'Pqrs', 'postCreate'); ?>" method="post" id="registrar-pqrs-form" class="form">
        <div class="row mt-4">
            <!-- Tipo de solicitud -->
            <div class="col-md-6 mb-3">
                <label for="tipo_solicitud" id="label-dark">Tipo de Solicitud</label>
                <select name="tipo_solicitud" id="tipo_solicitud" class="form-select" autocomplete="off">
                    <option value="">Seleccione...</option>
                    <?php
                        foreach ($tipos_pqrs as $pqrs) {
                            echo "<option value='" . $pqrs['tipo_pqrs_id'] . "'>" . $pqrs['tip_pqrs_nombre'] . "</option>";
                        }
                    ?>
                </select>
                <div class="text-danger" id="error_tipo_solicitud"></div>
            </div>
            <!-- Descripción -->
            <div class="col-md-12 mb-3">
                <label for="descripcion" id="label-dark">Descripción</label>
                <textarea id="descripcion" name="pqrs_mensaje" class="form-control" placeholder="Describa su solicitud, queja, reclamo o sugerencia" rows="4" autocomplete="off"></textarea>
                <div class="text-danger" id="error_descripcion"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Usuario -->
            <div class="col-md-6 mb-3">
                <label for="usuario_id" id="label-dark">Usuario</label>
                <input type="text" name="usuario_id" id="usuario_id" class="form-control" value="<?php echo $usu['usu_primer_nom']." ".$usu['usu_segundo_nom']; ?>" readonly>
            </div>
        </div>
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success">Registrar PQRS</button>
        </div>
    </form>
</div>
<div>
    <?php
        }
    ?>
</div>