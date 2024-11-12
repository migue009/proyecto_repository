<?php
include_once '../lib/conf/connection.php';
/*Podemos decir que se puede trabajar un modulo cuando podemos hacer un CRUD */
class MasterModel extends Connection{

    public function insert($sql){
        $result = mysqli_query($this->getConnect(),$sql);
        // estamos llamando la conexion desde el metodo getConnect()

        return $result;
    }

    public function consult($sql){
        $result = mysqli_query($this->getConnect(), $sql);
        
        return $result;
    }

    public function update($sql){
        $result = mysqli_query($this->getConnect(),$sql);
        // estamos llamando la conexion desde el metodo getConnect()

        return $result;
    }

    public function delete($sql){
        $result = mysqli_query($this->getConnect(),$sql);
        // estamos llamando la conexion desde el metodo getConnect()

        return $result;
    }

    public function autoIncrement($field,$table){
        $sql = "SELECT MAX($field) FROM $table";

        $result = mysqli_query($this->getConnect(),$sql);

        $resp = mysqli_fetch_row($result); //convierte la variable en un arreglo, row contiene en su indice números enteros  y assoc contiene en sus indices palabras claves.
        
        return $resp[0]+1;
    }
}
?>