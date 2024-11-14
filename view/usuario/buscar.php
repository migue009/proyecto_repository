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
                        if(!empty($clase))echo "<button class='$clase' id='cambiar_estado_usuario' type ='button' data-url='".getUrl("Usuarios","Usuarios","postUpdateStatus",false,"ajax")."' data-id ='".$usu['estado_id']."' data-user ='".$usu['usu_id']."' >$texto</button>";
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
        echo "</tr>";
    }  
?>