<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ลงทะเบียน | Register</title>

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
      <img src="<?=base_url('/img/'.lang('Constant.webLogo').'')?>" class="login-moral" />
      
    </div>
    <div class="card-body">
      <p class="login-box-msg">ลงทะเบียน</p>

      <div class="alert alert-warning text-center">เข้าใช้งานครั้งแรก กรุณากรอกข้อมูล</div>

      <?php if(session()->getFlashdata('fail')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
      <?php endif ?>

      <?php if (isset($validation)): ?>
          <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
      <?php endif ?>

      <form action="<?=base_url('/register')?>" id="register" method="post">
        <?= csrf_field(); ?>

        <div class="input-group mb-3">
          <select name="user_cluster" id="user_cluster" class="form-control" required>
            <option value="">-----เลือกเขตตรวจราชการ----</option>
            <?php foreach($cluster as $a){ ?>
            <option value="<?=$a['clus_id']?>" <?php if($a['clus_id'] == set_value('user_cluster')): echo 'selected'; endif; ?>><?=$a['clus_name']?></option>
            <?php } ?>
          </select>
        </div>

        <div class="input-group mb-3">
          <select name="user_area" id="user_area" class="form-control" required>
              <option value="<?=$area_code?>" selected>เขตพื้นที่การศึกษา : <?=$area_name?></option>
          </select>
        </div>

        <div class="input-group mb-3">
          <select name="sch_id" id="sch_id" class="form-control" required>
              <option value="<?=$sch_id?>" selected>โรงเรียน : <?=$sch_name." (".$sch_code.")"?></option>
          </select>
        </div>

        <div class="input-group mb-3">
          <select name="user_prefix" id="user_prefix" class="form-control" required>
            <option value="">-------เลือกคำนำหน้า-------</option>
            <?php foreach($prefix as $v){ ?>
            <option value="<?=$v['prefix_title']?>" <?php if($v['prefix_title'] == set_value('user_prefix')): echo 'selected'; endif; ?>><?=$v['prefix_title']?></option>
            <?php } ?>
          </select>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="user_fname" class="form-control" placeholder="ชื่อผู้ดูแล" value="<?= set_value('user_fname'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="user_lname" class="form-control" placeholder="นามสกุลผู้ดูแล" value="<?= set_value('user_lname'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
 
        <div class="input-group mb-3">
          <input type="password" name="user_password" class="form-control" placeholder="ตั้งรหัสผ่าน" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="user_confpassword" class="form-control" placeholder="ยืนยันรหัสผ่านอีกครั้ง" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            
          </div>
          <!-- /.col -->
          <div class="col-6">
            <input type="hidden" value="<?=$sch_code?>" name="user" />
            <button type="submit" class="btn btn-primary btn-block">บันทึกข้อมูล</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0">
        <a href="<?=base_url('/login')?>" class="text-center"> <i class="far fa-arrow-left"></i> กลับไปยังหน้า Login</a><br>
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