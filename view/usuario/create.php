<div class="container mt-5">
    <h3 class="display-4 text-center">Registrar Usuario</h3>
    <form action="<?php echo getUrl("Administrador", "Administrador", "postCreate"); ?>" method="post" id="form">
        <div class="row mt-4">
            <!-- tipo de documento y numero -->
            <div class="col-md-6 mb-3">
                <label for="usu_tipo_documento">Tipo de Documento</label>
                <select name="usu_tipo_documento" id="usu_tipo_documento" class="form-control" required>
                    <option value="">Seleccione...</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="NUIP">NUIP</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="usu_documento">Documento</label>
                <input type="text" id="usu_documento" name="usu_documento" class="form-control" placeholder="Número de documento" required>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Primer nombre y segundo nombre -->
            <div class="col-md-6 mb-3">
                <label for="primer_nombre">Primer Nombre</label>
                <input type="text" id="primer_nombre" name="usu_primer_nombre" class="form-control" placeholder="Ingrese el primer nombre" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_nombre">Segundo Nombre</label>
                <input type="text" id="segundo_nombre" name="usu_segundo_nombre" class="form-control" placeholder="Ingrese el segundo nombre" required>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Primer apellido y segundo apellido -->
            <div class="col-md-6 mb-3">
                <label for="primer_apellido">Primer Apellido</label>
                <input type="text" id="primer_apellido" name="usu_primer_apellido" class="form-control" placeholder="Ingrese el primer apellido" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="segundo_apellido">Segundo Apellido</label>
                <input type="text" id="segundo_apellido" name="usu_segundo_apellido" class="form-control" placeholder="Ingrese el segundo apellido" required>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Correo y Teléfono -->
            <div class="col-md-6 mb-3">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="usu_correo" class="form-control" placeholder="correo@ejemplo.com" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="usu_telefono" class="form-control" placeholder="Número de teléfono" required>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Clave y Dirección -->
            <div class="col-md-6 mb-3">
                <label for="clave">Clave</label>
                <input type="password" id="clave" name="usu_clave" class="form-control" placeholder="Ingrese la clave" required>
            </div>
            <!-- Rol -->
            <div class="col-md-6 mb-3">
                <label for="rol_id">Rol</label>
                <select name="rol_id" class="form-control" required>
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
            <!-- Carrera -->
            <div class="col-md-3 mb-3">
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" name="carrera" class="form-control" placeholder="Ej. 23" required>
            </div>
            <!-- Calle -->
            <div class="col-md-3 mb-3">
                <label for="calle">Calle</label>
                <input type="text" id="calle" name="calle" class="form-control" placeholder="Ej. 13" required>
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
                <input type="text" id="barrio" name="barrio" class="form-control" placeholder="Ej. San Fernando" required>
            </div>
        
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success">Registrar</button>
        </div>
    </form>
</div>
