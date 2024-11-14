<div class = "mt-5">
    <h3 class = "display-4">Consultar Usuarios</h3>
</div>
<div class = "row">
    <div class = "col-md-4 mt-4 mb-5">
        <input type="text" name="buscar" id="buscar" class ="form-control" placeholder="buscar por Nombre o Correo" data-url ='<?php echo getUrl("Usuarios","Usuarios","buscar",false, "ajax");?>'>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Actualizar</th>
                <th>Eliminar</th>

            </tr>
        </thead>
        <tbody>
            <?php
                foreach($usuarios as $usu){
                    $clase="";
                    $texto="";
                    echo "<tr>";
                    echo "<td>".$usu['usu_id']."</td>";
                    echo "<td>".$usu['usu_nombre']." ".$usu['usu_apellido']."</td>";
                    echo "<td>".$usu['usu_correo']."</td>";
                    echo "<td>".$usu['rol_nombre']."</td>";
                    if($usu['estado_id']==1){
                        $clase="btn btn-danger";
                        $texto="Inhabilitar";
                    }else if($usu['estado_id']==2){
                        $clase="btn btn-success";
                        $texto="Habilitar";
                    }
                    echo "<td>";
                        if(!empty($clase))echo "<button type='button' class='$clase' id='cambiar_estado_usuario' data-url='".getUrl("Usuarios","Usuarios","postUpdateStatus",false,"ajax")."' data-id ='".$usu['estado_id']."' data-user ='".$usu['usu_id']."'>$texto</button>";
                    echo "</td>";
                    echo "<td>"
                            ."<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "'>"
                                ."<button class='btn btn-primary'>Editar</button>"
                            ."</a>"
                    ."</td>";
                    //Arreglo clave usu_id valor $usu[usu_id]
                    echo "<td>"
                        ."<a href='" . getUrl("Usuarios", "Usuarios", "getdelete" , array("usu_id" => $usu['usu_id'])). "'>"
                            ."<button class='btn btn-danger'>Eliminar</button>"
                    ."</a>"
                    ."</td>";
                }
            ?>
        </tbody>
    </table>
</div>
