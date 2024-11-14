<div>

    <?php
        foreach($usuarios as $usu){
    ?>
</div>

<div class = "mt-5">
    <h3 class = "display-4"> Actualizar Usuario</h3>
</div>
<form action ="<?php echo getUrl("Usuarios","Usuarios","postUpdate"); ?>"method ="post">
    <input type="hidden" name="usu_id" value="<?php echo $usu['usu_id']; ?>">
    <div class = "row mt-5">
        <div class = "col mt-4">
            <label for="usu_nombre">Nombre</label>
            <input type="text" name="usu_nombre" class="form-control" placeholder="Nombre" value="<?php echo $usu['usu_nombre'] ?>">
        </div>
        <div class = "col mt-4">
            <label for="usu_apellido">Apellido</label>
            <input type="text" name="usu_apellido" class="form-control" placeholder="Apellido" value="<?php echo $usu['usu_apellido'] ?>">
        </div>
        <div class = "col mt-4">
            <label for="usu_correo">Correo</label>
            <input type="text" name="usu_correo" class="form-control" placeholder="Correo" value="<?php echo $usu['usu_correo'] ?>">
        </div>
        <div class = "col mt-4">
            <label for="rol_id">Rol</label>
            <select name="rol_id" id="" class="form-control">
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
        <div class = "col mt-4">
            <label for="estado_id">Estado</label>
            <select name="estado_id" id="" class="form-control">
                <?php
                
                    foreach ($estado as $est) {
                        if($usu['estado_id'] == $est['estado_id']){
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        echo "<option value='" . $est['estado_id'] . "'$selected>" . $est['estado_nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class = "mt-5">
        <input type="submit" value ="Enviar" class ="btn btn-success"> 
    </div>
</form>
<?php
    }
?>