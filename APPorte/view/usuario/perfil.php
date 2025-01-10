<div>
    <?php
        foreach($usuario as $usu) {
    ?>
</div>
<div class="container card">
    <div class="mt-5">
        <h3 class="text-center">Mi Perfil</h3>
    </div>
    <form action="<?php echo getUrl('Usuario', 'Usuario', 'postActualizarPerfil'); ?>" method="post" id="perfil-form">
        <input type="hidden" name="usu_id" value="<?php echo $usu['usuario_id']; ?>">

        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="usu_primer_nombre">Primer Nombre</label>
                <input type="text" id="usu_primer_nombre" name="usu_primer_nombre" class="form-control" value="<?php echo $usu['usu_primer_nom']; ?>" autocomplete="off">
            </div>
            <div class="col-md-6 mb-3">
                <label for="usu_segundo_nombre">Segundo Nombre</label>
                <input type="text" id="usu_segundo_nombre" name="usu_segundo_nombre" class="form-control" value="<?php echo $usu['usu_segundo_nom']; ?>" autocomplete="off">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="usu_primer_apellido">Primer Apellido</label>
                <input type="text" id="usu_primer_apellido" name="usu_primer_apellido" class="form-control" value="<?php echo $usu['usu_primer_ape']; ?>" autocomplete="off">
            </div>
            <div class="col-md-6 mb-3">
                <label for="usu_segundo_apellido">Segundo Apellido</label>
                <input type="text" id="usu_segundo_apellido" name="usu_segundo_apellido" class="form-control" value="<?php echo $usu['usu_segundo_ape']; ?>" autocomplete="off">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="usu_email">Correo Electrónico</label>
                <input type="email" id="usu_email" name="usu_email" class="form-control" value="<?php echo $usu['usu_correo']; ?>" autocomplete="off">
            </div>
            <div class="col-md-6 mb-3">
                <label for="usu_telefono">Teléfono</label>
                <input type="text" id="usu_telefono" name="usu_telefono" class="form-control" value="<?php echo $usu['usu_num_cel']; ?>"autocomplete="off">
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
            <div class="col-md-6 mb-3">
                <label for="usu_genero">Género</label>
                <select name="usu_genero" id="usu_genero" class="form-select">
                    <?php
                        foreach ($genero as $gen) {
                            if($usu['sex_id'] == $gen['sexo_id']){
                                $selected = "selected";
                            }else{
                                $selected = "";
                            }
                            echo "<option value='" . $gen['sexo_id'] . "'$selected>" . $gen['sexo_nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="usu_rol">Rol</label>
                <select name="usu_rol" id="usu_rol" class="form-select">
                    <?php
                        foreach ($roles as $rol) {
                            if($usu['rol_id'] == $rol['rol_id']){
                                $selected = "selected";
                            }else{
                                $selected = "";
                            }
                            echo "<option value='" . $rol['rol_id'] . "'$selected>" . $rol['rol_nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success">Actualizar Perfil</button>
        </div>
    </form>
</div>
<div>
    <?php
        }
    ?>
</div>
