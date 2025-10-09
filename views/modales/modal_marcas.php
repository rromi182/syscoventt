

<!-- Modal para Nueva/Editar Marca -->
<div class="modal fade" id="modalAgregarMarca">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Agregar Nueva Marca</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmAgregarMarca" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <!-- Columna Izquierda - Información Principal -->
                        <div class="col-md-12">
                            <!-- Card de Información de la Marca -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-tag mr-2"></i>
                                        Información de la Marca
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <!-- Campo Oculto para ID -->
                                    <input type="hidden" name="id_marca" id="id_marca">
                                    
                                    <!-- Nombre de la Marca -->
                                    <div class="form-group">
                                        <label for="nombre_marca" class="font-weight-bold">Descripción de la Marca *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-tag"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="nombre_marca" name="nombre_marca" 
                                                   placeholder="Ingrese la descripción de la marca" required>
                                        </div>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>El nombre debe ser único en el sistema
                                        </small>
                                    </div>

                                    <!-- Estado -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Estado</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="estado" name="estado" checked>
                                            <label class="custom-control-label" for="estado">ACTIVO</label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Las marcas inactivas no estarán disponibles para nuevos productos
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Guardar Marca
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>