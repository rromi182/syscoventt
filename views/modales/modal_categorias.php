<!-- Modal para Nueva/Editar Categoría -->
<div class="modal fade" id="modalAgregarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Agregar Nueva Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmAgregarCategoria" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <!-- Columna Izquierda - Información Principal -->
                        <div class="col-md-12">
                            <!-- Card de Información de la Categoría -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-layer-group mr-2"></i>
                                        Información de la Categoría
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <!-- Campo Oculto para ID -->
                                    <input type="hidden" name="id_categoria" id="id_categoria">
                                    
                                    <!-- Nombre de la Categoría -->
                                    <div class="form-group">
                                        <label for="nombre_categoria" class="font-weight-bold">Descripción de la Categoría *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-layer-group"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" 
                                                   placeholder="Ingrese la descripción de la categoría" required>
                                        </div>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>El nombre debe ser único en el sistema
                                        </small>
                                    </div>

                                    <!-- Estado -->
                                    <div class="form-group">
                                        <label class="font-weight-bold">Estado</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="estado_categoria" name="estado_categoria" checked>
                                            <label class="custom-control-label" for="estado_categoria">ACTIVO</label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Las categorías inactivas no estarán disponibles para nuevos artículos
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
                        <i class="fas fa-save mr-1"></i>Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>