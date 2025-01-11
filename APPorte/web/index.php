<?php

include_once '../lib/helpers.php';

    if (!isset($_SESSION['auth'])) {
        redirect('login.php');
    }
    echo"<body>";
     include_once "../view/partials/header.php";
     echo "<div class = 'layer'>"; echo "</div>";
        echo "<div class = 'page-flex'>";
            echo "<aside class = 'sidebar'>";
            include_once "../view/partials/sidebar.php";
            echo "</aside>";


                echo "<div class= 'main-wrapper'>";

                        echo "<nav class= 'main-nav--bg'>";
                            include_once "../view/partials/navbar.php";
                            echo "<main class = 'main users chart-page' id = 'skip-target'>";
                                if (isset($_GET['modulo'])) {
                                    resolve();
                                }else{
                                    include_once "../view/partials/content.php";
                                }
                            echo "</main>";
                        echo "</nav>";
                        echo "<footer class = 'footer'>";
                                include_once "../view/partials/footer.php";
                        echo "</footer>";
                echo "</div>";
        echo "<div>";
        include_once "../view/partials/scripts.php";
    echo"</body>";

?>