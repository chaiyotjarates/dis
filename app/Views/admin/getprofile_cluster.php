<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>

<!-- ส่วนของ Navbar -->
<?php echo view('template/navbar/navbar_admin'); ?>
<!-- ส่วนของ Sidebar -->
<?php echo view('template/sidebar/sidebar_admin'); ?>
  <!-- /.Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- ส่วนของ content_header -->
    <?php echo view('template/content_header'); ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center"><?php echo session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-left"><?php echo session()->getFlashdata('error'); ?></div>
        <?php endif ?>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
        <?php endif ?>
  
      <div class="card">

        <div class="card-header">
          <h3 class="card-title"><?=$title['1'];?><?=trim($user['user_prefix']).$user['user_fname']." ".$user['user_lname']?></h3>
        </div>

        <div class="card-body">

          <form action="<?=base_url('index.php/admin/updateprofile')?>" name="profile" id="profile" method="post" autocomplete="off"  enctype="multipart/form-data">


            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">รูปปัจจุบัน</label>
              <div class="col-sm-9">
                <?php if($user['user_profile'] != ""){ ?>
                  <img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>/uploads/profile/<?=$user['user_profile'];?>" />
                <?php }else{ ?>
                  <img class="profile-user-img img-fluid img-circle" src="<?=base_url('img/spt_logo.png')?>" />
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_idcard" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9" style="margin-top: 7px;">
                <?=$user['user_idcard']?>
            </div>
            </div>

            <div class="form-group row">
              <label for="user_idcard" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9" style="margin-top: 7px;">
                <?=$user['user_password']?>
            </div>
            </div>

            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">ชื่อ - สกุล </label>
              <div class="col-sm-9">
			        <?=$user['user_prefix']?><?=$user['user_fname']?>&nbsp;<?=$user['user_lname']?>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_email" class="col-sm-3 col-form-label">อีเมล์ </label>
              <div class="col-sm-9">
			        <?=$user['user_email']?>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_phone" class="col-sm-3 col-form-label">หมายเลขโทรศัพท์ </label>
              <div class="col-sm-9">
			        <?=$user['user_phone']?>
              </div>
            </div>

          </form>

        </div>
        <!-- /.card-body -->
        
      </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ส่วนของ script -->
  <?php echo view('template/script'); ?>

<script>

$(function () {
  
  $('[data-mask]').inputmask()

})

$(document).on('click', '#btn-submit', function(e) {
    e.preventDefault();
    swal({
      title: "ยืนยันการแก้ไขข้อมูล?",
      text: "หากท่านยืนยันการแก้ไข้อมูลให้กด OK เพื่อยืนยันข้อมูล",
      icon: "warning",
      buttons: true,
      primaryMode: true,
    })
    .then((updateProfile) => {
      if(updateProfile){
        $('#updateprofile').submit();
      }
    });
});


$(document).ready(function () {
  bsCustomFileInput.init();
});


</script>

    <!-- ส่วนของ Footer -->
    <?php echo view('template/footer'); ?>