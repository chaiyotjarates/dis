<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo lang('Constant.webTitle_full');?> <?php echo lang('Constant.webAuth_Obec_Short');?> | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300;400&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/adminlte.css">
  <!-- Theme Custom -->
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/style_login.css">
</head>
<body >

<section class="ftco-section" >
		<div class="container" >
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-4" style="opacity: 0.94;">
		      	<div class="icon d-flex align-items-center justify-content-center">
              <img src="<?=base_url('/img/'.lang('Constant.webLogo').'')?>" class="login-moral" >
		      	</div>
            <p class="login-box-msg"><?=lang('Constant.webTitle_full');?></p>
            <?php if(session()->getFlashdata('msg')) : ?>
            <div class="alert alert-warning text-center"><?= session()->getFlashdata('msg'); ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('success')) : ?>
              <div class="alert alert-success text-center"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('fail')) : ?>
              <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
            <?php endif ?>

						<form action="<?=base_url('/login/auth')?>" id="login" method="post">
            <?= csrf_field(); ?>
            <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้งาน" value="<?= set_value('username'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          
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
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">เข้าระบบ</button>
	            </div>
	            <div class="form-group d-md-flex">
                <p class="mb-1">
                  ลงทะเบียน 
                  <a href="<?=base_url('/registerSchool')?>" class="text-center">โรงเรียน</a> | 
                  <a href="<?=base_url('/registerArea')?>" class="text-center">เขตพื้นที่ฯ</a> | 
                  <a href="<?=base_url('/registerCluster')?>" class="text-center">เขตตรวจฯ</a> | 
                  <a href="<?=base_url('/registerAdmin')?>" class="text-center">Admin</a> 
                </p>
              </div>
              <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<!--<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>-->
								</div>
								<div class="w-50 text-md-right">
									<a href="<?=base_url('/forgotPassword')?>">ลืมรหัสผ่าน</a>
								</div>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

<!-- jQuery -->
<script src="<?=base_url()?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/dist/js/adminlte.min.js"></script>
<script>
  $(document).ready(function() {
      var timeout = 2000; // in miliseconds (3*1000)
      $('.alert').delay(timeout).fadeOut(1200);
  });
</script>
</body>
</html>
 