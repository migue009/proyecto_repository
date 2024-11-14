<div>

    <?php
        foreach($usuarios as $usu){
    ?>
</div>

<div class = "mt-5">
    <h3 class = "display-4"> Eliminar Usuario</h3>
</div>
<form action ="<?php echo getUrl("Usuarios","Usuarios","postDelete"); ?>"method ="post">
    <input type="hidden" name="usu_id" value="<?php echo $usu['usu_id']; ?>">
    <div class = "row mt-5">
        <div class = "col mt-4">
            <label for="usu_nombre">Nombre</label>
            <input type="text" name="usu_nombre" class="form-control" placeholder="Usuario" value="<?php echo $usu['usu_nombre'] ?>"readonly class="form-control">
        </div>
        <div class = "col mt-4">
            <label for="usu_apellido">Apellido</label>
            <input type="text" name="usu_apellido" class="form-control" placeholder="Usuario" value="<?php echo $usu['usu_apellido'] ?>"readonly class="form-control">
        </div>
        <div class = "col mt-4">
            <label for="usu_correo">Correo</label>
            <input type="text" name="usu_correo" class="form-control" placeholder="Usuario" value="<?php echo $usu['usu_correo'] ?>"readonly class="form-control">
        </div>
        <div class = "col mt-4">
            <label for="usu_clave">Clave</label>
            <input type="text" name="usu_clave" class="form-control" placeholder="Usuario" value="<?php echo $usu['usu_clave'] ?>"readonly class="form-control">
        </div>
    </div>
    <div class = "mt-5">
        <input type="submit" value ="Enviar" class ="btn btn-success"> 
    </div>
</form>
<?php
    }
?>