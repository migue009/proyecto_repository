<?php 
    include_once '../lib/helpers.php';
    if(isset($_GET['modulo'])){
        resolve();
    }    
  //Esta utilizando el archivo ajax como un puente  para comunicarse con el helpers  
?>