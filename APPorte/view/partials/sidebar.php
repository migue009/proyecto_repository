<div class="sidebar-start">
        <div class="sidebar-head">
            <a class="logo-wrapper">
                <span class="sr-only"></span>
                <img src="../view/partials/apportepng.png" alt="la foto" width="53px" height="65px">
                <div class="logo-text">
                    <span class="logo-title">APPorte</span>
                </div>
            </a>
            <button class="sidebar-toggle transparent-btn" type="button" onclick="toggleSidebar()">
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <span class="system-menu__title">Herramientas</span>
            <ul class="sidebar-body-menu">
                <ul class="cat-sub-menu">
                </ul>
                <li>
                    <a href="index.php">
                        <span class="icon home" aria-hidden="true"></span>Inicio
                    </a>
                </li>
                <li>
                    <a href="<?php echo getUrl('Solicitud','Solicitud','getCreateSolicitud');?>">
                        <span class="icon folder" aria-hidden="true"></span>Solicitudes
                    </a>
                </li>
                <li>
                    <a href="<?php echo getUrl('Administrador','Administrador','getUsuarios');?>">
                        <span class="icon user-3" aria-hidden="true"></span>Administrar usuarios
                    </a>
                </li>
                <li>
                    <a href="<?php echo getUrl('Pqrs', 'Pqrs', 'getCreate'); ?>">
                        <span class="icon" data-feather="clipboard" aria-hidden="true"></span>PQRS
                    </a>
                </li>
            </ul>
        </div>
    </div>