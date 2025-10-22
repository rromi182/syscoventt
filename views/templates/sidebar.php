<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo BASE_URL; ?>Dashboard" class="brand-link">
    <img src="<?php echo BASE_URL; ?>assets/img/logo-syscovent.png" alt="SyscoVent Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SyscoVent</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo BASE_URL; ?>assets/img/<?php echo $_SESSION['foto'] ?? 'user-photo.png'; ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo BASE_URL; ?>Dashboard" class="d-block"><?php echo $_SESSION['username'] ?? 'Usuario'; ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?php echo BASE_URL; ?>Dashboard" class="nav-link <?php echo ($data['page'] ?? '') == 'dashboard' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Panel de control</p>
          </a>
        </li>

        <!-- Usuarios -->
        <?php if (PermisosHelper::tienePermiso(PERMISO_ADMIN_USUARIOS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo ($data['page'] ?? '') == 'usuarios' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Usuarios
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>Usuarios" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gestión de Usuarios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>Usuarios/roles" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permisos</p>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        <!-- COMPRAS -->
        <!-- MOVIMIENTOS -->
        <li class="nav-header">MOVIMIENTOS</li>
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Compras
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- Operaciones de Auxiliar -->
            <?php if (PermisosHelper::tienePermiso(PERMISO_REGISTRAR_PEDIDO_COMPRA) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>PedidosCompras" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pedido de Compra</p>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if (PermisosHelper::tienePermiso(PERMISO_REGISTRAR_PRESUPUESTO) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Presupuesto de Compra</p>
              </a>
            </li>
            <?php endif; ?>
            <!-- Operaciones de Jefe -->
            <?php if (PermisosHelper::tienePermiso(PERMISO_GENERAR_ORDEN_COMPRA) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orden de Compra</p>
              </a>
            </li>
            <?php endif; ?>
            <!-- Operaciones de Auxiliar -->
            <?php if (PermisosHelper::tienePermiso(PERMISO_REGISTRAR_FACTURAS_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registrar Factura</p>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if (PermisosHelper::tienePermiso(PERMISO_REGISTRAR_NC_ND_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nota Crèdito/Dèbito</p>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if (PermisosHelper::tienePermiso(PERMISO_REGISTRAR_REMISION_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nota de Remisión</p>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if (PermisosHelper::tienePermiso(PERMISO_AJUSTAR_STOCK) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ajustar Stock</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>

        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_VENTAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <!-- Ventas -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
              Ventas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Apertura/Cierre Caja</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registrar Venta</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gestionar Cobranza</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nota Débito/Crédito</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nota Remisión</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Arqueo Caja</p>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>

        
        <!-- Articulos -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>
              Articulos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <?php if (PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL) || PermisosHelper::tienePermiso(PERMISO_VER_COMPRAS)) : ?>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>Articulos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Articulos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>Categorias" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorías</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>Marcas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Marcas</p>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        <!-- REFERENCIALES -->
        <li class="nav-header">REFERENCIALES</li>
        <?php if (PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Compras
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ciudades</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Departamentos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Proveedores</p>
              </a>
            </li>

          </ul>
        </li>
        <?php endif; ?>

        <!-- Informes -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Informes</p>
          </a>
        </li>

        

        <!-- Configuración -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Manual de Usuario</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>