<!--2. Establecemos la conexion-->
<?php

class Connection{
    private $host;
    private $port;
    private $user;
    private $pass;
    private $database;
    private $link;

    function __construct(){
        $this->setconnect();
        $this->connect();
        
    }
    /*
    this metodos y atributos de esa misma clase;
    function esto es un metodo;
    class esto es una clase;
    private,public,protect es encapsulamiento, comportamiento...
    */

    /*ASIGNAR VALORES PARA LA CONEXION*/
    private function setconnect(){
        require_once 'conf.php';/*solicita un archivo si no muere*/

        $this->host=$host;
        $this->user=$user;
        $this->pass=$pass;
        $this->port=$port;
        $this->database=$database;
    }
    /*ESTABLECER LA CONEXION*/
    private function connect(){//host, user, pass, database
        //$this->link=mysqli_connect($this->host,$this->user,$this->pass,$this->database);
        $this->link=pg_connect("host=$this->host port=$this->port dbname=$this->database user=$this->user password=$this->pass");

        /*if($this->link){
            echo "Conexion Exitosa";
        }else{
            die('Error de conexión a PostgreSQL: ' . pg_last_error());
        }*/
    }
    /*RETORNAR LA CONEXION*/
    public function getConnect(){
        return $this->link;
    }
    /*CERRAR LA CONEXION*/
    public function close(){
        pg_close($this->link);
    }
}

?>