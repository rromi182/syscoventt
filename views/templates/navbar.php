<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo BASE_URL; ?>Home" class="nav-link">Inicio</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>-->

    <!-- Notifications Dropdown Menu -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notificaciones</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 nuevos mensajes
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 solicitudes de amistad
          <span class="float-right text-muted text-sm">12 horas</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 nuevos reportes
          <span class="float-right text-muted text-sm">2 días</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
      </div>
    </li>-->

    <!-- User Menu -->
    <!-- User Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <!-- Verificar SI EXISTE la sesión antes de mostrar -->
        <?php if (isset($_SESSION['foto']) && !empty($_SESSION['foto'])): ?>
          <img src="<?php echo BASE_URL; ?>assets/img/<?php echo $_SESSION['foto']; ?>"
            class="img-circle"
            style="width: 30px; height: 30px; object-fit: cover;">
        <?php else: ?>
          <img src="<?php echo BASE_URL; ?>assets/img/user-photo.png"
            class="img-circle"
            style="width: 30px; height: 30px; object-fit: cover;">
        <?php endif; ?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
           <!-- Verificar SI EXISTE la sesión -->
           <?php if (isset($_SESSION['foto']) && !empty($_SESSION['foto'])): ?>
            <img src="<?php echo BASE_URL; ?>assets/img/<?php echo $_SESSION['foto']; ?>"
              class="img-circle mr-2"
              style="width: 50px; height: 50px; object-fit: cover;">
            <?php echo $_SESSION['nombre_completo']; ?>
          <?php else: ?>
            <img src="<?php echo BASE_URL; ?>assets/img/user-photo.png"
              class="img-circle mr-2"
              style="width: 50px; height: 50px; object-fit: cover;">
            <?php echo $_SESSION['nombre_completo']?? 'Usuario'; ?>
          <?php endif; ?>
        </span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Perfil
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-cog mr-2"></i> Configuración
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo BASE_URL; ?>Usuarios/logout" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
        </a>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->