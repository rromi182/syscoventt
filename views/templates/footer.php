<!-- Main Footer -->
<footer class="main-footer">
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">SyscoVent</a>.</strong>
  Todos los derechos reservados.
  <div class="float-right d-none d-sm-inline-block">
    <b>Versión</b> 1.0.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Título</h5>
    <p>Contenido del sidebar de control</p>
  </div>
</aside>
<!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->
 <!-- jQuery -->
<script src="<?php echo BASE_URL; ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BASE_URL; ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo BASE_URL; ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo BASE_URL; ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo BASE_URL; ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo BASE_URL; ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BASE_URL; ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo BASE_URL; ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo BASE_URL; ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>assets/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  const BASE_URL = "<?php echo BASE_URL; ?>";
</script>
<!-- Funciones -->
<script src="<?php echo BASE_URL; ?>assets/funciones/usuarios.js"></script>
<script src="<?php echo BASE_URL; ?>assets/funciones/marcas.js"></script>
<script src="<?php echo BASE_URL; ?>assets/funciones/categorias.js"></script>
<script src="<?php echo BASE_URL; ?>assets/funciones/articulos.js"></script>


<!-- Scripts adicionales personalizados -->
<?php if (isset($data['js'])): ?>
  <?php foreach ($data['js'] as $jsFile): ?>
    <script src="<?php echo BASE_URL . $jsFile; ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

<!-- Scripts de página específica -->
<?php if (isset($data['page_js'])): ?>
  <script>
    <?php echo $data['page_js']; ?>
  </script>
<?php endif; ?>