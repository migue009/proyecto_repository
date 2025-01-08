<div class="container card">
    <div class="mt-5">
        <h3 class="display-4 text-center main-title">Crear Solicitud</h3>
    </div>
    <form action="<?php echo getUrl('Solicitud', 'Solicitud', 'postCreateSolicitud',false,'ajax'); ?>" method="post" id="crear-solicitud-form" class="form">
        <!-- Selección del tipo de solicitud -->
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="tipo_solicitud" id="label-dark">Tipo de Solicitud</label>
                <select name="tipo_solicitud" id="tipo_solicitud" class="form-select">
                    <option value="">Seleccione...</option>
                    <?php 
                        foreach ($tiposSolicitud as $tipo) {
                            echo "<option value='" . $tipo['tipo_reporte_id'] . "'>" . $tipo['tp_rep_nombre'] . "</option>";
                        }
                    ?>
                </select>
                <div class="text-danger" id="error_tipo_solicitud"></div>
            </div>
        </div>

        <!-- Selección del escenario -->
        <div class="row mt-4" id="div_escenario" style="display: none;">
            <div class="col-md-6 mb-3">
                <label for="escenario" id="label-dark">Escenario</label>
                <select name="escenario" id="escenario" class="form-select">
                    <option value="">Seleccione...</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="reparacion">Reparación</option>
                </select>
                <div class="text-danger" id="error_escenario"></div>
            </div>
        </div>

        <!-- Sección dinámica para cargar campos específicos según el tipo de solicitud -->
        <div id="formulario_adicional"></div>

        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success">Crear Solicitud</button>
        </div>
    </form>
</div>
