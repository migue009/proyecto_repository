
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
      <span class="nav-user-greeting">
        <?php
          if (isset($_SESSION['nombre'])) {
            echo 'Hola, ' .$_SESSION['nombre'] .' '. $_SESSION['apellido']; // Mostramos el nombre de usuario
          } else {
            echo 'Hola, Invitado'; // En caso de no estar logueado
          }
        ?>
      </span>
      <div class="nav-user-dropdown">
        <button class="nav-user-btn gray-circle-btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="sr-only">Mi perfil</span>
          <span class="nav-user-img">
            <picture><source srcset="../img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="<?php echo getUrl('Administrador', 'Administrador', 'getPerfil'); ?>">
            <i data-feather="user" aria-hidden="true"></i>
            <span>Perfil</span>
          </a></li>
          <li><a class="dropdown-item" href="<?php echo getUrl('Pqrs', 'Pqrs', 'getConsult'); ?>">
            <i data-feather="mail" aria-hidden="true"></i>
            <span>Mensajes</span>
          </a></li>
          <li><a class="dropdown-item danger" href="<?php echo getUrl("Acceso","Acceso","logout", false, "ajax"); ?>">
            <i data-feather="log-out" aria-hidden="true"></i>
            <span>Cerrar sesión</span>
          </a></li>
          
        </ul>
      </div>
    </div>
</div>

  <script>
    // Selecciona el botón del dropdown
  const dropdownButton = document.querySelector('.nav-user-btn');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  // Cuando se hace clic en el botón, alterna la clase 'show'
  dropdownButton.addEventListener('click', function() {
    dropdownMenu.parentElement.classList.toggle('show');
  });

  // Si se hace clic fuera del dropdown, ciérralo
  document.addEventListener('click', function(event) {
    if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
      dropdownMenu.parentElement.classList.remove('show');
    }
  });
  </script>