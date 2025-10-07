<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Dicer">
  <meta name="generator" content="Hugo 0.98.0">
  <meta name="theme-color" content="#712cf9">
  <base href="<?= APP_URL ?>">
  <title><?= APP_NAME; ?></title>

  <link rel="shortcut icon" href="<?= APP_URL; ?>assets/logo/logo.jpg" type="image/x-icon">
  <link rel="icon" href="<?= APP_URL; ?>assets/logo/logo.jpg" type="image/x-icon">

  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" SameSite=None> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/css/bootstrap.min.css"> -->

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="assets/vendors/font-awesome/css/all.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


  <link rel="stylesheet" type="text/css" href="assets/vendors/tiny-slider/tiny-slider.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/choices/css/choices.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/glightbox/css/glightbox.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/quill/css/quill.snow.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/overlay-scrollbar/css/OverlayScrollbars.min.css">


  <!-- Theme CSS -->
  <link id="style-switch" rel="stylesheet" type="text/css" href="assets/css/style.css">

  <?php

  use App\Models\User;

  if (User::isLoggedIn()) { ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Fancy File Upload -->
    <link rel="stylesheet" href="assets/vendors/fancy-file-uploader/fancy_fileupload.css" type="text/css" media="all" />

    <link rel="stylesheet" type="text/css" href="assets/vendors/summernote/summernote-lite.min.css">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap5.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
  <?php } ?>

  <link href="assets/css/style.min.css" rel="stylesheet">

  <!--respons-->
  <link rel="stylesheet" href="assets/vendors/sweetaleart2.min.css">
  <script src="assets/vendors/sweetalert2.all.min.js"></script>
  <script src="assets/js/myalerts.js"></script>

  <!-- Custom styles for this template -->
</head>

<body class="app-body">