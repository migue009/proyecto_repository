<div class = "mt-5">
    <h3 class = "display-4"> Registrar Usuario</h3>
</div>
<div class="mt-5">
    <form action ="<?php echo getUrl("Administrador","Administrador","postCreate"); ?>"method ="post" id="form">
        <div class = "row mt-5">
            <div class = "col mt-4">
                <label for="usu_primer_nombre">Primer Nombre</label>
                <input type="text" id="primer_nombre" name="usu_primer_nombre" class="form-control" placeholder="primer nombre">
            </div>
            <div class = "col mt-4">
                <label for="usu_segundo_nombre">Segundo Nombre</label>
                <input type="text" id="segundo_nombre" name="usu_segundo_nombre" class="form-control" placeholder="segundo nombre">
            </div>
            <div class = "col mt-4">
                <label for="usu_primer_apellido">Primer Apellido</label>
                <input type="text" id="primer_apellido" name="usu_primer_apellido" class="form-control" placeholder="primer apellido">
            </div>
            <div class = "col mt-4">
                <label for="usu_segundo_apellido">Segundo Apellido</label>
                <input type="text" id="segundo_apellido" name="usu_segundo_apellido" class="form-control" placeholder="segundo apellido">
            </div>
            <div class = "col mt-4">
                <label for="usu_correo">Correo</label>
                <input type="text" id="correo" name="usu_correo" class="form-control" placeholder="correo">
            </div>
            <div class = "col mt-4">
                <label for="usu_clave">Clave</label>
                <input type="text" id="clave" name="usu_clave" class="form-control" placeholder="clave">
            </div>
            <div class = "col mt-4">
                <label for="rol_id">Rol</label>
                <select name="rol_id" id="" class="form-control">
                    <option value="">Seleccione...</option>
                    <?php
                        foreach ($roles as $rol) {
                            echo "<option value='" . $rol['rol_id'] . "'>" . $rol['rol_nombre'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class = "col mt-4">
                <label for="usu_telefono">Telefono</label>
                <input type="text" id="telefono" name="usu_telefono" class="form-control" placeholder="telefono">
            </div>
            <div class = "col mt-4">
                <label for="usu_direccion">Direccion</label>
                <input type="text" id="direccion" name="usu_direccion" class="form-control" placeholder="direccion">
            </div>
        </div>
        <div class = "mt-5">
            <input type="submit" value ="Enviar" class ="btn btn-success"> 
        </div>
    </form>
</div>
