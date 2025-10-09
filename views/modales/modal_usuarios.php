<!-- Modal para Nuevo/Editar Usuario -->
<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Agregar Nuevo Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frmAgregarUsuario" method="POST">
        <div class="modal-body">
          <div class="row">
            <!-- Columna Izquierda -->
            <div class="col-md-6">
              <!-- Card de Información del Empleado -->
              <div class="card card-primary card-outline" id="infoEmpleadoCard" style="display: none;">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-user-tie mr-2"></i>
                    Información del Empleado
                  </h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm">
                    <tr>
                      <td style="width: 40%;"><strong>Nombre:</strong></td>
                      <td><span id="infoNombre" class="text-primary"></span></td>
                    </tr>
                    <tr>
                      <td><strong>Cargo:</strong></td>
                      <td><span id="infoCargo" class="text-muted"></span></td>
                    </tr>
                    <tr>
                      <td><strong>Email:</strong></td>
                      <td><span id="infoEmail"></span></td>
                    </tr>
                    <tr>
                      <td><strong>Sucursal:</strong></td>
                      <td><span id="infoSucursal"></span></td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- Selección de Empleado -->
              <div class="form-group">
                <label for="id_empleado" class="font-weight-bold">Empleado *</label>
                <select class="form-control" id="id_empleado" name="id_empleado" required>
                  <option value="">Seleccionar empleado</option>
                  <?php if (isset($empleados) && !empty($empleados)): ?>
                    <?php foreach ($empleados as $empleado): ?>
                      <option value="<?php echo $empleado['id_empleado']; ?>">
                        <?php echo $empleado['per_nombre'] . ' ' . $empleado['per_apellido'] . ' - ' . $empleado['cargo']; ?>
                      </option>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <option value="">No hay empleados disponibles</option>
                  <?php endif; ?>
                </select>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle mr-1"></i>Solo se muestran empleados sin usuario activo
                </small>
              </div>


              <!-- Sucursal -->
              <div class="form-group">
                <label for="id_sucursal" class="font-weight-bold">Sucursal *</label>
                <select class="form-control" id="id_sucursal" name="id_sucursal" required>
                  <option value="">Seleccionar sucursal</option>
                  <?php if (isset($sucursales) && !empty($sucursales)): ?>
                    <?php foreach ($sucursales as $sucursal): ?>
                      <!-- NOTA: El campo puede llamarse 'sucursal' o 'nombre' -->
                      <option value="<?php echo $sucursal['id_sucursal']; ?>">
                        <?php echo $sucursal['sucursal'] ?? $sucursal['nombre'] ?? 'Sin nombre'; ?>
                      </option>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <option value="">No hay sucursales disponibles</option>
                  <?php endif; ?>
                </select>
              </div>
            </div>

            <!-- Columna Derecha -->
            <div class="col-md-6">
              <!-- Card de Credenciales de Usuario -->
              <div class="card card-info card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-key mr-2"></i>
                    Credenciales de Acceso
                  </h3>
                </div>
                <div class="card-body">
                  <!-- Username -->
                  <div class="form-group">
                    <label for="username" class="font-weight-bold">Nombre de Usuario *</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="username" name="username"
                        placeholder="Ingrese el nombre de usuario" required>
                    </div>
                    <small class="form-text text-muted">
                      El username debe ser único en el sistema
                    </small>
                  </div>

                  <!-- Password -->
                  <div class="form-group">
                    <label for="password" class="font-weight-bold">Contraseña *</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control" id="password" name="password"
                        placeholder="Ingrese la contraseña" required>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                          <i class="fas fa-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Confirm Password -->
                  <div class="form-group">
                    <label for="confirm_password" class="font-weight-bold">Confirmar Contraseña *</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                        placeholder="Confirme la contraseña" required>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                          <i class="fas fa-eye"></i>
                        </button>
                      </div>
                    </div>
                    <div id="passwordMatch" class="mt-1"></div>
                  </div>

                  <!-- Estado (si lo necesitas) -->
                  <div class="form-group">
                    <label class="font-weight-bold">Estado</label>
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="estado" name="estado" checked>
                      <label class="custom-control-label" for="estado">Usuario Activo</label>
                    </div>
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
            <i class="fas fa-save mr-1"></i>Guardar Usuario
          </button>
        </div>
      </form>
    </div>
  </div>
</div>