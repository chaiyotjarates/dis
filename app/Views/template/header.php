<?php
$request = service('request');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="msapplication-TileImage" content="<?=base_url()?>/img/icon/ms-icon-144x144.png">
  <title>
	<?php echo lang('Constant.webTitle_full');?> <?php echo lang('Constant.webAuth_Obec_Short');?> : OBEC</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300;400&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/adminlte.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- date picker -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/datepicker/css/bootstrap-datepicker3.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/summernote/summernote-bs4.min.css">
  <!-- bootstrap-switch -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css" >

  <link href="<?=base_url()?>/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="<?=base_url()?>/plugins/sweetalert3/sweetalert3.css" rel="stylesheet" />

  <!--<link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />-->
  <!-- Theme Custom -->
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/style.css">
  <style>
    /*-- /progress --*/
  .bs4-order-tracking{margin-bottom: 30px;overflow: hidden;color: #878788;padding-left: 0px;margin-top: 30px}
  .bs4-order-tracking li{list-style-type: none;font-size: 13px;width: 25%;float: left;position: relative;font-weight: 400;color: #878788;text-align: center}
  .bs4-order-tracking li:first-child:before{margin-left: 15px !important;padding-left: 11px !important;text-align : left !important}
  .bs4-order-tracking li:last-child:before{margin-right: 5px !important;padding-right: 11px !important;text-align : right !important}
  .bs4-order-tracking li>div{color: #fff;width: 29px;text-align: center;line-height: 29px;display: block;font-size: 12px;background: #878788;border-radius: 50%;margin: auto}
  .bs4-order-tracking li:after{content: '';width: 150%;height: 2px;background: #878788;position: absolute;left: 0%;right: 0%;top: 15px;z-index: -1}
  .bs4-order-tracking li:first-child:after{left: 50%}
  .bs4-order-tracking li:last-child:after{left: 0%!important;width: 0% !important}
  .bs4-order-tracking li.active{font-weight: bold;color: #dc3545}
  .bs4-order-tracking li.active>div{background: #dc3545}
  .bs4-order-tracking li.active:after{background: #dc3545}
  .card-timeline{background-color: #fff;z-index: 0}
  </style>
<link rel="apple-touch-icon" sizes="57x57" href="<?=base_url()?>/img/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=base_url()?>/img/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url()?>/img/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>/img/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url()?>/img/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url()?>/img/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=base_url()?>/img/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url()?>/img/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>/img/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=base_url()?>/img/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>/img/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>/img/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>/img/icon/favicon-16x16.png">
<link rel="manifest" href="/assets/img/favicon/manifest.json">
<link rel="shortcut icon" href="<?=base_url()?>/img/icon/favicon.ico">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
