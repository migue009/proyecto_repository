<div class = "mt-5">
    <h3 class="display-4 text-center">Registrar Usuario</h3>
</div>
<div class="container mt-5">
        <div class ='alert alert-danger d-none' role = 'alert' id="error">

        </div>
        <form action="<?php echo getUrl("Administrador", "Administrador", "postCreate"); ?>" method="post" id="form">
        <div class="row mt-4">
            <!-- tipo de documento y numero -->
             
            <div class="col-md-6 mb-3">
                <label for="usu_tipo_documento">Tipo de Documento</label>
                <select name="usu_tipo_documento" id="usu_tipo_documento" class="form-control">
                    <?php
                        foreach ($tipoDocu as $tipo) {
                            echo "<option value='" . $tipo['tipo_doc_id'] . "'>" . $tipo['tipo_doc_nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="usu_documento">Documento</label>
                <input type="text" id="usu_documento" name="usu_documento" class="form-control" placeholder="Número de documento">
            </div>
        </div>
        <div class="row mt-4">
            <!-- Primer nombre y segundo nombre -->
            <div class="col-md-6 mb-3">
                <label for="primer_nombre">Primer Nombre</label>
                <input type="text" id="primer_nombre" name="usu_primer_nombre" class="form-control" placeholder="Ingrese el primer nombre">
                <div class="text-danger" id="error_primer_nombre"></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" id="segundo_nombre" name="usu_segundo_nombre" class="form-control" placeholder="Ingrese el segundo nombre">
                <div class="text-danger" id="error_segundo_nombre"></div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Primer apellido y segundo apellido -->
            <div class="col-md-6 mb-3">
                <label for="primer_apellido">Primer Apellido</label>
                <input type="text" id="primer_apellido" name="usu_primer_apellido" class="form-control" placeholder="Ingrese el primer apellido">
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" id="segundo_apellido" name="usu_segundo_apellido" class="form-control" placeholder="Ingrese el segundo apellido">
            </div>
        </div>
        <div class="row mt-4">
            <!-- Correo y Teléfono -->
            <div class="col-md-6 mb-3">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="usu_correo" class="form-control" placeholder="correo@ejemplo.com">
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="usu_telefono" class="form-control" placeholder="Número de teléfono">
            </div>
        </div>
        <div class="row mt-4">
            <!-- Clave y confirmación -->
            <div class="col-md-6 mb-3">
                <label for="clave">Clave</label>
                <input type="password" id="clave" name="usu_clave" class="form-control" placeholder="Ingrese la clave">
            </div>
            <div class="col-md-6 mb-3">
                <label for="confirmar_clave">Confirmar Clave</label>
                <input type="password" id="confirmar_clave" name="confirmar_clave" class="form-control" placeholder="Confirme la clave">
            </div>
            <!-- Rol -->
            <div class="col-md-6 mb-3">
                <label for="rol_id">Rol</label>
                <select name="rol_id" class="form-control">
                    <option value="">Seleccione un rol</option>
                    <?php
                        foreach ($roles as $rol) {
                            echo "<option value='" . $rol['rol_id'] . "'>" . $rol['rol_nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt-4">
            <h1>dirección</h1>
            <!-- Carrera -->
            <div class="col-md-3 mb-3">
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" name="carrera" class="form-control" placeholder="Ej. 23">
            </div>
            <!-- Calle -->
            <div class="col-md-3 mb-3">
                <label for="calle">Calle</label>
                <input type="text" id="calle" name="calle" class="form-control" placeholder="Ej. 13">
            </div>
            <!-- Número Adicional -->
            <div class="col-md-3 mb-3">
                <label for="numero_adicional">Número Adicional</label>
                <input type="text" id="numero_adicional" name="numero_adicional" class="form-control" placeholder="Ej. 13A o 12-45" >
            </div>
            <!-- Complemento (Apartamento, Casa, Local) -->
            <div class="col-md-3 mb-3">
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento" class="form-control" placeholder="Ej. Apt 101, Casa 5" >
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Barrio -->
            <div class="col-md-6 mb-3">
                <label for="barrio">Barrio</label>
                <input type="text" id="barrio" name="barrio" class="form-control" placeholder="Ej. San Fernando">
            </div>
        
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success">Registrar</button>
        </div>
    </form>
    