<?php
    //Inicializa las variables de sesion
    session_start();

    
    //un script sirve para la automatizacion de tareas a traves de una estructura de codigo
    function redirect($url){
        echo "<script type='text/javascript'>"."window.location.href='$url'"."</script>";
    }//Redirecciona a través de una url

    //La etiqueta pre sirve para acomodar algo de manera vertical, print r sirve para imprimir arreglos y variables
    function dd($var){
        echo "<pre>";
        die(print_r($var));
    }

    //modulo dentro de controlador = carpeta dentro de controlador y controlador va estar dentro de modulo, y la funcion dentro del controlador(queryString parametro, informacion que viaja a traves de la url)
    function getUrl($modulo, $controlador, $funcion, $parametros = false, $pagina = false) {

        if($pagina == false){
            $pagina = "index";
        }
        $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
        
        // False es opcional
        
        if ($parametros != false) {
            foreach ($parametros as $key => $value) {
                $url .= "&$key=$value"; 
            }
        }
    
        return $url;
    }// Arma la url a través de las carpetas.


    //Caso camello: Camel Case-> Nos sirve para leer un archivo que tiene palabras con mayusculas como separador

    function resolve(){
        //ucwords= convierte la primera letra en mayusculas
        $modulo=ucwords($_GET['modulo']);
        $controlador = ucwords($_GET['controlador']);
        $funcion= $_GET['funcion'];
        //Modulo= carpeta dentro de controlador
        //controlador= archivos dentro del modulo
        //funcion = metodo del controlador

        if(is_dir("../controller/$modulo")){ //valida si la carpeta modulo existe

            if(file_exists("../controller/$modulo/".$controlador."Controller.php")){//valida si el archivo controlador existe

                include_once  "../controller/$modulo/".$controlador."Controller.php";

                //El nombre de la clase tiene que ser igual al nombre del archivo
                
                $nombreClase = $controlador."Controller"; //TareaController
                $objClase = new $nombreClase();
                
                if(method_exists($objClase,$funcion)){
                    $objClase -> $funcion();
                }else{
                    echo "La funcion especificada no existe";
                }

            }else{
                echo "El controlador especificado no existe";
            }

        }else{
            echo "El modulo especificado no existe";
        }

    }

    function validarCampoLetras($input){
        $patron = "/^[a-zA-Z\s]+$/";
        return preg_match($patron,$input) === 1;
    }

    function validarCampoNumeros($input){
        $patron = "/^[0-9]+$/";
        return preg_match($patron,$input) === 1;
        // == compara valores === compara valores y tipo de datos
    }

    
    function validarCorreo($input){
        $patron = "/^[a-zA-Z][a-zA-Z0-9]{5,29}@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+\.[a-zA-Z]{2,6}$/";
        return preg_match($patron,$input) === 1;
    }

    function validarClave($input) {
        if (strlen($input) < 8) {
            return false;
        } 

        $patronMayus= "/[A-Z]/";
        $patronMinus= "/[a-z]/";
        $patronNum = "/[0-9]/";
        $patronsim = "/[!@#$%^&*-_+~]/";

        //regex son funciones que trabajan las expresiones regulares las mas comunes: 
        //preg_match compara el patron con el input
        //preg_replace("/palabra/","palabra de cambio",cadena) cambia el la palabra por una de cambio en una cadena
        //preg_split("/separador comun/", cadena)transforma en un array una cadena de texto separada por un separador comun
        if (preg_match($patronMayus, $input) && preg_match($patronMinus, $input) && preg_match($patronNum, $input) && preg_match($patronsim, $input)){

            return true;

        }
        
        return false;
    }
    
?>