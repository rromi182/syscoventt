<!-- Modal para Nuevo/Editar Artículo -->
<div class="modal fade" id="modalAgregarArticulo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Nuevo Artículo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <form id="frmAgregarArticulo" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <!-- Columna Izquierda -->
            <div class="col-md-6">
              <!-- Código -->
              <div class="form-group">
                <label for="codigo" class="font-weight-bold">Código Ref. de Articulo *</label>
                <input type="text" class="form-control" id="codigo" name="codigo" 
                       placeholder="Ingrese el código del artículo" >
              </div>

              <!-- Descripción -->
              <div class="form-group">
                <label for="descripcion" class="font-weight-bold">Descripción *</label>
                <textarea class="form-control" id="descripcion" name="descripcion" 
                          placeholder="Ingrese la descripción del artículo" rows="3" ></textarea>
              </div>

              <!-- Precio -->
              <div class="form-group">
                <label for="precio" class="font-weight-bold">Precio *</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₲</span>
                  </div>
                  <input type="number" class="form-control" id="precio" name="precio" 
                         placeholder="Ingrese el precio"  min="0" maxlength="9999999" >
                </div>
              </div>

              <!-- Stock -->
              <div class="form-group">
                <label for="stock_minimo" class="font-weight-bold">Stock Minimo *</label>
                <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" 
                       placeholder="Ingrese la cantidad minima para el stock" min="1" >
              </div>
            </div>

            <!-- Columna Derecha -->
            <div class="col-md-6">
              <!-- Marca -->
              <div class="form-group">
                <label for="id_marca" class="font-weight-bold">Marca *</label>
                <select class="form-control" id="id_marca" name="id_marca" >
                  <option value="">Seleccionar marca</option>
                  <?php if (isset($marcas) && !empty($marcas)): ?>
                    <?php foreach ($marcas as $marca): ?>
                      <option value="<?php echo $marca['id_marca']; ?>">
                        <?php echo $marca['marca_descrip']; ?>
                      </option>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <option value="">No hay marcas disponibles</option>
                  <?php endif; ?>
                </select>
              </div>

              <!-- Categoría -->
              <div class="form-group">
                <label for="id_categoria" class="font-weight-bold">Categoría *</label>
                <select class="form-control" id="id_categoria" name="id_categoria" >
                  <option value="">Seleccionar categoría</option>
                  <?php if (isset($categorias) && !empty($categorias)): ?>
                    <?php foreach ($categorias as $categoria): ?>
                      <option value="<?php echo $categoria['id_categoria']; ?>">
                        <?php echo $categoria['categoria_descrip']; ?>
                      </option>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <option value="">No hay categorías disponibles</option>
                  <?php endif; ?>
                </select>
              </div>

              <!-- Imagen -->
              <div class="form-group">
                <label for="imagen" class="font-weight-bold">Imagen</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="imagen" name="imagen" 
                         accept="image/*">
                  <label class="custom-file-label" for="imagen">Seleccionar archivo</label>
                </div>
                <small class="form-text text-muted">
                  Formatos permitidos: JPG, JPEG, PNG. Tamaño máximo: 2MB
                </small>
                <!-- Vista previa de imagen -->
                <div id="vistaPrevia" class="mt-2 text-center" style="display: none;">
                  <img id="previewImg" src="#" alt="Vista previa" class="img-thumbnail" style="max-height: 150px;">
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
            <i class="fas fa-save mr-1"></i>Guardar 
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal para visor de imágenes -->
<div class="modal fade" id="modalImagen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloImagen">Vista de imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="imagenAmpliada" src="" alt="Imagen ampliada" class="img-fluid" style="max-height: 50vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>