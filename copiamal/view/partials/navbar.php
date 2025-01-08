
<div class="container main-nav">  
    <div class="main-nav-start">
      <div class="main-title">
        <h4>Seguridad vial al alcance de tu mano</h4>
      </div>
    </div>
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
      </button>
      
      <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
        <span class="sr-only">Cambiar tema</span>
        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
      </button>
      <span class="user-greeting">
        <?php 
          if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
            echo "Hola, " . $_SESSION['nombre'] . " " . $_SESSION['apellido'];
          } else {
            echo "Hola, Invitado";
          }
        ?>
      </span>
      <div class="nav-user-dropdown">

        <button class="nav-user-btn gray-circle-btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="nav-user-img">
            <picture><source srcset="../img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>

        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="##">
            <i data-feather="user" aria-hidden="true"></i>
            <span>Perfil</span>
          </a></li>
          <li><a class="dropdown-item" href="##">
            <i data-feather="settings" aria-hidden="true"></i>
            <span>Configuracion</span>
          </a></li>
          <li><a class="dropdown-item danger" href="<?php echo getUrl("Acceso","Acceso","logout", false, "ajax"); ?>">
            <i data-feather="log-out" aria-hidden="true"></i>
            <span>Cerrar sesión</span>
          </a></li>
        </ul>
      </div>
    </div>
</div>