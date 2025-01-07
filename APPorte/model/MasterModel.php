<?php
include_once '../lib/conf/connection.php';
/*Podemos decir que se puede trabajar un modulo cuando podemos hacer un CRUD */
class MasterModel extends Connection{

    public function insertUltimoId($sql) {
        $result = pg_query($this->getConnect(),$sql);
        $UltimoId = pg_fetch_result($result, 0, 0);  
        return $UltimoId;
    }

    public function insert($sql){
        $result = pg_query($this->getConnect(), $sql);

        return $result;
    }

    public function consult($sql) {
        $result = pg_query($this->getConnect(),$sql);

        return pg_fetch_all($result);
    }

    public function update($sql){
        $result = pg_query($this->getConnect(),$sql);
        // estamos llamando la conexion desde el metodo getConnect()

        return $result;
    }

    public function delete($sql){
        $result = pg_query($this->getConnect(),$sql);
        // estamos llamando la conexion desde el metodo getConnect()

        return $result;
    }

    // public function autoIncrement($field,$table){
    //     $sql = "SELECT $field FROM $table ORDER BY $field ASC";

    //     $result = pg_query($this->getConnect(),$sql);

    //     if ($result) {
    //         $ids = [];

    //         while ($row = pg_fetch_row($result)) {
    //             $ids[] = $row[0];
    //         }

    //         if (empty($ids)) {
    //             return 1;
    //         }

    //         $expectedId = 1;
    //         foreach ($ids as $id) {
    //             if ($id != $expectedId) {
    //                 // Encontramos el primer hueco y lo devolvemos.
    //                 return $expectedId;
    //             }
    //             $expectedId++;
    //         }
    //         return $expectedId;
    //     } else {
    //         // Si hay un error en la consulta, devolvemos el siguiente ID por defecto.
    //         return 1;
    //     }
    // }
}
?>