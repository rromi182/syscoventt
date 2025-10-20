<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <title><?php echo $data['title'] ?? 'SyscoVent'; ?></title>

  <!-- CSS ADICIONAL -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">

  <!-- FAVICON -->
  <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/logo-syscovent.png" type="image/x-icon">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-colreorder/css/colReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-keytable/css/keyTable.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-scroller/css/scroller.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-searchbuilder/css/searchBuilder.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-searchpanes/css/searchPanes.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/datatables-select/css/select.bootstrap4.min.css">

  <!--SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- CSS de Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Select2 Bootstrap 5 theme (opcional pero recomendado) -->
  <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/plugins/summernote/summernote-bs4.min.css">

  <!-- CSS adicional personalizado -->
  <?php if (isset($data['css'])): ?>
    <?php foreach ($data['css'] as $cssFile): ?>
      <link rel="stylesheet" href="<?php echo BASE_URL . $cssFile; ?>">
    <?php endforeach; ?>
  <?php endif; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">