<?php
// Incluir el header
include 'views/templates/header.php';
?>

<!-- Navbar -->
<?php include 'views/templates/navbar.php'; ?>

<!-- Main Sidebar Container -->
<?php include 'views/templates/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard - SyscoVent</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>Home">Inicio</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat boxes) -->
      <div class="row">
        <!-- Compras Pendientes -->
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-light border">
            <div class="inner">
              <h3 id="compras-pendientes">0</h3>
              <p>Compras Pendientes</p>
            </div>
            <div class="icon text-primary">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="<?php echo BASE_URL; ?>Compras/pendientes" class="small-box-footer">
              Ver Compras <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>

        <!-- Ventas Hoy -->
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_VENTAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-light border">
            <div class="inner">
              <h3 id="ventas-hoy">0</h3>
              <p>Ventas de Hoy</p>
            </div>
            <div class="icon text-success">
              <i class="fas fa-receipt"></i>
            </div>
            <a href="<?php echo BASE_URL; ?>Ventas" class="small-box-footer">
              Ver Ventas <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>

        <!-- Caja Abierta -->
        <?php if (PermisosHelper::tieneAlgunPermiso([PERMISO_APERTURA_CAJA, PERMISO_CIERRE_CAJA, PERMISO_GENERAR_ARQUEO_CAJA]) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-light border">
            <div class="inner">
              <h3 id="monto-caja">₲0</h3>
              <p>Caja Activa</p>
            </div>
            <div class="icon text-warning">
              <i class="fas fa-cash-register"></i>
            </div>
            <a href="<?php echo BASE_URL; ?>Caja" class="small-box-footer">
              Ir a Caja <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>
        <!-- Stock Mínimo -->
        <?php if (PermisosHelper::tienePermiso(PERMISO_AJUSTAR_STOCK) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-light border">
            <div class="inner">
              <h3 id="stock-minimo">0</h3>
              <p>Articulos Stock Mínimo</p>
            </div>
            <div class="icon text-danger">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="<?php echo BASE_URL; ?>Inventario" class="small-box-footer">
              Ver Stock <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- Main content row -->
      <div class="row">
        <!-- MÓDULO COMPRAS -->
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-light">
              <h3 class="card-title text-dark">
                <i class="fas fa-shopping-cart mr-2 text-primary"></i>MÓDULO DE COMPRAS
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/nuevo-pedido" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Pedido de Compra
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/presupuesto" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-file-alt mr-2"></i>Presupuesto Proveedor
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/ordenes" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-clipboard-check mr-2"></i>Órdenes de Compra
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/factura" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-file-invoice mr-2"></i>Registrar Factura
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/notas" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-sticky-note mr-2"></i>Notas Crédito/Débito
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/remision" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-truck-loading mr-2"></i>Notas de Remisión
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/ajustes" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-boxes mr-2"></i>Ajustes de Stock
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Compras/informes" class="btn btn-outline-primary btn-block btn-hover">
                    <i class="fas fa-chart-bar mr-2"></i>Informes de Compras
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <!-- MÓDULO VENTAS - FACTURACIÓN - CAJA -->
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_VENTAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-light">
              <h3 class="card-title text-dark">
                <i class="fas fa-cash-register mr-2 text-success"></i>MÓDULO VENTAS - FACTURACIÓN - CAJA
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Caja/apertura" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-lock-open mr-2"></i>Apertura de Caja
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Ventas/nueva-factura" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-file-invoice mr-2"></i>Registrar Factura
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Caja/cobranzas" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-hand-holding-usd mr-2"></i>Gestión Cobranzas
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Ventas/notas" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-sticky-note mr-2"></i>Notas Crédito/Débito
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Ventas/remision" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-shipping-fast mr-2"></i>Nota de Remisión
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Caja/arqueo" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-calculator mr-2"></i>Arqueo de Caja
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Caja/cierre" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-lock mr-2"></i>Cierre de Caja
                  </a>
                </div>

                <div class="col-sm-6 col-12 mb-3">
                  <a href="<?php echo BASE_URL; ?>Ventas/informes" class="btn btn-outline-success btn-block btn-hover">
                    <i class="fas fa-chart-line mr-2"></i>Informes de Ventas
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- Quick Stats Row -->
      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-light">
              <h3 class="card-title">Cuentas por Pagar</h3>
            </div>
            <div class="card-body text-center">
              <h2 class="text-primary">₲<span id="cuentas-pagar">0</span></h2>
              <p class="text-muted">Total Pendiente</p>
              <a href="<?php echo BASE_URL; ?>Compras/cuentas-pagar" class="btn btn-outline-primary btn-sm">Ver Detalles</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-light">
              <h3 class="card-title">Cuentas por Cobrar</h3>
            </div>
            <div class="card-body text-center">
              <h2 class="text-success">₲<span id="cuentas-cobrar">0</span></h2>
              <p class="text-muted">Total Pendiente</p>
              <a href="<?php echo BASE_URL; ?>Ventas/cuentas-cobrar" class="btn btn-outline-success btn-sm">Ver Detalles</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-light">
              <h3 class="card-title">Estado del Día</h3>
            </div>
            <div class="card-body text-center">
              <h2 class="text-dark" id="estado-dia">Normal</h2>
              <p class="text-muted" id="fecha-actual">Cargando...</p>
              <a href="<?php echo BASE_URL; ?>Dashboard/resumen" class="btn btn-outline-dark btn-sm">Ver Resumen</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Footer -->
<?php include 'views/templates/footer.php'; ?>

<!-- Dashboard Scripts -->
<!-- Dashboard Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simular carga de datos (reemplazar con AJAX real)
    setTimeout(() => {
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_COMPRAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        document.getElementById('compras-pendientes').textContent = '5';
        document.getElementById('cuentas-pagar').textContent = '1.580.000';
        <?php endif; ?>
        
        <?php if (PermisosHelper::tienePermiso(PERMISO_VER_VENTAS) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        document.getElementById('ventas-hoy').textContent = '23';
        document.getElementById('cuentas-cobrar').textContent = '3.560.000';
        <?php endif; ?>
        
        <?php if (PermisosHelper::tieneAlgunPermiso([PERMISO_APERTURA_CAJA, PERMISO_CIERRE_CAJA, PERMISO_GENERAR_ARQUEO_CAJA]) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        document.getElementById('monto-caja').textContent = '₲ 1.500.000';
        <?php endif; ?>
        
        <?php if (PermisosHelper::tienePermiso(PERMISO_AJUSTAR_STOCK) || PermisosHelper::tienePermiso(PERMISO_ADMIN_TOTAL)): ?>
        document.getElementById('stock-minimo').textContent = '8';
        <?php endif; ?>
        
        // Fecha actual (siempre visible)
        const now = new Date();
        document.getElementById('fecha-actual').textContent = now.toLocaleDateString('es-ES', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    }, 500);
});
</script>

