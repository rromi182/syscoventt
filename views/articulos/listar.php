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
          <h1 class="m-0">Mantener de Articulos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>Dashboard">Inicio</a></li>
            <li class="breadcrumb-item active">Articulos</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de Articulos</h3>
          <button class="btn btn-success btn-bg float-right add-articulo" onclick="frmAgregarArticulo()">
            <i class="fas fa-plus"></i> Agregar
          </button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <table id="tblArticulos" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  </tfoot>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<!-- Modal para Nuevo/Editar Articulos -->
<?php include 'views/modales/modal_articulos.php'; ?>

<!-- Footer -->
<?php include 'views/templates/footer.php'; ?>