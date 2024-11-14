<?php
//incluimos la lib
include_once '../lib/helpers.php';
//inluimos la cabeza
    include_once '../view/partials/header.php';
    // if (!isset($_SESSION['auth'])) {
    //     redirect('login.php');
    // }
    echo "<body>";
        echo "<div class='wrapper'>";
        //incluimos el sidebar
            include_once '../view/partials/sidebar.php';
            //panel principal
            echo "<div class ='main-panel'>";
                //incluimos en navbar
                include_once '../view/partials/navbar.php';
                echo "<div class='container'>";
                    echo "<div class='page-inner'>";
                    if(isset($_GET['modulo'])){
                        resolve();
                    }else{
                        include_once '../view/partials/content.php';
                    }
                    echo "</div>";
                echo "</div>";
                include_once '../view/partials/footer.php';
        echo "</div>";
        include_once '../view/partials/scripts.php';
    echo "</body>";
    echo "</html>";
?>
