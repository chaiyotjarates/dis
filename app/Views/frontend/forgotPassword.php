<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo lang('Constant.webTitle_full');?></a> <?php echo lang('Constant.webAuth_Obec_Short');?> | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300;400&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/adminlte.min.css">
  <!-- Theme Custom -->
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="<?=base_url()?>/img/<?php echo lang('Constant.webLogo');?>" class="login-moral" />
      
    </div>
    <div class="card-body">
      <p class="login-box-msg">ลืมรหัสผ่าน ระบบคุรุชนคนคุณธรรม</p>

        <?php if(session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msg'); ?></div>
        <?php endif ?>
        <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif ?>
        <?php if(session()->getFlashdata('sent')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('sent'); ?></div>
        <?php endif ?>
        <?php if(isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors(); ?></div>
        <?php endif ?>

      <form action="<?=base_url('/forgot')?>" id="forgot" method="post">
        <?= csrf_field(); ?>


        <div class="w4l-form-group">
          <div class="group4">
            <div class="icheck-danger">
              <input class="input-checkbox100" id="ckb4" name="checktype" type="radio" value="4">
              <label for="ckb4" >
                ผู้ดูแลระบบ
              </label>
            </div>&nbsp;
            <div class="icheck-info">
              <input class="input-checkbox100" id="ckb3" name="checktype" type="radio" value="3" >
              <label for="ckb3" >
                เขตตรวจราชการ
              </label>
            </div>&nbsp;
          </div>
        </div>
        <div class="w4l-form-group">
          <div class="group4">
            <div class="icheck-primary">
              <input class="input-checkbox100" id="ckb2" name="checktype" type="radio" value="2" >
              <label for="ckb2" >
                เขตพื้นที่การศึกษา
              </label>
            </div>&nbsp;
            <div class="icheck-success">
              <input class="input-checkbox100" id="ckb1" name="checktype" type="radio" value="1" checked>
              <label for="ckb1" >
                โรงเรียน
              </label>
            </div>
          </div>
        </div>


        <div class="input-group mb-3">
          <input type="email" name="user_email" id="user_email" class="form-control" placeholder="กรอกอีเมล์" value="<?= set_value('user_email'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">ส่งข้อมูล</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0">
        <a href="<?=base_url('/login')?>" class="text-center">หากรีเซตรหัสผ่านแล้ว</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url()?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/dist/js/adminlte.min.js"></script>
</body>
</html>
