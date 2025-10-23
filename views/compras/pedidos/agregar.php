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
                    <h1 class="m-0">Nuevo Pedido de Compra</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>Dashboard">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>PedidosCompras">Pedidos</a></li>
                        <li class="breadcrumb-item active">Nuevo Pedido</li>
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
                    <h3 class="card-title">Formulario de Pedido</h3>
                </div>
                <form id="frmPedidoCompra">
                    <div class="card-body">

                        <!-- Información Básica -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_sucursal">Sucursal <span class="text-danger">*</span></label>
                                    <select class="form-control" id="id_sucursal" name="id_sucursal" required>
                                        <option value="">Seleccionar Sucursal</option>
                                        <?php foreach ($data['sucursales'] as $sucursal): ?>
                                            <option value="<?php echo $sucursal['id_sucursal']; ?>">
                                                <?php echo $sucursal['sucursal']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observacion">Observación</label>
                                    <textarea class="form-control" id="observacion" name="observacion"
                                        rows="2" placeholder="Observaciones adicionales..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Agregar Artículos -->
                        <div class="row">
                            <div class="col-12">
                                <h5>Agregar Artículos</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        <select class="form-control" id="id_articulo">
                                            <option value="">Seleccionar Artículo</option>
                                            <?php foreach ($data['articulos'] as $articulo): ?>
                                                <option value="<?php echo $articulo['id_articulo']; ?>"
                                                    data-descripcion="<?php echo $articulo['articulo_descrip']; ?>">
                                                    <?php echo $articulo['articulo_descrip']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="cantidad"
                                            placeholder="Cantidad" min="1" value="1">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary" onclick="agregarArticulo()">
                                            <i class="fas fa-plus"></i> Agregar Artículo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Artículos Agregados -->
                        <div class="row">
                            <div class="col-12">
                                <h5>Artículos del Pedido</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tblArticulos">
                                        <thead>
                                            <tr>
                                                <th>Artículo</th>
                                                <th width="150">Cantidad</th>
                                                <th width="100">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyArticulos">
                                            <!-- Los artículos se agregarán aquí dinámicamente -->
                                        </tbody>
                                        <tfoot id="tfootArticulos" style="display: none;">
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">
                                                    No hay artículos agregados
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar Pedido
                        </button>
                        <a href="<?php echo BASE_URL; ?>PedidosCompras" class="btn btn-default">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Footer -->
<?php include 'views/templates/footer.php'; ?>