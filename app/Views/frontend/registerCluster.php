<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$title['1'];?> | Register</title>

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
  <link rel="stylesheet" href="<?=base_url()?>/dist/css/style.css">
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
<body class="hold-transition login-page">
<div class="login-box" style="opacity: 0.94;">
  <!-- /.login-logo -->
  <div class="card card-outline card-info">
    <div class="card-header text-center">
      <img src="<?=base_url('/img/'.lang('Constant.webLogo').'')?>" class="login-moral" />
      
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?=$title['1'];?></p>

      <div class="alert alert-warning text-center">เข้าใช้งานครั้งแรก กรุณากรอกข้อมูล</div>
      <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger text-center"><?= session()->getFlashdata('error'); ?></div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('fail')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
      <?php endif ?>

      <?php if (isset($validation)): ?>
          <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
      <?php endif ?>

      <form action="<?=base_url('/save_registerCluster')?>" id="registerCluster" method="post">
        <?= csrf_field(); ?>

        <div class="input-group mb-3">
          <select name="user_clus" id="user_clus" class="form-control" required>
            <option value="">-----เลือกเขตตรวจราชการ----</option>
            <?php foreach($cluster as $a){ ?>
            <option value="<?=$a['clus_id']?>" <?php if($a['clus_id'] == set_value('user_cluster')): echo 'selected'; endif; ?>><?=$a['clus_name']?></option>
            <?php } ?>
          </select>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="user_idcard" id="user_idcard" class="form-control" placeholder="เลขประชาชน" data-inputmask='"mask": "9999999999999"' data-mask>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="far fa-id-card"></span>
              </div>
            </div>
        </div> 
 
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="ตั้งรหัสผ่าน" required>
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

        <div class="input-group mb-3">
          <select name="user_prefix" id="user_prefix" class="form-control" required>
            <option value="">-------เลือกคำนำหน้า-------</option>
            <?php foreach($prefix as $v){ ?>
            <option value="<?=$v['prefix_title']?>" <?php if($v['prefix_title'] == set_value('user_prefix')): echo 'selected'; endif; ?>><?=$v['prefix_title']?></option>
            <?php } ?>
          </select>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="user_fname" class="form-control" placeholder="ชื่อ" value="<?= set_value('user_fname'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="user_lname" class="form-control" placeholder="นามสกุล" value="<?= set_value('user_lname'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="user_email" name="user_email" class="form-control" placeholder="อีเมล์" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="user_phone" name="user_phone" class="form-control" placeholder="เบอร์โทรศัพท์" data-inputmask='"mask": "999-9999999"' data-mask required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-info btn-block">บันทึกข้อมูล</button>
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
<script src="<?=base_url()?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function(){

        //เลือกเขตพื้นที่ฯจากเขตตรวจฯ
        $('#user_clus').change(function() {
            var code = $(this).val();
            $.ajax({
            url: "<?php echo base_url('/register/areaSearch');?>",
            type: "POST",
            dataType: "json",
            data: {
                "code": code
            },
            async: true,
            success: function(data) {
                var html = '';
                var i;
                html += '<option value="">เลือกเขตพื้นที่ฯ</option>';
                for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].area_code + '>' + data[i].area_name + '</option>';
                }
                $('#area_code').html(html);
                //$('#sch_code').html('<option value="">เลือกโรงเรียน</option>');
            }
            });
            return false;
        });

        //เลือกโรงเรียนจากเขตฯ
        $('#user_area').change(function() {
            var code = $(this).val();
            $.ajax({
            url: "<?php echo base_url('/register/schoolSearch');?>",
            type: "POST",
            dataType: "json",
            data: {
                "code": code
            },
            async: true,
            success: function(data) {
                var html = '';
                var i;
                html += '<option value="">เลือกโรงเรียน</option>';
                for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].sch_code + '>' + data[i].sch_name + '</option>';
                }
                $('#sch_id').html(html);
            }
            });
            return false;
        });

    });


function chkDigitPid() {
    var p_iPID = $("#user_idcard").val();
    var total = 0;
    var iPID;
    var chk;
    var Validchk;
    iPID = p_iPID.replace(/-/g, "");
    Validchk = iPID.substr(12, 1);
    var j = 0;
    var pidcut;
    for (var n = 0; n < 12; n++) {
        pidcut = parseInt(iPID.substr(j, 1));
        total = (total + ((pidcut) * (13 - n)));
        j++;
    }

    chk = 11 - (total % 11);

    if (chk == 10) {
        chk = 0;
    } else if (chk == 11) {
        chk = 1;
    }

    if (chk == Validchk) {
      $("#id-card-error").html('');
    } else {
      $("#id-card-error").html('หมายเลขประจำตัวประชาชนไม่ถูกต้อง');
      return false;
    }

}
</script>
<script>
  $(function() {
    $('[data-mask]').inputmask()
//    $("input[data-bootstrap-switch]").each(function() {
//      $(this).bootstrapSwitch('state', $(this).prop('checked'));
//    })
  });

  $(document).ready(function() {
      var timeout = 2000; // in miliseconds (3*1000)
      $('.alert').delay(timeout).fadeOut(1200);
  });
</script>
</body>
</html>